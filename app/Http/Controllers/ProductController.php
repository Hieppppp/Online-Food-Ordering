<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
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
        
        $categories = Category::where('category_status',1)->get();
        
        return view('BackEnd.product.addProduct',compact('categories'));
    }

    public function save(Request $request){

        $product = new Product();
        $product->product_name = $request->product_name;
        $product->category_id = $request->category_id;
        $product->product_detail = $request->product_detail;
        $product->product_status = $request->product_status;
        $product->added_on = $request->added_on;
        $product->full = $request->full;
        $product->full_price = $request->full_price;
        $product->half = $request->half;
        $product->half_price = $request->half_price;

        $image = $request->product_image;
        if($image){
            $imagename = time() .'.'. $image->getClientOriginalExtension();
            $request->product_image->move('product',$imagename);
            $product->product_image = $imagename; 
        }
        $product->save();
        return back()->with('sms','Thêm thành công!');
    }

    public function manage(Request $request){
        $this->AuthLogin();
        $categories = Category::where('category_status',1)->get();
        
        $query = DB::table('products')
            ->join('categories','products.category_id','=','categories.category_id')
            ->select('products.*','categories.category_name')
            ->orderBy('added_on','DESC');
    
        if (!empty($request->product_status)) {
            $product_status = $request->product_status == 'active' ? 1 : 0;
            $query->where('products.product_status', $product_status);
        }
    
        if (!empty($request->category_id) && $request->category_id != '0') {
            $query->where('categories.category_id', $request->category_id);
        }
    
        if (!empty($request->keywords)) {
            $query->where('products.product_name', 'like', '%' . $request->keywords . '%');
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


        $producties = $query->paginate(10);
    
        return view('BackEnd.product.manageProduct',compact('producties','categories','sortType'));
    }
    
    public function active($product_id){
        $product = Product::find($product_id);
        $product->product_status = 1;
        $product->save();
        return back();
    }
    public function inactive($product_id){
        $product = Product::find($product_id);
        $product->product_status = 0;
        $product->save();
        return back();
    }

    public function delete($product_id){
        $product = Product::find($product_id);
        // Xóa ảnh trong thư mục nếu có
        if ($product->product_image) {
            $imagePath = public_path('product/' . $product->product_image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }
        $product->delete();
        return redirect()->back();
    }

    public function update(Request $request){
        $this->AuthLogin();
        $product = Product::find($request->product_id);
    
        $product->product_name = $request->product_name;
        $product->category_id = $request->category_id;
        $product->product_detail = $request->product_detail;
        $product->full = $request->full;
        $product->full_price = $request->full_price;
        $product->half = $request->half;
        $product->half_price = $request->half_price;
    
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imagename = time() .'.'. $image->getClientOriginalExtension();
            $image->move('product', $imagename);
            $product->product_image = $imagename;
        }
    
        $product->save();
        return redirect('/product/manage')->with('sms', 'Update thành công!');
    }

    

    
    
}
