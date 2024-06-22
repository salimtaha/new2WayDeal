<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory , SoftDeletes;


    protected $guarded = [];

    protected $casts = [
        'available_for' => 'datetime',
        'expire_date' => 'datetime',
    ];


    public function scopeAvailable($query)
    {
        return $query->where('available_for', '>=', now()->format('Y-m-d'));
    }

    public function scopeNotexpired($query)
    {
        return $query->where('expire_date', '>=', now()->format('Y-m-d'));
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function orders()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderDetail::class , 'product_id');
    }
}
