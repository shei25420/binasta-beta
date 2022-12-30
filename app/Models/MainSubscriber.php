<?php

namespace App\Models;

use Hyn\Tenancy\Traits\UsesSystemConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainSubscriber extends Model
{
    use HasFactory, UsesSystemConnection;

    protected $fillable = ['email'];
}
