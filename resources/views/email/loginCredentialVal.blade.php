@component('mail::message')
# Login Credentials

<?php if($category_id != 3) {  echo "<h5>Dear ".$candidateName.", </h5>"; }else { echo "<h5>Hello, </h5>";} ?>

Please find below the login Credentials :
<br>
Username: {{ $username }} <br>
password: {{ $password }}<br>

@component('mail::button', ['url' => url('login')])
Click To Login
@endcomponent

Regards,<br>
HRD portal<br>
Ministry of New and Renewable Energy<br>
@endcomponent
