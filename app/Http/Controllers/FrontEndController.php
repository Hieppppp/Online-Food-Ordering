<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class FrontEndController extends Controller
{
    public function index(){
        $categories = Category::where('category_status',1)->get();
        $products = Product::where('product_status',1)->get();
        return view('FrontEnd.include.home',compact('categories','products'));
    }

    public function contact(){
        return view('FrontEnd.include.contact');
    }

    public function show_product(){
        $categories = Category::where('category_status',1)->get();
        $products = Product::where('product_status',1)->take(6)->get();
        return view('FrontEnd.include.show_product',compact('categories','products'));
    }

    public function show($id){

        $categories = Category::where('category_status',1)->get();

        $products = Product::where('products.category_id',$id)
            ->where('product_status',1)
            ->join('categories','products.category_id','=','categories.category_id')
            ->select('products.*','categories.category_name')
            ->get();
        return view('FrontEnd.include.product',compact('categories','products'));
    }

   
    
}
