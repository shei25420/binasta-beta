<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    use HasFactory;

    protected $fillable = ['country_id', 'parent_distributor_id', 'ref', 'first_name', 'last_name', 'email', 'password', 'domain', 'gender', 'suspended'];

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
