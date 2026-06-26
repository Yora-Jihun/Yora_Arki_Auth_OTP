@extends('vendor.mail.html.layout')
@section('title', 'Account Deletion Confirmation')

@section('content')
<h1 style="font-size: 28px; font-weight: 600; color: #0f172a; margin: 0 0 16px 0;">
    Important Notice
</h1>

<p style="font-size: 16px; line-height: 1.6; color: #334155; margin: 0 0 16px 0;">
    A request was made to delete your {{ $appName }} account.
</p>

<p style="font-size: 16px; line-height: 1.6; color: #334155; margin: 0 0 8px 0;">
    If this was you, please confirm by entering this verification code:
</p>

<div style="background-color: #fef2f2; border: 2px dashed #ef4444; border-radius: 8px; padding: 24px; text-align: center; margin: 24px 0;">
    <span style="font-size: 36px; font-weight: 700; letter-spacing: 6px; color: #dc2626; font-family: 'Courier New', monospace;">
        {{ $otp }}
    </span>
</div>

<p style="font-size: 14px; color: #64748b; margin: 24px 0;">
    This code will expire in 10 minutes.
</p>

<div style="background-color: #fef2f2; border-left: 4px solid #ef4444; padding: 16px; margin: 24px 0;">
    <p style="font-size: 14px; color: #dc2626; font-weight: 600; margin: 0 0 8px 0;">
        ⚠️ Warning: This action is irreversible and will permanently delete all your data.
    </p>
    <p style="font-size: 14px; color: #64748b; margin: 0;">
        If you did not request account deletion, please ignore this email and your account will remain active.
    </p>
</div>

<hr style="border: none; border-top: 1px solid #e2e8f0; margin: 32px 0;">

<p style="font-size: 14px; color: #64748b; margin: 0;">
    — {{ $appName }} Security Team
</p>
@endsection