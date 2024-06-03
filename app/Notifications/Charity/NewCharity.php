<?php

namespace App\Notifications\Charity;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewCharity extends Notification
{
    use Queueable;

    public  $charity;
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
            'title'=>'انضمام مؤسسه جديده',
            'msg'=>'اطلع علي بيانات المؤسسه لرؤيه البيانات ...',
            'charity_id'=>$this->charity->id,
        ];
    }
}
