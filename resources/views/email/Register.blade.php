@component('mail::message')
# Email Verification
Dear {{$name }},

find below the link for activation

 

@component('mail::button', ['url' => url('contact/'.$emailid)])
Click To Verification
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
