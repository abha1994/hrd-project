@component('mail::message')
# Email Verification
Dear {{$name }},

Please click on the below link to verify your Email

 

@component('mail::button', ['url' => url('contact/'.$emailid)])
Click To Verification
@endcomponent

Regards,<br>
HRD portal<br>
Ministry of New and Renewable Energy<br>
@endcomponent
