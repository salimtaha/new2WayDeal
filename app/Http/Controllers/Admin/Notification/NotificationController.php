<?php

namespace App\Http\Controllers\Admin\Notification;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Charity;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $admin = Admin::first();
        $admin->unreadNotifications->markAsRead();

        return view('admin.pages.notifications.index');
    }

    public function redirectTo($id)
    {
        $admin = Admin::first();
        $notification = $admin->notifications()->where('id', $id)->first();

        if ($notification->type == "App\\Notifications\\Charity\\NewCharity") {

            // mark as read
            $admin->unreadNotifications()->where('id' , $id)->update(['read_at' => now()]);

            $charity_id = $notification->data['charity_id'];
            return redirect()->route('admin.charities.show', ['id' => $charity_id]);
        }

        abort(404);
    }

    public function delete($id)
    {
        $admin = Admin::first();
        $notification = $admin->notifications()->where('id', $id)->first();
        $notification->delete();
        session()->flash('success', 'تم حذف الاشعار بنجاح');
        return redirect()->back();
    }
}
