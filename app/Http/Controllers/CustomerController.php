<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Shipping;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\VerificationToken;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;


class CustomerController extends Controller
{
    public function show(){
        return view('FrontEnd.customer.register');
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=> 'required|email|unique:customers',
            'phone_num'=> 'required|digits:10',
            'password'=> 'min:5|required_with:conf_pass|same:conf_pass',
            'conf_pass'=> 'min:5'
        ]);
        
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone_num = $request->phone_num;
        $customer->password = Hash::make($request->password);
        $customer->conf_pass = Hash::make($request->conf_pass);
        $save = $customer->save();

        if($save) {

            $token = base64_encode(Str::random(64));
        
            VerificationToken::create([
                'user_type' => 'customers',
                'email' => $request->email,
                'token' => $token
            ]);
            $actionLink = route('customer.verify', ['token' => $token]);
        
            $data['action_link'] = $actionLink;
            $data['customer_name'] = $request->name;
            $data['customer_email'] = $request->email;
        
            Mail::send('FrontEnd.mail.verify_email', $data, function($message) use ($data){
                $message->to($data['customer_email']);
                $message->subject('Verify Your Email');
            });
 
            return redirect('/login/customer');
        } else {

            $customer_id = $customer->customer_id;
            session()->put('customer_id', $customer_id);
            session()->put('customer_name', $customer->name);
        
            $data = $customer->toArray();
        
            Mail::send('FrontEnd.mail.welcome_mail', $data, function($message) use ($data){
                $message->to($data['email']);
                $message->subject('Welcome to Staple Food');
            });
        
            return redirect('/home');
        }
        
    }

    public function verifyCustomer(Request $request, $token){
        $verifyToken = VerificationToken::where('token', $token)->first();

        if( !is_null($verifyToken)){
            $customer = Customer::where('email', $verifyToken->email)->first();

            if( !$customer->verified){
                $customer->verified = 1;
                $customer->save();

                return redirect()->route('login_in')->with('success','Email đã được xác minh!');

            }else{
                return redirect()->route('login_in')->with('info','Email đã được lập!');
            }

        }
        else{
            return redirect()->route('customer.register')->with('sms','Mã không hợp lệ');
        }
    }


    public function login(){
        return view('FrontEnd.customer.login');
    }

    public function check(Request $request){
        $customer = Customer::where('email', $request->email)->first();
    
        if($customer && password_verify($request->password, $customer->password)){
            session()->put('customer_id', $customer->customer_id);
            session()->put('customer_name', $customer->name);
    
            return redirect('/home');
        }
        else{
            return redirect('/login/customer/')->with('sms', 'Mật khẩu không đúng! Vui lòng nhập lại!');
        }
    }

    public function logout(){
        session()->forget('customer_id');
        session()->forget('customer_name');
        return redirect('/home');
    }
    

    public function shipping(){
        $customer_id = session('customer_id');
        $customer = Customer::find($customer_id);

        return view('FrontEnd.checkout.shipping', compact('customer'));
    }

    public function save(Request $request){
        $shipping = new Shipping();
        $shipping->name = $request->name;
        $shipping->email = $request->email;
        $shipping->phone_num = $request->phone_num;
        $shipping->address = $request->address;

        $shipping->save();

        session()->put('shipping_id', $shipping->id);
        return redirect()->route('checkout_payment');
    }
   
    public function profile(){
        $customer_id = session('customer_id');
        $customer = Customer::find($customer_id);

        return view('FrontEnd.customer.customer_profile', compact('customer'));
    }

    public function updateProfile(Request $request)
    {
        $customer_id = session('customer_id');
        $customer = Customer::find($customer_id);
        
        // Kiểm tra xem người dùng đã upload hình ảnh mới chưa
        if ($request->hasFile('profile_image')) {
            $validated_image = $request->validate([
                'profile_image' => 'required|image|max:1000',
            ]);

            // Xóa hình ảnh cũ
            if ($customer->image) {
                Storage::delete('public/profile_images/' . $customer->image);
            }

            // Tạo tên mới cho hình ảnh dựa trên định dạng mong muốn
            $imageName = 'Customer_IMAGE_' . uniqid() . '.' . $request->file('profile_image')->getClientOriginalExtension();

            // Lưu hình ảnh mới với tên đã tạo
            $imagePath = $request->file('profile_image')->storeAs('profile_images', $imageName, 'public');
            $customer->image = $imageName;
        }

        // Cập nhật thông tin cá nhân của khách hàng
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone_num = $request->phone_num;
        $customer->save();

        // Cập nhật tên người dùng trong session
        session()->put('customer_name', $request->name);

        return redirect()->route('customer_profile')->with('sms', 'Update thành công.');
    }


    



}
