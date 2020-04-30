<?php

namespace App;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use DB;
class Admin_link extends Model
{
   
   
    /**
     * Fetch all data of Link officer from database
     *
     * @index
     */
     public static function index(){
	   $data['link_tbl_data'] = DB::table('assign_link_officer')->get();
	   $data['officer_data'] = DB::table('user_credential')->whereNotIn('role',['6','null'])->where('status','1')->get();
	   // dd($data['officer_data']);
	   $data['link_officer_data'] = DB::table('user_credential')->where('role','6')->where('status','1')->get();
       return $data;
     }
	 
	 
	/**
     * Post add form Link officer into database
     *
     * @add
     */ 
	 public static function add($postdata){
	    $transactionResult = DB::transaction(function() use ($postdata) {
			
			date_default_timezone_set('Asia/Kolkata');
		    $date = date('Y-m-d H:i:s');
			
			 $userData = array('name'=>$request->officer_name,'designation'=>$request->designation,'email'=>$request->email,'username'=>$username,'password'=>$password,'mobile'=>$request->mobile_no,'status'=> $request->status,'dob'=>$dob,'joining_date'=>$joining_date,'transfer_date'=>$transfer_date,'user_type'=>'officer','role'=>$request->roles);
			 
			 
			$officer_id = $postdata['officer_id'];
			$link_officer_id = $postdata['link_officer_id'];
		    $sql = DB::table('user_credential')->select('role','privilage_id')->where('officer_id',$officer_id)->get()->first();
			$update_info['role'] =  $sql->role;
			$update_info['privilage_id'] =  $sql->privilage_id;
			DB::table('user_credential')->where('officer_id',$link_officer_id)->update($update_info);
			DB::table('assign_link_officer')->insert($postdata);
            $result['status'] = '1';
			return $result; 			
		});
		return $transactionResult;
	}
	
	/**
     * Fetch Link officer data by officer id.
     *
     * @edit
     */
	 
	 public static function edit($id){
	   $data['link_tbl_data'] = DB::table('assign_link_officer')->where('assign_link_officer_id',$id)->get()->first();
	   $data['officer_data'] = DB::table('admin_user')->whereNotIn('role_id',[0,4,5])->where('status','1')->orderBy('officer_id','desc')->get();
	   $data['link_officer_data'] = DB::table('admin_user')->where('role_id','5')->where('status','1')->orderBy('officer_id','desc')->get();
	   return $data;
	 }
	 
	
     /**
     * Update link officer details i to databse
     *
     * @update_link
     */
	  
	   
	 public static function update_link($postdata,$id){
	     $transactionResult = DB::transaction(function() use ($postdata,$id) {
			date_default_timezone_set('Asia/Kolkata');
		    $date = date('Y-m-d H:i:s');
		
		    if(!empty($id)){
				$officer_id = $postdata['officer_id'];
				$link_officer_id = $postdata['link_officer_id'];
				$sql = DB::table('user_credential')->select('role','privilage_id')->where('officer_id',$officer_id)->get()->first();
				$update_info['role'] =  $sql->role;
				$update_info['privilage_id'] =  $sql->privilage_id;
				DB::table('user_credential')->where('officer_id',$link_officer_id)->update($update_info);
				DB::table('assign_link_officer')->where('assign_link_officer_id',$id)->update($postdata);
				
				$result['status'] = '1';
			}
		    return $result;
		});
		return $transactionResult;
	 }
	  
	  
	  
	  
	  
	  
	  
	  
	  
}

