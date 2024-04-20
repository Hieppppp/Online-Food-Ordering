<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogDetail;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class FrontEndController extends Controller
{
    public function index(){
        $categories = Category::where('category_status',1)->get();
        $products = Product::where('product_status',1)->get();
        $this->shareSettingsAndContactSet();
        return view('FrontEnd.include.home',compact('categories','products'));
    }

    public function contact(){
        $this->shareSettingsAndContactSet();
        return view('FrontEnd.include.contact');
    }


    public function show_product(){
        $categories = Category::where('category_status',1)->get();
        $products = Product::where('product_status',1)->take(6)->get();
        $this->shareSettingsAndContactSet();
        return view('FrontEnd.include.show_product',compact('categories','products'));
    }

    public function show($id){

        $categories = Category::where('category_status',1)->get();

        $products = Product::where('products.category_id',$id)
            ->where('product_status',1)
            ->join('categories','products.category_id','=','categories.category_id')
            ->select('products.*','categories.category_name')
            ->get();
        $this->shareSettingsAndContactSet();
        return view('FrontEnd.include.product',compact('categories','products'));
    }

    public function blog(){
        $blogs = Blog::where('blog_status',1)->get();
        $blogdetails = BlogDetail::where('blogdetail_status',1)->take(6)->get();
        $this->shareSettingsAndContactSet();
        return view('FrontEnd.include.blog',compact('blogs','blogdetails'));
    }

  

   
    
}
