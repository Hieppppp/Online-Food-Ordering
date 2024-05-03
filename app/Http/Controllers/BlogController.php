<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
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
        return view('BackEnd.blog.addBlog');
    }

    public function save(Request $request){
        $blog = new Blog();
        $blog->blog_name = $request->blog_name;
        $blog->blog_slug = $request->blog_slug;
        $blog->blog_status = $request->blog_status;
        $blog->save();

        return back()->with('sms','Thêm thành công!');
    }

    public function manage(){
        $this->AuthLogin();
        $blogs = Blog::all();
        return view('BackEnd.blog.manageBlog',compact('blogs'));
    }

    public function active($blog_id){
        $blog = Blog::find($blog_id);
        $blog->blog_status = 1;
        $blog->save();
        return back();

    }

    public function inactive($blog_id){
        $blog = Blog::find($blog_id);
        $blog->blog_status = 0;
        $blog->save();
        return back();
    }

    public function delete($blog_id){
        $blog = Blog::find($blog_id);
        $blog->delete();
        return redirect()->back();
    }

    public function update(Request $request){
        $this->AuthLogin();
        $blog = Blog::find($request->blog_id);
        $blog->blog_name = $request->blog_name;
        $blog->blog_slug = $request->blog_slug;
        $blog->save();
        return redirect('/blog/manage')->with('sms','Update thành công!');
    }
}
