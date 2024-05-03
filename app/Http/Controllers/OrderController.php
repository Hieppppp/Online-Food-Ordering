<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;



class OrderController extends Controller
{
    public function AuthLogin(){
        $admin_id = session()->get('admin_id');
        if($admin_id){
            return redirect('/admin/home');
        }
        else{
            return redirect('/admin/login')->send();
        }
    }
    public function manageOrder()
    {
        $this->AuthLogin();
        $orders = DB::table('orders')
            ->join('customers', 'orders.customer_id', '=', 'customers.customer_id') //nối bảng Orders với Customers
            ->join('payments', 'orders.order_id', '=', 'payments.order_id') //Nối bảng orders với payments
            ->select('orders.*', 'customers.name','payments.payment_type','payments.payment_status') //select các trường muốn lấy
            ->get();
        
        return view('BackEnd.order.manage', compact('orders'));
    }

    public function viewOrder($order_id){
        $this->AuthLogin();
        $order = Order::where('order_id', $order_id)->first();
        $customer = Customer::find($order->customer_id);
        $shipping = Shipping::find($order->shipping_id);
        $payment = Payment::where('order_id',$order->order_id)->first();
        $order_detail = OrderDetail::where('order_id', $order->order_id)->get();


        return view('BackEnd.order.view_order',compact('order','customer','shipping','payment','order_detail'));
    }

    public function viewInvoice($order_id){
        $this->AuthLogin();
        $order = Order::where('order_id', $order_id)->first();
    
        // Kiểm tra trạng thái của đơn hàng
        if ($order->status == 1) {
            // Lấy thông tin khách hàng, shipping, payment và order detail
            $customer = Customer::find($order->customer_id);
            $shipping = Shipping::find($order->shipping_id);
            $payment = Payment::where('order_id', $order->order_id)->first();
            $order_detail = OrderDetail::where('order_id', $order->order_id)->get();
    
            // Dữ liệu cần gửi trong email
            $data = [
                'order' => $order,
                'customer' => $customer,
                'shipping' => $shipping,
                'payment' => $payment,
                'order_detail' => $order_detail,
            ];
            
            // Gửi email với mẫu HTML
            Mail::send('BackEnd.mail.orderconfirm_invoice', $data, function($message) use ($customer, $order, $shipping) {
                $message->to($shipping->email)
                        ->subject('Hóa đơn đơn hàng #' . $order->order_id);
            });
    
            return view('BackEnd.order.view_order_invoice', compact('order', 'customer', 'shipping', 'payment', 'order_detail'));
        } 
        else {
            // Lấy thông tin khách hàng, shipping, payment và order detail
            $customer = Customer::find($order->customer_id);
            $shipping = Shipping::find($order->shipping_id);
            $payment = Payment::where('order_id', $order->order_id)->first();
            $order_detail = OrderDetail::where('order_id', $order->order_id)->get();
            return view('BackEnd.order.view_order_invoice', compact('order', 'customer', 'shipping', 'payment', 'order_detail'));
        } 
    }

    public function downloadInvoice($order_id){
        $this->AuthLogin();
        $order = Order::where('order_id', $order_id)->first();
        $customer = Customer::find($order->customer_id);
        $shipping = Shipping::find($order->shipping_id);
        $payment = Payment::where('order_id',$order->order_id)->first();
        $order_detail = OrderDetail::where('order_id', $order->order_id)->get();

        $pdf = Pdf::loadView('BackEnd.order.download_order_invoice',compact('order','customer','shipping','payment','order_detail'));

        return $pdf->stream('OrderInvoice.pdf');
        
    }

    public function deleteOrder($order_id){
        $order = Order::find($order_id);
        if ($order) {
            $order->delete();
            return back()->with('sms','Xóa thành công!');
        } else {
            return back()->with('error', 'Đơn hàng không tồn tại!');
        }
    }

    public function active($order_id){
        $order = Order::find($order_id);
        $order->status = 1;
        $order->save();
        return back();
    }
    public function inactive($order_id){
        $order = Order::find($order_id);
        $order->status = 0;
        $order->save();
        return back();
    }

    public function confirmInvoice($order_id){
        
    }
 
}

