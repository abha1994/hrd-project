<?php
namespace App;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth,Session;

class ChangePassword extends Model
{
    
    public static function changepassword($post_data)
    {
       
        $date = date('Y-m-d H:i:s');
        $old_password=  $post_data['oldpassword'];
        $old_password_encry=md5($old_password);
        $session_data= Session::get('userdata');
        
        $role_id= $session_data['role_id'];
        
        if($role_id=="4")
        {
        
        $candidate_id = $session_data['candidate_id'];
        $user_data = DB::table('user_credential')->where('registeration_id', $candidate_id)->get()->first();
        $old_pass= $user_data->password;
        
        if($old_pass==$old_password_encry)
        {
            $newpassword=$post_data['newpassword'];
            $newpasswordencry=md5($newpassword);
            $confirmpassword=$post_data['confirmpassword'];
            
            if($newpassword==$confirmpassword)
            {
                $user_id = $user_data->id;
                $history_exist = DB::table('password_history')->where('id', $user_id)->get();
                $pass_count = count($history_exist);
               
                    if($pass_count == 0){
                        
                        $password_his = DB::table('password_history')->where('id',$user_id)->get();
                       
                            $postdata['password'] = md5($newpassword);
                            $a = DB::table('user_credential')->where('registeration_id', $candidate_id)->update($postdata);
                            $history_data['id'] = $user_data->id;
                            $history_data['password'] = md5($newpassword);
                            $history_data['created_on'] = $date;
                            $b = DB::table('password_history')->insert($history_data);
                            $data['status'] = 1;
                            
                        
                       
                    }
                    else if($pass_count == 1){
                        $password_his = DB::table('password_history')->where('id',$user_id)->get();
                        
                        if($password_his[0]->password != $newpasswordencry ){
                            
                            $postdata['password'] = md5($newpassword);
                            $a = DB::table('user_credential')->where('registeration_id', $candidate_id)->update($postdata);
                            $history_data['id'] = $user_data->id;
                            $history_data['password'] = md5($newpassword);
                            $history_data['created_on'] = $date;
                            $b = DB::table('password_history')->insert($history_data);
                            $data['status'] = 1;
                    }
                    else{
                        $data['status'] = 5;
                    }
                    }
					else if($pass_count == 2){
                        $password_his = DB::table('password_history')->where('id',$user_id)->get();
                        
                        if($password_his[0]->password != $newpasswordencry and $password_his[1]->password != $newpasswordencry ){
                            
                            $postdata['password'] = md5($newpassword);
                            $a = DB::table('user_credential')->where('registeration_id', $candidate_id)->update($postdata);
                            $history_data['id'] = $user_data->id;
                            $history_data['password'] = md5($newpassword);
                            $history_data['created_on'] = $date;
                            $b = DB::table('password_history')->insert($history_data);
                            $data['status'] = 1;
                    }
                    else{
                        $data['status'] = 5;
                    }
                    }
                    else if($pass_count == 3){
                        $password_his = DB::table('password_history')->where('id',$user_id)->get();
                        if($password_his[0]->password != $newpasswordencry and $password_his[1]->password != $newpasswordencry and $password_his[2]->password != $newpasswordencry){
                            $oldest_date = DB::table('password_history')->where('id',$user_id)->orderBy('created_on','asc')->get()->first();
                            $c= DB::table('password_history')->where('id',$user_id)->where('created_on',$oldest_date->created_on)->delete();
                            $postdata['password'] = md5($newpassword);
                            $a = DB::table('user_credential')->where('registeration_id', $candidate_id)->update($postdata);
                            $history_data['id'] = $user_data->id;
                            $history_data['password'] = md5($newpassword);
                            $history_data['created_on'] = $date;
                            $b = DB::table('password_history')->insert($history_data);
                            $data['status'] = 2;
                           
                    }
                    else{
                        $data['status'] = 5;
                       
                    }
                }
                 
            }
            else
            {
                $data['status'] = 3;
            }
        }
        else
        {
            $data['status'] = 4;
        } 
        return $data;
    }
    
    else
    {
        $officer_id = $session_data['officer_id'];
        $user_data = DB::table('user_credential')->where('officer_id', $officer_id)->get()->first();
        $old_pass= $user_data->password;
        
        if($old_pass==$old_password_encry)
        {
            $newpassword=$post_data['newpassword'];
            $newpasswordencry=md5($newpassword);
            $confirmpassword=$post_data['confirmpassword'];
            
            if($newpassword==$confirmpassword)
            {
                $user_id = $user_data->id;
                $history_exist = DB::table('password_history')->where('id', $user_id)->get();
                $pass_count = count($history_exist);
                
                if($pass_count == 0){
                    
                    $password_his = DB::table('password_history')->where('id',$user_id)->get();
                    
                    $postdata['password'] = md5($newpassword);
                    $a = DB::table('user_credential')->where('officer_id', $officer_id)->update($postdata);
                    $history_data['id'] = $user_data->id;
                    $history_data['password'] = md5($newpassword);
                    $history_data['created_on'] = $date;
                    $b = DB::table('password_history')->insert($history_data);
                    $data['status'] = 1;
                    
                    
                    
                }
                else if($pass_count == 1){
                    $password_his = DB::table('password_history')->where('id',$user_id)->get();
                    
                    if($password_his[0]->password != $newpasswordencry ){
                        
                        $postdata['password'] = md5($newpassword);
                        $a = DB::table('user_credential')->where('officer_id', $officer_id)->update($postdata);
                        $history_data['id'] = $user_data->id;
                        $history_data['password'] = md5($newpassword);
                        $history_data['created_on'] = $date;
                        $b = DB::table('password_history')->insert($history_data);
                        $data['status'] = 1;
                    }
                    else{
                        $data['status'] = 5;
                    }
                }
                else if($pass_count == 2){
                    $password_his = DB::table('password_history')->where('id',$user_id)->get();
                    
                    if($password_his[0]->password != $newpasswordencry and $password_his[1]->password != $newpasswordencry ){
                        
                        $postdata['password'] = md5($newpassword);
                        $a = DB::table('user_credential')->where('officer_id', $officer_id)->update($postdata);
                        $history_data['id'] = $user_data->id;
                        $history_data['password'] = md5($newpassword);
                        $history_data['created_on'] = $date;
                        $b = DB::table('password_history')->insert($history_data);
                        $data['status'] = 1;
                    }
                    else{
                        $data['status'] = 5;
                    }
                }
                else if($pass_count == 3){
                    $password_his = DB::table('password_history')->where('id',$user_id)->get();
                    if($password_his[0]->password != $newpasswordencry and $password_his[1]->password != $newpasswordencry and $password_his[2]->password != $newpasswordencry){
                        $oldest_date = DB::table('password_history')->where('id',$user_id)->orderBy('created_on','asc')->get()->first();
                        $c= DB::table('password_history')->where('id',$user_id)->where('created_on',$oldest_date->created_on)->delete();
                        $postdata['password'] = md5($newpassword);
                        $a = DB::table('user_credential')->where('officer_id', $officer_id)->update($postdata);
                        $history_data['id'] = $user_data->id;
                        $history_data['password'] = md5($newpassword);
                        $history_data['created_on'] = $date;
                        $b = DB::table('password_history')->insert($history_data);
                        $data['status'] = 2;
                        
                    }
                    else{
                        $data['status'] = 5;
                        
                    }
                }
                
            }
            else
            {
                $data['status'] = 3;
            }
        }
        else
        {
            $data['status'] = 4;
        }
        return $data;
    }
    }
   
}
