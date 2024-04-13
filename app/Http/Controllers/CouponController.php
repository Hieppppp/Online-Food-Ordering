<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function index(){
        return view('BackEnd.coupon.addCoupon');
    }

    public function save(Request $request){
        $coupon = new Coupon();
        $coupon->coupon_code = $request->coupon_code;
        $coupon->coupon_type = $request->coupon_type;
        $coupon->coupon_value = $request->coupon_value;
        $coupon->cart_min_value = $request->cart_min_value;
        $coupon->expired_on = $request->expired_on;
        $coupon->coupon_status = $request->coupon_status;
        $coupon->added_on = $request->added_on;

        $coupon->save();

        return back()->with('sms','Thêm thành công!'); 
        
    }

    public function manage(){
        $coupons = Coupon::all();
        return view('BackEnd.coupon.manageCoupon',compact('coupons'));
    }

    public function active($coupon_id){
        $coupon = Coupon::find($coupon_id);
        $coupon->coupon_status = 1;
        $coupon->save();
        return back();
    }
    public function inactive($coupon_id){
        $coupon = Coupon::find($coupon_id);
        $coupon->coupon_status = 0;
        $coupon->save();
        return back();
    }

    public function delete($coupon_id){
        $coupon = Coupon::find($coupon_id);
        $coupon->delete();
        return redirect()->back();

    }

    public function update(Request $request){
        $coupon = Coupon::find($request->coupon_id);
        $coupon->coupon_code = $request->coupon_code;
        $coupon->coupon_type = $request->coupon_type;
        $coupon->coupon_value = $request->coupon_value;
        $coupon->cart_min_value = $request->cart_min_value;
        $coupon->save();
        return redirect('/coupon/manage')->with('sms','Update thành công!');
    }
    
}
