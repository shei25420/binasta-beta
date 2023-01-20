<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MpesaTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'merchant_request_id'];

    public function order () {
        return $this->belongsTo(Order::class);
    }

    public function distributorOrder () {
        return $this->belongsTo(DistributorOrder::class);
    }
}
