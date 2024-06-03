<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CharityMember extends Model
{
    use HasFactory , SoftDeletes;
    protected $guarded = [];
    protected $table = "charity_members";

    public function charity()
    {
        return $this->belongsTo(Charity::class , 'charity_id');
    }

    public function governorate()
    {
        return $this->belongsTo(Governorate::class , 'governorate_id');
    }
    public function city()
    {
        return $this->belongsTo(City::class , 'city_id');
    }
}
