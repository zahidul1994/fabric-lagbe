<?php

namespace App\Http\Controllers\Api;

use App\Helpers\UserInfo;
use App\Http\Controllers\Controller;
use App\Http\Resources\AcceptedBiddersDetailsCollection;
use App\Http\Resources\AcceptedBidRequestCollection;
use App\Http\Resources\AcceptedBidRequestedCollection22;
use App\Http\Resources\AcceptedBuyerDetailsCollection;
use App\Http\Resources\BidderDetailsCollection;
use App\Http\Resources\BidderListCollection;
use App\Http\Resources\BuyerRecordedTransactionCollection;
use App\Http\Resources\ProductBidCollection;
use App\Http\Resources\ProductMyBidCollection;
use App\Http\Resources\ProductsListCollection;
use App\Http\Resources\SellerRecordedTransactionCollection;
use App\Http\Resources\TransactionListCollection;
use App\Model\PaymentHistory;
use App\Model\Product;
use App\Model\ProductBid;
use App\Model\SaleRecord;
use App\Model\Seller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductBidController extends Controller
{
    public function productBidSubmit(Request $request){
        $product = Product::find($request->product_id);
        $bidCheck = ProductBid::where('product_id',$product->id)->where('sender_user_id',Auth::id())->first();

        $membership_package_id = checkMembershipStatus(Auth::id());
        $user_type = checkUserType(Auth::id());
        if($user_type == 'seller' && $membership_package_id == 1){
            return response()->json(['success'=>false,'response'=>'Upgrade your membership package!'], 401);
        }
        if($request->currency_id != 27){
            $bid_price = convert_to_bdt($request->unit_bid_price);
        }else{
            $bid_price = $request->unit_bid_price;
        }
        if (empty($bidCheck)){
            $productBid = new ProductBid();
            $productBid->sender_user_id = Auth::id();
            $productBid->receiver_user_id = $product->user_id;
            $productBid->product_id = $request->product_id;
            $productBid->unit_bid_price = $bid_price;
            $productBid->bid_status = 0;

            if ($request->bid_type && $request->bid_quantity){
                $productBid->bid_type = $request->bid_type;
                if ($request->bid_type == 'partial'){
                    $productBid->total_bid_price = $bid_price * $request->bid_quantity;
                    $productBid->bid_quantity = $request->bid_quantity;
                }else{
                    $productBid->total_bid_price = $bid_price * $product->quantity;
                    $productBid->bid_quantity = $product->quantity;
                }
            }else{
                $productBid->bid_type = 'full';
                $productBid->total_bid_price = $bid_price * $product->quantity;
                $productBid->bid_quantity = $product->quantity;
            }


            $productBid->save();
            $bidder = User::where('id',$productBid->sender_user_id )->first();

            $user = User::where('id',$productBid->receiver_user_id )->first();

            //$productOwnerInfo = productOwnerInfo($request->product_id);
            $title = 'Placed Bid';
            $message = $product->name.'" has been bidden by '.$bidder->name.' with '.$productBid->unit_bid_price.currency()->symbol.' unit bid amount';
            placedBidNotification($product->id,$product->user->id,$title,$message);
            if($user->country_code == '+880') {
                UserInfo::smsAPI('880'.$user->phone, $message);
                SmsNotification($user->id,$title,$message);
            }

            if(!empty($productBid))
            {
                return response()->json(['success'=>true,'response' => 'Your bid placed successfully '], 201);
            }else{
                return response()->json(['success'=>false,'response'=>'Something went wrong'], 401);
            }


        }else{
            return response()->json(['success'=>false,'response'=>'You have already bidden for this products.'], 401);
        }

    }
    public function bidderList($id){
        $product_bids = ProductBid::where('receiver_user_id',Auth::id())->where('product_id',$id)->get();
        return new BidderListCollection($product_bids);

    }
    public function bidderListV2(Request $request,$id){
        $name = $request->search;
        $orderBy = $request->order_by ?? 'desc' ;
        $product_bids = ProductBid::join('products','products.id','=','product_bids.product_id')
            ->join('units','products.unit_id','=','units.id')
            ->where('product_bids.receiver_user_id',Auth::id())
            ->where('product_bids.product_id',$id)
            ->where(function($query) use ($name){
                $query->where('products.name', 'like', '%'.$name.'%')
                    ->orWhere('products.name_bn', 'like', '%'.$name.'%')
                    ->orWhere('products.quantity', 'like', '%'.$name.'%')
                    ->orWhere('units.name', 'like', '%'.$name.'%')
                    ->orWhere('units.name_bn', 'like', '%'.$name.'%')
                    ->orWhere('product_bids.unit_bid_price', 'like', '%'.$name.'%')
                    ->orWhere('product_bids.total_bid_price', 'like', '%'.$name.'%');
            })
            ->select('product_bids.*')
            ->orderBy('product_bids.created_at',$orderBy)
            ->paginate($request->page_size);

        return new BidderListCollection($product_bids);

    }
    public function getBidderDetails($id){
        $product_bid = ProductBid::where('id',$id)->get();
        return new BidderDetailsCollection($product_bid);

    }
    public function sellerAcceptedBids(){
        $accepted_bids = ProductBid::where('receiver_user_id',Auth::id())->where('bid_status',1)->latest()->get();
        return new ProductBidCollection($accepted_bids);
    }
    public function sellerAcceptedBidsV2(Request $request){
        $name = $request->search;
        $orderBy = $request->order_by ?? 'desc' ;
        $accepted_bids = ProductBid::join('products','products.id','=','product_bids.product_id')
            ->join('units','products.unit_id','=','units.id')
            ->where('product_bids.receiver_user_id',Auth::id())
            ->where('product_bids.bid_status',1)
            ->where(function($query) use ($name){
                $query->where('products.name', 'like', '%'.$name.'%')
                    ->orWhere('products.name_bn', 'like', '%'.$name.'%')
                    ->orWhere('products.quantity', 'like', '%'.$name.'%')
                    ->orWhere('units.name', 'like', '%'.$name.'%')
                    ->orWhere('units.name_bn', 'like', '%'.$name.'%')
                    ->orWhere('product_bids.unit_bid_price', 'like', '%'.$name.'%')
                    ->orWhere('product_bids.total_bid_price', 'like', '%'.$name.'%');
            })
            ->select('product_bids.*')
            ->orderBy('product_bids.created_at',$orderBy)
            ->paginate($request->page_size);

//        $accepted_bids = ProductBid::where('receiver_user_id',Auth::id())->where('bid_status',1)->latest()->get();
        return new ProductBidCollection($accepted_bids);
    }
    public function AcceptedBidderDetails($id){

        return new AcceptedBiddersDetailsCollection(ProductBid::where('id',$id)->get());
    }
    public function AcceptedBuyerDetails($id){
        return new AcceptedBuyerDetailsCollection(ProductBid::where('id',$id)->get());
    }
    public function buyerAcceptedBids(){
        $accepted_bids = ProductBid::where('sender_user_id',Auth::id())->where('bid_status',1)->latest()->get();
        return new ProductBidCollection($accepted_bids);
    }
    public function buyerAcceptedBidsV2(Request $request){
        $name = $request->search;
        $orderBy = $request->order_by ?? 'desc' ;
        $accepted_bids = ProductBid::join('products','products.id','=','product_bids.product_id')
            ->join('units','products.unit_id','=','units.id')
            ->where('product_bids.sender_user_id',Auth::id())
            ->where('product_bids.bid_status',1)
            ->where(function($query) use ($name){
                $query->where('products.name', 'like', '%'.$name.'%')
                    ->orWhere('products.name_bn', 'like', '%'.$name.'%')
                    ->orWhere('products.quantity', 'like', '%'.$name.'%')
                    ->orWhere('units.name', 'like', '%'.$name.'%')
                    ->orWhere('units.name_bn', 'like', '%'.$name.'%')
                    ->orWhere('product_bids.unit_bid_price', 'like', '%'.$name.'%')
                    ->orWhere('product_bids.total_bid_price', 'like', '%'.$name.'%');
            })
            ->select('product_bids.*')
            ->orderBy('product_bids.created_at',$orderBy)
            ->paginate($request->page_size);

        return new ProductBidCollection($accepted_bids);
    }
    public function sellerMyBids(){
        // $my_bids = ProductBid::where('sender_user_id',Auth::id())->latest()->get();
      


        $my_bids = ProductBid::where('sender_user_id',Auth::id())->where('bid_as','seller')->latest()->get();
        

        return new ProductMyBidCollection($my_bids);
    }
    public function sellerMyBidsV2(Request $request){
        // $name = $request->search;
        // $orderBy = $request->order_by ?? 'desc' ;

        // $my_bids = ProductBid::join('products','products.id','=','product_bids.product_id')
        //     ->join('units','products.unit_id','=','units.id')
        //     ->where('product_bids.sender_user_id',Auth::id())
        //     ->where(function($query) use ($name){
        //         $query->where('products.name', 'like', '%'.$name.'%')
        //             ->orWhere('products.name_bn', 'like', '%'.$name.'%')
        //             ->orWhere('products.quantity', 'like', '%'.$name.'%')
        //             ->orWhere('units.name', 'like', '%'.$name.'%')
        //             ->orWhere('units.name_bn', 'like', '%'.$name.'%')
        //             ->orWhere('product_bids.unit_bid_price', 'like', '%'.$name.'%')
        //             ->orWhere('product_bids.total_bid_price', 'like', '%'.$name.'%');
        //     })
        //     ->select('product_bids.*')
        //     ->orderBy('product_bids.created_at',$orderBy)
        //     ->paginate($request->page_size);
        $my_bids = ProductBid::join('users', 'product_bids.receiver_user_id', '=', 'users.id')
        ->where('product_bids.receiver_user_id', Auth::id())
        ->orderBy('product_bids.created_at', 'desc')
        ->select('users.*','product_bids.*')
        ->get();
    
        
            return new ProductMyBidCollection($my_bids);
    }
    public function buyerMyBids(){
        $my_bids = ProductBid::where('sender_user_id',Auth::id())->where('bid_as','buyer')->latest()->get();
        return new ProductMyBidCollection($my_bids);
    }
    public function buyerMyBidsV2(Request $request){
        
        $name = $request->search;
        $orderBy = $request->order_by ?? 'desc' ;

        $my_bids = ProductBid::join('products','products.id','=','product_bids.product_id')
            ->join('units','products.unit_id','=','units.id')
            ->where('product_bids.sender_user_id',Auth::id())
            ->where(function($query) use ($name){
                $query->where('products.name', 'like', '%'.$name.'%')
                    ->orWhere('products.name_bn', 'like', '%'.$name.'%')
                    ->orWhere('products.quantity', 'like', '%'.$name.'%')
                    ->orWhere('units.name', 'like', '%'.$name.'%')
                    ->orWhere('units.name_bn', 'like', '%'.$name.'%')
                    ->orWhere('product_bids.unit_bid_price', 'like', '%'.$name.'%')
                    ->orWhere('product_bids.total_bid_price', 'like', '%'.$name.'%');
            })
            ->select('product_bids.*')
            ->orderBy('product_bids.created_at',$orderBy)
            ->paginate($request->page_size);
        return new ProductMyBidCollection($my_bids);
    }

    public function buyerRecordedTransaction(){
        $saleRecords = SaleRecord::where('buyer_user_id',Auth::id())->where('type','seller_product')->latest()->get();
        return new BuyerRecordedTransactionCollection($saleRecords);
    }
    public function buyerRecordedTransactionV2(Request $request){
        $name = $request->search;
        $orderBy = $request->order_by ?? 'desc' ;
        $saleRecords = SaleRecord::join('products','products.id','=','sale_records.product_id')
            ->join('units','products.unit_id','=','units.id')
            ->where('sale_records.buyer_user_id',Auth::id())
            ->where('sale_records.type','seller_product')
            ->where(function($query) use ($name){
                $query->where('products.name', 'like', '%'.$name.'%')
                    ->orWhere('products.name_bn', 'like', '%'.$name.'%')
                    ->orWhere('products.quantity', 'like', '%'.$name.'%')
                    ->orWhere('units.name', 'like', '%'.$name.'%')
                    ->orWhere('units.name_bn', 'like', '%'.$name.'%')
                    ->orWhere('sale_records.amount', 'like', '%'.$name.'%');
            })
            ->select('sale_records.*')
            ->orderBy('sale_records.created_at',$orderBy)
            ->paginate($request->page_size);
        return new BuyerRecordedTransactionCollection($saleRecords);
    }
    public function sellerRecordedTransaction(){
        $saleRecords = SaleRecord::where('seller_user_id',Auth::id())->where('type','seller_product')->latest()->get();
        return new SellerRecordedTransactionCollection($saleRecords);
    }
    public function sellerRecordedTransactionV2(Request $request){
        $name = $request->search;
        $orderBy = $request->order_by ?? 'desc' ;
        $saleRecords = SaleRecord::join('products','products.id','=','sale_records.product_id')
            ->join('units','products.unit_id','=','units.id')
            ->where('sale_records.seller_user_id',Auth::id())
            ->where('sale_records.type','seller_product')
            ->where(function($query) use ($name){
                $query->where('products.name', 'like', '%'.$name.'%')
                    ->orWhere('products.name_bn', 'like', '%'.$name.'%')
                    ->orWhere('products.quantity', 'like', '%'.$name.'%')
                    ->orWhere('units.name', 'like', '%'.$name.'%')
                    ->orWhere('units.name_bn', 'like', '%'.$name.'%')
                    ->orWhere('sale_records.amount', 'like', '%'.$name.'%');
            })
            ->select('sale_records.*')
            ->orderBy('sale_records.created_at',$orderBy)
            ->paginate($request->page_size);
//        $saleRecords = SaleRecord::where('seller_user_id',Auth::id())->where('type','seller_product')->latest()->get();
        return new SellerRecordedTransactionCollection($saleRecords);
    }

    public function bidAccept($id){
        $product_bid = ProductBid::find($id);
        $check = ProductBid::where('id',$id)->where('bid_status',1)->first();
        $checkProduct = Product::find($product_bid->product_id);
        $checkForCommission = SaleRecord::where('product_id',$checkProduct->id)->where('product_bid_id',$id)->first();
        if (empty(!$checkForCommission)){
            return response()->json(['success'=>false,'response'=>'You have already accepted bid for this product'], 401);
        }
        if (empty(!$check)){
            return response()->json(['success'=>false,'response'=>'You have already bidden for this product'], 401);
        }
        $get_invoice_code = SaleRecord::orderBy('created_at','DESC')->first();;
        if(!empty($get_invoice_code)){
            $invoice_no = "FLL".date('Y')."-".str_pad($get_invoice_code->id + 1, 8, "0", STR_PAD_LEFT);;
        }else{
            $invoice_no = "FLL".date('Y')."-"."00000001";
        }
//        $product_bid = ProductBid::find($id);
        $product_bid->bid_status = 1;

        if (Auth::user()->user_type == 'seller'){
            $seller = Seller::where('user_id',$product_bid->receiver_user_id)->first();
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

            $user = User::where('id',$product_bid->sender_user_id)->first();
            $title = 'Accepted Bid';
            $message = 'Dear'. $user->name .', your bid for "'. $product_bid->product->name .'" product has been accepted.';
            createNotification($user->id,$title,$message);
            //UserInfo::smsAPI("0".$user->phone,$message);
            if($user->country_code == '+880') {
                UserInfo::smsAPI('880' . $user->phone, $message);
                SmsNotification($user->id,$title,$message);
            }


            //Bid Reject.............
            $product = Product::find($product_bid->product_id);
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

        }else{
            $seller = Seller::where('user_id',$product_bid->sender_user_id)->first();
            $commission = ($product_bid->total_bid_price * sellerCurrentCommission($product_bid->sender_user_id))/100;
            $vat = vat($commission);
            $admin_commission = $commission + $vat;
            $seller->pay_to_admin += $admin_commission;
            $seller->save();
            $product_bid->save();

            $saleRecord = new SaleRecord();
            $saleRecord->buyer_user_id = Auth::id();
            if($product_bid->receiver_user_id == Auth::id()){
                $saleRecord->seller_user_id = $product_bid->sender_user_id;
                $saleRecord->type = 'requested_product';
            } else{
                $saleRecord->seller_user_id = $product_bid->sender_user_id;
                $saleRecord->type = 'seller_product';
            }

            $commission = ($product_bid->total_bid_price * sellerCurrentCommission($product_bid->sender_user_id))/100;
            $vat = vat($commission);
            $admin_commission = $commission + $vat;

            $saleRecord->product_id = $product_bid->product_id;
            $saleRecord->product_bid_id = $product_bid->id;
            $saleRecord->membership_package_id = checkMembershipStatus($product_bid->receiver_user_id);
            $saleRecord->amount = $product_bid->total_bid_price;
            $saleRecord->commission = $commission;
            $saleRecord->vat_percentage = \App\Model\Vat::first()->vat_percentage;
            $saleRecord->vat = $vat;
            $saleRecord->admin_commission = $admin_commission;
            $saleRecord->payment_status = 'Pending';
            $saleRecord->buy_status = 0;
            $saleRecord->invoice_code = $invoice_no;
            $saleRecord->save();

            $user = User::where('id',$product_bid->receiver_user_id)->first();
            $title = 'Accepted Bid';
            $message = 'Dear'. $user->name .', your bid for "'. $product_bid->product->name .'" product has been accepted.';
            createNotification($seller->user_id,$title,$message);
            //UserInfo::smsAPI("0".$user->phone,$message);
            if($user->country_code == '+880') {
                UserInfo::smsAPI('880' . $seller->user->phone, $message);
                SmsNotification($user->id,$title,$message);
            }
            //Bid Reject.............
            $product = Product::find($product_bid->product_id);
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
        }


        $product = Product::find($product_bid->product_id);
        $product->bid_status = 'Accepted';
        $product->save();

        if(!empty($saleRecord))
        {
            return response()->json(['success'=>true,'response' => 'Bid Accepted Successfully'], 201);
        }else{
            return response()->json(['success'=>false,'response'=>'Something went wrong'], 401);
        }
    }

    public function sellerTransactionList(){
        $transaction_reports = PaymentHistory::where('user_id', Auth::user()->id)->get();
        return new TransactionListCollection($transaction_reports);
    }
    public function sellerAcceptedBidRequests(){
        $product_bids = ProductBid::where('sender_user_id',Auth::user()->id)->where('bid_status',1)->latest()->get();
        return new AcceptedBidRequestCollection($product_bids);
    }
    public function sellerAcceptedBidRequestsV2(Request $request){
        $name = $request->search;
        $orderBy = $request->order_by ?? 'desc' ;
        $product_bids = ProductBid::join('products','products.id','=','product_bids.product_id')
            ->join('units','products.unit_id','=','units.id')
            ->where('product_bids.sender_user_id',Auth::id())
            ->where('product_bids.bid_status',1)
            ->where(function($query) use ($name){
                $query->where('products.name', 'like', '%'.$name.'%')
                    ->orWhere('products.name_bn', 'like', '%'.$name.'%')
                    ->orWhere('products.quantity', 'like', '%'.$name.'%')
                    ->orWhere('units.name', 'like', '%'.$name.'%')
                    ->orWhere('units.name_bn', 'like', '%'.$name.'%')
                    ->orWhere('product_bids.unit_bid_price', 'like', '%'.$name.'%')
                    ->orWhere('product_bids.total_bid_price', 'like', '%'.$name.'%');
            })
            ->select('product_bids.*')
            ->orderBy('product_bids.created_at',$orderBy)
            ->paginate($request->page_size);
//        $product_bids = ProductBid::where('sender_user_id',Auth::user()->id)->where('bid_status',1)->latest()->get();
//        dd($product_bids);
        return new AcceptedBidRequestCollection($product_bids);
    }
    public function buyerAcceptedBidRequests(){
        $product_bids = ProductBid::where('receiver_user_id',Auth::id())->where('bid_status',1)->latest()->get();
        return new AcceptedBidRequestCollection($product_bids);
    }
    public function buyerAcceptedBidRequestsV2(Request $request){
        $name = $request->search;
        $orderBy = $request->order_by ?? 'desc' ;

        $product_bids = ProductBid::join('products','products.id','=','product_bids.product_id')
            ->join('units','products.unit_id','=','units.id')
            ->where('product_bids.receiver_user_id',Auth::id())
            ->where('product_bids.bid_status',1)
            ->where(function($query) use ($name){
                $query->where('products.name', 'like', '%'.$name.'%')
                    ->orWhere('products.name_bn', 'like', '%'.$name.'%')
                    ->orWhere('products.quantity', 'like', '%'.$name.'%')
                    ->orWhere('units.name', 'like', '%'.$name.'%')
                    ->orWhere('units.name_bn', 'like', '%'.$name.'%')
                    ->orWhere('product_bids.unit_bid_price', 'like', '%'.$name.'%')
                    ->orWhere('product_bids.total_bid_price', 'like', '%'.$name.'%');
            })
            ->select('product_bids.*')
            ->orderBy('product_bids.created_at',$orderBy)
            ->paginate($request->page_size);

        return new AcceptedBidRequestCollection($product_bids);
    }
    public function buyerRequestedRecordedTransaction(){
        $saleRecords = SaleRecord::where('buyer_user_id',Auth::id())->where('type','requested_product')->latest()->get();
        return new BuyerRecordedTransactionCollection($saleRecords);
    }
    public function buyerRequestedRecordedTransactionV2(Request $request){
        $name = $request->search;
        $orderBy = $request->order_by ?? 'desc' ;

        $saleRecords = SaleRecord::join('products','products.id','=','sale_records.product_id')
            ->join('units','products.unit_id','=','units.id')
            ->where('sale_records.buyer_user_id',Auth::id())
            ->where('sale_records.type','requested_product')
            ->where(function($query) use ($name){
                $query->where('products.name', 'like', '%'.$name.'%')
                    ->orWhere('products.name_bn', 'like', '%'.$name.'%')
                    ->orWhere('products.quantity', 'like', '%'.$name.'%')
                    ->orWhere('units.name', 'like', '%'.$name.'%')
                    ->orWhere('units.name_bn', 'like', '%'.$name.'%')
                    ->orWhere('sale_records.amount', 'like', '%'.$name.'%');
            })
            ->select('sale_records.*')
            ->orderBy('sale_records.created_at',$orderBy)
            ->paginate($request->page_size);
        return new BuyerRecordedTransactionCollection($saleRecords);
    }
    public function sellerRequestedRecordedTransaction(){
        $saleRecords = SaleRecord::where('seller_user_id',Auth::id())->where('type','requested_product')->latest()->get();
        return new SellerRecordedTransactionCollection($saleRecords);
    }
    public function sellerRequestedRecordedTransactionV2(Request $request){
        $name = $request->search;
        $orderBy = $request->order_by ?? 'desc' ;
        $saleRecords = SaleRecord::join('products','products.id','=','sale_records.product_id')
            ->join('units','products.unit_id','=','units.id')
            ->where('sale_records.seller_user_id',Auth::id())
            ->where('sale_records.type','requested_product')
            ->where(function($query) use ($name){
                $query->where('products.name', 'like', '%'.$name.'%')
                    ->orWhere('products.name_bn', 'like', '%'.$name.'%')
                    ->orWhere('products.quantity', 'like', '%'.$name.'%')
                    ->orWhere('units.name', 'like', '%'.$name.'%')
                    ->orWhere('units.name_bn', 'like', '%'.$name.'%')
                    ->orWhere('sale_records.amount', 'like', '%'.$name.'%');
            })
            ->select('sale_records.*')
            ->orderBy('sale_records.created_at',$orderBy)
            ->paginate($request->page_size);
//        $saleRecords = SaleRecord::where('seller_user_id',Auth::id())->where('type','requested_product')->latest()->get();
        return new SellerRecordedTransactionCollection($saleRecords);
    }
}
