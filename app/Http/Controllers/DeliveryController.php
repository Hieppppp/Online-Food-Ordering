<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index(){
        return view('BackEnd.delivery.addDelivery');
    }
    public function save(Request $request){
        $delivery = new Delivery();
        $delivery->delivery_name = $request->delivery_name;
        $delivery->delivery_phone = $request->delivery_phone;
        $delivery->delivery_pass = $request->delivery_pass;
        $delivery->delivery_status = $request->delivery_status;
        $delivery->added_on = $request->added_on;

        $delivery->save();

        return back()->with('sms','Thêm thành công!');

    }

    public function manage(){
        $deliveries = Delivery::all();
        return view('BackEnd.delivery.manageDelivery',compact('deliveries'));
    }

    public function active($delivery_id){
        $delivery = Delivery::find($delivery_id);
        $delivery->delivery_status = 1;
        $delivery->save();
        return back();
    }
    public function inactive($delivery_id){
        $delivery = Delivery::find($delivery_id);
        $delivery->delivery_status = 0;
        $delivery->save();
        return back();
    }

    public function delete($delivery_id){
        $delivery = Delivery::find($delivery_id);
        $delivery->delete();
        return redirect()->back();

    }

    public function update(Request $request){
        $delivery = Delivery::find($request->delivery_id);
        $delivery->delivery_name = $request->delivery_name;
        $delivery->delivery_phone = $request->delivery_phone;
        $delivery->delivery_pass = $request->delivery_pass;
        $delivery->save();
        return redirect('/delivery/manage')->with('sms','Update thành công!');
    }
}
