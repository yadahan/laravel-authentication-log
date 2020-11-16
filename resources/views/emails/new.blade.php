@component('mail::message')
# Hello!

Your {{ config('app.name') }} account logged in from a new device.

> **Account:** {{ $account->email }}<br>
> **Time:** {{ $time->toCookieString() }}<br>
> **IP Address:** {{ $ipAddress }}<br>
> **Browser:** {{ $browser }}

If this was you, you can ignore this alert. If you suspect any suspicious activity on your account, please change your password.

Regards,<br>{{ config('app.name') }}
@endcomponent
