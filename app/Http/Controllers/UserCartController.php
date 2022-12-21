<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class UserCartController extends Controller
{
    public function index()
    {


        $cart = Cart::where('user_id', auth()->user()->id)->get();

        return view('frontend.cart.index', [
            'title' => 'Cart',
            'carts' => $cart,
        ]);
    }

    public function increase(Request $request)
    {
        // get chart by id
        $cart = Cart::where('id', $request->id)->get();
        // cek stok produk ada atau tidak
        $product = Product::where('id', $cart[0]->product->id)->get();
        if ($product[0]->quantity <= 0) {
            return redirect('/cart')->with('error', 'Stok ' . $product[0]->product_name . ' habis !!');
        }
        // quantity dikurangi 1
        $quantity = $product[0]->quantity - 1;
        // update quantity
        $product[0]->update(['quantity' => $quantity]);
        // qty + 1
        $qty = $cart[0]->qty + 1;
        // price * qty
        $price = $cart[0]->product->price * $qty;
        // update qty di chart
        $cart[0]->update(['qty' => $qty, 'total_price' => $price]);
        // hapus coupon ketika ada update
        $carts = Cart::where('user_id', auth()->user()->id)->get();
        foreach ($carts as $cart) {
            $cart->update(['coupon_id' => null]);
        }
        return redirect('/cart');
    }

    public function decrease(Request $request)
    {
        // get chart by id
        $cart = Cart::where('id', $request->id)->get();
        // qty chart -1
        $qty = $cart[0]->qty - 1;
        // set harga * total qty
        $price = $cart[0]->product->price * $qty;
        // update qty & total harga
        $cart[0]->update(['qty' => $qty, 'total_price' => $price]);
        // get data product
        $product = Product::where('id', $cart[0]->product->id)->get();
        // quantity titambah 1
        $quantity = $product[0]->quantity + 1;
        // update quantity
        $product[0]->update(['quantity' => $quantity]);
        // hapus coupon ketika ada update
        $carts = Cart::where('user_id', auth()->user()->id)->get();
        foreach ($carts as $cart) {
            $cart->update(['coupon_id' => null]);
        }

        return redirect('/cart');
    }

    public function delete(Cart $cart)
    {
        
        $product = Product::where('id', $cart->product->id)->get();
        $qty = $product[0]->quantity + $cart->qty;
        $product[0]->update(['quantity' => $qty]);

        Cart::destroy($cart->id);

        $carts = Cart::where('user_id', auth()->user()->id)->get();
        foreach ($carts as $cart) {
            $cart->update(['coupon_id' => null]);
                $cart->update(['total_price' => $cart->product->price, 'discount' => null]);
        }
        
        return redirect('/cart');
    }
}
