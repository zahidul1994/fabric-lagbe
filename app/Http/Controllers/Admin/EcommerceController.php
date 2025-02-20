<?php

namespace App\Http\Controllers\Admin;
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
use Illuminate\Support\Str;
use App\Model\SizingProduct;
use Illuminate\Http\Request;
use App\Model\PaymentHistory;
use App\Model\SubSubCategory;
use App\Model\SubSubChildCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Model\SubSubChildChildCategory;

class EcommerceController extends Controller
{
    function __construct(Request $request)
    {
         $this->middleware('permission:ecommerce-orders-list', ['only' => ['index']]);
        // $this->middleware('permission:seller-product-verification-status', ['only' => ['sellerProductUpdateStatus']]);
        
    }
    public function index(Request $request)
    {
       
        $start_date = $request->start_date ?? date('Y-m-d',strtotime('-7 day'));
        $end_date = $request->end_date ?? date('Y-m-d');
        $orders = Order::with('user')->where('order_status','!=','Rejected')->latest()->get();
        return view('backend.admin.ecommerces.index',compact('orders','start_date','end_date'));
    }
    public function sellerProductList(Request $request)
    {
        $start_date = $request->start_date ?? date('Y-m-d',strtotime('-7 day'));
        $end_date = $request->end_date ?? date('Y-m-d');
        $sellerProductInfos = Product::where('user_type','seller')->latest()->get();
        return view('backend.admin.ecommerces.index',compact('sellerProductInfos','start_date','end_date'));
    }

    public function show($id){
       $order = Order::with('user','orderdetail')->findOrFail(decrypt($id));
      $order->view=1;
      $order->save();
        return view('backend.admin.ecommerces.show',compact('order'));

    }
    public function edit($id){
        $product = Product::find($id);
        $dyingProduct = DyingProduct::where('product_id',$id)->first();
        return view('backend.partials.dying_product_edit',compact('product','dyingProduct'));
    }
    public function acceptReject($id,$status){      
       $order = Order::with('user','orderdetail')->findOrFail(decrypt($id));
       if($order->delivery_status=="Complete"){
        Toastr::success("Order Alredy Complete First !!","Warning");
                return back();
       }
       if(empty($order->payment_status)){
        Toastr::success("Payment First !!","Warning");
                return back();
       }
       if($status=='approve'){
        if($order){
            foreach($order->orderdetail as $orderinfo){
                $product=Product::find($orderinfo->product_id);
               if( $product->quantity<$orderinfo->quantity){
                Toastr::success("The Product Name:.$product->name. Stock Out !!","Warning");
                return back();
              }
     
                 }
        foreach($order->orderdetail as $orderinfo){
           $product=Product::find($orderinfo->product_id);
           $product->quantity -=$orderinfo->quantity;
           $product->save();

            }
        }
        $order->order_status='Accpted';
        $order->save();
      
        }

       else{
        $order->order_status='Rejected';
        $order->save();
       }
       
        Toastr::success("Order  Updated Successfully","Success");
        return redirect()->route('admin.ecommerce-orders.index');
    
    }
    public function deliveryPendingComplete(Request $request){
        $order = Order::find($request->id);
        $order->delivery_status = $request->status;
        if($order->save() && $order->delivery_status=='Complete'){
            return 1;
            }
            else{
                return 0;
            }
           
     
    }
  

}
