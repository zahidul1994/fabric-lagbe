<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductsListCollection;
use App\Model\Category;
use App\Model\CategoryEight;
use App\Model\CategoryNine;
use App\Model\CategorySeven;
use App\Model\CategorySix;
use App\Model\CategoryTen;
use App\Model\Product;
use App\Model\SubCategory;
use App\Model\SubSubCategory;
use App\Model\SubSubChildCategory;
use App\Model\SubSubChildChildCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchProductController extends Controller
{
    public function getSellerRecentProducts(Request $request){

        $conditions = ['published' => 1,'verification_status' => 1, 'user_type' => 'buyer','bid_status' =>'Applied'];

        if($request->category_id != null){
            $conditions = array_merge($conditions, ['category_id' => $request->category_id]);
        }
        if($request->sub_category_id != null){
            $conditions = array_merge($conditions, ['sub_category_id' => $request->sub_category_id]);
        }
        if($request->sub_sub_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_category_id' => $request->sub_sub_category_id]);
        }
        if($request->sub_sub_child_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_child_category_id' => $request->sub_sub_child_category_id]);
        }

        if($request->sub_sub_child_child_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_child_child_category_id' => $request->sub_sub_child_child_category_id]);
        }
        if($request->category_six_id != null){
            $conditions = array_merge($conditions, ['category_six_id' => $request->category_six_id]);
        }
        if( $request->category_seven_id != null){
            $conditions = array_merge($conditions, ['category_seven_id' =>  $request->category_seven_id]);
        }

        $products = Product::where($conditions)->latest()->get();
        //return $products;

        return new ProductCollection($products);
    }
    public function getSellerRecentProductsPagination(Request $request,$page_size){

        $conditions = ['published' => 1,'verification_status' => 1, 'user_type' => 'buyer','bid_status' =>'Applied'];

        if($request->category_id != null){
            $conditions = array_merge($conditions, ['category_id' => $request->category_id]);
        }
        if($request->sub_category_id != null){
            $conditions = array_merge($conditions, ['sub_category_id' => $request->sub_category_id]);
        }
        if($request->sub_sub_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_category_id' => $request->sub_sub_category_id]);
        }
        if($request->sub_sub_child_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_child_category_id' => $request->sub_sub_child_category_id]);
        }

        if($request->sub_sub_child_child_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_child_child_category_id' => $request->sub_sub_child_child_category_id]);
        }
        if($request->category_six_id != null){
            $conditions = array_merge($conditions, ['category_six_id' => $request->category_six_id]);
        }
        if( $request->category_seven_id != null){
            $conditions = array_merge($conditions, ['category_seven_id' =>  $request->category_seven_id]);
        }

        $products = Product::where($conditions)->latest()->paginate($page_size);
        //return $products;

        return new ProductCollection($products);
    }

    public function getSellerRecentProductsPaginationV2(Request $request,$page_size){

        $conditions = ['published' => 1,'verification_status' => 1, 'user_type' => 'buyer','bid_status' =>'Applied'];

        if($request->category_id != null){
            $conditions = array_merge($conditions, ['category_id' => $request->category_id]);
        }
        if($request->sub_category_id != null){
            $conditions = array_merge($conditions, ['sub_category_id' => $request->sub_category_id]);
        }
        if($request->sub_sub_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_category_id' => $request->sub_sub_category_id]);
        }
        if($request->sub_sub_child_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_child_category_id' => $request->sub_sub_child_category_id]);
        }

        if($request->sub_sub_child_child_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_child_child_category_id' => $request->sub_sub_child_child_category_id]);
        }
        if($request->category_six_id != null){
            $conditions = array_merge($conditions, ['category_six_id' => $request->category_six_id]);
        }
        if( $request->category_seven_id != null){
            $conditions = array_merge($conditions, ['category_seven_id' =>  $request->category_seven_id]);
        }

        if( $request->name != null){
            $name = $request->name;
            $products = Product::where($conditions)
                ->where(function($query) use ($name){
                    $query->where('name', 'like', '%'.$name.'%')
                        ->orWhere('name_bn', 'like', '%'.$name.'%');
                })
                ->latest()->paginate($page_size);
        }else{
            $products = Product::where($conditions)->latest()->paginate($page_size);
        }

        return new ProductCollection($products);
    }

    public function getSellerFeaturedProducts(Request $request){
        $conditions = ['published' => 1,'featured_product' => 1,'verification_status' => 1, 'user_type' => 'buyer','bid_status' =>'Applied'];

        if($request->category_id != null){
            $conditions = array_merge($conditions, ['category_id' => $request->category_id]);
        }
        if($request->sub_category_id != null){
            $conditions = array_merge($conditions, ['sub_category_id' => $request->sub_category_id]);
        }
        if($request->sub_sub_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_category_id' => $request->sub_sub_category_id]);
        }
        if($request->sub_sub_child_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_child_category_id' => $request->sub_sub_child_category_id]);
        }

        if($request->sub_sub_child_child_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_child_child_category_id' => $request->sub_sub_child_child_category_id]);
        }
        if($request->category_six_id != null){
            $conditions = array_merge($conditions, ['category_six_id' => $request->category_six_id]);
        }
        if( $request->category_seven_id != null){
            $conditions = array_merge($conditions, ['category_seven_id' =>  $request->category_seven_id]);
        }

        $products = Product::where($conditions)->latest()->get();
        //return $products;

        return new ProductCollection($products);
    }
    public function getSellerFeaturedProductsV2(){
        $featuredProducts = Product::where('user_type','buyer')->where('verification_status',1)->where('featured_product_v2',1)->where('bid_status','Applied')->where('priority_buyer','!=',null)->orderBy('priority_buyer','asc')->take(20)->get();
        return new  ProductCollection($featuredProducts);
    }
    public function getBuyerFeaturedProductsV2(){
        $featuredProducts = Product::where('user_type','seller')->where('verification_status',1)->where('featured_product_v2',1)->where('bid_status','Applied')->where('priority_seller','!=',null)->orderBy('priority_seller','asc')->take(20)->get();
        return new  ProductCollection($featuredProducts);
    }
    public function getSellerFeaturedProductsPagination(Request $request,$page_size){
        $conditions = ['published' => 1,'featured_product' => 1,'verification_status' => 1, 'user_type' => 'buyer','bid_status' =>'Applied'];

        if($request->category_id != null){
            $conditions = array_merge($conditions, ['category_id' => $request->category_id]);
        }
        if($request->sub_category_id != null){
            $conditions = array_merge($conditions, ['sub_category_id' => $request->sub_category_id]);
        }
        if($request->sub_sub_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_category_id' => $request->sub_sub_category_id]);
        }
        if($request->sub_sub_child_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_child_category_id' => $request->sub_sub_child_category_id]);
        }

        if($request->sub_sub_child_child_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_child_child_category_id' => $request->sub_sub_child_child_category_id]);
        }
        if($request->category_six_id != null){
            $conditions = array_merge($conditions, ['category_six_id' => $request->category_six_id]);
        }
        if( $request->category_seven_id != null){
            $conditions = array_merge($conditions, ['category_seven_id' =>  $request->category_seven_id]);
        }

        $products = Product::where($conditions)->latest()->paginate($page_size);
        //return $products;

        return new ProductCollection($products);
    }

    public function getSellerFeaturedProductsPaginationV2(Request $request,$page_size){
        $conditions = ['published' => 1,'featured_product' => 1,'verification_status' => 1, 'user_type' => 'buyer','bid_status' =>'Applied'];

        if($request->category_id != null){
            $conditions = array_merge($conditions, ['category_id' => $request->category_id]);
        }
        if($request->sub_category_id != null){
            $conditions = array_merge($conditions, ['sub_category_id' => $request->sub_category_id]);
        }
        if($request->sub_sub_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_category_id' => $request->sub_sub_category_id]);
        }
        if($request->sub_sub_child_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_child_category_id' => $request->sub_sub_child_category_id]);
        }

        if($request->sub_sub_child_child_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_child_child_category_id' => $request->sub_sub_child_child_category_id]);
        }
        if($request->category_six_id != null){
            $conditions = array_merge($conditions, ['category_six_id' => $request->category_six_id]);
        }
        if( $request->category_seven_id != null){
            $conditions = array_merge($conditions, ['category_seven_id' =>  $request->category_seven_id]);
        }

        if( $request->name != null){
            $name = $request->name;
            $products = Product::where($conditions)
                ->where(function($query) use ($name){
                    $query->where('name', 'like', '%'.$name.'%')
                        ->orWhere('name_bn', 'like', '%'.$name.'%');
                })
                ->latest()->paginate($page_size);
        }
        else{
            $products = Product::where($conditions)->latest()->paginate($page_size);
        }

        return new ProductCollection($products);
    }

    public function getBuyerRecentProducts(Request $request){

        $conditions = ['published' => 1,'verification_status' => 1, 'user_type' => 'seller','bid_status' =>'Applied'];

        if($request->category_id != null){
            $conditions = array_merge($conditions, ['category_id' => $request->category_id]);
        }
        if($request->sub_category_id != null){
            $conditions = array_merge($conditions, ['sub_category_id' => $request->sub_category_id]);
        }
        if($request->sub_sub_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_category_id' => $request->sub_sub_category_id]);
        }
        if($request->sub_sub_child_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_child_category_id' => $request->sub_sub_child_category_id]);
        }

        if($request->sub_sub_child_child_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_child_child_category_id' => $request->sub_sub_child_child_category_id]);
        }
        if($request->category_six_id != null){
            $conditions = array_merge($conditions, ['category_six_id' => $request->category_six_id]);
        }
        if( $request->category_seven_id != null){
            $conditions = array_merge($conditions, ['category_seven_id' =>  $request->category_seven_id]);
        }

        $products = Product::where($conditions)->latest()->get();

        return new ProductCollection($products);
    }
    public function getBuyerRecentProductsPagination(Request $request,$page_size){
        $conditions = ['published' => 1,'verification_status' => 1, 'user_type' => 'seller','bid_status' =>'Applied'];

        if($request->category_id != null){
            $conditions = array_merge($conditions, ['category_id' => $request->category_id]);
        }
        if($request->sub_category_id != null){
            $conditions = array_merge($conditions, ['sub_category_id' => $request->sub_category_id]);
        }
        if($request->sub_sub_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_category_id' => $request->sub_sub_category_id]);
        }
        if($request->sub_sub_child_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_child_category_id' => $request->sub_sub_child_category_id]);
        }

        if($request->sub_sub_child_child_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_child_child_category_id' => $request->sub_sub_child_child_category_id]);
        }
        if($request->category_six_id != null){
            $conditions = array_merge($conditions, ['category_six_id' => $request->category_six_id]);
        }
        if( $request->category_seven_id != null){
            $conditions = array_merge($conditions, ['category_seven_id' =>  $request->category_seven_id]);
        }
        $products = Product::where($conditions)->latest()->paginate($page_size);

        return new ProductCollection($products);
    }

    public function getBuyerRecentProductsPaginationV2(Request $request,$page_size){
        $conditions = ['published' => 1,'verification_status' => 1, 'user_type' => 'seller','bid_status' =>'Applied'];

        if($request->category_id != null){
            $conditions = array_merge($conditions, ['category_id' => $request->category_id]);
        }
        if($request->sub_category_id != null){
            $conditions = array_merge($conditions, ['sub_category_id' => $request->sub_category_id]);
        }
        if($request->sub_sub_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_category_id' => $request->sub_sub_category_id]);
        }
        if($request->sub_sub_child_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_child_category_id' => $request->sub_sub_child_category_id]);
        }

        if($request->sub_sub_child_child_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_child_child_category_id' => $request->sub_sub_child_child_category_id]);
        }
        if($request->category_six_id != null){
            $conditions = array_merge($conditions, ['category_six_id' => $request->category_six_id]);
        }
        if( $request->category_seven_id != null){
            $conditions = array_merge($conditions, ['category_seven_id' =>  $request->category_seven_id]);
        }
        if( $request->name != null){
            $name = $request->name;
            $products = Product::where($conditions)
                ->where(function($query) use ($name){
                    $query->where('name', 'like', '%'.$name.'%')
                        ->orWhere('name_bn', 'like', '%'.$name.'%');
                })
                ->latest()->paginate($page_size);
        }else{
            $products = Product::where($conditions)->latest()->paginate($page_size);
        }

        return new ProductCollection($products);
    }

    public function getBuyerFeaturedProducts(Request $request){
        $conditions = ['published' => 1,'featured_product' => 1,'verification_status' => 1, 'user_type' => 'seller', 'bid_status' =>'Applied'];

        if($request->category_id != null){
            $conditions = array_merge($conditions, ['category_id' => $request->category_id]);
        }
        if($request->sub_category_id != null){
            $conditions = array_merge($conditions, ['sub_category_id' => $request->sub_category_id]);
        }
        if($request->sub_sub_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_category_id' => $request->sub_sub_category_id]);
        }
        if($request->sub_sub_child_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_child_category_id' => $request->sub_sub_child_category_id]);
        }

        if($request->sub_sub_child_child_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_child_child_category_id' => $request->sub_sub_child_child_category_id]);
        }
        if($request->category_six_id != null){
            $conditions = array_merge($conditions, ['category_six_id' => $request->category_six_id]);
        }
        if( $request->category_seven_id != null){
            $conditions = array_merge($conditions, ['category_seven_id' =>  $request->category_seven_id]);
        }

        $products = Product::where($conditions)->latest()->get();

        return new ProductCollection($products);
    }
    public function getBuyerFeaturedProductsPagination(Request $request,$page_size){
        $conditions = ['published' => 1,'featured_product' => 1,'verification_status' => 1, 'user_type' => 'seller', 'bid_status' =>'Applied'];

        if($request->category_id != null){
            $conditions = array_merge($conditions, ['category_id' => $request->category_id]);
        }
        if($request->sub_category_id != null){
            $conditions = array_merge($conditions, ['sub_category_id' => $request->sub_category_id]);
        }
        if($request->sub_sub_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_category_id' => $request->sub_sub_category_id]);
        }
        if($request->sub_sub_child_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_child_category_id' => $request->sub_sub_child_category_id]);
        }

        if($request->sub_sub_child_child_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_child_child_category_id' => $request->sub_sub_child_child_category_id]);
        }
        if($request->category_six_id != null){
            $conditions = array_merge($conditions, ['category_six_id' => $request->category_six_id]);
        }
        if( $request->category_seven_id != null){
            $conditions = array_merge($conditions, ['category_seven_id' =>  $request->category_seven_id]);
        }
        $products = Product::where($conditions)->latest()->paginate($page_size);

        return new ProductCollection($products);
    }

    public function getBuyerFeaturedProductsPaginationV2(Request $request,$page_size){
        $conditions = ['published' => 1,'featured_product' => 1,'verification_status' => 1, 'user_type' => 'seller', 'bid_status' =>'Applied'];

        if($request->category_id != null){
            $conditions = array_merge($conditions, ['category_id' => $request->category_id]);
        }
        if($request->sub_category_id != null){
            $conditions = array_merge($conditions, ['sub_category_id' => $request->sub_category_id]);
        }
        if($request->sub_sub_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_category_id' => $request->sub_sub_category_id]);
        }
        if($request->sub_sub_child_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_child_category_id' => $request->sub_sub_child_category_id]);
        }

        if($request->sub_sub_child_child_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_child_child_category_id' => $request->sub_sub_child_child_category_id]);
        }
        if($request->category_six_id != null){
            $conditions = array_merge($conditions, ['category_six_id' => $request->category_six_id]);
        }
        if( $request->category_seven_id != null){
            $conditions = array_merge($conditions, ['category_seven_id' =>  $request->category_seven_id]);
        }
        if( $request->name != null){
            $name = $request->name;
            $products = Product::where($conditions)
                ->where(function($query) use ($name){
                    $query->where('name', 'like', '%'.$name.'%')
                        ->orWhere('name_bn', 'like', '%'.$name.'%');
                })
                ->latest()->paginate($page_size);
        }
        else{
            $products = Product::where($conditions)->latest()->paginate($page_size);
        }

        return new ProductCollection($products);
    }

    public function getSearchProducts(Request $request){
        $conditions = ['published' => 1,'verification_status' => 1, 'bid_status' =>'Applied'];
        if($request->category_id != null){
            $conditions = array_merge($conditions, ['category_id' => $request->category_id]);
        }
        if($request->sub_category_id != null){
            $conditions = array_merge($conditions, ['sub_category_id' => $request->sub_category_id]);
        }
        if($request->sub_sub_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_category_id' => $request->sub_sub_category_id]);
        }
        if($request->sub_sub_child_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_child_category_id' => $request->sub_sub_child_category_id]);
        }

        if($request->sub_sub_child_child_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_child_child_category_id' => $request->sub_sub_child_child_category_id]);
        }
        if($request->category_six_id != null){
            $conditions = array_merge($conditions, ['category_six_id' => $request->category_six_id]);
        }
        if( $request->category_seven_id != null){
            $conditions = array_merge($conditions, ['category_seven_id' =>  $request->category_seven_id]);
        }

        $products = Product::where($conditions)->latest()->paginate(20);
        //return $products;

        return new ProductCollection($products);
    }

    public function getSearchProductsPagination(Request $request,$page_size){
        $conditions = ['published' => 1,'verification_status' => 1, 'bid_status' =>'Applied'];

        if($request->category_id != null){
            $conditions = array_merge($conditions, ['category_id' => $request->category_id]);
        }
        if($request->sub_category_id != null){
            $conditions = array_merge($conditions, ['sub_category_id' => $request->sub_category_id]);
        }
        if($request->sub_sub_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_category_id' => $request->sub_sub_category_id]);
        }
        if($request->sub_sub_child_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_child_category_id' => $request->sub_sub_child_category_id]);
        }

        if($request->sub_sub_child_child_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_child_child_category_id' => $request->sub_sub_child_child_category_id]);
        }
        if($request->category_six_id != null){
            $conditions = array_merge($conditions, ['category_six_id' => $request->category_six_id]);
        }
        if( $request->category_seven_id != null){
            $conditions = array_merge($conditions, ['category_seven_id' =>  $request->category_seven_id]);
        }
        if( $request->category_eight_id != null){
            $conditions = array_merge($conditions, ['category_eight_id' =>  $request->category_eight_id]);
        }
        if( $request->category_nine_id != null){
            $conditions = array_merge($conditions, ['category_nine_id' =>  $request->category_nine_id]);
        }
        if( $request->category_ten_id != null){
            $conditions = array_merge($conditions, ['category_ten_id' =>  $request->category_ten_id]);
        }

        $products = Product::where($conditions)->latest()->paginate($page_size);

        return new ProductCollection($products);
    }

    public function getSearchProductsPaginationV2(Request $request,$page_size){
        $conditions = ['published' => 1,'verification_status' => 1, 'bid_status' =>'Applied'];

        if($request->category_id != null){
            $conditions = array_merge($conditions, ['category_id' => $request->category_id]);
        }
        if($request->sub_category_id != null){
            $conditions = array_merge($conditions, ['sub_category_id' => $request->sub_category_id]);
        }
        if($request->sub_sub_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_category_id' => $request->sub_sub_category_id]);
        }
        if($request->sub_sub_child_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_child_category_id' => $request->sub_sub_child_category_id]);
        }

        if($request->sub_sub_child_child_category_id != null){
            $conditions = array_merge($conditions, ['sub_sub_child_child_category_id' => $request->sub_sub_child_child_category_id]);
        }
        if($request->category_six_id != null){
            $conditions = array_merge($conditions, ['category_six_id' => $request->category_six_id]);
        }
        if( $request->category_seven_id != null){
            $conditions = array_merge($conditions, ['category_seven_id' =>  $request->category_seven_id]);
        }
        if( $request->category_eight_id != null){
            $conditions = array_merge($conditions, ['category_eight_id' =>  $request->category_eight_id]);
        }
        if( $request->category_nine_id != null){
            $conditions = array_merge($conditions, ['category_nine_id' =>  $request->category_nine_id]);
        }
        if( $request->category_ten_id != null){
            $conditions = array_merge($conditions, ['category_ten_id' =>  $request->category_ten_id]);
        }

        if( $request->name != null){
            $name = $request->name;
            $products = Product::where($conditions)
                ->where(function($query) use ($name){
                    $query->where('name', 'like', '%'.$name.'%')
                    ->orWhere('name_bn', 'like', '%'.$name.'%');
                })
                ->latest()->paginate($page_size);
        }
        else{
            $products = Product::where($conditions)->latest()->paginate($page_size);
        }

        return new ProductCollection($products);
    }
    public function searchProduct(Request $request)
    {
        $query = $request->q;
        $sort_by = $request->sort_by;
        $page_size = $request->page_size;
        $category_id = (Category::where('slug', $request->category_1)->first() != null) ? Category::where('slug', $request->category_1)->first()->id : null;
        $subcategory_id = (SubCategory::where('slug', $request->category_2)->first() != null) ? SubCategory::where('slug', $request->category_2)->first()->id : null;
        $subsubcategory_id = (SubSubCategory::where('slug', $request->category_3)->first() != null) ? SubSubCategory::where('slug', $request->category_3)->first()->id : null;
        $subsubchildcategory_id = (SubSubChildCategory::where('slug', $request->category_4)->first() != null) ? SubSubChildCategory::where('slug', $request->category_4)->first()->id : null;
        $subsubchildchildcategory_id = (SubSubChildChildCategory::where('slug', $request->category_5)->first() != null) ? SubSubChildChildCategory::where('slug', $request->category_5)->first()->id : null;
        $category_six_id = (CategorySix::where('slug', $request->category_6)->first() != null) ? CategorySix::where('slug', $request->category_6)->first()->id : null;
        $category_seven_id = (CategorySeven::where('slug', $request->category_7)->first() != null) ? CategorySeven::where('slug', $request->category_7)->first()->id : null;
        $category_eight_id = (CategoryEight::where('slug', $request->category_8)->first() != null) ? CategoryEight::where('slug', $request->category_8)->first()->id : null;
        $category_nine_id = (CategoryNine::where('slug', $request->category_9)->first() != null) ? CategoryNine::where('slug', $request->category_9)->first()->id : null;
        $category_ten_id = (CategoryTen::where('slug', $request->category_10)->first() != null) ? CategoryTen::where('slug', $request->category_10)->first()->id : null;
        $min_price = $request->min_price;
        $max_price = $request->max_price;

        $conditions = ['published' => 1,'verification_status' => 1,'bid_status' =>'Applied'];

        if($category_id != null){
            $conditions = array_merge($conditions, ['category_id' => $category_id]);
        }
        if($subcategory_id != null){
            $conditions = array_merge($conditions, ['sub_category_id' => $subcategory_id]);
        }
        if($subsubcategory_id != null){
            $conditions = array_merge($conditions, ['sub_sub_category_id' => $subsubcategory_id]);
        }
        if($subsubchildcategory_id != null){
            $conditions = array_merge($conditions, ['sub_sub_child_category_id' => $subsubchildcategory_id]);
        }
        if($subsubchildchildcategory_id != null){
            $conditions = array_merge($conditions, ['sub_sub_child_child_category_id' => $subsubchildchildcategory_id]);
        }

        if($category_six_id != null){
            $conditions = array_merge($conditions, ['category_six_id' => $category_six_id]);
        }

        if($category_seven_id != null){
            $conditions = array_merge($conditions, ['category_seven_id' => $category_seven_id]);
        }

        if($category_eight_id != null){
            $conditions = array_merge($conditions, ['category_eight_id' => $category_eight_id]);
        }

        if($category_nine_id != null){
            $conditions = array_merge($conditions, ['category_nine_id' => $category_nine_id]);
        }

        if($category_ten_id != null){
            $conditions = array_merge($conditions, ['category_ten_id' => $category_ten_id]);
        }

        $products = Product::where($conditions);

        if(Auth::user()){
            $products = $products->where('user_id', '!=', Auth::user()->id);
        }

        if($min_price != null && $max_price != null){
            $products = $products->where('unit_price', '>=', $min_price)->where('unit_price', '<=', $max_price);
        }

        if($query != null){
            $products = $products->where('name', 'like', '%'.$query.'%');
        }

        if($sort_by != null){
            switch ($sort_by) {
                case 'newest':
                    $products->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $products->orderBy('created_at', 'asc');
                    break;
                case 'price_low_to_high':
                    $products->orderBy('unit_price', 'asc');
                    break;
                case 'price_high_to_low':
                    $products->orderBy('unit_price', 'desc');
                    break;
                default:
                    // code...
                    break;
            }
        }

        $allProducts = filter_products($products)->latest()->paginate($page_size)->appends(request()->query());
        return new ProductsListCollection($allProducts);
    }

}
