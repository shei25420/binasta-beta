<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BinapointsConfiguration extends Model
{
    use HasFactory;

    protected $fillable = ['awarded', 'value'];
}
