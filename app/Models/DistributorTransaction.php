<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistributorTransaction extends Model
{
    use HasFactory;

    protected $fillable = ["ref", "distributor_order_id", "payment_type"];

    public function order () {
        return $this->belongsTo(DistributorOrder::class);
    }
}
