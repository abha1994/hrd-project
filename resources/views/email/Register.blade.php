@component('mail::message')
# Email Verification
<?php if($category_id != 3) {  echo "<h5>Dear ".$name.", </h5>"; }else { echo "<h5>Hello, </h5>";} ?>

Please click on the below link to verify your Email :

@component('mail::button', ['url' => url('contact/'.$emailid)])
Click To Verification
@endcomponent

Regards,<br>
HRD portal<br>
Ministry of New and Renewable Energy<br>
@endcomponent
