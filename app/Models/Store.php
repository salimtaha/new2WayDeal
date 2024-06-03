<?php

namespace App\Models;

use App\Models\City;
use App\Models\Governorate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Store extends Authenticatable
{
    use HasFactory , SoftDeletes ,  Notifiable ;
    protected $guarded  = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function governorate()
    {
        return $this->belongsTo(Governorate::class , 'governorate_id');
    }
    public function city()
    {
        return $this->belongsTo(City::class , 'city_id');
    }

    public function account()
    {
        return $this->hasOne(AccountBalance::class , 'store_id');
    }
    public function rates()
    {
        return $this->hasMany(StoreRate::class , 'store_id');
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class , 'store_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class , 'store_id');
    }
    public function donations()
    {
        return $this->hasMany(Donation::class , 'store_id');
    }

    public function alerts()
    {
        return $this->hasMany(Alert::class , 'store_id');
    }
}