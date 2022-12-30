<?php

namespace App\Models;

use Hyn\Tenancy\Traits\UsesSystemConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, UsesSystemConnection;

    protected $fillable = ['product_category_id', 'name', 'ingredients', 'description', 'buying_price', 'selling_price', 'wholesale_price', 'slug'];

    public function product_category () {
        return $this->belongsTo(ProductCategory::class);
    }

    public function product_options () {
        return $this->hasMany(ProductOption::class);
    }

    public function images () {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function discounts () {
        return $this->hasMany(Discount::class);
    }

    public function user_reviews () {
        return $this->hasMany(UserReview::class);
    }
}
