<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
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
        $blog = Blog::find($request->blog_id);
        $blog->blog_name = $request->blog_name;
        $blog->blog_slug = $request->blog_slug;
        $blog->save();
        return redirect('/blog/manage')->with('sms','Update thành công!');
    }
}
