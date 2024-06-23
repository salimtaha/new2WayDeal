<?php

namespace App\Http\Controllers\API\Seller;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationsResource;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function index()
    {
        return SendResponse(200, 'Notifications fetched successfully',
            [
                'count' => auth()->user()->notifications->count(),
                'notifications' => NotificationsResource::collection(auth()->user()->notifications),
            ]
        );
    }


    public function show($notification)
    {
        $notification = auth()->user()->notifications()->where('id', $notification)->first();

        if (!$notification) {
            return SendResponse(404, 'Notification not found');
        }
        return SendResponse(200, 'Notification fetched successfully', new NotificationsResource($notification));
    }
}
