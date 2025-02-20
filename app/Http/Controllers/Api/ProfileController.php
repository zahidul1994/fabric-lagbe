<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\buyerProfileCollections;
use App\Http\Resources\sellerProfileCollections;
use App\Model\Buyer;
use App\Model\ProductBid;
use App\Model\Seller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public $successStatus = 201;
    public $failStatus = 401;

    public function sellerVerificationStatus(){
        $seller = Seller::where('user_id',Auth::id())->first();
        return $seller->verification_status;
    }
    public function buyerProfileUpdate(Request $request) {
        $bid_check = ProductBid::where('sender_user_id',Auth::id())->where('receiver_user_id',Auth::id())->first();

        if (empty($bid_check)){
            $this->validate($request, [
                'name' => 'required',
            ]);
            $user = User::find(Auth::id());
            $buyer = Buyer::where('user_id',Auth::id())->first();
            $user->name = $request->name;
            $user->name_bn = $request->name_bn;
            $user->email = $request->email;
            $user->whatsapp_number = $request->whatsapp_number;
            $buyer->selected_category = $request->selected_category;
            if($request->hasFile('avatar_original')){
                $user->avatar_original = $request->avatar_original->store('uploads/profile');
            }
            if($request->hasFile('nid_front')){
                $user->nid_front = $request->nid_front->store('uploads/nid');
            }
            if($request->hasFile('nid_back')){
                $user->nid_back = $request->nid_back->store('uploads/nid');
            }
            $affected_row = $user->save();
            if($affected_row){
                return response()->json(['success'=>true,'response' => $user], $this->successStatus);
            }else{
                return response()->json(['success'=>false,'response'=>'Something went wrong.'], 400);
            }
        }else{
            $user = User::findOrFail(Auth::id());
            if($request->hasFile('avatar_original')){
                $user->avatar_original = $request->avatar_original->store('uploads/profile');
            }
            $user->save();
            return response()->json(['success'=>false,'response'=>'You can not change your profile information because you have placed bid.'], 400);
        }

    }

    public function sellerProfileUpdate(Request $request) {

        $bid_check = ProductBid::where('sender_user_id',Auth::id())->orWhere('receiver_user_id',Auth::id())->first();

        if (empty($bid_check)){
            $this->validate($request, [
                'name' => 'required',
            ]);
            $user = User::findOrFail(Auth::id());
            $user->name = $request->name;
            $user->email = $request->email;
            $user->whatsapp_number = $request->whatsapp_number;
            $user->address = $request->business_address;
            if($request->hasFile('avatar_original')){
                $user->avatar_original = $request->avatar_original->store('uploads/profile');
            }
            $affected_row = $user->update();

            $seller = Seller::where('user_id',Auth::id())->first();
            $seller->company_name = $request->company_name;
            $seller->company_name_bn = $request->company_name_bn;
            $seller->company_address = $request->company_address;
            $seller->company_address_bn = $request->company_address_bn;
            $seller->selected_category = $request->selected_category;
            $seller->division_id= $request->division_id;
            $seller->district_id= $request->district_id;
            $seller->designation= $request->designation;
            if($request->hasFile('trade_licence')){
                $seller->trade_licence = $request->trade_licence->store('uploads/seller_info/trade_licence');
            }
            if($request->hasFile('nid_front')){
                $seller->nid_front = $request->nid_front->store('uploads/seller_info/nid');
            }
            if($request->hasFile('nid_back')){
                $seller->nid_back = $request->nid_back->store('uploads/seller_info/nid');
            }
            $seller->save();

            if($affected_row){
                return response()->json(['success'=>true,'response' => $user, 'seller_info' => $seller], $this->successStatus);
            }else{
                return response()->json(['success'=>false,'response'=>'No Successfully Updated!'], $this->failStatus);
            }
        }else{
            $user = User::findOrFail(Auth::id());
            if($request->hasFile('avatar_original')){
                $user->avatar_original = $request->avatar_original->store('uploads/profile');
            }
            $user->save();
            return response()->json(['success'=>false,'response'=>'You can not change your profile information because you have placed bid.'], $this->failStatus);
        }

    }
    public function passwordUpdate(Request $request){
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|min:8',
        ]);
        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->old_password, $hashedPassword)) {
            if (!Hash::check($request->new_password, $hashedPassword)) {
                if ($request->confirm_password == $request->new_password) {
                    $user = \App\User::find(Auth::id());
                    $user->password = Hash::make($request->new_password);
                    $user->save();
                    return response()->json(['success' => true, 'response' => 'Password Updated Successfully'], $this->successStatus);
                }else {
                    return response()->json(['success'=>false,'response'=>'New password does not match with confirm password.'], $this->failStatus);
                }
            } else {
                return response()->json(['success'=>false,'response'=>'New password cannot be the same as old password.'], $this->failStatus);
            }
        } else {
            return response()->json(['success'=>false,'response'=>'Current password not match.'], $this->failStatus);
        }
    }
    public function passwordUpdateV2(Request $request){
//        $this->validate($request, [
//            'old_password' => 'required',
//            'new_password' => 'required|min:8',
//            'confirm_password' => 'required|min:8',
//        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->old_password, $hashedPassword)) {
            if (!Hash::check($request->new_password, $hashedPassword)) {
                if ($request->confirm_password == $request->new_password) {
                    $user = \App\User::find(Auth::id());
                    $user->password = Hash::make($request->new_password);
                    $user->save();
                    return response()->json(['success' => true, 'response' => 'Password Updated Successfully'], $this->successStatus);
                }else {
                    return response()->json(['success'=>false,'response'=>'New password does not match with confirm password.'], $this->failStatus);
                }
            } else {
                return response()->json(['success'=>false,'response'=>'New password cannot be the same as old password.'], $this->failStatus);
            }
        } else {
            return response()->json(['success'=>false,'response'=>'Current password not match.'], $this->failStatus);
        }
    }

    public function buyerDetails()
    {
        return new  buyerProfileCollections(User::where('id',Auth::id())->get());
    }
    public function sellerDetails()
    {
         return new  sellerProfileCollections(User::where('id',Auth::id())->get());

     
    }

//new method for merged details

    public function userDetails($userType)
{
    $user = User::where('id', Auth::id())->get();

    if ($userType == 'buyer') {
        return new buyerProfileCollections($user);
    } elseif ($userType == 'seller') {
        return new sellerProfileCollections($user);
    } else {
        
        return null;
    }
}

}
