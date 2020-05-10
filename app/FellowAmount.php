<?php

namespace App;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use DB;
class FellowAmount extends Model
{
    
    /**
     * Fetch all data of role from database
     *
     * @index
     */
    public static function index(){
	   $data['fellowamount_data'] = DB::table('fellow_amount')->join('courses', 'courses.course_id', '=', 'fellow_amount.course_id')->orderBy('fellow_amount_id','asc')->get();
	   $data['courses_data'] = DB::table('courses')->where('display','1')->orderBy('course_id','asc')->get();
	   $y1="2019-2020";
	   $y2="2020-2021";
	   $y3="2021-2022";
	   
       return $data;
    }

	 /**
     * Post add form data into database
     *
     * @add
     */
   
    public static function add($postdata){
	    $transactionResult = DB::transaction(function() use ($postdata) {
			DB::table('fellow_amount')->insert($postdata); // fellow amount data insert into table
			$result['status'] = '1';
			return $result;
		});
		return $transactionResult;
	}
	
	
	 /**
     * Fetch Fellow Amount data by role id.
     *
     * @edit
     */
	 
	public static function edit($id){
	   $data['fellow_amount_data'] = DB::table('fellow_amount')->where('fellow_amount_id',$id)->join('courses', 'courses.course_id', '=', 'fellow_amount.course_id')->orderBy('fellow_amount_id','asc')->get()->first();
	  // dd($data['fellow_amount_data']);
	   return $data;
	}
	
	/**
     * Update Fellow Amount Data into database  by id
     *
     * @update_role
     */
	 
	 public static function update_fellowamount($postdata,$id){
	    $transactionResult = DB::transaction(function() use ($postdata,$id) {
			date_default_timezone_set('Asia/Kolkata');
		    $date = date('Y-m-d H:i:s');
		
		    if(!empty($id)){
				DB::table('fellow_amount')->where('fellow_amount_id',$id)->update($postdata);
				$result['status'] = '1';
			}
		    return $result;
		});
		return $transactionResult;
	 }
	 
	
	/**
     *Delete Fellow Amount data from database using role id
     *
     * @delete_data
     */
	 
	  public static function delete_data($id){
		$transactionResult = DB::transaction(function() use ($id) {
		if(!empty($id)){
			
				DB::table('fellow_amount')->where('fellow_amount_id',$id)->delete();
			   $data['status'] = "1"; //data deleted successfully;
			
		}else{
			$data['status'] = "0"; //Id does not exists;
		}
	   return $data;
	   });
	   return $transactionResult;
	 }
	 
	 
	  
}

