<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Illuminate\Http\Request;

class LoginCredential extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
    */
    //public $emailid ;
    public $candidateName;
    public $username;
    public $emailid;
	public $password;
	public $category_id;
     
    public function __construct($username,$id,$firtname,$password,$category_id)
    {       
        $this->emailid = $id;
        $this->username = $username;
        $this->candidateName = $firtname;
        $this->password = $password;
		$this->category_id = $category_id;
         
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        //return $this->markdown('email.Register');
         return $this->from('hrd@gov.in','HRD')
                    ->to($this->emailid)
                    ->subject('Login Credentials')
                    ->markdown('email.loginCredentialVal');
    }
}
