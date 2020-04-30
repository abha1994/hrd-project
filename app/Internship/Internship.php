<?php

namespace App\Internship;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use DB,Session;

class Internship extends Model
{
   
     public static function index(){
	
	    $candidate_id = Auth::user()->id;
		$registeration_id = DB::table('user_credential')->where('id',$candidate_id)->get()->first();
		
		$data['internship_data']= DB::table('internship_tbl')->where('user_id',$candidate_id)->get()->first();
		if(!empty($data['internship_data'])){
	       $data['intern_course_details']= DB::table('intern_course_details')->where('candidate_id',$data['internship_data']->candidate_id)->get();
		}
	    $data['loginuser_data'] = DB::table('registration')->where('candidate_id',$registeration_id->registeration_id)->get()->first();
	    $data['category_data'] = DB::table('category')->orderBy('category_id','asc')->get();
	    $data['country_data'] = DB::table('country')->orderBy('name','asc')->get();
	    $data['state_data'] = DB::table('state_master')->orderBy('state_name','asc')->get();
	    $data['district_data'] = DB::table('district_master')->orderBy('district_name','asc')->get();
		$data['courses_data'] = DB::table('courses')->orderBy('course_name','asc')->get();
       return $data;
     }
	 

 
}
