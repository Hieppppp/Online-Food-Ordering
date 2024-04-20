<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Shipping;
use Illuminate\Support\Facades\DB; 

class HistoryPuscherController extends Controller
{
    public function purchase(){
        $this->shareSettingsAndContactSet();
        return view('FrontEnd.customer.customer_invoice');
    } 
    
    // public function viewHistoryPurchase($customer_id){
    //     // Lấy tất cả các đơn hàng của khách hàng có ID là $customer_id
    //     $orders = Order::where('customer_id', $customer_id)->where('status', 1)->get();
    
    //     $invoices = []; // Khởi tạo mảng $invoices trước khi sử dụng
    
    //     // Kiểm tra nếu có đơn hàng
    //     if ($orders->isNotEmpty()) {
    //         // Lấy thông tin khách hàng, shipping, payment và order detail cho mỗi đơn hàng
    //         foreach ($orders as $order) {
    //             $customer = Customer::find($order->customer_id);
    //             $shipping = Shipping::find($order->shipping_id);
    //             $payment = Payment::where('order_id', $order->order_id)->first();
    //             $order_detail = OrderDetail::where('order_id', $order->order_id)->get();
    //             // Có thể lưu thông tin của mỗi đơn hàng vào một mảng nếu bạn muốn xử lý chúng sau này
    //             $invoices[] = compact('order', 'customer', 'shipping', 'payment', 'order_detail');
    //         }
    //     } 

    //     dd($invoices);
        
    //     // Trả về view hiển thị danh sách các hóa đơn và truyền biến $invoices vào view
    //     // return view('FrontEnd.customer.customer_invoice', compact('invoices'));
    // }
    
    
    
    
    
}
