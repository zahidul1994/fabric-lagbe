<?php
/**
 * Created by PhpStorm.
 * User: ashiq
 * Date: 11/11/2019
 * Time: 3:08 PM
 */

namespace App\Helpers;

use App\Model\FlashDeal;
use App\Model\FlashDealProduct;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Auth;
use Auth;
use Session;
use Carbon\Carbon;
// use App\Helpers\UserInfo;
use Intervention\Image\ImageManagerStatic as Image;

class UserInfo
{
    public function __construct()
    {

    }


    public static function smsAPI($receiver_number, $sms_text)
    {

        //Non-masking
//        $api ="http://portal.metrotel.com.bd/smsapi?api_key=C2001118615978b3b5b880.40771009&type=text&contacts=".$receiver_number."&senderid=8809612441392&msg=".urlencode($sms_text);
       // $api ="http://202.164.208.226/smsapi?api_key=C200241164ec39c70b4a65.01239953&type=text&contacts=".$receiver_number."&senderid=8809612442098&msg=".urlencode($sms_text);
        //previous api
        //$api ="http://sms.viatech.com.bd/smsapi?api_key=C200132264115d355ae3f3.53574269&type=text&contacts=".$receiver_number."&senderid=8809612442098&msg=".urlencode($sms_text);
        //Masking
        //$api = "https://api.mobireach.com.bd/SendTextMessage?Username=fabric&Password=Nazmul21@/&From=FabricLagbe&To=".$receiver_number."&Message=". urlencode($sms_text);
    // $api = "https://api.rtcom.xyz/onetomany?acode=30000109&api_key=7c4ef74597aba7b9659a1708bb3a71d1a2bfc1d3&senderid=8809617612742&type=text&msg=".urlencode($sms_text)."&contacts=".$receiver_number."&transactionType=T&contentID=";
    
    //new api for rtcom starts
    $api_key = "7c4ef74597aba7b9659a1708bb3a71d1a2bfc1d3";
$acode = "30000109";
$senderid = "8809617612742";
$type = "text";
$transactionType = "T";
$contentID = ""; // Add your content ID if needed


// URL encode the parameters
$sms_text_encoded = urlencode($sms_text);

$test = 'test';


// Construct the API URL
$api = "https://api.rtcom.xyz/onetomany?acode={$acode}&api_key={$api_key}&senderid={$senderid}&type={$type}&msg={$sms_text_encoded}&contacts={$receiver_number}&transactionType={$transactionType}&contentID={$contentID}";
    
    //new api for rtcom ends

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $api,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "authorization: Basic QWxhZGRpbjpvcGVuIHNlc2FtZQ=="
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return $err;
        } else {
            return $response;
        }
    }


}
