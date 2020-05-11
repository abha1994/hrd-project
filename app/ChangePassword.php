<?php
namespace App;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth,Session;
use Illuminate\Support\Facades\Hash;

class ChangePassword extends Model
{
    
    public static function changepassword($post_data,$login_user_data)
    {
       
        $date = date('Y-m-d H:i:s');
        $old_password=  $post_data['oldpassword'];
		
        $candidate_id =$login_user_data->id;
      
        $user_data = DB::table('user_credential')->where('id', $candidate_id)->get()->first();
        $old_pass= $user_data->password;
		// dd($old_pass);
		
		if (Hash::check($old_password, $old_pass)) {
       
	 
            $newpassword=$post_data['newpassword'];
            $newpasswordencry=Hash::make($newpassword);
            $confirmpassword=$post_data['confirmpassword'];
            
            if($newpassword==$confirmpassword)
            {
				 
                $user_id = $user_data->id;
                $history_exist = DB::table('password_history')->where('id', $user_id)->get();
				
                $pass_count = count($history_exist);
               
                    if($pass_count == 0){
                        
                        $password_his = DB::table('password_history')->where('id',$user_id)->get();
                       
                            $postdata['password'] = $newpasswordencry;
							$abc = $postdata['password'];
                            $a = DB::table('user_credential')->where('id', $candidate_id)->update($postdata);
                            $history_data['id'] = $user_data->id;
                            $history_data['password'] = $newpasswordencry;
                            $history_data['created_on'] = $date;
                            $b = DB::table('password_history')->insert($history_data);
                            $data['status'] = 1;
                            
                        
                       
                    }
                    else if($pass_count == 1){
                        $password_his = DB::table('password_history')->where('id',$user_id)->get();
                       
                        if(Hash::check($newpassword,$password_his[0]->password )){
                             $data['status'] = 5;
                          
                    }
                    else{
                          $postdata['password'] = $newpasswordencry;
                            $a = DB::table('user_credential')->where('id', $candidate_id)->update($postdata);
                            $history_data['id'] = $user_data->id;
                            $history_data['password'] = $newpasswordencry;
                            $history_data['created_on'] = $date;
                            $b = DB::table('password_history')->insert($history_data);
                            $data['status'] = 1;
                    }
                    }
					else if($pass_count == 2){
                        $password_his = DB::table('password_history')->where('id',$user_id)->get();
                        
                        if(Hash::check($newpassword,$password_his[0]->password ) || Hash::check($newpassword,$password_his[1]->password ) ){
                            $data['status'] = 5;
                           
                    }
                    else{
                        $postdata['password'] = $newpasswordencry;
                            $a = DB::table('user_credential')->where('id', $candidate_id)->update($postdata);
                            $history_data['id'] = $user_data->id;
                            $history_data['password'] = $newpasswordencry;
                            $history_data['created_on'] = $date;
                            $b = DB::table('password_history')->insert($history_data);
                            $data['status'] = 1;
                    }
                    }
                    else if($pass_count == 3){
                        $password_his = DB::table('password_history')->where('id',$user_id)->get();
                        if(Hash::check($newpassword,$password_his[0]->password ) || Hash::check($newpassword,$password_his[1]->password ) || Hash::check($newpassword,$password_his[2]->password )){
                           $data['status'] = 5;
                           
                    }
                    else{
                        $oldest_date = DB::table('password_history')->where('id',$user_id)->orderBy('created_on','asc')->get()->first();
                            $c= DB::table('password_history')->where('id',$user_id)->where('created_on',$oldest_date->created_on)->delete();
                            $postdata['password'] = $newpasswordencry;
                            $a = DB::table('user_credential')->where('id', $candidate_id)->update($postdata);
                            $history_data['id'] = $user_data->id;
                            $history_data['password'] = $newpasswordencry;
                            $history_data['created_on'] = $date;
                            $b = DB::table('password_history')->insert($history_data);
                            $data['status'] = 2;
                       
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
