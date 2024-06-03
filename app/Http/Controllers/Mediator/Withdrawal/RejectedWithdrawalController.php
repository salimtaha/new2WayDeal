<?php

namespace App\Http\Controllers\Mediator\Withdrawal;

use App\Models\Withdrawal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RejectedWithdrawalController extends Controller
{

    public function index(Request $request)
    {
        $withdrawals = Withdrawal::with(['store', 'method'])
        ->whereRelation('store', 'status', '=', 'approved')
        ->where('status', 'rejected')
        ->where('mediator_id' , auth('mediator')->user()->id)

        ->when($request->search, function ($query) use ($request) {
            $query->where('status', 'rejected');
            $query->where('mediator_id' , auth('mediator')->user()->id);

            $query->where(function($query) use($request){
                $query->whereRelation('store', 'name', 'LIKE', '%' . $request->search . '%');
                $query->orWhereRelation('method', 'name', 'LIKE', '%' . $request->search . '%');
            });


        })
        ->select('*')->latest()->paginate(5);

    return view('mediator.withdrawals.rejected', compact('withdrawals'));
    }
}
