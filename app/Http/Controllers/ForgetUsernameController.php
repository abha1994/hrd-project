<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;
use Validator,Redirect;




class ForgetUsernameController extends Controller
{
    //fuction for view forgetusername view
    public function index(Request $request)
    {
        
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
        
        return view('forgetusername_form');
    }
    
    public function forgetusername_form(Request $request) {
        
        
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
            
            'CaptchaCode' => 'required',
            
        ]);
        
        
        $code = $request->input('CaptchaCode');
        $isHuman = captcha_validate($code);
        
        if ($isHuman)
        {
            
            $first_name = $request->first_name;
            $dob = $request->dob;
            $email_id = $request->email_id;
            
            $officer_data=  DB::table('admin_user')->where('email', $email_id )->where('officer_name',$first_name)->where('dob',$dob)->get()->first();
            $registration_data=  DB::table('registration')->where('email_id', $email_id )->where('first_name',$first_name)->where('dob',$dob)->get()->first();
            if($registration_data)
            {
                $candidate_id= $registration_data->candidate_id;
                $user_data=  DB::table('user_credential')->where('registeration_id', $candidate_id)->get()->first();
                $username= $user_data->username;
                
                $otp = $request->fu_otp;
                $otp_db= $user_data->fu_otp;
                //dd($first_name,$dob,$email_id,$candidate_id,$username,$otp,$otp_db);
                if($otp==$otp_db)
                {
                    
                    $to = 'test1@localhost';
                    $subject = 'HRD Username';
                    $html = "";
                    $html  .= "Your username is ".$username." Kindly log in with this username.";
                    $message = $html;
                    
                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $headers .= 'From: Server <test2@localhost>' . "\r\n";
                    $headers .= 'X-Mailer: PHP/' . phpversion();
                    
                    mail($to, $subject, $message, $headers);
                    return back()
                    ->with('success',"Username has been sent to your registered email_id!");
                    
                }
                else
                {
                    return back()
                    ->with('error',"Entered otp is not valid!");
                }
            }
        
            elseif($officer_data)
            {
               
                $officer_id= $officer_data->officer_id;
                $user_data=  DB::table('user_credential')->where('officer_id', $officer_id)->get()->first();
                $username= $user_data->username;
                
                $otp = $request->fu_otp;
                $otp_db= $user_data->fu_otp;
                //dd($first_name,$dob,$email_id,$candidate_id,$username,$otp,$otp_db);
                if($otp==$otp_db)
                {
                    
                    $to = 'test1@localhost';
                    $subject = 'HRD Username';
                    $html = "";
                    $html  .= "Your username is ".$username." Kindly log in with this username.";
                    $message = $html;
                    
                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $headers .= 'From: Server <test2@localhost>' . "\r\n";
                    $headers .= 'X-Mailer: PHP/' . phpversion();
                    
                    mail($to, $subject, $message, $headers);
                    return back()
                    ->with('success',"Username has been sent to your registered email_id!");
                    
                }
                else
                {
                    return back()
                    ->with('error',"Entered otp is not valid!");
                }
            }
            else
            {
                return back()
                ->with('error',"Details are not valid!");
            }
           
        }
        else
        {
            return back()
            ->with('error',"Captcha Code Didn't match successsfully!");
        }
    
    }
    
    
    
    public function sendotpfu(Request $request) {
        
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
        
        
        
        $first_name = $request->get('first_name');
        $dob = $request->get('dob');
        
        
        $detail_exist1 = DB::table('admin_user')->where('officer_name', $first_name)->where('dob',$dob)->get();
        $detail_exist = DB::table('registration')->where('first_name', $first_name)->where('dob',$dob)->get();
        if(count($detail_exist)>0)
        {
            
            $email_id = $request->get('email_id');
            
            if(strlen($email_id)>0)
            {
                
                $email_exist = DB::table('registration')->where('email_id', $email_id)->get();
                if(count($email_exist)>0)
                {
                    $email_id = $request->get('email_id');
                    $registration_data=  DB::table('registration')->where('email_id', $email_id)->get()->first();
                    $candidate_id= $registration_data->candidate_id;
                    
                    $user_data=  DB::table('user_credential')->where('registeration_id', $candidate_id)->get()->first();
                    $username= $user_data->username;
                    
                    
                    $string2="1234567890";
                    $string= str_shuffle($string2);
                    $otp  = substr($string,4,6);
                    $postdata['fu_otp'] = $otp;
                    $a = DB::table('user_credential')->where('username', $username)->update($postdata);
                    
                    $to = 'test1@localhost';
                    $subject = 'OTP for Forget Username HRD';
                    $html = "";
                    $html  .= $otp." is your otp for HRD portal forget username.";
                    $message = $html;
                    
                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $headers .= 'From: Server <test2@localhost>' . "\r\n";
                    $headers .= 'X-Mailer: PHP/' . phpversion();
                    
                    mail($to, $subject, $message, $headers);
                    echo 1; /* back()->with('success',"OTP has been sent to your registered email id.!") */
                }
                else
                {
                    echo 0; /* back()
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
                        echo 3; /*  back()->with('success',"OTP has been sent to your registered mobile no.!"); */
                        
                    }
                }
                else
                {
                    echo 4; /* back()
                    ->with('error',"Mobile No. doesn't exist!"); */
                }
            }
        }
        
        elseif (count($detail_exist1)>0)
        
        {
            
            
            $email_id = $request->get('email_id');
            
            if(strlen($email_id)>0)
            {
                
                $email_exist = DB::table('admin_user')->where('email', $email_id)->get();
                if(count($email_exist)>0)
                {
                    $email_id = $request->get('email_id');
                    $officer_data=  DB::table('admin_user')->where('email', $email_id)->get()->first();
                    $officer_id= $officer_data->officer_id;
                    
                    $user_data=  DB::table('user_credential')->where('officer_id', $officer_id)->get()->first();
                    $username= $user_data->username;
                    
                    
                    $string2="1234567890";
                    $string= str_shuffle($string2);
                    $otp  = substr($string,4,6);
                    $postdata['fu_otp'] = $otp;
                    $a = DB::table('user_credential')->where('username', $username)->update($postdata);
                    
                    $to = 'test1@localhost';
                    $subject = 'OTP for Forget Username HRD';
                    $html = "";
                    $html  .= $otp." is your otp for HRD portal forget username.";
                    $message = $html;
                    
                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $headers .= 'From: Server <test2@localhost>' . "\r\n";
                    $headers .= 'X-Mailer: PHP/' . phpversion();
                    
                    mail($to, $subject, $message, $headers);
                    echo 1; /* back()->with('success',"OTP has been sent to your registered email id.!") */
                }
                else
                {
                    echo 0; /* back()
                    ->with('error',"Email id doesn't exist!"); */
                }
            }
            
            else
            {
                $mobileno = $request->get('mobile_no');
                if(strlen($mobileno)>0)
                {
                    $mobile_exist = DB::table('admin_user')->where('mobile_no', $mobileno)->get();
                    if(count($mobile_exist)>0)
                    {
                        
                        $string2="1234567890";
                        $string= str_shuffle($string);
                        $otp  = substr($string,4,6);
                        echo 3; /*  back()->with('success',"OTP has been sent to your registered mobile no.!"); */
                        
                    }
                }
                else
                {
                    echo 4; /* back()
                    ->with('error',"Mobile No. doesn't exist!"); */
                }
            }
            
        }
        else
        {
            echo 2;/*  back()
            ->with('error',"Details doesn't exist!. Kindly enter correct details"); */
        }
    }
    
    
}
