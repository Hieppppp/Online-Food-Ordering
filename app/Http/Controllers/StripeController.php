<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class StripeController extends Controller
{
    public function handleGet(){
        $this->shareSettingsAndContactSet();
        return view('FrontEnd.checkout.stripe');
    }

    public function handlePost(Request $request)
    {
        // Thiết lập API key của Stripe
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        // Tạo một Stripe Charge
        try {
            $charge = Charge::create([
                'amount' => $request->input('grandTotal'),
                'currency' => 'USD', // Loại tiền tệ
                'source' => $request->stripeToken, // Token của thẻ
                'description' => $request->name // Mô tả thanh toán
                // 'description' => 'Thanh toán của ' . $request->name . ' với số tiền ' . $request->input('grandTotal')

            ]);

            // Lưu thông báo thành công vào session
            session()->flash('success', 'Thanh toán thành công!');

            // Chuyển hướng đến trang hoàn thành đơn hàng
            return redirect('/checkout/order/complete');
        } catch (\Exception $e) {
            // Xử lý lỗi
            return back()->with('error_message', 'Đã xảy ra lỗi: ' . $e->getMessage())->withInput();
        }
    }

}
