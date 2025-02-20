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
use App\Model\Seller;
use App\Model\SizingProduct;
use App\Model\Yarn;
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

class YarnController extends Controller
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
        return view('frontend.seller.yarn.create',compact('categories','units','currencies'));
    }

    public function store(Request $request)
    {
                     
                    // dd($request);
                    $product = new Product();
                    $product->name = $request->name;
                    $product->user_id = Auth::id();
                    $product->user_type = 'seller';
                    $product->category_id = 4;

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

                    // $product->quantity = $request->total_length;

                    $product->quantity = $request->quantity;
                    $product->unit_id = $request->unit_id;
                    $product->unit_price = $unit_price;
                    $product->vat = $request->vat;
                    $product->expected_price = $expected_price;

                    $product->currency_id = 27;
                    
                    
                    $product->price_validity = $request->price_validity;
                    $product->made_in = $request->made_in;
                    $product->description = $request->description;
                    $product->published = 1;
                    $product->featured_product = 0;
                    $product->delivery_status = 'pending';
                    $product->slug = $request->name.'-'.Str::random(5);
                    $product->verification_status = 0;
                   
                    $product->save();
                    $image_alt = getImageAlt($product->id);
                    $product->image_alt = $image_alt;
                    $insert_id = $product->id;

                    if ($insert_id){

                        $yarnProduct = new Yarn();
                        $yarnProduct->product_id = $insert_id;

                        $yarnProduct->cotton_type = $request->cotton_type;
                        $yarnProduct->cotton_count = $request->cotton_count;
                        $yarnProduct->cotton_used_for = $request->cotton_used_for;
                        $yarnProduct->cotton_quality_type = $request->cotton_quality_type;
                        $yarnProduct->cotton_ring_type = $request->cotton_ring_type;
                        $yarnProduct->cotton_fiber = $request->cotton_fiber;
                       
                        $yarnProduct->viscose_used_for = $request->viscose_used_for;
                        $yarnProduct->viscose_count = $request->viscose_count;
                        $yarnProduct->viscose_ring_type = $request->viscose_ring_type;
                        $yarnProduct->viscose_fiber = $request->viscose_fiber;
                        $yarnProduct->viscose_used_for = $request->viscose_used_for;
                        
                        $yarnProduct->fancy_type = $request->fancy_type;
                        $yarnProduct->fancy_count = $request->fancy_count;
                        $yarnProduct->fancy_fiber= $request->fancy_fiber;
                        $yarnProduct->fancy_used_for = $request->fancy_used_for;


                        $yarnProduct->synthatic_type = $request->synthatic_type;
                        $yarnProduct->synthatic_count = $request->synthatic_count;
                        $yarnProduct->synthatic_fiber= $request->synthatic_fiber;
                        $yarnProduct->synthatic_used_for = $request->synthatic_used_for;
                        $yarnProduct->synthatic_ring_type = $request->synthatic_ring_type;


                        $yarnProduct->polyester_type = $request->polyester_type;
                        $yarnProduct->polyester_count = $request->polyester_count;
                        $yarnProduct->polyester_quality_type= $request->polyester_quality_type;
                        $yarnProduct->polyester_ring_type = $request->polyester_ring_type;
                        $yarnProduct->polyester_fiber = $request->polyester_fiber;


                        $yarnProduct->texturised_type = $request->texturised_type;
                        $yarnProduct->texturised_quality_type = $request->texturised_quality_type;
                        $yarnProduct->texturised_count= $request->texturised_count;
                        $yarnProduct->texturised_fiber = $request->texturised_fiber;
                        $yarnProduct->texturised_used_for = $request->texturised_used_for;

                     



                       
                        $yarnProduct->save();
                    }
    if($insert_id){
        $user = User::where('id',Auth::id())->first();
        $title = 'Seller Sizing Product Entry';
        $message = $user->name .' Added A New Product "'.$product->name.'" .';
        createNotificationWithProductId(9,$title,$message,$insert_id);
    }
    Toastr::success("Product Inserted Successfully. Now Waiting For Approval.","Success");
 
    return redirect()->route('seller.products.index');
}
}
