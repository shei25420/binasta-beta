<?php

namespace App\Models;

use Hyn\Tenancy\Traits\UsesSystemConnection;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Distributor extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UsesSystemConnection;

    protected $fillable = ['country_id', 'parent_distributor_id', 'ref', 'first_name', 'last_name', 'email', 'password', 'domain', 'gender', 'suspended'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function patron () {
        return $this->belongsTo(Distributor::class, 'parent_distributor_id');
    }

    public function country () {
        return $this->belongsTo(Country::class);
    }

    public function orders () {
        return $this->hasMany(DistributorOrder::class);
    }
}
