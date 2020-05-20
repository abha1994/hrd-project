@component('mail::message')
# HRD New Password


Please find below New Password of HRD Portal :


 Passowrd : {{$user_password}}<br>

@component('mail::button', ['url' => url('/login')])
Click To Login
@endcomponent

Regards,<br>
HRD portal<br>
Ministry of New and Renewable Energy<br>
@endcomponent
