<?php

namespace App\Models;

use Hyn\Tenancy\Traits\UsesSystemConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserReview extends Model
{
    use HasFactory, UsesSystemConnection;

    protected $fillable = ['product_id', 'user_id', 'review', 'stars', 'banned'];

    public function product () {
        return $this->belongsTo(Product::class);
    }

    public function user () {
        return $this->belongsTo(User::class);
    }
}
