<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
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
    
    public function index(){
        return view('BackEnd.admin.login');
    }

    public function home(){
        $this->AuthLogin();
        return view('BackEnd.admin.home');
    }

    public function dashboard(Request $request){
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);

        $result = DB::table('admins')
            ->where('admin_email',$admin_email)
            ->where('admin_password',$admin_password)
            ->first();
        if($result){
            session()->put('admin_id', $result->admin_id);
            session()->put('admin_name', $result->admin_name);
            return redirect('/admin/home');
        }
        else{
            session()->put('message','Mật khẩu hoặc tài khoản sai! Vui lòng nhập lại.');

            return redirect('/admin/login');
        }

    }

    public function logout(){
        $this->AuthLogin();
        session()->forget('admin_id');
        session()->forget('admin_name');
        return redirect('/admin/login');
    }
}
