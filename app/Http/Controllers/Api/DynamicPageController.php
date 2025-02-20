<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\DynamicPage;
use Brian2694\Toastr\Facades\Toastr;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DynamicPageController extends Controller
{
    public function privacy_and_policy(){
        $privacy_and_policy = DynamicPage::where('slug','privacy-policy')->first();
        $data['description']= getDescriptionByBnEn($privacy_and_policy);
        $data['created_at']= $privacy_and_policy->created_at;
        $data['updated_at']= $privacy_and_policy->updated_at;
        if (!empty($data)){
            return response()->json(['success'=>true,'response'=> $data], 200);
        }else{
            return response()->json(['success'=>false,'response'=> 'Something went wrong!'], 404);
        }
    }

    public function terms_and_conditions(){
       
        $terms_and_conditions =DynamicPage::where('slug','terms-and-conditions')->first();
        $data['description']= getDescriptionByBnEn($terms_and_conditions);
        $data['created_at']= $terms_and_conditions->created_at;
        $data['updated_at']= $terms_and_conditions->updated_at;
        if (!empty($data)){
            return response()->json(['success'=>true,'response'=> $data], 200);
        }else{
            return response()->json(['success'=>false,'response'=> 'Something went wrong!'], 404);
        }
    }

    public function return_refund_policy(){
        $return_refund_policy = DynamicPage::where('slug','return-refund-policy')->first();
        $data['description']= getDescriptionByBnEn($return_refund_policy);
        $data['created_at']= $return_refund_policy->created_at;
        $data['updated_at']= $return_refund_policy->updated_at;
        if (!empty($data)){
            return response()->json(['success'=>true,'response'=> $data], 200);
        }else{
            return response()->json(['success'=>false,'response'=> 'Something went wrong!'], 404);
        }
    }

    public function cookies_policy(){
        $cookies_policy = DynamicPage::where('slug','cookies-policy')->first();
        $data['description']= getDescriptionByBnEn($cookies_policy);
        $data['created_at']= $cookies_policy->created_at;
        $data['updated_at']= $cookies_policy->updated_at;
        if (!empty($data)){
            return response()->json(['success'=>true,'response'=> $data], 200);
        }else{
            return response()->json(['success'=>false,'response'=> 'Something went wrong!'], 404);
        }
    }

    public function faq(){
        $faq = DynamicPage::where('slug','faq')->first();
        $data['description']= getDescriptionByBnEn($faq);
        $data['created_at']= $faq->created_at;
        $data['updated_at']= $faq->updated_at;
        if (!empty($data)){
            return response()->json(['success'=>true,'response'=> $data], 200);
        }else{
            return response()->json(['success'=>false,'response'=> 'Something went wrong!'], 404);
        }
    }
    public function staySafe(){
        $staySafe = DynamicPage::where('slug','stay-safe')->first();
        $data['description']= getDescriptionByBnEn($staySafe);
        $data['created_at']= $staySafe->created_at;
        $data['updated_at']= $staySafe->updated_at;
        if (!empty($data)){
            return response()->json(['success'=>true,'response'=> $data], 200);
        }else{
            return response()->json(['success'=>false,'response'=> 'Something went wrong!'], 404);
        }
    }

    public function about_us(){
        $about_us = DynamicPage::where('slug','about-us')->first();
        $data['description']= getDescriptionByBnEn($about_us);
        $data['created_at']= $about_us->created_at;
        $data['updated_at']= $about_us->updated_at;
        if (!empty($data)){
            return response()->json(['success'=>true,'response'=> $data], 200);
        }else{
            return response()->json(['success'=>false,'response'=> 'Something went wrong!'], 404);
        }
    }
    public function contact_us(){
        return view('frontend.pages.contact_us');
    }
}
