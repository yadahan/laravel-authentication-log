@component('mail::message')

# {{ __('authentication-log::new_device.subject', ['app' => config('app.name')]) }}

> **{{ __('authentication-log::new_device.account') }}** {{ $account->email }}<br>
> **{{ __('authentication-log::new_device.login_at') }}** {{ $loginAt }}<br>
> **{{ __('authentication-log::new_device.ip_address') }}** {{ $ipAddress }}<br>
> **{{ __('authentication-log::new_device.browser') }}** {{ $browser }}

{{ __('authentication-log::new_device.content') }}

@endcomponent
