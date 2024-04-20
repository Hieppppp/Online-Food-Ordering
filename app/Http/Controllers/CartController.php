<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
    public function addToCartAjax(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'product_name' => $product->product_name,
                'image' => $product->product_image,
                'price' => $product->full_price,
                'quantity' => 1,
                'options' => [
                    'half_price' => $product->half_price,
                ]
            ];
        }
        session()->put('cart', $cart);

        // Tính toán số lượng sản phẩm trong giỏ hàng
        $cartCount = count($cart);

        return response()->json([
            'success' => true, 
            'message' => 'Sản phẩm đã được thêm vào giỏ hàng!',
            'cart_count' => $cartCount // Trả về số lượng sản phẩm trong giỏ hàng
        ]);
    }



    public function show(){
        $this->shareSettingsAndContactSet();
        return view('FrontEnd.cart.show');
    }

    public function remove($id){
        $cart = session()->get('cart', []);
        // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không
        if(isset($cart[$id])) {
            // Xóa sản phẩm khỏi giỏ hàng
            unset($cart[$id]);
            session()->put('cart', $cart);
            return redirect()->back()->with('sms', 'Sản phẩm đã được xóa khỏi giỏ hàng!');
        }
        return redirect()->back()->with('error', 'Sản phẩm không tồn tại trong giỏ hàng!');
    }

    public function update(Request $request, $id){
        $cart = session()->get('cart', []);

        if(isset($cart[$id])){
            $cart[$id]['quantity']=$request->quantity;
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('error', 'Sản phẩm không tồn tại trong giỏ hàng!');
    }

    
   
}
