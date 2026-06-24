<?php

namespace App\Services;

use App\Models\Otp;
use App\Notifications\OtpVerification;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\ValidationException;

class OtpService
{
    private const MAX_ATTEMPTS_PER_HOUR = 3;

    public function sendForRegistration(string $email): void
    {
        $this->validateRateLimit($email);

        $otp = Otp::generate($email);

        Notification::route('mail', $email)
            ->notify(new OtpVerification($otp->otp));
    }

    public function verify(string $email, string $otp, string $type = 'registration'): bool
    {
        $otpRecord = Otp::where('email', $email)->where('type', $type)->first();

        if (! $otpRecord || ! $otpRecord->isValid($otp)) {
            return false;
        }

        $otpRecord->delete();

        return true;
    }

    private function validateRateLimit(string $email): void
    {
        $attempts = Cache::get("otp_requests_{$email}", 0);

        if ($attempts >= self::MAX_ATTEMPTS_PER_HOUR) {
            throw ValidationException::withMessages([
                'email' => 'Too many verification requests. Please try again later.',
            ]);
        }

        Cache::put("otp_requests_{$email}", $attempts + 1, now()->addHour());
    }

    public function getRemainingTime(string $email, string $type = 'registration'): int
    {
        $otpRecord = Otp::where('email', $email)->where('type', $type)->first();

        if (! $otpRecord) {
            return 0;
        }

        return (int) max(0, now()->diffInSeconds($otpRecord->expires_at, false));
    }
}
