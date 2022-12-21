<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // 1 cart hanya dimiliki 1 user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 1 cart hanya dimiliki 1 produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // 1 cart hanya dimiliki 1 produk
    public function coupon()
    {
        return $this->belongsTo(coupon::class);
    }
}
