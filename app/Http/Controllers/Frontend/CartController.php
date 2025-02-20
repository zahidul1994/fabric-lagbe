<?php

namespace App\Http\Controllers\Frontend;

use App\Model\Color;
use App\Model\Order;
use App\Model\CheckOutOnly;
use App\Model\Coupon;
use App\Model\Address;
use App\Model\Product;
use App\Model\UserCartLog;
use App\Model\OrderDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function cartShow(){
        return view('frontend.pages.cart');
    }
    public function checkout(){
      
        $cartContent = json_encode(Cart::content());
        $user = Auth::user();

        $checkoutOnly = new CheckOutOnly();

        $checkoutOnly->cart_data = $cartContent;
        $checkoutOnly->user_name = $user->name;
        $checkoutOnly->user_phone = $user->phone;

        $checkoutOnly->save();

       
        return view('frontend.pages.checkout');
    }

    public function cartRemove($rowId)
    {
        Toastr::error('This Product removed from cart');
        Cart::remove($rowId);
        return back();
    }
    public function ProductAddCart(Request  $request) {

        $cartCheck = Cart::content()->where('id',$request->product_id)->first();
        $product = Product::find($request->product_id);
        if($cartCheck){
           $info=  Cart::update($cartCheck->rowId, ['qty' =>$cartCheck->qty+1]);
            return view('frontend.includes.addToCart');
        }

        if($request->variant == 0){

            $data = array();
            $data['id'] = $product->id;
            $data['name'] = $product->name;
            $data['qty'] = 1;
            $data['price'] = $product->unit_vat_price;
            $data['options']['price_without_vat'] = $product->unit_price;
            $data['options']['product_vat'] = $product->vat_percent;
            $data['options']['image'] = $product->thumbnail_img;
            $data['options']['cart_type'] = "product";
            $data['options']['product_quantity'] = $product->quantity;
            $data['options']['unit_vat_price'] = $product->unit_vat_price;
            $data['options']['unit'] = $product->unit->name;
            $data['options']['var_price_qty'] = $product->var_price_qty;
            Cart::add($data);
            return view('frontend.includes.addToCart', compact('data'));
        }

    }
    public function storeUserStore(Request $request){
        return response($request->all());
        $this->validate($request,[
            'full_name' => 'required',
            // 'region' => 'required',
            // 'phone' => 'required',
            // 'phone' => 'required',
            // 'house_no' => 'required',
            // 'area' => 'required',
            // 'delivery_to' => 'required',
            'address' => 'required',
        ]);
        $data['full_name'] = $request->full_name;
        $data['region'] = $request->region;
        $data['phone'] = $request->phone;
        $data['city'] = $request->city;
        $data['house_no'] = $request->house_no;
        $data['area'] = $request->area;
        $data['colony'] = $request->colony;
        $data['address'] = $request->address;
        $data['delivery_to'] = $request->delivery_to;
        $shipping_info = json_encode($data);

        $coupon = Coupon::where('code',$request->coupon_code)->where('status',1)->first();
        $order = new UserCartLog();
         $order->user_id = Auth::user()->id;
        $order->shipping_address = $shipping_info;
        $order->coupon_discount =  $coupon->coupon_discount;
        $order->total = Cart::total();
        $order->vat = $request->vat;
       

        $order->grand_total = Cart::total() + 50 + $request->vat - $request->coupon_discount;
        $order->delivery_cost = 50;
        $order->delivery_status = "Pending";
        $order->view = 0;
        $order->save();
        foreach (Cart::content() as $content) {
            $product = Product::find($content->id);
            $orderDetails = new OrderDetails();
            $orderDetails->order_id = $order->id;
            $orderDetails->product_id = $content->id;
            $orderDetails->seller_id = $product->user_id;
            $orderDetails->order_id = $order->id;
            $orderDetails->unit = $content->options->unit?:null;
            $orderDetails->product_id = $product->id;
            $orderDetails->name = $product->name;
            $orderDetails->price_with_vat = $content->price;
            $orderDetails->price = $content->options->price_without_vat;
            $orderDetails->vat_percent = $content->options->product_vat;
            $orderDetails->quantity = $content->qty;
            $orderDetails->product_referral_code = '0';
            $orderDetails->save();

            // $product->num_of_sale++;
            $product->save();
            $orderDetails->save();
        }
        if($order){
            Toastr::success('Order Successfully done! ');
            Cart::destroy();
            return redirect()->route('order-summary',$order->id);
        }else{
            Toastr::warning('Something went wrong');
            return redirect()->back();
        }
    }
    public function orderSubmit(Request $request){
        $this->validate($request,[
            'full_name' => 'required',
            // 'region' => 'required',
            // 'phone' => 'required',
            // 'phone' => 'required',
            // 'house_no' => 'required',
            // 'area' => 'required',
            // 'delivery_to' => 'required',
            'address' => 'required',
        ]);
        $data['full_name'] = $request->full_name;
        $data['region'] = $request->region;
        $data['phone'] = $request->phone;
        $data['city'] = $request->city;
        $data['house_no'] = $request->house_no;
        $data['area'] = $request->area;
        $data['colony'] = $request->colony;
        $data['address'] = $request->address;
        $data['delivery_to'] = $request->delivery_to;
        $shipping_info = json_encode($data);

        $coupon = Coupon::where('code',$request->coupon_code)->where('status',1)->first();
        $order = new Order();
        $order->invoice_code = 'FLL-'.date('Ymd-his');
        $order->user_id = Auth::user()->id;
        $order->shipping_address = $shipping_info;
        $order->payment_status = '';
        $order->total = Cart::total();
        $order->vat = $request->vat;
        if ($coupon){
            $order->coupon_id = $coupon->id;
            $order->coupon_discount = $request->coupon_discount;
        }

        $order->grand_total = Cart::total() + $request->delivery_charge + $request->vat - $request->coupon_discount;
        $order->delivery_cost = $request->delivery_charge;
        $order->delivery_status = "Pending";
        $order->view = 0;
        $order->save();
        foreach (Cart::content() as $content) {
            $product = Product::find($content->id);
            $orderDetails = new OrderDetails();
            $orderDetails->order_id = $order->id;
            $orderDetails->product_id = $content->id;
            $orderDetails->seller_id = $product->user_id;
            $orderDetails->order_id = $order->id;
            $orderDetails->unit = $content->options->unit?:null;
            $orderDetails->product_id = $product->id;
            $orderDetails->name = $product->name;
            $orderDetails->price_with_vat = $content->price;
            $orderDetails->price = $content->options->price_without_vat;
            $orderDetails->vat_percent = $content->options->product_vat;
            $orderDetails->quantity = $content->qty;
            $orderDetails->product_referral_code = '0';
            $orderDetails->save();

            // $product->num_of_sale++;
            $product->save();
            $orderDetails->save();
        }
        if($order){
            Toastr::success('Order Successfully done! ');
            Cart::destroy();
            return redirect()->route('order-summary',$order->id);
        }else{
            Toastr::warning('Something went wrong');
            return redirect()->back();
        }
    }
    // public function orderSummary($id){
    //     $order = Order::find($id);
    //     return view('frontend.pages.order_summery',compact('order'));

    // }
    public function orderSubmit1(Request $request) {
        if ($request->address_id == null) {
            Toastr::error('Please select an address.','Please Select');
            return back();
        }

        $this->validate($request,[
            'pay' => 'required',
        ]);
        if($request->pay == 'cod'){
            $payment_status = 'Due';
        }
        if($request->pay == 'ssl'){
            $payment_status = 'Paid';
        }
        $address = Address::where('user_id',Auth::id())->where('id',$request->address_id)->first();
        $data['name'] = Auth::User()->name;
        $data['email'] = Auth::User()->email;
        $data['address'] = $address->address;
        $data['country'] = $address->country;
        $data['city'] = $address->city;
        $data['postal_code'] = $address->postal_code;
        $data['phone'] = $address->phone;
        $shipping_info = json_encode($data);


        $order = new Order();
        $order->invoice_code = date('Ymd-his');
        $order->user_id = Auth::user()->id;
        $order->shipping_address = $shipping_info;
        $order->payment_type = $request->pay;
        $order->payment_status = $payment_status;
        $order->grand_total = Cart::total();
        $order->delivery_cost = 0;
        $order->delivery_status = "Pending";
        $order->view = 0;
        $order->type = "product";
        $order->save();

        foreach (Cart::content() as $content) {
            $product = Product::find($content->id);
            $orderDetails = new OrderDetails();
            $orderDetails->order_id = $order->id;
            $orderDetails->variation = $content->options->variant;
            $orderDetails->product_id = $content->id;
            $orderDetails->name = $content->name;
            $orderDetails->price = $content->price;
            $orderDetails->quantity = $content->qty;
            $orderDetails->save();

            $product->num_of_sale++;
            $product->save();
        }
        $orderUpdate = Order::find($order->id);
        $orderUpdate->grand_total = $content->price * $content->qty;
        $orderUpdate->save();

        if ($request->pay == 'cod') {

            Toastr::success('Order Successfully done! ');
            Cart::destroy();
            return redirect()->route('index');
        }else {
//
            Toastr::warning('Online PaymentHistory Method not yet done. Please try on COD');
            return redirect()->back();
        }
        return redirect()->back();
    }
    public function get_coupon_amount(Request $request){
        $coupon = Coupon::where('code',$request->coupon)->where('status',1)->first();

        if($coupon){
            $check = Order::where('user_id',Auth::id())->where('coupon_id',$coupon->id)->first();
            if(empty($check)){
                if ($coupon->type == 'percentage'){
                    $percentageAmount = Cart::total() * ($coupon->amount/100);
                    $data['amount']=$percentageAmount;
                    $data['value']= getNumberWithCurrencyByBnEn($percentageAmount);
                }else{
                    $data['amount']= $coupon->amount;
                    $data['value']= getNumberWithCurrencyByBnEn($coupon->amount);
                }
                return $data;
            }else{
                return null;
            }

        }else{
            return null;
        }
    }
    public function get_total_amount(Request $request){

        $cartTotal = Cart::total();
        $vat = $request->vat;
        $deliveryCharge = $request->delivery_charge;
        $couponDiscount = $request->coupon_discount;
        $value = getNumberWithCurrencyByBnEn($cartTotal + $vat + $deliveryCharge - $couponDiscount);
        return $value;
    }

    public function payManually(Request $request, $id){
        $order = Order::find($id);
        $order->payment_status = 'Partial';
        $order->payment_type = 'manually';
        $order->payment_method = $request->payment_type;
        if($request->payment_type == 'Cash'){
            $data['description'] = $request->description;
            $order->payment_method = json_encode($data);
        }elseif($request->payment_type == 'LC'){
            $data['description'] = $request->description;
            $order->payment_method = json_encode($data);
        }elseif($request->payment_type == 'Check'){
            $data['bank_name'] = $request->bank_name;
            $data['check_number'] = $request->check_number;
            $data['dispatch_date'] = $request->dispatch_date;
            $data['description'] = $request->description;
            $order->payment_method = json_encode($data);
        }
        $order->save();
        Toastr::success('Payment Successfully done! ');
        if(Auth::user()->user_type == 'seller'){
            return redirect()->route('seller.dashboard');
        }elseif(Auth::user()->user_type == 'buyer'){
            return redirect()->route('buyer.dashboard');
        }

    }
    public function payStripe($id){
        $order = Order::find($id);
    }


    // public function globalAddToCart(Request $request)
    // {
    //   return  $this->ProductBuy($request);
    // }


    public function ProductAddCartIncrement(Request  $request) {

        $cartCheck = Cart::content()->where('id',$request->product_id)->first();
        $product = Product::find($request->product_id);
        if($cartCheck){
           $info=  Cart::update($cartCheck->rowId, ['qty' =>$cartCheck->qty+1]);
            return view('frontend.includes.addToCart');
        }


    }
    public function ProductAddCartDecrement(Request  $request) {

        $cartCheck = Cart::content()->where('id',$request->product_id)->first();
        $product = Product::find($request->product_id);
        if($cartCheck){
           $info=  Cart::update($cartCheck->rowId, ['qty' =>$cartCheck->qty-1]);
            return view('frontend.includes.addToCart');
        }


    }
    public function ProductAddCartIncrementDecrement(Request  $request) {

        $product = Product::find($request->product_id);
        $cartCheck = Cart::content()->where('id',$request->product_id)->first();
       if($cartCheck && (($product->quantity)>($request->quantity)==true)){
            Cart::update($cartCheck->rowId, ['qty' =>$request->quantity]);
            return view('frontend.includes.addToCart');
        }
        else{
            Cart::update($cartCheck->rowId, ['qty' =>$product->quantity]);
            return view('frontend.includes.addToCart');
        }


    }

}
