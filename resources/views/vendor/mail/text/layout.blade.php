@php
    $appName = config('app.name');
@endphp
==========================================
{{ $appName }} - Verify Your Email
==========================================

Welcome to {{ $appName }}!

Thank you for registering. Please verify your email address to complete your registration.

Your verification code is: {{ $otp }}

This code will expire in 10 minutes.

If you did not request this verification, please ignore this email. — {{ $appName }} Team