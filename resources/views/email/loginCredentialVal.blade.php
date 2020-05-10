@component('mail::message')
# Login Credentials
Dear {{ $candidateName }},

find below the login Credentials
<br>
username: {{ $username }} Or {{$emailid}}<br>
password: password@123<br>

@component('mail::button', ['url' => url('login')])
Click To Login
@endcomponent

Regards,<br>
HRD portal<br>
Ministry of New and Renewable Energy<br>
@endcomponent
