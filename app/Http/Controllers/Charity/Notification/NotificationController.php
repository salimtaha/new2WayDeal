<?php

namespace App\Http\Controllers\Charity\Notification;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Charity;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        return view('charity.notification.index');
    }
    public function show($id)
    {
        $authCharityId = Auth::guard('charity')->user()->id;
        $charity = Charity::where('id' , $authCharityId)->first();
        $charity->unreadNotifications()->where('id' , $id)->update(['read_at' => now()]);


        return view('charity.notification.index');
    }

}
