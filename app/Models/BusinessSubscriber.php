<?php

namespace App\Models;

use Hyn\Tenancy\Traits\UsesSystemConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessSubscriber extends Model
{
    use HasFactory, UsesSystemConnection;

    protected $fillabe = ['email'];
}
