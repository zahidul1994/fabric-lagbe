<?php

namespace App\Http\Controllers\Seller;
use App\User;
use App\Model\Unit;
use App\Model\Order;
use App\Model\Seller;
use App\Model\Product;
use App\Model\Category;
use App\Model\Currency;
use App\Helpers\UserInfo;
use App\Model\ProductBid;
use App\Model\SubCategory;
use App\Model\DyingProduct;
use App\Model\Notification;
use App\Model\OrderDetails;
use Illuminate\Support\Str;
use App\Model\SizingProduct;
use Illuminate\Http\Request;
use App\Model\SubSubCategory;
use App\Model\SubSubChildCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Model\SubSubChildChildCategory;

class EcommerceController extends Controller
{
    public function index(Request $request)
    {     
       
        $sales = OrderDetails::with('user','product')->whereseller_id(Auth::id())->latest()->get();
        
        return view('frontend.seller.ecommerces.index',compact('sales'));
    }
   

    public function show($id){
       $order = OrderDetails::with('user')->findOrFail(decrypt($id));
       $order->seller_view=1;
       $order->save();
      return view('frontend.seller.ecommerces.show',compact('order'));

    }
    public function deliveryPendingComplete(Request $request){
        $order = OrderDetails::find($request->id);
        $order->delivery_status = $request->status;
        $order->delivery_date = date('d-m-Y');
        if($order->save() && $order->delivery_status=='Complete'){
            return 1;
            }
            else{
                return 0;
            }
           
     
    }


}
