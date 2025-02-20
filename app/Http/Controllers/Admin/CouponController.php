<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Coupon;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CouponController extends Controller
{
 
    public function index()
    {
        $coupons = Coupon::latest()->get();
        return view('backend.admin.coupons.index',compact('coupons'));
    }

    public function create()
    {
        return view('backend.admin.coupons.create');
    }

    public function store(Request $request)
    {
        $coupon = new Coupon();
        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->amount = $request->amount;
        $coupon->status = 0;
        $coupon->save();
        Toastr::success("Coupon Inserted Successfully");
        return redirect()->route('admin.coupons.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $coupon = Coupon::find($id);
        return view('backend.admin.coupons.edit',compact('coupon'));
    }

    public function update(Request $request, $id)
    {
        $coupon = Coupon::find($id);
        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->amount = $request->amount;
        $coupon->save();
        Toastr::success("Coupon Updated Successfully");
        return redirect()->route('admin.coupons.index');
    }

    public function destroy($id)
    {
        //
    } 
    public function statusUpdate(Request $request)
    {
        $coupon = Coupon::findOrFail($request->id);
        $coupon->status = $request->status;
        if($coupon->save()){
            return 1;
        }
        return 0;
    }
}
