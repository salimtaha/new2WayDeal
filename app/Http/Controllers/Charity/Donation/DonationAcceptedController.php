<?php

namespace App\Http\Controllers\Charity\Donation;

use App\Models\Donation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Charity\Donation\DonationStatusNotification;

class DonationAcceptedController extends Controller
{
    public function index()
    {
        return view('charity.donation.accepted');
    }

    public function getAll()
    {

        $authCharity = Auth::guard('charity')->user()->id;
        $donations = Donation::with(['store'])->where('status', 'accept')->where('charity_id' , $authCharity)->select('*')->latest();



        return DataTables::of($donations)

            ->addIndexColumn()

            ->addColumn('newstatus', function ($row) {
                return $row->status = "تم قبول التبرع";
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
                </div>
            </div>';
            })

            ->rawColumns(['action', 'store_name', 'newstatus', 'created'])


            ->Make(true);
    }


    public function show($id)
    {
        $donation = Donation::with('store')->findOrFail($id);
        return view('charity.donation.show', compact('donation'));
    }
    public function canceld($id)
    {

        $donation = Donation::findOrFail($id);
        $donation->update(['status' => 'canceld']);

        $status =" نعتذر لن نتمكن من ارسال وفد لاستلام التبرع";
        $store = $donation->store;
        $charity = $donation->charity;

        // send notification to store
        Notification::send($store , new DonationStatusNotification($status , $charity));


        session()->flash('success', 'تم رفض طلب التبرع بنجاح');
        return redirect()->back();
    }
}
