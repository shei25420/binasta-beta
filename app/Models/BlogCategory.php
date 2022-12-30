<?php

namespace App\Models;

use Hyn\Tenancy\Traits\UsesSystemConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory, UsesSystemConnection;

    protected $fillable = ['name'];

    public function blogs () {
        return $this->hasMany(Blog::class);
    }
}
