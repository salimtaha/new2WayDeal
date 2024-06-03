<?php

namespace App\Trait\mediator;

use App\Models\Withdrawal;
use Illuminate\Support\Carbon;


trait MediatorTrait
{
    public $start_day ,$end_day;

    public function __construct()
    {
        $this->start_day = Carbon::parse(now()->format('Y-m-d h:m:s'))->startOfDay();
        $this->end_day = Carbon::parse(now()->format('Y-m-d h:m:s'))->endOfDay();

    }
    public function withdrawalsAcceptedToday()
    {

        $withdrawals_today = Withdrawal::where('status', 'accepted')
            ->whereBetween('created_at', [$this->start_day, $this->end_day])
            ->sum('amount');
        return $withdrawals_today;
    }
    public function withdrawalsToday()
    {

        $withdrawals_today = Withdrawal::whereBetween('created_at', [$this->start_day, $this->end_day])
            ->sum('amount');
        return $withdrawals_today;
    }

    public function totalWithdrawals()
    {
        $total_withdrawals = Withdrawal::sum('amount');
        return $total_withdrawals;

    }
    public function totalAcceptedWithdrawals()
    {
        $total_withdrawals = Withdrawal::where('status', 'accepted')->sum('amount');
        return $total_withdrawals;

    }

    public function numOfStoresMakeWithdrawalsToday()
    {
        // number of stores make success withdrawal today
        $users_today = Withdrawal::where('status', 'accepted')
            ->whereBetween('created_at', [$this->start_day, $this->end_day])
            ->pluck('store_id')
            ->unique()
            ->count();
        return $users_today;
    }
    public function numOfStoresMakeWithdrawals()
    {
        // number of stores make success withdrawal today
        $users_today = Withdrawal::pluck('store_id')
            ->unique()
            ->count();
        return $users_today;
    }
    public function numOfStoresMakeِAcceptedWithdrawals()
    {
        // number of stores make success withdrawal today
        $users_today = Withdrawal::where('status', 'accepted')
            ->pluck('store_id')
            ->unique()
            ->count();
        return $users_today;
    }
    public function withdrawalsRejectedToday()
    {
        $users_today = Withdrawal::where('status', 'rejected')
            ->whereBetween('created_at' , [$this->start_day , $this->end_day])
            ->sum('amount');
        return $users_today;
    }
    public function withdrawalsRejected()
    {
        $users_today = Withdrawal::where('status', 'rejected')
            ->sum('amount');
        return $users_today;
    }
}
