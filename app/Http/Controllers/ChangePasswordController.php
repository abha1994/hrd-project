<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DateTime;
use DB;
use Auth,Session;
use Validator,Redirect;
use App\ChangePassword;



class ChangePasswordController extends Controller
{
    
    public function index(Request $request)
    {
		
        $login_user_id = Auth::id();
            date_default_timezone_set('Asia/Kolkata');
            $date = date('Y-m-d H:i:s');
            $url = $_SERVER['REQUEST_URI'];
            $device = $_SERVER['HTTP_USER_AGENT'];
            $ipaddress = $_SERVER['REMOTE_ADDR'];
            
            $audtitrail_tbl_post['users_id_tbl'] = $login_user_id;
            $audtitrail_tbl_post['status'] = '0';
            $audtitrail_tbl_post['action_type1'] = '1';
            $audtitrail_tbl_post['module_name'] = $url;
            $audtitrail_tbl_post['desc'] = '';
            $audtitrail_tbl_post['device'] = $device;
            $audtitrail_tbl_post['ipaddress'] = $ipaddress;
            $audtitrail_tbl_post['timestamp'] = $date;
            $data = DB::table('audtitrail_tbl')->insert($audtitrail_tbl_post);
			
	    // $old_password=  'Password@321';
        // $old_password_encry=Hash::make($old_password);
		// $old_password_encry1=Hash::make($old_password);
		// dd($old_password_encry,$old_password_encry1);
           
            return view('change_password_form');
        }
        
        public function changepassword(Request $request)
        {
			
			 $login_user_data =  Auth::user();
        
    
            
            date_default_timezone_set('Asia/Kolkata');
            $date = date('Y-m-d H:i:s');
            $url = $_SERVER['REQUEST_URI'];
            $device = $_SERVER['HTTP_USER_AGENT'];
            $ipaddress = $_SERVER['REMOTE_ADDR'];
            
            $audtitrail_tbl_post['users_id_tbl'] = $login_user_data->id;
            $audtitrail_tbl_post['status'] = '0';
            $audtitrail_tbl_post['action_type1'] = '1';
            $audtitrail_tbl_post['module_name'] = $url;
            $audtitrail_tbl_post['desc'] = '';
            $audtitrail_tbl_post['device'] = $device;
            $audtitrail_tbl_post['ipaddress'] = $ipaddress;
            $audtitrail_tbl_post['timestamp'] = $date;
            $data = DB::table('audtitrail_tbl')->insert($audtitrail_tbl_post);
            
            $this->validate($request, [
                'oldpassword' => 'required',
                'newpassword' => 'required|min:8|max:15|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
                'confirmpassword' => 'required|min:8|max:15|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
                
            ]);
            
            
            $post_data['oldpassword']= $request->oldpassword;
            $post_data['newpassword']= $request->newpassword;
            $post_data['confirmpassword']= $request->confirmpassword;
            
            $data = ChangePassword::changepassword($post_data,$login_user_data);
            
            if($data['status'] == "1" ){
                return back()
                ->with('success',"Password has been changed Successfully")
                ->with('all_data',$post_data);
            }else if($data['status'] == "2"){
                return back()
                ->with('success',"Password has been changed Successfully")
                ->with('all_data',$post_data);
            }else if($data['status'] == "3"){
                return back()
                ->with('error',"New Password and Confirm Password Did not Match")
                ->with('all_data',$post_data);
            }else if($data['status'] == "4"){
                return back()
                ->with('error',"Incorrect Old Password")
                ->with('all_data',$post_data);
            }
            else if($data['status'] == "5"){
                return back()
                ->with('error',"Password should not match with old 3 password")
                ->with('all_data',$post_data);
            }
            
        
         
        }
        
   
    }
    
    
    
    




