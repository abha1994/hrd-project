@component('mail::message')
# HRD New Password



Please find below Username of HRD Portal :


 Username : {{$username}}<br>

@component('mail::button', ['url' => url('/login')])
Click To Login
@endcomponent

Regards,<br>
HRD portal<br>
Ministry of New and Renewable Energy<br>
@endcomponent
