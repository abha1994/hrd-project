@component('mail::message')
# Login Credentials
Dear {{ $ofname }},

Please find below Details of login credentials of our HRD Portal :

 Username : {{ $username }} <br>
 Passowrd : {{$mail_pass}}<br>

@component('mail::button', ['url' => url('/login')])
Click To Login
@endcomponent

Regards,<br>
HRD portal<br>
Ministry of New and Renewable Energy<br>
@endcomponent
