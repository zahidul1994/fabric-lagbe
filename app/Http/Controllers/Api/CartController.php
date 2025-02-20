<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Color;
use App\Model\Order;
use App\Model\Coupon;
use App\Model\Address;
use App\Model\Product;
use App\Model\UserCartLog;
use App\Model\OrderDetails;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Model\SSLCommerzModel;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ProductAddCart(Request $request)
{
    $cartCheck = Cart::content()->where('id', $request->product_id)->first();
    $product = Product::find($request->product_id);

    if ($cartCheck) {
        $info = Cart::update($cartCheck->rowId, ['qty' => $cartCheck->qty + 1]);
        return response()->json(['message' => 'Product quantity updated in the cart']);
    }

    if ($request->variant == 0) {
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
        return response()->json(['data' => $data, 'message' => 'Product added to the cart']);
    }
}




public function ProductAddCartIncrement(Request $request)
{
    $cartCheck = Cart::content()->where('id', $request->product_id)->first();
    $product = Product::find($request->product_id);

    if ($cartCheck) {
        Cart::update($cartCheck->rowId, ['qty' => $cartCheck->qty + 1]);
        return response()->json(['message' => 'Product quantity incremented successfully'], 200);
    } else {
        return response()->json(['error' => 'Product not found in cart'], 404);
    }
}

public function ProductAddCartDecrement(Request $request)
{
    $cartCheck = Cart::content()->where('id', $request->product_id)->first();
    $product = Product::find($request->product_id);

    if ($cartCheck) {
        if ($cartCheck->qty > 1) {
            Cart::update($cartCheck->rowId, ['qty' => $cartCheck->qty - 1]);
            return response()->json(['message' => 'Product quantity decremented successfully'], 200);
        } else {
            Cart::remove($cartCheck->rowId);
            return response()->json(['message' => 'Product removed from cart successfully'], 200);
        }
    } else {
        return response()->json(['error' => 'Product not found in cart'], 404);
    }
}



public function orderSubmit(Request $request){

    $this->validate($request, [
        'full_name' => 'required',
        'address' => 'required',
        'city' => 'required',
        'area' => 'required',
        'colony' => 'required',
        'delivery_to' => 'required',
        'vat' => 'required|numeric|min:0',
        'delivery_charge' => 'required|numeric|min:0',
        'coupon_code' => 'nullable|string',
        'coupon_discount' => 'nullable|numeric|min:0',
    ]);

    $data = $request->all();
    $shipping_info = json_encode($data);

    // $coupon = Coupon::where('code', $request->coupon_code)
    //                 ->where('status', 1)
    //                 ->first();

    $order = new Order();
    $order->invoice_code = 'FLL-'.date('Ymd-his');
    $order->user_id = $request->user_id;
    $order->shipping_address = $shipping_info;
    $order->payment_status = '';
    $order->total = $request->total;
    // $order->vat = $request->vat;
    
    // if ($coupon){
    //     $order->coupon_id = $coupon->id;
    //     $order->coupon_discount = $request->coupon_discount;
    // }

    $order->grand_total = $request->total + $request->delivery_charge + $request->vat - $request->coupon_discount;
    $order->delivery_cost = $request->delivery_charge;
    $order->delivery_status = "Pending";
    $order->view = 0;
    $order->save();

    foreach ($request->products as $product) {
        $orderDetails = new OrderDetails();
        $orderDetails->order_id = $order->id;
        $orderDetails->product_id = $product['id'];
        $orderDetails->seller_id = $product['seller_id'];
        $orderDetails->unit = $product['unit'] ?: null;
        $orderDetails->name = $product['name'];
        $orderDetails->price_with_vat = $product['price'];
        $orderDetails->price = $product['price_without_vat'];
        $orderDetails->vat_percent = $product['product_vat'];
        $orderDetails->quantity = $product['quantity'];
        $orderDetails->product_referral_code = '0';
        $orderDetails->save();

        $product = Product::find($product['id']);
        // $product->num_of_sale++;
        $product->save();
    }

    return response()->json([
        'status' => 'success',
        'message' => 'Order created successfully',
        'order' => $order
    ]);
}


public function payManually(Request $request, $id)
    {
        $order = Order::find($id);
        $order->payment_status = 'Partial';
        $order->payment_type = 'manually';
        $order->payment_method = $request->payment_type;

        if ($request->payment_type == 'Cash') {
            $data['description'] = $request->description;
            $order->payment_method = json_encode($data);
        } 
        // elseif ($request->payment_type == 'LC') {
        //     $data['description'] = $request->description;
        //     $order->payment_method = json_encode($data);
        // } elseif ($request->payment_type == 'Check') {
        //     $data['bank_name'] = $request->bank_name;
        //     $data['check_number'] = $request->check_number;
        //     $data['dispatch_date'] = $request->dispatch_date;
        //     $data['description'] = $request->description;
        //     $order->payment_method = json_encode($data);
        // }

        $order->save();

        return response()->json([
            'message' => 'Payment information has been updated successfully'
        ]);
    }


    public function success(Request $request)
    {
        $sslc = new SSLCommerz();
        $tran_id = $request->tran_id;
        $order_details = SSLCommerzModel::where('tran_id', $tran_id)
            ->select('transaction_id', 'ssl_status', 'currency', 'amount', 'order_id')
            ->first();

        if (!$order_details) {
            return response()->json([
                'error' => 'Transaction not found',
            ], 404);
        }

        $chekTotal = $order_details->amount;

        if ($order_details->ssl_status == 'Pending') {
            $validation = $sslc->orderValidate($tran_id, $chekTotal, $order_details->currency, $request->all());

            if ($validation == TRUE) {
                $order = Order::find($order_details->order_id);
                $order->payment_status = "Paid";
                $order->payment_type = 'SSL';
                $data['description'] = "Payment Complete with SSL";
                $order->payment_method = json_encode($data);
                $order->save();

                $order_details->ssl_status = 'Complete';
                $order_details->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Payment complete',
                ]);
            } else {
                return response()->json([
                    'error' => 'Validation failed',
                ], 400);
            }
        } else if ($order_details->ssl_status == 'Processing' || $order_details->ssl_status == 'Complete') {
            return response()->json([
                'success' => true,
                'message' => 'Transaction is successfully completed',
            ]);
        } else {
            return response()->json([
                'error' => 'Invalid transaction status',
            ], 400);
        }
    }



    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
