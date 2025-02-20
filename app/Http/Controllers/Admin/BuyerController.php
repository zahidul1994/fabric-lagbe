<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UserInfo;
use App\Http\Controllers\Controller;
use App\Model\Buyer;
use App\Model\Seller;
use App\Model\VerificationCode;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BuyerController extends Controller
{
//    function __construct()
//    {
//        $this->middleware('permission:buyer-list || buyer-ban-unban || buyer-verification', ['only' => ['index','buyerListAjax']]);
//        $this->middleware('permission:buyer-profile', ['only' => ['buyerProfile']]);
//        $this->middleware('permission:buyer-profile-edit', ['only' => ['profileEdit','profileUpdate']]);
////        $this->middleware('permission:buyer-password', ['only' => ['updatePassword']]);
//        $this->middleware('permission:buyer-verification', ['only' => ['verification']]);
//        $this->middleware('permission:buyer-ban-unban', ['only' => ['ban']]);
//    }

//    public function index()
//    {
//        $buyers = Buyer::latest()->get();
//        return view('backend.admin.buyer.index', compact('buyers'));
//    }

    public function index(Request $request){
        $date = date('Y-m-d');
        $start_date = $request->start_date ?? date('Y-m-d', strtotime('-7 day'));
        $end_date = $request->end_date ?? $date;
        $buyers = Buyer::all();
        foreach ($buyers as $buyer){
            if ($buyer->selected_category_v2 == null){
                if ($buyer->selected_category){
                    $buyer->selected_category_v2 = getSelectedCategories($buyer->user_id,'buyer');
                    $buyer->save();
                }
            }
            $user = User::find($buyer->user_id);
            if ($user->name_bn && $user->name == null){
                $user->name =  $user->name_bn;
                $user->save();
            }
        }
        return view('backend.admin.buyer.index',compact('start_date','end_date'));

    }
    public function buyerListAjax($start_date = null, $end_date = null){
        return Buyer::ajaxBuyerList1($start_date, $end_date);
    }
    public function buyerProfile($id){
        $buyer = Buyer::where('user_id',$id)->first();
        return view('backend.admin.buyer.profile',compact('buyer'));
    }
    public function verification(Request  $request){
        $buyer = Buyer::find($request->id);
        $buyer->verification_status = $request->status;
        if($buyer->save() && $buyer->verification_status==1){
            $user = User::where('id',$buyer->user_id)->first();
            $title = 'Approved Buyer';
            $message = 'Dear, '. $user->name .' your buyer account has been approved by fabriclagbe.com';
            createNotification($buyer->user_id,$title,$message);
            if($user->country_code == '+880') {
                UserInfo::smsAPI('880' . $user->phone, $message);
                SmsNotification($user->id,$title,$message);
            }
            return 1;
        }
        return 0;
    }
    public function individualBuyer($buyer_id){
        $buyers = Buyer::where('id',$buyer_id)->latest()->get();
        return view('backend.admin.buyer.index',compact('buyers'));
    }
    public function statusEdit(Request $request){
        $buyer = Buyer::find($request->id);
        return view('backend.admin.buyer.status',compact('buyer'));
    }
    public function statusUpdate($id){
        $buyer = Buyer::find($id);
        if ($buyer->verification_status == 0){
            $buyer->verification_status = 1;
            $buyer->save();
            if($buyer->id){
                $user = User::where('id',$buyer->user_id)->first();
                $title = 'Approved Buyer';
                $message = 'Dear, '. $user->name .' your buyer account has been approved by fabriclagbe.com';
                createNotification($buyer->user_id,$title,$message);
                if($user->country_code == '+880') {
                    UserInfo::smsAPI('880'.$user->phone, $message);
                    SmsNotification($user->id,$title,$message);
                }
            }
        }else{
            $buyer->verification_status = 0;
            $buyer->save();
            if($buyer->id){
                $user = User::where('id',$buyer->user_id)->first();
                $title = 'Approved Seller';
                $message = 'Dear, '. $user->name .' your account has been deactivated';
                createNotification($buyer->user_id,$title,$message);
                if($user->country_code == '+880') {
                    UserInfo::smsAPI('880'.$user->phone, $message);
                    SmsNotification($user->id,$title,$message);
                }
            }
        }
        return back();

    }
    public function profileEdit($id){
        $buyer = User::find(decrypt($id));
        return view('backend.admin.buyer.edit',compact('buyer'));
    }
    public function profileUpdate(Request $request, $id){
        $selectedCategories['category_1']= $request->category_1;
        $selectedCategories['category_2']= $request->category_2;
        $selectedCategories['category_3']= $request->category_3;
        $selectedCategories['category_4']= $request->category_4;
        $selectedCategories['category_5']= $request->category_5;
        $selectedCategories['category_6']= $request->category_6;
        $selectedCategories['category_7']= $request->category_7;
        $selectedCategories['category_8']= $request->category_8;
        $selectedCategories['category_9']= $request->category_9;
        $selectedCategories['category_10']= $request->category_10;

        $user = User::find($id);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->whatsapp_number = $request->whatsapp_number;
        $user->email = $request->email;
        $user->address = $request->address;
        if($request->hasFile('nid_front')){
            $user->nid_front = $request->nid_front->store('uploads/nid');
        }
        if($request->hasFile('nid_back')){
            $user->nid_back = $request->nid_back->store('uploads/nid');
        }
        $user->save();
        $buyer = Buyer::where('user_id',$id)->first();
        $buyer->selected_category = json_encode($selectedCategories);
        $buyer->save();

        Toastr::success('Profile Updated Successfully','Success');
        return redirect()->back();
    }
    public function updatePassword(Request $request, $id)
    {
        $this->validate($request, [
            'password' =>  'required|min:8',
        ]);

        $user =  User::find($id);
        if ($request->confirm_password == $request->password) {
            $user->password = Hash::make($request->password);
            $user->save();
            Toastr::success('Password Updated Successfully','Success');
            return redirect()->back();
        }else{
            Toastr::error('New password does not match with confirm password.', 'Error');
            return redirect()->back();
        }
    }

    public function ban($id){
        $user = User::findOrFail($id);

        if($user->banned == 1) {
            $user->banned = 0;
        } else {
            $user->banned = 1;
        }
        $user->save();
        return back();
    }
    public function activate($id){
        $user = User::findOrFail($id);
        $verification = VerificationCode::where('phone',$user->phone)->first();
        if (!empty($verification)){
            $verification->status = 1;
            $verification->save();
            $user->verification_code = $verification->code;
        }else{
            $user->verification_code = 1234;
        }
        $user->banned = 0;
        $user->save();
        $seller = Seller::where('user_id',$user->id)->first();
        if ($user->user_type == 'seller' && empty($seller)){
            $newSeller = new Seller();

        }
        return back();
    }
}
