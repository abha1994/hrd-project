<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\StudentLoginOtp;
use App\Mail\ResetPassword;
use DateTime;
use Validator,Redirect;
use Session;



class StudentLoginController extends Controller
{
    
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
			
			return view('stulogin_form');
	   
		
    }
    
    public function stuLogin_form(Request $request) {
        
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
		
		$email_id = $request->email_id;
		$mobile_no = $request->mobile_no;
		//echo $mobile_no; die;
		$otp = $request->otp;
		
        if ($isHuman)
        {

				$regist_data=  DB::table('studentregistrations')->where('email_id', $email_id)->get()->first();

				if($regist_data == null){
			    return back()->with('error',"Email does not exist")
					->with('email_id',$email_id)
					->with('otp',$otp)
					->with('CaptchaCode',$code);
			   }else{
				   
					$otp_db= $regist_data->otp;
					if($otp == $otp_db)
					{
						$stdotp= $otp_db;
						$stdemail= $regist_data->email_id;	
						$studentID= $regist_data->id;						
						return view('feedbackStudent')->with('stdotp', $stdotp)->with('stdemail', $stdemail)->with('studentID', $studentID);
					}
					else{
						return back()->with('error',"Entered otp is not valid!")
						->with('email_id',$email_id)
						->with('otp',$otp)
						->with('CaptchaCode',$code);
					}
			  }
			
            
        }
        else
        {
            return back()
            ->with('error',"Captcha Code Didn't match successsfully!")
			->with('email_id',$email_id)
			->with('otp',$otp)
			->with('CaptchaCode',$code);
        }   
    }
	
	//********** Feedback Form Submit ****************//
	
	
	public function feedback_form(Request $request) {
		
		//dd($request);
        
		
		$transactionResult = DB::transaction(function() use ($request) {
			
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
		
		$existData=DB::table('traininng_program_evaluation')->where('student_id',$request->studentID)->get()->first();
		
		        $postdata['star_rating'] = $request->star_rating;
		        $postdata['student_id'] = $request->studentID;
		        $postdata['tbl_tpe1'] = $request->tpe1;
				$postdata['tbl_tpe2'] = $request->tpe2;
				$postdata['tbl_tpe3'] = $request->tpe3;
				$postdata['tbl_tpe4'] = $request->tpe4;
				$postdata['tbl_tpe5'] = $request->tpe5;
				$postdata['tbl_tpe6'] = $request->tpe6;
				$postdata['tbl_tpe7'] = $request->tpe7;
				$postdata['tbl_tpe8'] = $request->tpe8;
				$postdata['suggestions'] = $request->suggestion;
				
		if($existData)
		{
			DB::table('traininng_program_evaluation')->where('student_id',$request->studentID)->update($postdata);
			
			//$data['msg']="Successfully Updated";
			
			return view('feedbackThanku');
		}
		
		else{
			
			DB::table('traininng_program_evaluation')->insert($postdata);
				//return back()->with('success',"You have submitted Training Program Evalution Feedback!!")->with($postdata);
				
				//$data['msg']="Successfully Inserted";
			
			return view('feedbackThanku');
		}
		
		die;
				
				
		
		
        

			  
			});
				return $transactionResult;
  
    }
	
	//********** Feedback Form Submit ****************//
    
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
		

            $email_id = $request->get('email_id');
			
            if(strlen($email_id)>0)
            {
               
                 $email_exist = DB::table('studentregistrations')->where('email_id', $email_id)->get()->first(); 

                if($email_exist != null)
                {
                    
                    $string2="1234567890";
                    $string= str_shuffle($string2);
                    $otp  = substr($string,4,6);
                    $postdata['otp'] = $otp;
                    $a = DB::table('studentregistrations')->where('email_id', $email_id)->update($postdata);
                    
                  
                     Mail::to($email_id)->send(new StudentLoginOtp($otp,$email_id));
                   
                     echo 1;/* return back()->with('success',"OTP has been sent to your registered email id.!");*/
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
                  $mobile_exist = DB::table('studentregistrations')->where('mobile', $mobileno)->get()->first();
				  
				  //echo $mobile_exist.count($mobile_exist); die;
                    if(count(array($mobile_exist))>0)
                    {
                        
                        $string2="1234567890";
                        $string= str_shuffle($string2);
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
    
}
