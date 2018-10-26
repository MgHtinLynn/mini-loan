@component('mail::message')
# Dear {{ $name }},

Here is OTP

@component('mail::panel')
    {{ $verifyToken }}
@endcomponent

Thanks,<br>

@endcomponent
