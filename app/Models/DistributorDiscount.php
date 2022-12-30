<?php

namespace App\Models;

use Hyn\Tenancy\Traits\UsesSystemConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistributorDiscount extends Model
{
    use HasFactory, UsesSystemConnection;

    protected $fillable = ["distributor_package_id", "percentage", "start_date", "end_date"];

    public function distributor_package () {
        return $this->belongsTo(DistributorPackage::class);
    }
}
