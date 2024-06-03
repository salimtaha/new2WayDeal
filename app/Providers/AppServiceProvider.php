<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // share setting & create if not exists


        Paginator::useBootstrap();

            $setting = Setting::firstOr( function(){
                return Setting::create([
                    'title'=>'defualt',
                'copyright'=>'default',
                'description'=>'default',
                'phone'=>[0122334445,0232332434],
                'info_email'=>'default',
                'withdrawal_email'=>'default',
                'support_email'=>'default',
                'logo'=>'default',
                'favicon'=>'default.jpg',
                'facebook'=>'default.jpg',
                'twitter'=>'default',
                'youtupe'=>'default',
                'tiktok'=>'default',
                'instagram'=>'default',
                ]);
            });




        view()->share([
            'setting'=>$setting,
        ]);
    }
}
