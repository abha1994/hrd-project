<?php

namespace App\Nref;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use DB,Session;

class Institute extends Model
{
   
     public static function index(){
		$candidate_id = Auth::user()->id;
		$registeration_id = DB::table('user_credential')->where('id',$candidate_id)->get()->first();
		$data['loginuser_data'] = DB::table('registration')->where('candidate_id',$registeration_id->registeration_id)->get()->first();
		$data['institute_details_data'] = DB::table('institute_details')->where('user_id',$candidate_id)->get()->first();
		$data['type_institute'] = DB::table('institute_type')->orderBy('institute_type_id','asc')->get();
	    $data['category_data'] = DB::table('category')->orderBy('category_id','asc')->get();
	    $data['country_data'] = DB::table('country')->orderBy('name','asc')->get();
	    $data['state_data'] = DB::table('state_master')->orderBy('state_name','asc')->get();
	    $data['district_data'] = DB::table('district_master')->orderBy('district_name','asc')->get();
		$data['courses_data'] = DB::table('courses')->orderBy('course_name','asc')->get();
       return $data;
     }
	 

 
}
