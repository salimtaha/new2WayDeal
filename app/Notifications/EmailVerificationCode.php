<?php

namespace App\Notifications;

use Ichtrojan\Otp\Otp;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EmailVerificationCode extends Notification
{
    use Queueable;
    public $message;
    public $subject;
    public $fromEmail;
    public $mailer;
    private $opt;

    public function __construct()
    {
        $this->message = "copy code and put it in field email verfication :)";
        $this->subject = "verify your email";
        $this->fromEmail = "towaydeal@gmail.com";
        $this->mailer = "smtp";
        $this->opt = new Otp;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail($notifiable)
    {
        $otp = $this->opt->generate($notifiable->email , 'numeric',6 ,60);
        return (new MailMessage)
                    ->mailer('smtp')
                    ->subject($this->subject)
                    ->greeting('Welcome : ' . $notifiable->name)
                    ->line($this->subject)
                    ->line($this->message)
                    ->line('code : '. $otp->token);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
