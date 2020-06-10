<?php

namespace App\Http\Controllers\shortterm\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Nref\studentRegistrationModel;
use Session;
use DB;
use Auth;
use PDF;
use Validator,Redirect;

class ShortTermAcknowledgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

		$institute_id =  Auth::id(); // Institute login id
        $candidates = DB::table('candidate_attendence')->where('scheme_code',4)->orderBy('attendence_id','desc')->get();
		
		$instituteDetails = DB::table('short_term_program')
            ->leftJoin('user_credential', 'short_term_program.user_id', '=', 'user_credential.id')
			->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
			->select('short_term_program.user_id','registration.institute_name')
			->where(['status_id' =>3])
			->orderBy('registration.institute_name','asc')
            ->get();
		 
		
		// dd($candidates);
		$students = DB::table('studentregistrations')
            ->leftJoin('candidate_attendence', 'studentregistrations.id', '=', 'candidate_attendence.student_id')
			->where(['candidate_attendence.scheme_code' =>4])
			->orderBy('attendence_id','asc')
            ->get();
			
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
			
		return view('backend/shortterm/Admin.admin_acknowledge.acknowledgeShortadmin',compact('students','candidates','instituteDetails','shortTerm'));
    }

	
	public function acknowledgeAjaxAdmin(Request $request)
	{
		
		$shortermname=$request->input('shortermname');
		$programnew=$request->input('programnew');

		$institute_id =  Auth::id(); // Institute login id
		
		$instituteDetails = DB::table('short_term_program')
            ->leftJoin('user_credential', 'short_term_program.user_id', '=', 'user_credential.id')
			->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
			->select('short_term_program.user_id','registration.institute_name')
			->where(['status_id' =>3])
			->orderBy('registration.institute_name','asc')
            ->get();

        //$attendanceList 
		
		$query= DB::table('studentregistrations')
            ->leftJoin('candidate_attendence', 'studentregistrations.id', '=', 'candidate_attendence.student_id')
			->select('studentregistrations.*','candidate_attendence.*');
			if($shortermname!="")
			{
				$query = $query->where('candidate_attendence.user_id',$shortermname);
			}
			
			if($programnew!="")
			{
				$query = $query->where('candidate_attendence.course_type',$programnew);
			}

			$query = $query->where('candidate_attendence.scheme_code',4);
			$query = $query->orderBy('attendence_id','asc');
			
			$attendanceList = $query->get();
			

		return view('backend/shortterm/Admin.admin_acknowledge.acknowledgeshortadminAjax',compact('attendanceList','instituteDetails'));
	}


}
