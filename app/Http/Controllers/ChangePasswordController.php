<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;
use Auth,Session;
use Validator,Redirect;
use App\ChangePassword;



class ChangePasswordController extends Controller
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
            
            return view('backend/Nref/Admin/change_password_form');
        }
        
        public function changepassword(Request $request)
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
            
            $validatedData = $request->validate([
                'oldpassword' => 'required',
                'newpassword' => 'required|min:8|max:15|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
                'confirmpassword' => 'required|min:8|max:15|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
                
            ]);
            
            
            $post_data['oldpassword']= $request->oldpassword;
            $post_data['newpassword']= $request->newpassword;
            $post_data['confirmpassword']= $request->confirmpassword;
            
            $data = ChangePassword::changepassword($post_data);
            
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
            
            
            
            
            
           /*  $date = date('Y-m-d H:i:s');
            $old_password=  $request->oldpassword;
            $old_password_encry=md5($old_password);
            $session_data= Session::get('userdata');
            $candidate_id = $session_data['candidate_id'];
            $user_data = ChangePassword::index();
            $old_pass= $user_data->password;
            
            if($old_pass==$old_password_encry)
            {
                $newpassword=$request->newpassword;
                $confirmpassword=$request->confirmpassword;
                
                if($newpassword==$confirmpassword)
                {
                    $user_id = $user_data->user_id;
                    $history_exist = DB::table('password_history')->where('user_id', $user_id)->get();
                    if(count($history_exist)<3)
                    {
                    
                          $postdata['password'] = md5($newpassword);
                          $a = DB::table('user_credential')->where('registeration_id', $candidate_id)->update($postdata);
                          $history_data['user_id'] = $user_data->user_id;
                          $history_data['password'] = md5($newpassword);
                          $history_data['created_on'] = $date;
                          $b = DB::table('password_history')->insert($history_data);
                          return back()
                          ->with('success',"Password has been changed Successfully");
                    }
                    else
                    {
                        
                        $postdata['password'] = md5($newpassword);
                        $a = DB::table('user_credential')->where('registeration_id', $candidate_id)->update($postdata);
                        $history_data['user_id'] = $user_data->user_id;
                        $history_data['password'] = md5($newpassword);
                        $history_data['created_on'] = $date;
                        $b = DB::table('password_history')->insert($history_data);
                        return back()
                        ->with('success',"Password has been changed Successfully");
                    }
                }
                else
                {
                    return back()
                    ->with('error',"New Password and Retype New Password Did not Match");
                }
            }
            else
            {
                return back()
                ->with('error',"Incorrect Previous Password");
                
            } */
        }
        
    }
    
    
    
    




