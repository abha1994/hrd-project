<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\ForgetUsernameOtp;
use App\Mail\ForgetUsername;
use DateTime;
use Validator,Redirect;
use Session;



class ForgetUserController extends Controller
{
    
    public function index(Request $request)
    {
        // echo "sdfDSF";die;
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
            'first_name' => 'required'
            //'CaptchaCode' => 'required',
            
        ]);
        
        
        $code = $request->input('CaptchaCode');
        $isHuman = captcha_validate($code);
        $first_name = $request->first_name;
		
        $email_id = $request->email_id;
		$fu_otp = $request->fu_otp;
        if ($isHuman)
        {
            $user_data=  DB::table('user_credential')->where('name', $first_name)->where('email', $email_id)->get()->first();
		   
            if($user_data)
            {
               
                $username= $user_data->username;
                $otp_db= $user_data->fu_otp;
                //dd($first_name,$dob,$email_id,$candidate_id,$username,$otp,$otp_db);
                if($fu_otp==$otp_db)
                {
                    
                    Mail::to($email_id)->send(new ForgetUsernameOtp($username,$email_id));
                    return back()
                    ->with('success',"Username has been sent to your registered Email id : ".$email_id);
                    
                }
                else
                {
                    return back()->with('error',"Entered otp is not valid!")
					->with('first_name',$first_name)
			        ->with('email_id',$email_id)
			        ->with('fu_otp',$fu_otp)
			        ->with('CaptchaCode',$code);
					
                }
            }
        
           
            else
            {
                return back()
                ->with('error',"Details are not valid!")
				->with('first_name',$first_name)
			    ->with('email_id',$email_id)
			    ->with('fu_otp',$fu_otp)
			    ->with('CaptchaCode',$code);
				
            }
           
        }
        else
        {
			
            return back()
            ->with('error',"Captcha Code Didn't match successsfully!")
			->with('first_name',$first_name)
			->with('email_id',$email_id)
			->with('fu_otp',$fu_otp)
			->with('CaptchaCode',$code);
			
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
        //$dob = $request->get('dob');
        
        
        
        $detail_exist = DB::table('user_credential')->where('name', $first_name)->get();
        if(count($detail_exist)>0)
        {
            
            $email_id = $request->get('email_id');
            
            if(strlen($email_id)>0)
            {
                
                $email_exist = DB::table('user_credential')->where('email', $email_id)->get()->first();
				
                if($email_exist)
                {
                    $email_id = $request->get('email_id');
                    
                    $username= $email_exist->username;
                    $string2="1234567890";
                    $string= str_shuffle($string2);
                    $otp  = substr($string,4,6);
                    $postdata['fu_otp'] = $otp;
                    $a = DB::table('user_credential')->where('username', $username)->update($postdata);
                    

                    
                    Mail::to($email_id)->send(new ForgetUsernameOtp($otp,$email_id));
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
        
       
        else
        {
            echo 2;/*  back()
            ->with('error',"Details doesn't exist!. Kindly enter correct details"); */
        }
    }
    
    
}
