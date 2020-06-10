<?php

namespace App\Http\Controllers\shortterm\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DateTime,Session;
use App\User;
use Validator,Redirect;
use DB;
use Response;
use Auth;
use App\Http\Requests\Form_validation;
class courseUploadController extends Controller
{
    function __construct()
    {
         

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
			try{
		  
			//**********Save Data into audtitrail_tbl************//
			$audtitrail_tbl_post = array('status'=>'0','scheme_code'=>'4','action_type1'=>'5','desc'=>'Show Short Term course upload report');
			//audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************//
		
		$short_term_data= DB::table('short_term_program')->get();
$shortTerm = DB::table('short_term_program')
			->leftJoin('user_credential','short_term_program.user_id','=','user_credential.id')
			->leftJoin('registration','user_credential.registeration_id','=','registration.candidate_id')
			->select('short_term_program.user_id','name_proposed_training_program','registration.institute_name')
			->groupby('short_term_program.user_id')
             ->get();

		
		 return view('backend.shortterm.Admin.course_content.create',compact('short_term_data','shortTerm'));
		  }catch(\Exception $ex) {
			//**********Save Data into audtitrail_tbl************//
			$audtitrail_tbl_post = array('status'=>'1','scheme_code'=>'4','action_type1'=>'5','desc'=>'Show Short Term course upload reports not working');
			//audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************//
			return redirect('error');
	    }
	}
	
	public function coursecontentfilter(Request $request)
	{
		
		try{
		  
		  
			//**********Save Data into audtitrail_tbl************//
			$audtitrail_tbl_post = array('status'=>'0','scheme_code'=>'4','action_type1'=>'5','desc'=>'Show Short Term course upload report');
			//audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************//
	  
        $val2=$request->input('v1');
		
		if($val2!=""){
			$short_term_data= DB::table('short_term_program')->where('user_id',$val2)->get();
		  return view('backend.shortterm.Admin.course_content.coursecontent_filter',compact('short_term_data'));
		}
		 }catch(\Exception $ex) {
			//**********Save Data into audtitrail_tbl************//
			$audtitrail_tbl_post = array('status'=>'1','scheme_code'=>'4','action_type1'=>'5','desc'=>'Show Short Term course upload reports not working');
			//audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************//
			return redirect('error');
	    }
	}



  


	
}
