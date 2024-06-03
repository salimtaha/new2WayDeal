<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function getStatusAttribute($value)
    {
        if ($value == "paid") {
            return "تم الدفع";
        } elseif ($value == "completed") {
            return "تم التسليم";
        } elseif ($value == "pending") {
            return "غير مدفوع";
        } else {
            return "الطلب ملغي";
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
    public function governorate()
    {
        return $this->belongsTo(Governorate::class, 'governorate_id');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }


}
