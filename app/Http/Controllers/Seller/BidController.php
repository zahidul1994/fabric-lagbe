<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\ProductBid;
use App\Model\Review;
use App\Model\SaleRecord;
use App\Model\Seller;
use App\Model\Vat;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\UserInfo;

class BidController extends Controller
{
    public function index(){
        $product_bids = ProductBid::where('receiver_user_id',Auth::id())->where('bid_status',1)->latest()->get();
        return view('frontend.seller.product_bids.index',compact('product_bids'));
    }
    public function getBidderList($slug){
        $product = Product::where('slug',$slug)->first();
        $product_bids = ProductBid::where('product_id',$product->id)->latest()->get();
        return view('frontend.seller.product_bids.bidder_list',compact('product_bids'));
    }
    public function getBidderDetails($id){
        $product_bid = ProductBid::find($id);
        $bidder = User::where('id',$product_bid->sender_user_id)->first();
        return view('frontend.seller.product_bids.bidder_details',compact('product_bid','bidder'));
    }
    public function chatWithAdmin($id){
        $saleRecord = SaleRecord::where('product_bid_id',$id)->first();
        $seller = User::where('id',$saleRecord->seller_user_id)->first();
        return view('frontend.seller.product_bids.chat_with_admin',compact('saleRecord','seller'));
    }

    public function bidAccept($id){
        $product_bid = ProductBid::find($id);
//        $check = ProductBid::where('id',$id)->where('bid_status',1)->first();
        $checkProduct = Product::find($product_bid->product_id);
        $checkForCommission = SaleRecord::where('product_id',$checkProduct->id)->where('product_bid_id',$id)->first();
        if (empty(!$checkForCommission)){
            Toastr::warning('You have already accepted bid for this product');
            return back();
        }

        $get_invoice_code = SaleRecord::orderBy('created_at','DESC')->first();;
        if(!empty($get_invoice_code)){
            $invoice_no = "FLL".date('Y')."-".str_pad($get_invoice_code->id + 1, 8, "0", STR_PAD_LEFT);;
        }else{
            $invoice_no = "FLL".date('Y')."-"."00000001";
        }



        $product_bid->bid_status = 1;
        $seller = Seller::where('user_id',$product_bid->receiver_user_id)->first();

        //$adminCommission = ($product_bid->bid_price * sellerCurrentCommission($product_bid->receiver_user_id))/100;
        $commission = ($product_bid->total_bid_price * sellerCurrentCommission($product_bid->receiver_user_id))/100;
        $vat = vat($commission);
        $admin_commission = $commission + $vat;

        $seller->pay_to_admin += $admin_commission;
        $seller->save();
        $product_bid->save();

        $saleRecord = new SaleRecord();
        $saleRecord->seller_user_id = Auth::id();
        if($product_bid->receiver_user_id == Auth::id()){
            $saleRecord->buyer_user_id = $product_bid->sender_user_id;
            $saleRecord->type = 'seller_product';
        } else{
            $saleRecord->buyer_user_id = $product_bid->receiver_user_id;
            $saleRecord->type = 'requested_product';
        }

        $commission = ($product_bid->total_bid_price * sellerCurrentCommission($product_bid->receiver_user_id))/100;
        $vat = vat($commission);
        $admin_commission = $commission + $vat;

        $saleRecord->product_id = $product_bid->product_id;
        $saleRecord->product_bid_id = $product_bid->id;
        $saleRecord->membership_package_id = checkMembershipStatus(Auth::id());
        $saleRecord->amount = $product_bid->total_bid_price;
        $saleRecord->commission = $commission;
        $saleRecord->vat_percentage = \App\Model\Vat::first()->vat_percentage;
        $saleRecord->vat = $vat;
        $saleRecord->admin_commission = $admin_commission;
        $saleRecord->payment_status = 'Pending';
        $saleRecord->buy_status = 0;
        $saleRecord->invoice_code = $invoice_no;
        $saleRecord->save();

        $product = Product::find($product_bid->product_id);
        $product->bid_status = 'Accepted';
        $product->save();

        $user = User::where('id',$product_bid->sender_user_id)->first();
        $title = 'Accepted Bid';
        $message = 'Dear,'. $user->name .' your bid for "'. $product->name .'" product has been accepted.';
        createNotification($user->id,$title,$message);
        if($user->country_code == '+880') {
            UserInfo::smsAPI('880' . $user->phone, $message);
            SmsNotification($user->id,$title,$message);
        }

        //Bid Reject.............
        $productBidRejects = ProductBid::where('product_id',$product->id)->where('bid_status',0)->get();
        foreach ($productBidRejects as $productBidReject){
            $title = 'Bid Rejected';
            $message = 'Dear,'. $productBidReject->sender->name .' your bid for "'. $product->name .'" product has been rejected.';
            createNotification($productBidReject->sender_user_id,$title,$message);
            if($user->country_code == '+880') {
                UserInfo::smsAPI('880' . $productBidReject->sender->phone, $message);
                SmsNotification($productBidReject->sender_user_id,$title,$message);
            }
        }

        Toastr::success('Bidder Accepted Successfully');
        return redirect()->route('seller.product-bids.list');
    }
    public function getAcceptedBidderDetails($id){
        $product_bid = ProductBid::find($id);
        $buyer = User::where('id',$product_bid->sender_user_id)->first();
        return view('frontend.seller.product_bids.accepted_bidder_details',compact('product_bid','buyer'));
    }
    public function saleRecordStore(Request $request){
        $product_bid = ProductBid::find($request->product_bid_id);
        $saleRecord = SaleRecord::where('product_bid_id',$product_bid->id)->first();
        $review_check = Review::where('sender_user_id',Auth::id())->where('product_id',$product_bid->product_id)->first();

        if (empty($review_check)){
            $review = new Review();
            $review->sender_user_id = Auth::id();
            $review->receiver_user_id = $saleRecord->buyer_user_id;
            $review->product_id = $product_bid->product_id;
            $review->rating = $request->rating;
            $review->comment = $request->comment;
            $review->save();

            if($review->save()){
                $product = Product::findOrFail($product_bid->product_id);
                if(count(Review::where('product_id', $product->id)->where('status', 1)->get()) > 0){
                    $product->rating = Review::where('product_id', $product->id)->where('status', 1)->sum('rating')/count(Review::where('product_id', $product->id)->where('status', 1)->get());
                }
                else {
                    $product->rating = 0;
                }
                $product->save();
            }

            Toastr::success('Successfully received sales record.');
            if($saleRecord->type == 'seller_product'){
                return redirect()->route('seller.recorded-transaction.list');
            } else{
                return redirect()->route('seller.requested-recorded-transaction.list');
            }
        }else{
            Toastr::error('You have already reviewed this buyer');
            return redirect()->back();
        }

    }
    public function acceptedBidList(){
        $product_bids = ProductBid::where('sender_user_id',Auth::id())->where('bid_status',1)->latest()->get();
        return view('frontend.seller.product_bids.accepted_bid_list',compact('product_bids'));
    }
    public function getRequestedBuyersDetails($id){
        $product_bid = ProductBid::find($id);
        $buyer = User::where('id',$product_bid->receiver_user_id)->first();
        return view('frontend.seller.product_bids.accepted_bidder_details',compact('product_bid','buyer'));
    }

    public function myBids(){
        $product_bids = ProductBid::where('sender_user_id',Auth::id())->latest()->get();
        return view('frontend.seller.product_bids.my_bids',compact('product_bids'));
    }
}
