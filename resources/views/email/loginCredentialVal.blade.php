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

Thanks,<br>
{{ config('app.name') }}
@endcomponent
