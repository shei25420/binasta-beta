<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistributorPackage extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function productOptions () {
        return $this->belongsToMany(ProductOption::class, 'distributor_package_product_option', 'distributor_package_id', 'product_option_id');
    }

    public function discounts () {
        return $this->hasMany(DistributorDiscount::class, "distributor_package_id");
    }
}
