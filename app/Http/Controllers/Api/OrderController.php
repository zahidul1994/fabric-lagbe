<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Model\Buyer;
use App\Model\Order;
use App\Model\Seller;
use App\Model\Product;
use App\Model\UserCartLog;
use App\Model\OrderDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\userProfileCollections;

class OrderController extends Controller
{
    public $successStatus = 201;
    public $failStatus = 401;

## for save user cartdata ##
    public function storeUserCart(Request $request){
        $cartItems = $request->cart_values;
        $cart_values = array(); 
        foreach ($cartItems as $cartItem) {
            $product = Product::find($cartItem['id']);
            $cart_values[] = array(
               'product_id' => $cartItem['id'], 
               'seller_id' => $product->user_id, 
               'unit' => $product->unit->name, 
               'name' => $product->name, 
               'price' => $cartItem['price'], 
               'unit_price' =>$product->unit_vat_price, 
               'quantity' => $cartItem['qty'], 
               'vat_percent' => $product->vat_percent,
            );
        }
       
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
        $save = new UserCartLog();
         $save->user_id = $request->user_id;
        $save->shipping_address = $shipping_info;
        $save->coupon_discount =  $request->coupon_discount?:0;
        $save->total =$request->total;
        $save->vat = $request->vat?:0;
        $save->grand_total = $request->grand_total;
        $save->delivery_cost = $request->delivery_cost?:0;
        $save->view = 0;
        $save->cart_values =json_encode($cart_values);
        $save->save();
        return response()->json([
            'success' => true,
            'message' => 'Your data save successfully',
            'save_id' =>$save,
            'vale'=>json_decode($save->cart_values,true),
        ], $this->successStatus);
    
    }



    public function store(Request $request){
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
        if($request->has('coupon_code')){
            $coupon = Coupon::where('code',$request->coupon_code)->where('status',1)->first();
        }else{
            $coupon = '';
        }

        $order = new Order();
        $order->invoice_code = 'FLL-'.date('Ymd-his');
        $order->user_id = Auth::user()->id;
        $order->shipping_address = $shipping_info;
        $order->payment_status = '';
        $order->total = $request->getTotalPrice;
        $order->vat = $request->vat;
        if ($coupon){
            $order->coupon_id = $coupon->id;
            $order->coupon_discount = $request->coupon_discount;
        }

        $order->grand_total = $request->getTotalPrice + 50 + $request->vat - $request->coupon_discount;
        $order->delivery_cost = 50;
        $order->delivery_status = "Pending";
        $order->view = 0;
        $insert_id = $order->save();
        $cartItems = $request->cartData;
        if($insert_id){
            // foreach (Cart::content() as $content) {
            foreach ($cartItems as $cartItem) {
                $product = Product::find($cartItem['id']);
                $orderDetails = new OrderDetails();
                $orderDetails->order_id = $order->id;
                $orderDetails->product_id = $cartItem['id'];
                $orderDetails->seller_id = $product->user_id;
                $orderDetails->order_id = $order->id;
                $orderDetails->unit =  $cartItem['unit'];
                $orderDetails->product_id = $product->id;
                $orderDetails->name = $product->unit->name;
                $orderDetails->price = $cartItem['price'];
                $orderDetails->quantity = $cartItem['qty'];
                $orderDetails->product_referral_code = '0';
                $orderDetails->price_with_vat = $cartItem['price'];
                $orderDetails->vat_percent = $product->product_vat;
                $orderDetails->save();
            }

            // Cart::destroy();
            return response()->json([
                'success' => true,
                'message' => 'Your order has been placed successfully',
                'order_id' =>$order,
            ], $this->successStatus);
        }else{
            return response()->json([
                'success'=>false,
                'message'=>'No Order Successfully!'
            ], $this->failStatus);
        }

        // $address = Address::findOrFail($request->shipping_address_id);
        // if($address){
        //     $user = User::find($request->user_id);
        //     $shipping_address_data = array(
        //         "name"=>$user->name,
        //         "phone"=>$user->phone,
        //         "email"=>$user->email,
        //         "address"=>$address->address,
        //         "country"=>$address->country,
        //         "city"=>$address->city,
        //         "state"=>$address->state,
        //         "postal_code"=>"logged",
        //         "payment_mode"=>'cod',
        //     );
        // }

        // $shipping_address = $address ? json_encode($shipping_address_data) : NULL;
        // $order = new Order;
        // if($request->user_id){
        //     $order->user_id = $request->user_id;
        // }
        // else{
        //     $order->guest_id = mt_rand(100000, 999999);
        // }
        // $order->shipping_address = $shipping_address;
        // $order->payment_type = 'cash_on_delivery';
        // $order->grand_total = $request->getTotalPrice;
        // $order->delivery_viewed = '0';
        // $order->payment_status_viewed = '0';
        // $order->code = date('Ymd-His').rand(10,99);
        // $order->date = strtotime('now');
        // $order->delivery_charge = 0;
        // if($order->save()){
        //     $cartItems = $request->cartData;
        //     foreach ($cartItems as $cartItem) {
        //         $product = Product::findOrFail($cartItem['id']);
        //             $product->update([
        //                 'current_stock' => DB::raw('current_stock - ' . $cartItem['qty'])
        //             ]);

        //         $order_detail_shipping_cost= 0;

        //         OrderDetail::create([
        //             'order_id' => $order->id,
        //             'seller_id' => $product->user_id,
        //             'product_id' => $product->id,
        //             'variation' => 0,
        //             'price' => $cartItem['price'] * $cartItem['qty'],
        //             'tax' => 0,
        //             'shipping_cost' => $order_detail_shipping_cost,
        //             'quantity' => $cartItem['qty'],
        //             'payment_status' => 'paid'
        //         ]);
        //         $product->update([
        //             'num_of_sale' => DB::raw('num_of_sale + ' . $cartItem['qty'])
        //         ]);
        //     }
        // }


        // return response()->json([
        //     'success' => true,
        //     'order_id' =>$request->all(),
        //     'message' => 'Your order has been placed successfully'
        // ]);






//         $user = User::find(Auth::id());
//         $seller = Seller::where('user_id',$user->id)->first();
//         if (!empty($seller)){
//             return response()->json(['success'=>false,'response'=>'You are already a seller.'], $this->failStatus);
//         }
//         $user->user_type = 'seller';
//         $multiple_user_types = json_decode($user->multiple_user_types);
//         if(!in_array("seller", $multiple_user_types)){
//             array_push($multiple_user_types, "seller");
//             $user->multiple_user_types = $multiple_user_types;
//         }
//         $user->save();


//         $seller = new Seller();
//         $seller->user_id = $user->id;
//         $seller->company_name = $request->company_name;
//         $seller->company_name_bn = $request->company_name_bn;
//         $seller->company_phone = $request->company_phone;
//         $seller->company_email = $request->company_email;
//         $seller->company_address = $request->company_address;
//         $seller->company_address_bn = $request->company_address_bn;
//         $seller->verification_status	= 0;
//         $seller->division_id= $request->division_id ? $request->division_id : NULL;
//         $seller->district_id= $request->district_id ? $request->district_id : NULL;
//         $seller->designation= $request->designation;
//         $seller->selected_category= $request->selected_category;

//         $tl = array();
//         if($request->hasFile('trade_licence')){
//             foreach ($request->trade_licence as $key => $photo) {
//                 $path = $photo->store('uploads/seller_info/trade_licence');
//                 array_push($tl, $path);
//             }
//             $seller->trade_licence = json_encode($tl);
//         }

//         if($request->hasFile('nid_front')){
//             $seller->nid_front = $request->nid_front->store('uploads/seller_info/nid');
//         }
//         if($request->hasFile('nid_back')){
//             $seller->nid_back = $request->nid_back->store('uploads/seller_info/nid');
//         }
//         $insert_id = $seller->save();
//         if($insert_id){
//             $title = 'Applied for Seller';
//             $message = $user->name .' applied for seller.';
//             registrationNotification($user->id,$title,$message);
//             // admin sms
// //                    UserInfo::smsAPI('8801725930131', $message);
// //                    SmsNotification(9,$title,$message);
//         }
//         if($insert_id){
//             return response()->json(['success'=>true,'response' => $user,'seller_info' => $seller], $this->successStatus);
//         }else{
//             return response()->json(['success'=>false,'response'=>'No Successfully Updated!'], $this->failStatus);
//         }
    }


}
