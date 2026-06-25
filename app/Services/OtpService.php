<?php

namespace App\Services;

use App\Models\AuditLog;
use App\Models\Otp;
use App\Notifications\OtpVerification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\ValidationException;

class OtpService
{
    private const MAX_ATTEMPTS_PER_HOUR = 3;
    private const MAX_FAILED_VERIFICATIONS = 5;
    private const RESEND_COOLDOWN_SECONDS = 60;
    private const VERIFY_IP_RATE_LIMIT = 10;
    private const VERIFY_IP_RATE_TTL = 60;

    public function sendForRegistration(string $email): void
    {
        $this->validateRateLimit($email);
        $this->validateResendCooldown($email);

        $otp = Otp::generate($email);

        Notification::route('mail', $email)
            ->notify(new OtpVerification($otp->otp));

        Cache::put("otp_last_sent_{$email}", now()->toDateTimeString(), self::RESEND_COOLDOWN_SECONDS);

        $this->log('otp_sent', $email, [
            'otp_id' => $otp->id,
        ]);
    }

    public function verify(string $email, string $otp, string $type = 'registration', ?string $ip = null): bool
    {
        $this->validateIpRateLimit($ip);

        $otpRecord = Otp::where('email', $email)
            ->where('type', $type)
            ->notLocked()
            ->first();

        if (! $otpRecord) {
            $this->log('otp_failed', $email, ['reason' => 'not_found'], $ip);

            return false;
        }

        if (! $otpRecord->isValid($otp)) {
            $otpRecord->incrementFailedAttempts();

            $this->log('otp_failed', $email, [
                'otp_id' => $otpRecord->id,
                'failed_attempts' => $otpRecord->failed_attempts,
            ], $ip);

            if ($otpRecord->failed_attempts >= self::MAX_FAILED_VERIFICATIONS) {
                $otpRecord->lock();

                $this->log('otp_locked', $email, [
                    'otp_id' => $otpRecord->id,
                    'failed_attempts' => $otpRecord->failed_attempts,
                ], $ip);
            }

            return false;
        }

        $this->log('otp_verified', $email, ['otp_id' => $otpRecord->id], $ip);

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

    private function validateResendCooldown(string $email): void
    {
        $lastSent = Cache::get("otp_last_sent_{$email}");

        if ($lastSent && now()->diffInSeconds(Carbon::parse($lastSent)) < self::RESEND_COOLDOWN_SECONDS) {
            throw ValidationException::withMessages([
                'email' => 'Please wait before requesting a new code.',
            ]);
        }
    }

    private function validateIpRateLimit(?string $ip): void
    {
        if (! $ip) {
            return;
        }

        $key = "otp_verify_ip_{$ip}";
        $attempts = Cache::get($key, 0);

        if ($attempts >= self::VERIFY_IP_RATE_LIMIT) {
            throw ValidationException::withMessages([
                'otp' => 'Too many verification attempts. Please try again later.',
            ]);
        }

        Cache::put($key, $attempts + 1, self::VERIFY_IP_RATE_TTL);
    }

    public function getRemainingTime(string $email, string $type = 'registration'): int
    {
        $otpRecord = Otp::where('email', $email)->where('type', $type)->first();

        if (! $otpRecord) {
            return 0;
        }

        return (int) max(0, now()->diffInSeconds($otpRecord->expires_at, false));
    }

    public function getResendCooldownRemaining(string $email): int
    {
        $lastSent = Cache::get("otp_last_sent_{$email}");

        if (! $lastSent) {
            return 0;
        }

        $elapsed = now()->diffInSeconds(Carbon::parse($lastSent));

        return max(0, self::RESEND_COOLDOWN_SECONDS - $elapsed);
    }

    private function log(string $event, string $email, array $metadata = [], ?string $ip = null): void
    {
        AuditLog::create([
            'event' => $event,
            'email' => $email,
            'ip_address' => $ip ?? Request::ip(),
            'user_agent' => Request::userAgent(),
            'metadata' => $metadata,
            'created_at' => now(),
        ]);
    }
}
