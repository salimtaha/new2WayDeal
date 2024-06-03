<?php

namespace App\Http\Controllers\Mediator;

use Carbon\Carbon;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use App\Models\WithdrawalMethod;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Trait\mediator\MediatorTrait;

class WelcomeController extends Controller
{
    use MediatorTrait;
    public function index()
    {
        $count =[];
        $count['withdrawal_today'] = $this->withdrawalsToday();
        $count['withdrawal_accepted_today'] = $this->withdrawalsAcceptedToday();
        $count['total_withdrawals'] = $this->totalWithdrawals();
        $count['total_accepted_withdrawals'] = $this->totalAcceptedWithdrawals();
        $count['num_of_stores_make_withdrawals'] = $this->numOfStoresMakeWithdrawals();
        $count['num_of_stores_make_accepted_withdrawals'] = $this->numOfStoresMakeِAcceptedWithdrawals();
        $count['rejected_withdrawal_today'] = $this->withdrawalsRejectedToday();
        $count['rejected_withdrawal'] = $this->withdrawalsRejected();



        $latest_withdrawals = Withdrawal::with(['store', 'method'])->latest()->take(6)->get();
        $methods = WithdrawalMethod::get();

        return view('mediator.welcome' , compact('count' , 'latest_withdrawals' , 'methods'));
    }


}
