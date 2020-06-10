<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Illuminate\Http\Request;

class ForgetPasswordOtp extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
    */
    //public $emailid ;
   
    public $otp;
    public $emailid;
	
	
     
    public function __construct($otp,$email_id)
    {       
        $this->emailid = $email_id;
        $this->otp = $otp;
       
         
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        
         return $this->from('noreply@nic.in','HRD')
                    ->to($this->emailid)
                    ->subject('HRD Forget Password OTP')
                    ->markdown('email.ForgetPasswordOtp');
    }
}
