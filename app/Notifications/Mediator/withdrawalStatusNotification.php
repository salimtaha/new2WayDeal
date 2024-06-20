<?php

namespace App\Notifications\Mediator;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class withdrawalStatusNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $withdrawal , $store , $status;
    public function __construct($withdrawal , $store , $status)
    {
        $this->withdrawal = $withdrawal;
        $this->store = $store;
        $this->status = $status;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }




    public function toArray($notifiable)
    {
        return [
            'msg' =>$this->status,
            'withdrawal_id'=>$this->withdrawal,
        ];
    }
}
