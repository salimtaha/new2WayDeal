<?php

namespace App\Notifications\Admin\Charity;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeCharity extends Notification
{
    use Queueable;

    public $charity;
    public function __construct($charity)
    {
        $this->charity = $charity;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'title'=>'تهنئه🎉',
            'msg'=>'تم قبول بيانات الاعتماد بنجاح , مرحباً بك في مجتمعنا العريق TowWayDeal',
            'charity_id'=>$this->charity->id,
        ];
    }
}
