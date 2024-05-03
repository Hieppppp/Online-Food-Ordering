<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class categoryController extends Controller
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
        $this->AuthLogin();
        return view('BackEnd.category.addCategory');
    }

    public function save(Request $request){
        $category = new Category();
        $category->category_name = $request->category_name;
        $category->order_number = $request->order_number;
        $category->category_status = $request->category_status;
        $category->added_on=$request->added_on;
        $category->save();

        return back()->with('sms','Thêm thành công!');
    }

    public function manage(){
        $this->AuthLogin();
        $categories = Category::all();
        return view('BackEnd.category.manageCategory',compact('categories'));
    }

    public function active($category_id){
        $category = Category::find($category_id);
        $category->category_status = 1;
        $category->save();
        return back();

    }

    public function inactive($category_id){
        $category = Category::find($category_id);
        $category->category_status = 0;
        $category->save();
        return back();
    }

    public function delete($category_id){
        $category = Category::find($category_id);
        $category->delete();
        return redirect()->back();
    }

    public function update(Request $request){
        $this->AuthLogin();
        $category = Category::find($request->category_id);
        $category->category_name = $request->category_name;
        $category->order_number = $request->order_number;
        $category->save();
        return redirect('/category/manage')->with('sms','Update thành công!');
    }
}
