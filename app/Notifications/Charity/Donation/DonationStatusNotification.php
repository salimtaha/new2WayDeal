<?php

namespace App\Notifications\Charity\Donation;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DonationStatusNotification extends Notification
{
    use Queueable;

    public $status  , $charity;
    public function __construct($status , $charity)
    {
        $this->status = $status;
        $this->charity = $charity;
    }


    public function via($notifiable)
    {
        return ['database'];
    }



    public function toArray($notifiable)
    {
        return [
            'msg' => $this->status,
            'charity_name'=>$this->charity->name,
            'charity_id'=>$this->charity->id,
        ];
    }
}
