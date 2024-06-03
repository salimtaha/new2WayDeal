<?php

namespace App\Http\Controllers\Mediator\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        return view('mediator.notifications.index');
    }
}
