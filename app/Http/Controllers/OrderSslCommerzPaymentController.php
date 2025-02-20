<?php

namespace App\Http\Controllers;
use App\Model\Order;
use App\Model\OrderDetails;
use Illuminate\Http\Request;
use App\Model\SSLCommerzModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Brian2694\Toastr\Facades\Toastr;
session_start();
class OrderSslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout()
    {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }

    public function index(Request $request, $id)
    {
        
        if(currency()->code != 'BDT'){
            Toastr::warning('You first change to currency mode into BDT.');
            return redirect()->back();
        }
       
            $order = Order::find($id);
            $post_data = array();
            $post_data['total_amount'] = $order->grand_total; # You cant not pay less than 10
            $post_data['currency'] = "BDT";
            $post_data['tran_id'] = uniqid('', true); // tran_id must be unique
            $order->currency = $post_data['currency'];
            $order->transaction_id = $post_data['tran_id'];
           
            // custom save dynamic table
            $modeSave = new SSLCommerzModel();
            $modeSave->user_type = Auth::id();
            $modeSave->ssl_encrypted_text = encrypt(Session::get('password'));
            $modeSave->order_id = $order->id;
            $modeSave->tran_id = $post_data['tran_id'];
            $modeSave->save();
            $_SESSION['payment_values']['tran_id']=$post_data['tran_id'];
            $server_name=$request->root()."/";
            $post_data['success_url'] = $server_name . "ecommercesuccess";
            $post_data['fail_url'] = $server_name . "ecommercefail";
            $post_data['cancel_url'] = $server_name . "ecommercecancel";
            $sslc = new SSLCommerz();
            $payment_options = $sslc->initiate($post_data, false);
            if (!is_array($payment_options)) {
                print_r($payment_options);
                $payment_options = array();
            }
      
     
       
    }
    public function ecommercesuccess(Request $request)
    {
        $sslc = new SSLCommerz();
        $tran_id = $request->tran_id;
        $order_detials = SSLCommerzModel::wheretran_id($tran_id)
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'ssl_status','currency','amount')->first();
            $chekTotal = $order_detials->amount;
            if($order_detials->ssl_status=='Pending')
            {

                $validation = $sslc->orderValidate($tran_id, $chekTotal, $order_detials->currency, $request->all());
                if($validation == TRUE ){
                    $order = Order::find($order_detials->order_id);
                    $order->payment_status ="Paid";
                    $order->payment_type = 'SSL';
                    $data['description'] = "Payment Complete with SSL";
                    $order->payment_method = json_encode($data);
                    $order->save();
                    $order_detials->ssl_status='Complete';
                    $order_detials->save();
                    return redirect('ssl/redirect/'.$tran_id);
                }
                else{
                   
                    echo "validation Fail";
                }
            }
            else if($order_detials->ssl_status=='Processing' || $order_detials->ssl_status=='Complete')
            {
                Toastr::success('Transaction is successfully Completed','Success');
                return back();
            }
            else
            {
                Toastr::error('Invalid Transaction ','Error');
                return back();
            }
       

    }
    public function ecommercefail(Request $request)
    {
        $tran_id = $_SESSION['payment_values']['tran_id'];
        $order_detials = SSLCommerzModel::wheretran_id($tran_id)
        ->where('transaction_id', $tran_id)->first();
        if ($order_detials) {
            $order_detials->ssl_status='Failed';
            $order_detials->save();
            Toastr::error('Invalid Transaction ','Error');
            return back();
        }
        else{
           
            echo "validation Fail";
        }

    }
    public function ecommercecancel(Request $request)
    {
        $tran_id = $_SESSION['payment_values']['tran_id'];
        $order_detials = SSLCommerzModel::wheretran_id($tran_id)
        ->where('transaction_id', $tran_id)->first();
        if ($order_detials) {
            $order_detials->ssl_status='Canceled';
            $order_detials->save();
            Toastr::error('Transaction Cancel','Error');
            return back();
        }
        else{
           
            echo "validation Fail";
        }
        

    }





    public function payViaAjax(Request $request)
    {

        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "orders"
        # In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = '10'; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        #Before  going to initiate the payment order status need to update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

   
}
