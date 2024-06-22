<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory , SoftDeletes;
    protected $casts = [
        'available_for' => 'datetime',
        'expire_date' => 'datetime',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class , 'category_id');
    }
    public function orderItems()
    {
        return $this->hasMany(OrderDetail::class , 'product_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class , 'product_id');
    }
    public function store()
    {
        return $this->belongsTo(Store::class , 'store_id');
    }
}
