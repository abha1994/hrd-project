<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\LoginCredential;
use Response;
class registerVerificationController extends Controller
{

    public function verify($id){
    	

    	$registeruser = DB::table('registration')->where('email_id', $id)->first();
    	if($registeruser){
    		if($registeruser->email_varified==0){
    			// update email_verified field
    			DB::table('registration')->where('email_id', $id)->limit(1)->update(array('email_varified' => 1));  
        		// end of email_verified_field

        		//insert value in user_credential table
        		$date = date('Y-m-d H:i:s');
        		$password = 'password@123';
                if($registeruser->category_id==3){
                    $username = strtolower(substr($registeruser->institute_name,0,5));
                    $username = $username.$registeruser->candidate_id;
                    $hashPassword = Hash::make($password);
                    $firtname = substr($registeruser->institute_name,0,5);
                    $candidate =$registeruser->institute_name;
                    $scheme_code = 3;
                }else if($registeruser->category_id==2){
                    $username = strtolower(substr($registeruser->first_name,0,5));
                    $username = $username.$registeruser->candidate_id;
                    $hashPassword = Hash::make($password);
                    $firtname = $registeruser->first_name;
                    $candidate = $registeruser->first_name.' '.$registeruser->middle_name. ' ' . $registeruser->last_name;
                    $scheme_code =2;

                }else{
                    $username = strtolower(substr($registeruser->first_name,0,5));
                    $username = $username.$registeruser->candidate_id;
                    $hashPassword = Hash::make($password);
                    $firtname = $registeruser->first_name;
                    $candidate = $registeruser->first_name.' '.$registeruser->middle_name. ' ' . $registeruser->last_name;
                    $scheme_code =1;


                }

        		// $username = substr($registeruser->first_name,0,5);
        		// $username = $username.$registeruser->candidate_id;
        		// $hashPassword = Hash::make($password);
        		// $firtname = $registeruser->first_name;
	        	// $candidate = $registeruser->first_name.' '.$registeruser->middle_name. ' ' . $registeruser->last_name;
    	    	$userData = array(
        	    	'name' => $candidate,
	        	    'email' =>$id,
	            	'mobile' =>$registeruser->mobile_no,
	            	'registeration_id' =>$registeruser->candidate_id,
	            	'username' =>$username,
	            	'password' =>$hashPassword,
                    'scheme_code' => $scheme_code
        		);
        		//dd($userData);
         		DB::table('user_credential')->insert($userData); 
         		$userCredential = array('username'=>$username,'name' =>$registeruser->first_name,'emailid'=>$id);

         		Mail::to($id)->send(new LoginCredential($username,$id,$firtname));

         		//return view('auth.login');
         		return redirect()->route('login')->with('message','Your login Credential sent to email. Please check your email id');
     		}
     		else
     		{
     			echo 'your email id is all ready verified';
     		}

        	// end of user_credetial table
        }else{
        	echo 'there is some proble please try after some time';
        }

    }

    public function thankyou(){
    	return view('auth.regiserThank');
    	

    }

    public function validateemail(Request $request){
        //echo 'amresh';
        $data = $request->email_id;
         
        if($data){
            $result =DB::table('registration')->where('email_id',$data)->count();

            if($result>0){
                return Response::json('Email id all ready exit in database');
            }else{
                return Response::json('<span style="color:green">Congratulation email id not exit in database</span>');   
            }
        }
      
    }
    public function validatemobile(Request $request){
        //echo 'amresh';
        $data = $request->mobile_no;
         
        if($data){
            $result =DB::table('registration')->where('mobile_no',$data)->count();

            if($result>0){
                return Response::json('Mobie Number all ready exit in database');
            }else{
                return Response::json('<span style="color:green">Congratulation mobile number not exit in database</span>');   
            }
        }
      
    }

}
