<?php
namespace App\Http\Controllers\Buyer;
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
       
        $orders = Order::with('user')->whereuser_id(Auth::id())->latest()->get();
        return view('frontend.buyer.ecommerces.index',compact('orders'));
    }
   

    public function show($id){
       $order = Order::with('user','orderdetail')->findOrFail(decrypt($id));
   
        return view('frontend.buyer.ecommerces.show',compact('order'));

    }
    
}
