<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Coupon;
use Illuminate\Http\Request;

class UserCouponController extends Controller
{
    public function addCoupon(Request $request)
    {
        // ambil data coupon berdasarkan request coupon code
        $coupon = Coupon::where('coupon_code', $request->coupon_code)->get();
        // cek apakah coupon ada atau tidak
        if ($coupon->count() <= 0) {
            // jika coupon tidak ada maka jalankan pesan errror
            return redirect('/cart')->with('coupon', 'Coupon not valid !');
        }
        // jika coupon ada maka ambil data cart
        $carts = Cart::where('user_id', auth()->user()->id)->get();
        // input coupon ke semua cart dengan user id auth
        foreach ($carts as $cart) {
            $cart->update(['coupon_id' => $coupon[0]->id]);
        }
        // ambnil total pricce dari cart
        $harga = collect($carts)->sum('total_price');

        // validasi coupon FA111
        if ($carts[0]->coupon->coupon_code === 'FA111') {
            $diskon = $carts[0]->coupon->discount_percent / 100 * $harga;
            $harga = $harga - $diskon;
            foreach ($carts as $cart) {
                $cart->update(['final_price' => $harga, 'discount' => $diskon]);
            }
            return redirect('/cart');
        }

        // validasi coupon FA222
        if ($carts[0]->coupon->coupon_code === 'FA222') {
            foreach ($carts as $cart) {
                if ($cart->product->product_code === 'FA4532') {
                    $diskon =  $carts[0]->coupon->discount_price;
                    $harga =  $harga - $diskon;
                    foreach ($carts as $cart) {
                        $cart->update(['final_price' => $harga, 'discount' => $diskon]);
                    }
                    return redirect('/cart');
                }
            }
            foreach ($carts as $cart) {
                $cart->update(['coupon_id' => null]);
            }
            return redirect('/cart')->with('coupon', 'Coupon hanya bisa digunakan untuk product FA4532');
        }

        if ($carts[0]->coupon->coupon_code === 'FA333') {
            foreach ($carts as $cart) {
                if ($cart->product->price >= 400000) {
                    $diskon = $carts[0]->coupon->discount_percent / 100 * $harga;
                    $harga = $harga - $diskon;
                    foreach ($carts as $cart) {
                        $cart->update(['final_price' => $harga, 'discount' => $diskon]);
                    }
                    return redirect('/cart');
                }
            }
            foreach ($carts as $cart) {
                $cart->update(['coupon_id' => null]);
            }
            return redirect('/cart')->with('coupon', 'Coupon hanya bisa digunakan untuk product FA4532');
        }

        if ($carts[0]->coupon->coupon_code === 'FA444') {

            $day = Carbon::now();
            $start = Carbon::createFromTimeString('13:00');
            $end = Carbon::createFromTimeString('15:00');

            if ($day->dayOfWeek == Carbon::WEDNESDAY) {
                if ($day->between($start, $end)) {
                    $diskon = $carts[0]->coupon->discount_percent / 100 * $harga;
                    $harga = $harga - $diskon;
                    foreach ($carts as $cart) {
                        $cart->update(['final_price' => $harga, 'discount' => $diskon]);
                    }
                    return redirect('/cart');
                }
            }
        }
        foreach ($carts as $cart) {
            $cart->update(['coupon_id' => null]);
            return redirect('/cart')->with('coupon', 'Coupon FA444, hanya berlaku hari SELASA jam 13:00 s/d 15:00');
        }
    }

    public function removeCoupon(Request $request)
    {
        $carts = Cart::where('user_id', auth()->user()->id)->get();
        foreach ($carts as $cart) {
            $cart->update(['coupon_id' => null]);
            $cart->update(['total_price' => $cart->product->price, 'discount' => null]);
        }
        return redirect('/cart');
    }
}
