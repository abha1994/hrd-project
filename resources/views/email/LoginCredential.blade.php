@component('mail::message')
# Login Credentials of Officer
Dear {{ $ofname }},

find below Details of login credentials of our HRD Portal

 Username : {{ $username }} Or {{$emailid}}<br>
 Passowrd : password@321<br>

@component('mail::button', ['url' => url('/login')])
Click To Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
