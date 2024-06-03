<?php

namespace App\Models;

use App\Models\City;
use App\Models\Governorate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Charity extends Authenticatable
{
    use HasFactory , SoftDeletes , Notifiable;
    protected $guarded = [];

    public function governorate()
    {
        return $this->belongsTo(Governorate::class , 'governorate_id');
    }
    public function city()
    {
        return $this->belongsTo(City::class , 'city_id');
    }

    public function members()
    {
        return $this->hasMany(CharityMember::class , 'charity_id');
    }

    public function donations()
    {
        return $this->hasMany(Donation::class , 'charity_id');
    }
}
