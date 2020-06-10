<?php

namespace App\Http\Controllers\shortterm\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Nref\studentRegistrationModel;
use Session;
use DB;
use Auth;
use PDF;
use Validator,Redirect;

class AttandanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
		/* $shortTerm = DB::table('short_term_program')
			->select('short_term_id','name_proposed_training_program','coordinator_name')
			->orderBy('coordinator_name','asc')
            ->get(); */
			
			$shortTerm = DB::table('short_term_program')
			->leftJoin('user_credential','short_term_program.user_id','=','user_credential.id')
			->leftJoin('registration','user_credential.registeration_id','=','registration.candidate_id')
			->select('short_term_program.user_id','name_proposed_training_program','registration.institute_name')
			->groupby('short_term_program.user_id')
             ->get();
		
		return view('backend.shortterm.Admin.attandanceShortterm',compact('shortTerm'));
    }
	
	
	public function getProgramAjax(Request $request)
	{
		$termVal = $request->input('termVal');
		
		if($termVal!="")
		{
		
		$query = DB::table('short_term_program')
		->select('name_proposed_training_program')->where('user_id',$termVal)->get();
		$data[]="<option value=''>Select Program</option>";
		for($i=0;$i<count($query);$i++)
		{
			$arr=explode(',',$query[$i]->name_proposed_training_program);
			
	foreach($arr as $arrname)
	{
		$data[]="<option value='".$arrname."'>".$arrname."</option>";
	}
			
			
		}
		
		}
		else{
			$data[]="<option value=''>Select Program</option>";
		}
		
		return $data;
	}

	
	/* public function getProgramAjax(Request $request)
	{
		$termVal = $request->input('termVal');
		if($termVal!="")
		{
		    $query = DB::table('short_term_program')
		            ->select('name_proposed_training_program')->where('short_term_id',$termVal)->get()->first();
            if(isset($query->name_proposed_training_program))
            {
	            $arr=explode(',',$query->name_proposed_training_program);
	            $data[]="<option value=''>Select Program</option>";
				foreach($arr as $arrname)
				{
					$data[]="<option value='".$arrname."'>".$arrname."</option>";
				}
            }
		}
		else{
			$data[]="<option value=''>Select Program</option>";
		}
		return $data;
	} */


	
	
	public function getattandanceTerm(Request $request)
	{

		$val1=$request->input('programnew');
		$val2=$request->input('shortermname');
		
		$query = DB::table('candidate_attendence')
            ->leftJoin('studentregistrations', 'candidate_attendence.student_id', '=', 'studentregistrations.id');
			//->where(['report_type' =>$val1,'report_year'=>$val2,'report_month' =>$mnths,])
			
            if($val1!=""){
			$query = $query->where('course_type',$val1);
			}
			
			if($val2!=""){
			$query = $query->where('candidate_attendence.user_id',$val2);
			}
			$query = $query->where('candidate_attendence.scheme_code',4);
			$attendanceList = $query->orderBy('student_id','desc')->get();
		    return view('backend/shortterm/Admin.attandanceAjax',compact('attendanceList'));
	}


}
