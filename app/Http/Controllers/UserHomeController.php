<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class UserHomeController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', auth()->user()->id)->get();

        return view('frontend.home.index', [

            'title' => 'Home',
            'carts' => $cart,
        ]);
    }
}
