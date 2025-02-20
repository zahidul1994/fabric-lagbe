<?php

namespace App\Http\Controllers\Seller;



use Illuminate\Http\Request;
use App\Helpers\UserInfo;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\ColorStainingInfo;
use App\Model\Currency;
use App\Model\DyingProduct;
use App\Model\Product;
use App\Model\Fabric;
use App\Model\HandMade;
use App\Model\Seller;
use App\Model\SizingProduct;
use App\Model\YarnProduct;
use App\Model\SubCategory;
use App\Model\SubSubCategory;
use App\Model\SubSubChildCategory;
use App\Model\SubSubChildChildCategory;
use App\Model\Unit;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Storage;

class HandMadeController extends Controller
{
    public function create()
    {
        $checkSellerApprovalStatus = Seller::where('user_id',Auth::id())->pluck('verification_status')->first();
        if($checkSellerApprovalStatus == 0){
            Toastr::warning('You are not approved by administrator, Please contact with administrator','Warning');
            return redirect()->back();
        }
        $checkProfile = sellerProfileCheck();
        if ($checkProfile == false){
            Toastr::warning('Please complete your profile information','Warning');
        }
        $categories = Category::where('type','product')->get();
        $units = Unit::all();
        $currencies = Currency::where('status',1)->get();
        return view('frontend.seller.handmade.create',compact('categories','units','currencies'));
    }

    public function store(Request $request)

    {
    
    
        if(count(checkSellerCurrentCommissionDueStatus(Auth::user()->id)) > 0){
            Toastr::warning('Your previous commission not paid yet! Please Pay your commission first. ','Warning');
            return redirect()->route('seller.accounts');
        }
    
    //        if(empty($request->hasFile('photos'))){
    //            Toastr::warning('You can not submit without product image! You can try again.','Warning');
    //            return redirect()->back();
    //        }
        if($request->sub_category_id && ($request->sub_category_id == 'Select Product')){
            $sub_category_id = NULL;
        }else{
            $sub_category_id = $request->sub_category_id;
        }
    
        if($request->sub_sub_category_id && ($request->sub_sub_category_id == 'Select Product')){
            $sub_sub_category_id = NULL;
        }else{
            $sub_sub_category_id = $request->sub_sub_category_id;
        }
    
        if($request->sub_sub_child_category_id && ($request->sub_sub_child_category_id == 'Select Product')){
            $sub_sub_child_category_id = NULL;
        }else{
            $sub_sub_child_category_id = $request->sub_sub_child_category_id;
        }
    
        if($request->sub_sub_child_child_category_id && ($request->sub_sub_child_child_category_id == 'Select Product')){
            $sub_sub_child_child_category_id = NULL;
        }else{
            $sub_sub_child_child_category_id = $request->sub_sub_child_child_category_id;
        }
        if($request->category_six_id && ($request->category_six_id == 'Select Product')){
            $category_six_id = NULL;
        }else{
            $category_six_id = $request->category_six_id;
        }
        if($request->category_seven_id && ($request->category_seven_id == 'Select Product')){
            $category_seven_id = NULL;
        }else{
            $category_seven_id = $request->category_seven_id;
        }
        if($request->category_eight_id && ($request->category_eight_id == 'Select Product')){
            $category_eight_id = NULL;
        }else{
            $category_eight_id = $request->category_eight_id;
        }
        if($request->category_nine_id && ($request->category_nine_id == 'Select Product')){
            $category_nine_id = NULL;
        }else{
            $category_nine_id = $request->category_nine_id;
        }
        if($request->category_ten_id && ($request->category_ten_id == 'Select Product')){
            $category_ten_id = NULL;
        }else{
            $category_ten_id = $request->category_ten_id;
        }
    
        $product = new Product();
        $product->name = $request->name;
        $product->name_bn = $request->name_bn;
        $product->user_id = Auth::id();
        $product->user_type = 'seller';
        $product->category_id = $request->category_id;
        $product->sub_category_id = $sub_category_id;
        $product->sub_sub_category_id = $sub_sub_category_id;
        $product->sub_sub_child_category_id = $sub_sub_child_category_id;
        $product->sub_sub_child_child_category_id = $sub_sub_child_child_category_id;
        $product->category_six_id = $category_six_id;
        $product->category_seven_id = $category_seven_id;
        $product->category_eight_id = $category_eight_id;
        $product->category_nine_id = $category_nine_id;
        $product->category_ten_id = $category_ten_id;
    
        $photos = array();
        if($request->hasFile('photos')){
            $thumbnail_img = $request->photos[0];
            $product->thumbnail_img = $thumbnail_img->store('uploads/products/thumbnail');
    
            foreach ($request->photos as $key => $photo) {
                $path = $photo->store('uploads/products/photos');
                array_push($photos, $path);
            }
            $product->photos = json_encode($photos);
        }
    
    
        if(currency()->code == 'BDT'){
            $unit_price = $request->unit_price;
            $expected_price = $request->expected_price;
        }else{
            $unit_price = convert_to_bdt($request->unit_price);
            $expected_price = convert_to_bdt($request->expected_price);
        }
    
        $product->quantity = $request->quantity;
        $product->category_others = $request->category_others;
        $product->unit_id = $request->unit_id;
        $product->unit_price = $unit_price;
        $product->vat = $request->vat;
        $product->unit_vat_price =$unit_price+(($unit_price*getDefaultVat())/100);
        $product->expected_price = $expected_price;
        $product->currency_id = 27;
        $product->price_validity = $request->price_validity;
        $product->made_in = $request->made_in;
        $product->raw_metarials = $request->raw_metarials;
        $product->description = $request->description;
        $product->description_bn = $request->description_bn;
        $product->published = 1;
        $product->featured_product = 0;
        $product->delivery_status = 'pending';
        $product->slug = $request->slug.'-'.Str::random(5);
        $product->verification_status = 0;
        $product->save();
            $insert_id = $product->id;
    
            if ($insert_id){
    
                if($request->sub_category_id && ($request->sub_category_id == 'Select Product')){
                    $sub_category_id = NULL;
                }else{
                    $sub_category_id = $request->sub_category_id;
                }
    
                if($request->sub_sub_category_id && ($request->sub_sub_category_id == 'Select Product')){
                    $sub_sub_category_id = NULL;
                }else{
                    $sub_sub_category_id = $request->sub_sub_category_id;
                }
    
                if($request->sub_sub_child_category_id && ($request->sub_sub_child_category_id == 'Select Product')){
                    $sub_sub_child_category_id = NULL;
                }else{
                    $sub_sub_child_category_id = $request->sub_sub_child_category_id;
                }
    
                if($request->sub_sub_child_child_category_id && ($request->sub_sub_child_child_category_id == 'Select Product')){
                    $sub_sub_child_child_category_id = NULL;
                }else{
                    $sub_sub_child_child_category_id = $request->sub_sub_child_child_category_id;
                }
                if($request->category_six_id && ($request->category_six_id == 'Select Product')){
                    $category_six_id = NULL;
                }else{
                    $category_six_id = $request->category_six_id;
                }
                if($request->category_seven_id && ($request->category_seven_id == 'Select Product')){
                    $category_seven_id = NULL;
                }else{
                    $category_seven_id = $request->category_seven_id;
                }
                if($request->category_eight_id && ($request->category_eight_id == 'Select Product')){
                    $category_eight_id = NULL;
                }else{
                    $category_eight_id = $request->category_eight_id;
                }
                if($request->category_nine_id && ($request->category_nine_id == 'Select Product')){
                    $category_nine_id = NULL;
                }else{
                    $category_nine_id = $request->category_nine_id;
                }
                if($request->category_ten_id && ($request->category_ten_id == 'Select Product')){
                    $category_ten_id = NULL;
                }else{
                    $category_ten_id = $request->category_ten_id;
                }
    
                $handmade = new Handmade();
                $handmade->product_id = $insert_id;
                $handmade->name = $request->name;
                $handmade->name_bn = $request->name_bn;
                $handmade->user_id = Auth::id();
                $handmade->user_type = 'seller';
                $handmade->category_id = $request->category_id;
                // $handmade->sub_category_id = $sub_category_id;
                // $handmade->sub_sub_category_id = $sub_sub_category_id;
                // $handmade->sub_sub_child_category_id = $sub_sub_child_category_id;
                // $handmade->sub_sub_child_child_category_id = $sub_sub_child_child_category_id;
                // $handmade->category_six_id = $category_six_id;
                // $handmade->category_seven_id = $category_seven_id;
                // $handmade->category_eight_id = $category_eight_id;
                // $handmade->category_nine_id = $category_nine_id;
                // $handmade->category_ten_id = $category_ten_id;
    
                $photos = array();
                if($request->hasFile('photos')){
                    $thumbnail_img = $request->photos[0];
                    $handmade->thumbnail_img = $thumbnail_img->store('uploads/products/thumbnail');
    
                    foreach ($request->photos as $key => $photo) {
                        $path = $photo->store('uploads/products/photos');
                        array_push($photos, $path);
                    }
                    $handmade->photos = json_encode($photos);
                }
    
    
                if(currency()->code == 'BDT'){
                    $unit_price = $request->unit_price;
                    $expected_price = $request->expected_price;
                }else{
                    $unit_price = convert_to_bdt($request->unit_price);
                    $expected_price = convert_to_bdt($request->expected_price);
                }
    
                $handmade->quantity = $request->quantity;
                $handmade->unit_id = $request->unit_id;
                $handmade->unit_price = $unit_price;
                $handmade->vat = $request->vat;
                $handmade->unit_vat_price =$unit_price+(($unit_price*getDefaultVat())/100);
                $handmade->expected_price = $expected_price;
                $handmade->currency_id = 27;
                $handmade->price_validity = $request->price_validity;
                $handmade->made_in = $request->made_in;
                $handmade->raw_metarials = $request->raw_metarials;
                $handmade->description = $request->description;
                $handmade->description_bn = $request->description_bn;
                $handmade->published = 1;
                $handmade->featured_fabric = 0;
                $handmade->delivery_status = 'pending';
                $handmade->slug = $request->slug.'-'.Str::random(5);
                $handmade->verification_status = 0;
                $handmade->save();
    
    
    
            }
    
            return redirect()->route('seller.products.index');


}
}