<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function store()
    {
        return $this->belongsTo(Store::class , 'store_id');
    }
    public function charity()
    {
        return $this->belongsTo(Charity::class , 'charity_id');
    }
    // public function scopeOfCharity($query, $charityId)
    // {
    //     return $query->where('charity_id', $charityId);
    // }
}
