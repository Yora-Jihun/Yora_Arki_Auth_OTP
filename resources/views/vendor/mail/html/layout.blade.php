@php
    $appName = config('app.name');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
</head>
<body style="margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; background-color: #f8fafc; color: #0f172a;">
    <div style="max-width: 600px; margin: 0 auto; padding: 32px 24px;">
        <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom: 32px;">
            <tr>
                <td align="left">
                    <a href="{{ url('/') }}" style="text-decoration: none; display: block;">
                        <table cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="background-color: #2563eb; width: 44px; height: 44px; text-align: center; vertical-align: middle; font-size: 18px; font-weight: 700; color: white; letter-spacing: -0.5px;">
                                    YA
                                </td>
                                <td width="12" style="font-size: 0; line-height: 0;">&nbsp;</td>
                                <td style="vertical-align: middle; font-size: 24px; font-weight: 600; color: #0f172a; letter-spacing: -0.5px;">
                                    {{ $appName }}
                                </td>
                            </tr>
                        </table>
                    </a>
                </td>
            </tr>
        </table>

        @yield('content')
    </div>
</body>
</html>