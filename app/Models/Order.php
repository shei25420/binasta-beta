<?php

namespace App\Models;

use Hyn\Tenancy\Traits\UsesSystemConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, UsesSystemConnection;

    protected $fillable = ['ref', 'user_id', 'user_address_id', 'location', 'phone_number'];

    public function product_options () {
        return $this->belongsToMany(ProductOption::class, 'order_product_option', 'order_id', 'product_option_id')->withPivot('quantity');
    }

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function user_address () {
        return $this->belongsTo(UserAddress::class);
    }

    public function transaction () {
        return $this->hasOne(Transaction::class);
    }
}
