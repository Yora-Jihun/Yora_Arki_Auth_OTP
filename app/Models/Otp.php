<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $email
 * @property string $otp
 * @property Carbon $expires_at
 * @property string $type
 * @property int $failed_attempts
 * @property Carbon|null $locked_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder<Otp> ofType(string $type)
 * @method static \Illuminate\Database\Eloquent\Builder<Otp> expired()
 * @method static \Illuminate\Database\Eloquent\Builder<Otp> notLocked()
 */
class Otp extends Model
{
    protected $fillable = ['email', 'otp', 'expires_at', 'type', 'failed_attempts', 'locked_at'];

    protected $casts = [
        'expires_at' => 'datetime',
        'locked_at' => 'datetime',
    ];

    public static function generate(string $email, string $type = 'registration'): self
    {
        return self::updateOrCreate(
            ['email' => $email, 'type' => $type],
            [
                'otp' => (string) random_int(100000, 999999),
                'expires_at' => now()->addMinutes(10),
            ]
        );
    }

    public function isValid(string $otp): bool
    {
        return hash_equals($this->otp, $otp) && $this->expires_at->isFuture();
    }

    /**
     * @param  Builder<Otp>  $query
     * @return Builder<Otp>
     */
    public function scopeExpired(Builder $query): Builder
    {
        return $query->where('expires_at', '<', now());
    }

    /**
     * @param  Builder<Otp>  $query
     * @return Builder<Otp>
     */
    public function scopeOfType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }

    /**
     * @param  Builder<Otp>  $query
     * @return Builder<Otp>
     */
    public function scopeNotLocked(Builder $query): Builder
    {
        return $query->where(function ($query) {
            $query->where('locked_at', null)->orWhere('locked_at', '<=', now()->subMinutes(5));
        });
    }

    public function incrementFailedAttempts(): void
    {
        $this->increment('failed_attempts');
        $this->refresh();
    }

    public function lock(): void
    {
        $this->update(['locked_at' => now()]);
    }

    public function isLocked(): bool
    {
        return $this->locked_at !== null && $this->locked_at->gt(now()->subMinutes(5));
    }
}
