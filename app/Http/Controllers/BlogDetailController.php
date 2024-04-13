<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class BlogDetailController extends Controller
{
    public function index(){
        
        $blogs = Blog::where('blog_status',1)->get();
        
        return view('BackEnd.blogdetail.addBlogDetail',compact('blogs'));
    }

    public function save(Request $request){

        $blogdetail = new BlogDetail();
        $blogdetail->blogdetail_name = $request->blogdetail_name;
        $blogdetail->blog_id = $request->blog_id;
        $blogdetail->blogdetail_content = $request->blogdetail_content;
        $blogdetail->blogdetail_detail = $request->blogdetail_detail;
        $blogdetail->blogdetail_status = $request->blogdetail_status;
        $blogdetail->added_on = $request->added_on;
        $image = $request->blogdetail_image;
        if($image){
            $imagename = time() .'.'. $image->getClientOriginalExtension();
            $request->blogdetail_image->move('blog',$imagename);
            $blogdetail->blogdetail_image = $imagename; 
        }
        $blogdetail->save();
        return back()->with('sms','Thêm thành công!');
    }

    public function manage(Request $request){
        $blogs = Blog::where('blog_status',1)->get();
        
        $query = DB::table('blog_details')
            ->join('blogs','blog_details.blog_id','=','blogs.blog_id')
            ->select('blog_details.*','blogs.blog_name')
            ->orderBy('added_on','DESC');
    
        if (!empty($request->blogdetail_status)) {
            $blogdetail_status = $request->blogdetail_status == 'active' ? 1 : 0;
            $query->where('blog_details.blogdetail_status', $blogdetail_status);
        }
    
        if (!empty($request->blog_id) && $request->blog_id != '0') {
            $query->where('blogs.blog_id', $request->blog_id);
        }
    
        if (!empty($request->keywords)) {
            $query->where('blog_details.blogdetail_name', 'like', '%' . $request->keywords . '%');
        }

        // Xử lý logic sắp xếp
        $sortBy = $request->input('sort-by');
        $sortType = $request->input('sort-type'); //theo thứ tự tăng dần
        $allowSort = ['asc', 'desc'];

        if (!empty($sortType) && in_array($sortType, $allowSort)) {
            $sortType = ($sortType != 'desc') ? 'asc' : 'desc';
        } else {
            $sortType = 'asc';
        }

        $sortArray = [
            'sortBy' => $sortBy,
            'sortType' => $sortType
        ];

        // Áp dụng logic sắp xếp vào truy vấn
        if (!empty($sortBy)) {
            $query->orderBy($sortBy, $sortType);
        }


        $blogdetails = $query->get();
    
        return view('BackEnd.blogdetail.manageBlogDetail',compact('blogdetails','blogs','sortType'));
    }

    public function active($blogdetail_id){
        $blogdetail = BlogDetail::find($blogdetail_id);
        $blogdetail->blogdetail_status = 1;
        $blogdetail->save();
        return back();
    }
    public function inactive($blogdetail_id){
        $blogdetail = BlogDetail::find($blogdetail_id);
        $blogdetail->blogdetail_status = 0;
        $blogdetail->save();
        return back();
    }

    public function delete($blogdetail_id){
        $blogdetail = BlogDetail::find($blogdetail_id);
        // Xóa ảnh trong thư mục nếu có
        if ($blogdetail->blogdetail_image) {
            $imagePath = public_path('blog/' . $blogdetail->blogdetail_image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }
        $blogdetail->delete();
        return redirect()->back();
    }

    public function update(Request $request){
        $blogdetail = BlogDetail::find($request->blogdetail_id);
    
        $blogdetail->blogdetail_name = $request->blogdetail_name;
        $blogdetail->blog_id = $request->blog_id;
        $blogdetail->blogdetail_content = $request->blogdetail_content;
        $blogdetail->blogdetail_detail = $request->blogdetail_detail;
        if ($request->hasFile('blogdetail_image')) {
            $image = $request->file('blogdetail_image');
            $imagename = time() .'.'. $image->getClientOriginalExtension();
            $image->move('blog', $imagename);
            $blogdetail->blogdetail_image = $imagename;
        }
    
        $blogdetail->save();
        return redirect('/blogdetail/manage')->with('sms', 'Update thành công!');
    }
}
