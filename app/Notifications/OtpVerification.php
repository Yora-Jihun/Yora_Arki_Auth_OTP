<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OtpVerification extends Notification
{
    use Queueable;

    public function __construct(public string $otp) {}

    /**
     * @return array<int, string>
     */
    public function via(mixed $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(mixed $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your Verification Code - '.config('app.name'))
            ->greeting('Hello!')
            ->line("Your verification code is: **{$this->otp}**")
            ->line('This code will expire in 10 minutes.')
            ->salutation('— '.config('app.name'));
    }
}
