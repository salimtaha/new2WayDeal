<?php

namespace App\Http\Controllers\Mediator\Withdrawal;

use App\Models\StoreRate;
use App\Models\Withdrawal;
use App\Notifications\Mediator\withdrawalStatusNotification;
use Illuminate\Http\Request;
use App\Models\WithdrawalSetting;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;

class PendingWithdrawalController extends Controller
{
    public function index(Request $request)
    {

        $withdrawals = Withdrawal::with(['store', 'method'])
            // ->whereRelation('store', 'status', '=', 'approved')
            ->where('status', 'pending')
            ->when($request->search, function ($query) use ($request) {
                $query->where('status', 'pending');
                $query->where(function($query) use($request){
                    $query->whereRelation('store', 'name', 'LIKE', '%' . $request->search . '%');
                    $query->orWhereRelation('method', 'name', 'LIKE', '%' . $request->search . '%');
                });


            })
            ->select('*')->latest()->paginate(5);

        return view('mediator.withdrawals.pending', compact('withdrawals'));
    }


    public function show($id)
    {
        $withdrawal = Withdrawal::with(['store', 'method'])->findOrFail($id);

        $store_pending_withdrawals = Withdrawal::where('store_id', $withdrawal->store->id)
            ->where('id' , '!=' , $withdrawal->id)
            ->where('status', 'pending')
            ->paginate(2);

        $store_rate = StoreRate::where('store_id', $withdrawal->store->id)->select(DB::raw('AVG(value) as rate'))->get();
        $store_rate = $store_rate[0]->rate;

        $withdrawal['store_rate'] = $store_rate;
        return view('mediator.withdrawals.show', compact('withdrawal', 'store_pending_withdrawals'));
    }

    public function accept($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);

        if ($withdrawal->status  = "pending") {

            $account_balance = $withdrawal->store->account;

            $balance_after_withdrawal = $account_balance->value - $withdrawal->amount;

            if ($withdrawal->amount < WithdrawalSetting::first()->minimum_withdrawal_amount) {
                session()->flash('failed', 'المبلغ المطلوب سحبه اقل من الحد الادني للسحب');
                return redirect()->back();
            } elseif ($withdrawal->amount > WithdrawalSetting::first()->maximum_withdrawal_amount) {
                session()->flash('failed', 'المبلغ المطلوب سحبه اكبر من الحد الاقصى للسحب');
                return redirect()->back();
            } elseif ($balance_after_withdrawal < WithdrawalSetting::first()->the_lowest_amount_in_the_account) {
                session()->flash('failed', 'المبلغ المتبقي في الحساب اقل من الحد الادني المسموح به...');
                return redirect()->back();
            }
            // if all conditions true
            $account_balance->update(['value' => $account_balance->value - $withdrawal->amount]);
            $withdrawal->update([
                'status' => 'accepted',
                'mediator_id'=> auth('mediator')->user()->id,
            ]);

            $store = $withdrawal->store;
            $status = "تم سحب المبلغ بنجاح";
            Notification::send($store , new withdrawalStatusNotification($withdrawal , $store , $status));


            session()->flash('success', ' تم خصم الرصيد من الحساب , الرجاء اتمام التحويل  ');
            return redirect()->back();
        }else{
            session()->flash('success', 'تم معالجه العمليه  من قبل مسئول اخر');
            return redirect()->back();
        }
    }
    public function reject($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);
        if ($withdrawal->status = "pending") {
            $withdrawal->update([
                'status' => 'rejected',
                'mediator_id'=> auth('mediator')->user()->id,
            ]);

            $store = $withdrawal->store;
            $status = "تم  رفض عمليه السحب لعدم مطابقه شروط السحب ";
            Notification::send($store , new withdrawalStatusNotification($withdrawal , $store , $status));

            session()->flash('success', 'تم رفض عمليه السحب بنجاح ...');
        } else {
            session()->flash('failed', ' لا يمكن التعديل علي حاله عمليه السحب الحاليه ...');
        }
        return redirect()->back();
    }
}
