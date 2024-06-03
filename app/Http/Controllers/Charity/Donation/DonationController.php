<?php

namespace App\Http\Controllers\Charity\Donation;

use App\Models\Donation;
use App\Models\StoreRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Charity\Donation\DonationStatusNotification;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    //
    public function index()
    {
        return view('charity.donation.index');
    }

    public function getAll()
    {

        $authCharity = Auth::guard('charity')->user()->id;
        $donations = Donation::with(['store'])->where('status', 'pending')->where('charity_id' , $authCharity)->select('*')->latest();


        return DataTables::of($donations)

            ->addIndexColumn()

            ->addColumn('newstatus', function ($row) {
                return $row->status = "انتظار الموافقه";
            })
            ->addColumn('store_name', function ($row) {
                return $row->store->name;
            })

            ->addColumn('created', function ($row) {
                return $row->created_at->format('Y-m-d h-m');
            })

            ->addColumn('action', function ($row) {
                return '<div class="dropdown">
                <button title="btn" type="button" class="btn p-0 dropdown-toggle hide-arrow"
                    data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="' . Route('charities.donations.canceld',  $row->id) . '"><i
                            class="bx bx-edit-alt me-1"></i> رفض التبرع</a>
                            <a class="dropdown-item" href="' . Route('charities.donations.show', $row->id) . '"><i
                            class="bx bx-show me-1"></i> عرض التبرع</a>
                            <a class="dropdown-item" href="' . Route('charities.donations.accept', $row->id) . '"><i
                            class="bx bx-show me-1"></i> قبول التبرع</a>
                </div>
            </div>';
            })

            ->rawColumns(['action', 'store_name', 'newstatus', 'created'])


            ->Make(true);
    }
    public function accept($id)
    {

        $donation = Donation::findOrFail($id);

        $store = $donation->store;
        $charity = $donation->charity;

        $donation->update(['status' => 'accept']);

        $status = " تم قبول التبرع ترسال وفد لاستلام التبرع";
        // send notification to store
        Notification::send($store , new DonationStatusNotification($status , $charity));


        session()->flash('success', ' تم قبول طلب التبرع بنجاح الرجاء التوجه للاستلام في اقرب وقت...');
        return redirect()->back();
    }

    public function show($id)
    {
        $donation = Donation::with('store')->findOrFail($id);

        $store = $donation->store;
         //Store Rate
         $store_rate = StoreRate::where('store_id' , $store->id)->select(DB::raw('AVG(value) as rate' ))->get();
         $store_rate = $store_rate[0]->rate;

         $store['rate'] = $store_rate;

        return view('charity.donation.show', compact('donation' , 'store'));
    }
    public function canceld($id)
    {

        $donation = Donation::findOrFail($id);
        $donation->update(['status' => 'canceld']);

        $status = " تم رفض التبرع ";
        $store = $donation->store;
        $charity = $donation->charity;

        // send notification to store
        Notification::send($store , new DonationStatusNotification($status , $charity));


        session()->flash('success', 'تم رفض طلب التبرع بنجاح');
        return redirect()->back();
    }
}
