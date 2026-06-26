<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OtpVerification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public string $otp,
        public string $type = 'registration'
    ) {}

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
            ->subject($this->getSubject())
            ->markdown('mail.otp.'.$this->type, [
                'otp' => $this->otp,
                'appName' => config('app.name'),
            ]);
    }

    private function getSubject(): string
    {
        return match ($this->type) {
            'registration' => 'Verify Your Email - '.config('app.name'),
            'password_reset' => 'Password Reset Request - '.config('app.name'),
            'account_deletion' => 'Account Deletion Confirmation - '.config('app.name'),
            default => 'Your Verification Code - '.config('app.name'),
        };
    }
}
