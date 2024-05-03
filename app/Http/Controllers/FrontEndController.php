<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogDetail;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FrontEndController extends Controller
{
    public function index(){
        $categories = Category::where('category_status',1)->get();
        $products = Product::where('product_status',1)->get();
        $this->shareSettingsAndContactSet();
        $categoryIds = [1, 2, 3, 4,5,6,7,8,9,10];
        $productCats = $this->fetchProducts($categoryIds);
          // Lấy tên loại sản phẩm tương ứng với mỗi category_id
        $categoryNames = Category::whereIn('category_id', $categoryIds)->pluck('category_name', 'category_id');

        // $sales = DB::table('products')
        //     ->leftJoin('order_details', 'products.product_id', '=', 'order_details.product_id')
        //     ->selectRaw('products.product_id, products.product_name, COALESCE(sum(order_details.product_quantity),0) total')
        //     ->groupBy('products.product_id', 'products.product_name') // Bao gồm cả product_name vào GROUP BY
        //     ->orderBy('total','desc')
        //     ->take(6)
        //     ->get();
        // $topProduct = [];
        // foreach($sales as $sale){
        //     $p = Product::findOrFail($sale->product_id);
        //     $p->total_quantity = $sale->total;
        //     $topProduct[] = $p;
        // }

        $topProduct = $this->fetchTopProduct(6);

        $newestProducts = DB::table('products')
            ->orderBy('added_on', 'desc') // Sắp xếp theo thời gian tạo mới nhất
            ->take(8) // Lấy 8 sản phẩm mới nhất
            ->get();


        return view('FrontEnd.include.home',compact('categories','products','topProduct','newestProducts','productCats','categoryNames'));
    }

    public function contact(){
        $this->shareSettingsAndContactSet();
        return view('FrontEnd.include.contact');
    }


    // public function show_product($id = null){
    //     $categories = Category::where('category_status', 1)->get();
    //     $products = Product::where('product_status', 1);
    
    //     if ($id) {
    //         $products->where('products.category_id', $id);
    //     }
    
    //     $products = $products->join('categories', 'products.category_id', '=', 'categories.category_id')
    //         ->select('products.*', 'categories.category_name')
    //         ->paginate(6);
        
    
    //     $this->shareSettingsAndContactSet();
    //     return view('FrontEnd.include.show_product', compact('categories', 'products'));
    // }
    
    // Tích hợp tìm hiếm sản phẩm và phân trang
    public function show_product(Request $request, $id = null){
        $categories = Category::where('category_status', 1)->get();
    
        $search = $request->input('search');
    
        $products = Product::select('products.product_id', 'products.category_id', 'products.product_name', 'products.product_detail', 'products.full_price', 'products.product_image')
            ->where('products.product_status', 1)
            ->when($id, function ($query, $id) {
                return $query->where('products.category_id', $id);
            })
            ->when($search, function ($query, $search) { //điều kiện truy vấn query
                return $query->where(function($subQuery) use ($search) { 
                    $subQuery->where('products.product_name', 'LIKE', '%' . $search . '%') //tìm kiếm trong tên sản phẩm
                             ->orWhere('products.product_detail', 'LIKE', '%' . $search . '%') // tìm kiếm trong mô tả
                             ->orWhereHas('category', function ($q) use ($search) { // tìm kiếm trong danh mục sử dụng phương thức orWhereHas
                                $q->where('category_name', 'LIKE', '%' . $search . '%'); 
                            });
                });
            })
            ->join('categories', 'products.category_id', '=', 'categories.category_id')
            ->paginate(9);

        $topProduct = $this->fetchTopProduct(4);
    
        $this->shareSettingsAndContactSet();
        
        return view('FrontEnd.include.show_product', compact('categories', 'products','topProduct'));
    }
    
    // Lây top những sản phẩm được mua nhiều nhất
    public function fetchTopProduct($limit){
        $sales = DB::table('products')
            ->leftJoin('order_details', 'products.product_id', '=', 'order_details.product_id')
            ->selectRaw('products.product_id, products.product_name, COALESCE(sum(order_details.product_quantity),0) total')
            ->groupBy('products.product_id', 'products.product_name') // Bao gồm cả product_name vào GROUP BY
            ->orderBy('total','desc')
            ->take($limit)
            ->get();
        $topProduct = [];
        foreach($sales as $sale){
            $p = Product::findOrFail($sale->product_id);
            $p->total_quantity = $sale->total;
            $topProduct[] = $p;
        }

        return $topProduct;
        
    }
    //Lấy sản phẩm theo mã loại sản phẩm mặc định
    public function fetchProducts($categoryIds) {
        $productCats = Product::whereIn('category_id', $categoryIds)
            ->orderBy('product_id', 'ASC')
            ->get()
            ->groupBy('category_id');
        
        return $productCats;
    }

    public function blog(){
        $blogs = Blog::where('blog_status',1)->get();
        $blogdetails = BlogDetail::where('blogdetail_status',1)->take(6)->get();
        $this->shareSettingsAndContactSet();
        return view('FrontEnd.include.blog',compact('blogs','blogdetails'));
    }

    public function blogdetail(Request $request, $blogdetail_id){
        $blogs = Blog::where('blog_status', 1)->get();
        $blogdetails = BlogDetail::where('blogdetail_status', 1)
            ->join('blogs', 'blog_details.blog_id', '=', 'blogs.blog_id')
            ->select('blog_details.*', 'blogs.blog_name', 'blogs.blog_slug') // Chỉ định cả blog_name và blog_quantity
            ->find($blogdetail_id);
        
        $this->shareSettingsAndContactSet();
        return view('FrontEnd.include.blogdetail', compact('blogs', 'blogdetails'));
    }

    public function comment(Request $request){
        // dd($request);
        $save = new Comment;
        $save->customer_id = $request->customer_id;
        $save->blogdetail_id = $request->blogdetail_id;
        $save->comment = $request->comment;
        $save->save();
        return redirect()->back()->with('sms','Thành công!');
    }
    

    
    

    

   
    
}
