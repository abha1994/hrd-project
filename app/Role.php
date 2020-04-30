<?php

namespace App;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use DB;
class Role extends Model
{
   
    /**
     * Fetch all data of role from database
     *
     * @index
     */
    public static function index(){
	   $data['role_data'] = DB::table('role')->orderBy('role_id','asc')->get();
       return $data;
    }
	 
	/**
     * Post add form data into database
     *
     * @add
     */
   
    public static function add($postdata){
	    $transactionResult = DB::transaction(function() use ($postdata) {
			DB::table('role')->insert($postdata); // Officer data insert into table
			$result['status'] = '1';
			return $result;
		});
		return $transactionResult;
	}
	
	 /**
     * Fetch role data by role id.
     *
     * @edit
     */
	 
	public static function edit($id){
	   $data['role_data'] = DB::table('role')->where('role_id',$id)->orderBy('role_id','asc')->get()->first();
	   return $data;
	}
	 
	/**
     * Update Role Data into database  by id
     *
     * @update_role
     */
	 
	 public static function update_role($postdata,$id){
	    $transactionResult = DB::transaction(function() use ($postdata,$id) {
			date_default_timezone_set('Asia/Kolkata');
		    $date = date('Y-m-d H:i:s');
		
		    if(!empty($id)){
				DB::table('role')->where('role_id',$id)->update($postdata);
				$result['status'] = '1';
			}
		    return $result;
		});
		return $transactionResult;
	 }
	 
	  /**
     *Delete role data from database using role id
     *
     * @delete_data
     */
	 
	  public static function delete_data($id){
		$transactionResult = DB::transaction(function() use ($id) {
		if(!empty($id)){
			$id_in_use = DB::table('admin_user')->where('role_id',$id)->get();
			$wordCount = count($id_in_use);
			if($wordCount > 0){
			   $data['status'] = "2"; //role used somewhere;	
			}else{
				DB::table('role')->where('role_id',$id)->delete();
			   $data['status'] = "1"; //data deleted successfully;
			}
		}else{
			$data['status'] = "0"; //Id does not exists;
		}
	   return $data;
	   });
	   return $transactionResult;
	 }
	 
	
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
}

