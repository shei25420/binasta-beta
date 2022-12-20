<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'variation', 'buying_price', 'selling_price', 'wholesale_price', 'wholesale_min', 'stock'];

    public function product () {
        return $this->belongsTo(Product::class);
    }
}
