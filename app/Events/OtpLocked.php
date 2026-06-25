<?php

namespace App\Events;

class OtpLocked
{
    public function __construct(public string $email, public ?string $ip = null, public ?string $userAgent = null, public array $metadata = []) {}
}
