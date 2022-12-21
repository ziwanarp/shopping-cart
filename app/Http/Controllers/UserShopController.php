<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserShopController extends Controller
{
    public function index()
    {
        $product = Product::all();
        $cart = Cart::where('user_id', auth()->user()->id)->get();

        return view('frontend.shop.index', [
            'title' => 'Shop',
            'products' => $product,
            'carts' => $cart,
        ]);
    }

    public function addToCart(Request $request)
    {
        // ambil harga berdasarkan id product
        $result = Product::where('id', $request->product_id)->get();
        $result = $result[0];

        //ambil data cart berdasarkan auth
        $get = Cart::where('user_id', auth()->user()->id)->where('product_id', $request->product_id)->get();

        // jika ada barang yang sama jalankan update QTY + Harga
        if (count($get) > 0) {
            $qty = $get[0]->qty + 1;
            $harga = $get[0]->product->price * $qty;

            // update stok produk
            $product = Product::where('id', $request->product_id)->get();

            //jika produk <= 0 maka tampilkan pesan error
            if ($product[0]->quantity <= 0) {
                return redirect('/shop')->with('error', 'Stok habis !!');
            }

            // kurangi stok produk
            $quantity = $product[0]->quantity - 1;
            Product::where('id', $request->product_id)->update(['quantity' => $quantity]);

            // update qty $ harga
            Cart::where('user_id', auth()->user()->id)->where('product_id', $request->product_id)->update(['qty' => $qty, 'total_price' => $harga]);
            return redirect('/cart');
        }
        
        // set user id berdasarkan auth
        $carts['user_id'] = auth()->user()->id;

        // set product id berdasarkan product id
        $carts['product_id'] = $request->product_id;

        // set qty default 1
        $carts['qty'] = 1;

        // set harga product
        $carts['total_price'] = $result->price;

        // update stok produk
        $product = Product::where('id', $request->product_id)->get();
        $quantity = $product[0]->quantity - 1;
        Product::where('id', $request->product_id)->update(['quantity' => $quantity]);

        Cart::create($carts);

        return redirect('/cart');
    }
}
