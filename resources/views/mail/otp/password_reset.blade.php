@extends('vendor.mail.html.layout')
@section('title', 'Password Reset Request')

@section('content')
<h1 style="font-size: 28px; font-weight: 600; color: #0f172a; margin: 0 0 16px 0;">
    Password Reset Request
</h1>

<p style="font-size: 16px; line-height: 1.6; color: #334155; margin: 0 0 16px 0;">
    You recently requested to reset your password for your {{ $appName }} account.
</p>

<p style="font-size: 16px; line-height: 1.6; color: #334155; margin: 0 0 8px 0;">
    Your reset code is:
</p>

<div style="background-color: #fef3c7; border: 2px dashed #f59e0b; border-radius: 8px; padding: 24px; text-align: center; margin: 24px 0;">
    <span style="font-size: 36px; font-weight: 700; letter-spacing: 6px; color: #d97706; font-family: 'Courier New', monospace;">
        {{ $otp }}
    </span>
</div>

<p style="font-size: 14px; color: #64748b; margin: 24px 0;">
    This code will expire in 10 minutes.
</p>

<p style="font-size: 14px; color: #64748b; margin: 0 0 24px 0;">
    If you did not request a password reset, please ignore this email and your password will remain unchanged.
</p>

<table width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center">
            <a href="{{ route('password.reset') }}" style="display: inline-block; background-color: #2563eb; color: white; text-decoration: none; padding: 12px 24px; border-radius: 6px; font-weight: 600; font-size: 14px;">
                Reset Your Password
            </a>
        </td>
    </tr>
</table>

<hr style="border: none; border-top: 1px solid #e2e8f0; margin: 32px 0;">

<p style="font-size: 14px; color: #64748b; margin: 0;">
    — {{ $appName }} Team
</p>
@endsection