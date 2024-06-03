<?php

namespace App\Console\Commands\Admin\Event;

use App\Models\User;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Event;
use App\Models\Store;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use App\Notifications\Admin\Event\EventRememberNotification;

class EventRemember extends Command
{

    protected $signature = 'EventRemember';


    protected $description = 'Command description';

    public function handle()
    {
        $today_date =  Carbon::parse(Carbon::today());

        $events = Event::all();
        foreach ($events as $event) {
            $start_date = Carbon::parse($event->start);

            if ($start_date->equalTo($today_date)) {

                // to test
                $admin = Admin::first();
                $admin->notify(new EventRememberNotification());

                /* $users = User::all();
                foreach ($users as $user) {
                    $user->notify(new EventRememberNotification());
                }

                $stores = Store::all();
                foreach ($stores as $store) {
                    $store->notify(new EventRememberNotification());
                }
                */
            }
        }
    }
}
