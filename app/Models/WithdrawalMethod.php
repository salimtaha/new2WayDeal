<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawalMethod extends Model
{
    use HasFactory;
    protected $fillable = ['name' , 'description' , 'status'];

    public function withdrawals()
    {

        return $this->hasMany(Withdrawal::class , 'withdrawal_method');
    }

}
