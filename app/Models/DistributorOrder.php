<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistributorOrder extends Model
{
    use HasFactory;

    protected $fillable = ["ref", 'distributor_id', 'distributor_address_id', 'location', 'phone_number'];

    public function distributor () {
        return $this->belongsTo(Distributor::class);
    }

    public function distributor_address () {
        return $this->belongsTo(DistributorAddress::class);
    }

    public function distributor_packages () {
        return $this->belongsToMany(DistributorPackage::class);
    }
}
