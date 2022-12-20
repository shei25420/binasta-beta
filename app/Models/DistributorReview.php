<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistributorReview extends Model
{
    use HasFactory;

    protected $fillable = ['distributor_id', 'review', 'stars'];

    public function distributor () {
        return $this->belongsTo(Distributor::class);
    }
}
