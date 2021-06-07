@component('mail::message')

# {{ __('authentication-log::new_device.subject', ['app' => config('app.name')]) }}

> **@lang('authentication-log::new_device.account'):** {{ $account->email }}<br>
> **@lang('authentication-log::new_device.login_at'):** {{ $loginAt }}<br>
> **@lang('authentication-log::new_device.ip_address'):** {{ $ipAddress }}<br>
> **@lang('authentication-log::new_device.browser'):** {{ $browser }}

{{ __('authentication-log::new_device.content') }}

@endcomponent
