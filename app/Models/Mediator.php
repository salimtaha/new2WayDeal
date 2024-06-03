<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Mediator extends  Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable , SoftDeletes;
    protected $guarded = [];


    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = bcrypt($value);
    // }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class , 'mediator_id');
    }

}
