<?php

namespace App\Models;

use Hyn\Tenancy\Traits\UsesSystemConnection;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UsesSystemConnection;

    protected $fillable = ['email', 'password'];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
