<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function mediator()
    {
        return $this->belongsTo(Mediator::class , 'mediator_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class , 'store_id');
    }

    public function method()
    {
        return $this->belongsTo(WithdrawalMethod::class , 'withdrawal_method');
    }
}
