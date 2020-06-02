<?php

namespace App\Http\Controllers\Nref\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Nref\studentRegistrationModel;
use Session;
use DB;
use Auth;
use PDF;
use Validator,Redirect;

class AcknowledgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $curMonth=date("n"); 
		$currentYear= date("Y");
		$institute_id =  Auth::id(); // Institute login id
       $candidates = DB::table('candidate_attendence')->where('scheme_code',3)->orderBy('attendence_id','desc')->get();
		
		$instituteDetails = DB::table('institute_details')
            ->leftJoin('user_credential', 'institute_details.user_id', '=', 'user_credential.id')
			->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
			->select('institute_details.institute_id','registration.institute_name')
			->where(['status_id' =>3])
			->orderBy('registration.institute_name','asc')
            ->get();
		 
		
		// dd($candidates);
		$students = DB::table('studentregistrations')
            ->leftJoin('candidate_attendence', 'studentregistrations.id', '=', 'candidate_attendence.student_id')
			->where(['month_atten' =>$curMonth,'year_atten'=>$currentYear])
			//->where('candidate_attendence.user_id',$institute_id)
			->orderBy('attendence_id','asc')
            ->get();
		return view('backend/nref/Admin.admin_acknowledge.acknowledge',compact('students','candidates','instituteDetails'));
    }

	
	public function acknowledgeAjaxAdmin(Request $request)
	{
		
		$valinst=$request->input('instVal');
		$val1=$request->input('monthVal');
		$val2=$request->input('yearr');
		$institute_id =  Auth::id(); // Institute login id
        $students = DB::table('studentregistrations')->where('institute_id',$institute_id)->orderBy('id','desc')->get();
        $candidates = DB::table('candidate_attendence')->where('institute_id',$institute_id)->orderBy('attendence_id','desc')->get();
		
		$instituteDetails = DB::table('institute_details')
            ->leftJoin('user_credential', 'institute_details.user_id', '=', 'user_credential.id')
			->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
			->select('institute_details.institute_id','registration.institute_name')
			->where(['status_id' =>3])
			->orderBy('registration.institute_name','asc')
            ->get();

        //$attendanceList 
		
		$query= DB::table('studentregistrations')
            ->leftJoin('candidate_attendence', 'studentregistrations.id', '=', 'candidate_attendence.student_id')
			->select('studentregistrations.*','candidate_attendence.*');
			if($valinst!="")
			{
				$query = $query->where('candidate_attendence.institute_id',$valinst);
			}
			
			if($val1!="")
			{
				$query = $query->where('candidate_attendence.month_atten',$val1);
			}
			
			if($val2!="")
			{
				$query = $query->where('candidate_attendence.year_atten',$val2);
			}
			
			$query = $query->orderBy('attendence_id','asc');
			
			$attendanceList = $query->get();
			
			//->where(['candidate_attendence.institute_id'=>$valinst,'month_atten' =>$val1,'year_atten'=>$val2])
			//->orderBy('attendence_id','asc')
           // ->get();
		return view('backend/nref/Admin.admin_acknowledge.acknowledgeAjax',compact('attendanceList','students','candidates','val1','instituteDetails'));
	}


}
