@component('mail::message')
# Your OTP Code

Hello {{ $user->name }},

Your OTP code is: **{{ $otp }}**

This OTP will expire in 5 minutes.

@component('mail::button', ['url' => url(route('otp.verifyForm', ['user_id' => $user->id]))])
Verify OTP
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent