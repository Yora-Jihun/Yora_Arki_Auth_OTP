@extends('vendor.mail.html.layout')
@section('title', 'Your Verification Code')

@section('content')
<h1 style="font-size: 28px; font-weight: 600; color: #0f172a; margin: 0 0 16px 0;">
    Hello!
</h1>

<p style="font-size: 16px; line-height: 1.6; color: #334155; margin: 0 0 16px 0;">
    Your verification code is:
</p>

<div style="background-color: #eff6ff; border: 2px dashed #3b82f6; border-radius: 8px; padding: 24px; text-align: center; margin: 24px 0;">
    <span style="font-size: 36px; font-weight: 700; letter-spacing: 6px; color: #2563eb; font-family: 'Courier New', monospace;">
        {{ $otp }}
    </span>
</div>

<p style="font-size: 14px; color: #64748b; margin: 24px 0;">
    This code will expire in 10 minutes.
</p>

<hr style="border: none; border-top: 1px solid #e2e8f0; margin: 32px 0;">

<p style="font-size: 14px; color: #64748b; margin: 0;">
    — {{ $appName }}
</p>
@endsection