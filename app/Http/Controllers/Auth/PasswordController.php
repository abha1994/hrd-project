<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;
use Validator,Redirect;
use Session;
use Auth;


class PasswordController extends Controller
{
   
    public function index(Request $request)
    { 
	echo "SDfSD";die;
		$all_data =  Session::get('userdata');
		if($all_data == null){
			
			date_default_timezone_set('Asia/Kolkata');
			$date = date('Y-m-d H:i:s');
			$url = $_SERVER['REQUEST_URI'];
			$device = $_SERVER['HTTP_USER_AGENT'];
			$ipaddress = $_SERVER['REMOTE_ADDR'];
			
			$audtitrail_tbl_post['users_id_tbl'] = '0';
			$audtitrail_tbl_post['status'] = '0';
			$audtitrail_tbl_post['action_type1'] = '1';
			$audtitrail_tbl_post['module_name'] = $url;
			$audtitrail_tbl_post['desc'] = '';
			$audtitrail_tbl_post['device'] = $device;
			$audtitrail_tbl_post['ipaddress'] = $ipaddress;
			$audtitrail_tbl_post['timestamp'] = $date;
			$data = DB::table('audtitrail_tbl')->insert($audtitrail_tbl_post);
			return view('front/forgetpassword_form');
	   }else{
			  return redirect('dashboard');
		 }
		
    }
    
    public function forgetpassword_form(Request $request) {
        
        date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d H:i:s');
        $url = $_SERVER['REQUEST_URI'];
        $device = $_SERVER['HTTP_USER_AGENT'];
        $ipaddress = $_SERVER['REMOTE_ADDR'];
        
        $audtitrail_tbl_post['users_id_tbl'] = '0';
        $audtitrail_tbl_post['status'] = '0';
        $audtitrail_tbl_post['action_type1'] = '2';
        $audtitrail_tbl_post['module_name'] = $url;
        $audtitrail_tbl_post['desc'] = '';
        $audtitrail_tbl_post['device'] = $device;
        $audtitrail_tbl_post['ipaddress'] = $ipaddress;
        $audtitrail_tbl_post['timestamp'] = $date;
        $data = DB::table('audtitrail_tbl')->insert($audtitrail_tbl_post);
        
        
        $validatedData = $request->validate([
            'username' => 'required',
            'CaptchaCode' => 'required',
            
        ]);
        
        $code = $request->input('CaptchaCode');
        $isHuman = captcha_validate($code);
		
        $username = $request->username;
		$email_id = $request->email_id;
		$otp = $request->otp;
		
        if ($isHuman)
        {
           
			// $regist_data=  DB::table('registration')->where('email_id', $email_id)->get()->first();
			// if($regist_data == null){
			// }else{
			// dd($regist_data);
            $user_data=  DB::table('user_credential')->where('username', $username)->get()->first();
			
			if($user_data == null){
			   return back()->with('error',"Username does not exist")
					->with('username',$username)
					->with('email_id',$email_id)
					->with('otp',$otp)
					->with('CaptchaCode',$code);
			}else{
				
				$registeration_id = $user_data->registeration_id;
				$regist_data=  DB::table('registration')->where('candidate_id', $registeration_id)->where('email_id', $email_id)->get()->first();
				if($regist_data == null){
			    return back()->with('error',"Username or Email does not exist")
					->with('username',$username)
					->with('email_id',$email_id)
					->with('otp',$otp)
					->with('CaptchaCode',$code);
			   }else{
					$otp_db= $user_data->otp;
					if($otp == $otp_db)
					{
						$string1="abcdefghijklmnopqrstuvwxyz";
						$string2="1234567890";
						$string3="!@#$%^&*()_+";
						$string=$string1.$string2.$string3;
						$string= str_shuffle($string);
						$user_password  = substr($string,8,14); 
						$postdata['password'] = md5($user_password);
						$a = DB::table('user_credential')->where('username', $username)->update($postdata);
						
						$to = 'test1@localhost';
						$subject = 'HRD new password';
						$html = "";
						$html  .= "Your new password is ".$user_password." Kindly log in with new password.";
						$message = $html;
						
						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$headers .= 'From: Server <test2@localhost>' . "\r\n";
						$headers .= 'X-Mailer: PHP/' . phpversion();
						
						mail($to, $subject, $message, $headers);
						return back()
						->with('success',"New password has been sent to your registered email_id!")
						->with('username',$username)
						->with('email_id',$email_id)
						->with('otp',$otp)
						->with('CaptchaCode',$code);
					}
					else{
						return back()->with('error',"Entered otp is not valid!")
						->with('username',$username)
						->with('email_id',$email_id)
						->with('otp',$otp)
						->with('CaptchaCode',$code);
					}
			  }
			}
            
        }
        else
        {
            return back()
            ->with('error',"Captcha Code Didn't match successsfully!")
			->with('username',$username)
			->with('email_id',$email_id)
			->with('otp',$otp)
			->with('CaptchaCode',$code);
        }   
    }
    
    public function sendotp(Request $request) {
        
        date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d H:i:s');
        $url = $_SERVER['REQUEST_URI'];
        $device = $_SERVER['HTTP_USER_AGENT'];
        $ipaddress = $_SERVER['REMOTE_ADDR'];
        
        $audtitrail_tbl_post['users_id_tbl'] = '0';
        $audtitrail_tbl_post['status'] = '0';
        $audtitrail_tbl_post['action_type1'] = '2';
        $audtitrail_tbl_post['module_name'] = $url;
        $audtitrail_tbl_post['desc'] = '';
        $audtitrail_tbl_post['device'] = $device;
        $audtitrail_tbl_post['ipaddress'] = $ipaddress;
        $audtitrail_tbl_post['timestamp'] = $date;
        $data = DB::table('audtitrail_tbl')->insert($audtitrail_tbl_post);
        
        $username = $request->get('username');
        
        $username_exist = DB::table('user_credential')->where('username', $username)->get()->first();
        
        if($username_exist)
        {
            $email_id = $request->get('email_id');
			
            if(strlen($email_id)>0)
            {
                $role_id= $username_exist->role;
               
                if($role_id=="4")
                {
                  $email_exist = DB::table('registration')->where('email_id', $email_id)->where('candidate_id',$username_exist->registeration_id)->get()->first(); 
				  // if($email_exist == null){
					    // echo 5; //email does not exists
				  // }
                }
                else
                {
                    $email_exist = DB::table('admin_user')->where('email', $email_id)->where('officer_id',$username_exist->registeration_id)->get()->first();
					 // if($email_exist == null){
					    echo 5; //email does not exists
				  // }
                }
                if($email_exist != null)
                {
                    
                    $string2="1234567890";
                    $string= str_shuffle($string2);
                    $otp  = substr($string,4,6);
                    $postdata['otp'] = $otp;
                    $a = DB::table('user_credential')->where('username', $username)->update($postdata);
                    
                    $to = 'email1@localhost';
                    $subject = 'OTP for Forget Password HRD';
                    $html = "";
                    $html  .= $otp." is your otp for HRD portal forget password.";
                    $message = $html;
                    
                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $headers .= 'From: Server <email2@localhost>' . "\r\n";
                    $headers .= 'X-Mailer: PHP/' . phpversion();
                    
                    mail($to, $subject, $message, $headers);
                    echo 1;/* return back()->with('success',"OTP has been sent to your registered email id.!"); */
                }
                else
                {
                   echo 0; /* return back()
                    ->with('error',"Email id doesn't exist!"); */
                }
            }
            else
            {
                $mobileno = $request->get('mobile_no');
                if(strlen($mobileno)>0)
                {
                    $mobile_exist = DB::table('registration')->where('mobile_no', $mobileno)->get();
                    if(count($mobile_exist)>0)
                    {
                        
                        $string2="1234567890";
                        $string= str_shuffle($string);
                        $otp  = substr($string,4,6);
                        echo 3;/* return back()->with('success',"OTP has been sent to your registered mobile no.!"); */
                        
                    }
                    else
                    {
                        echo 4; /* return back()
                        ->with('error',"Mobile No. doesn't exist!"); */
                    }
                }
            }
        }
        
        
        else
        {
           echo 2;/*  return back()
            ->with('error',"Username doesn't exist!"); */
        }
        
    }
    
}
