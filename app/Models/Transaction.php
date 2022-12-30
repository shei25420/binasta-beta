<?php

namespace App\Models;

use Hyn\Tenancy\Traits\UsesSystemConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory, UsesSystemConnection;

    protected $fillable = ["ref", "order_id", "payment_type"];

    public function order () {
        return $this->belongsTo(Order::class);
    }
}
