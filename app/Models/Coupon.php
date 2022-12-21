<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
   use HasFactory;

   protected $guarded = ['id'];

   // 1 coupon hanya dimiliki 1 cart
   public function cart()
   {
      return $this->belongsTo(Cart::class);
   }

   // public function getRouteKeyName()
   // {
   //    return 'coupon_code';
   // }
}
