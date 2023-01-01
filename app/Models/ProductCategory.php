<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function image () {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function products () {
        return $this->hasMany(Product::class);
    }
}
