<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class CheckOutController extends Controller
{
    public function payment(){
        $this->shareSettingsAndContactSet();
        return view('FrontEnd.checkout.checkout_payment');
    }

    public function order(Request $request){
        // Kiểm tra xem 'customer_id' đã được lưu trong session hay không
        if(!session()->has('customer_id')){
            // Nếu không, bạn có thể chuyển hướng người dùng đến trang đăng nhập hoặc hiển thị modal đăng nhập
            return redirect()->route('login')->with('error', 'Please login before placing an order.');
        }
        $paymentType = $request->payment_type;
        if($paymentType == 'Cash'){
            //Lấy thông tin giỏ hàng từ session
            $cart = session()->get('cart',[]);
            //Lấy thông tin shipping_id từ session
            $shippingId = session()->get('shipping_id');
            //Lưu thông tin đơn hàng mới
            $order = new Order();
            $order->customer_id = session()->get('customer_id');
            $order->shipping_id = $shippingId;
            $order->status = 0;
            $order->order_total = session()->get('sum');
            $order->save();
    
            //Lưu thông tin thanh toán
            $payMent = new Payment();
            $payMent->order_id = $order->order_id; 
            $payMent->payment_type = $paymentType;
            $payMent->save();
    
            //Lưu chi tiết đơn hàng
            foreach ($cart as $productId => $item) {
                $orderDetail = new OrderDetail();
                $orderDetail->order_id = $order->order_id;
                $orderDetail->product_id = $productId;
                $orderDetail->product_name = $item['product_name']; 
                $orderDetail->product_price = $item['price'];
                $orderDetail->product_quantity = $item['quantity'];
                $orderDetail->save();
            }
    
            //Xóa giỏ hàng sau khi đã đặt hàng thành công
            session()->forget('cart');
            session()->flash('success', 'Your order has been successfully processed!');
    
            return redirect('checkout/order/complete');
    
        } 
        elseif($paymentType == 'Stripe'){
            //Lấy thông tin giỏ hàng từ session
            $cart = session()->get('cart',[]);
            //Lấy thông tin shipping_id từ session
            $shippingId = session()->get('shipping_id');
            //Lưu thông tin đơn hàng mới
            $order = new Order();
            $order->customer_id = session()->get('customer_id');
            $order->shipping_id = $shippingId;
            $order->status = 0;
            $order->order_total = session()->get('sum');
            $order->save();
    
            //Lưu thông tin thanh toán
            $payMent = new Payment();
            $payMent->order_id = $order->order_id; 
            $payMent->payment_type = $paymentType;
            $payMent->save();
    
            //Lưu chi tiết đơn hàng
            foreach ($cart as $productId => $item) {
                $orderDetail = new OrderDetail();
                $orderDetail->order_id = $order->order_id;
                $orderDetail->product_id = $productId;
                $orderDetail->product_name = $item['product_name']; 
                $orderDetail->product_price = $item['price'];
                $orderDetail->product_quantity = $item['quantity'];
                $orderDetail->save();
            }
            session()->forget('cart');
            return redirect('/stripe-payment');
    
        }
    }
    
    public function complete(){
        $this->shareSettingsAndContactSet();
        return view('FrontEnd.checkout.order_complete');
    }
}
