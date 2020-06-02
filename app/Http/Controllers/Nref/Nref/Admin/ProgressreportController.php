<?php

namespace App\Http\Controllers\Nref\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Nref\studentRegistrationModel;
use Session;
use DB;
use Auth;
use PDF;
use Validator,Redirect;

class ProgressreportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$institute_id =  Auth::id(); // Institute login id
		
		$instituteDetails = DB::table('institute_details')
            ->leftJoin('user_credential', 'institute_details.user_id', '=', 'user_credential.id')
			->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
			->select('institute_details.institute_id','registration.institute_name')
			->where(['status_id' =>3])
			->orderBy('registration.institute_name','asc')
            ->get();
		
		return view('backend/nref/Admin.admin_progressReport.progressReport',compact('instituteDetails'));
    }


	// Get Report AJax For Main Filter
	
	
	public function getReportAdminAjaxnew(Request $request)
	{
		$inst = $request->input('inst');
		$val1=$request->input('reportType');
		$val2=$request->input('reportYear');
		$val3=$request->input('reportMonth');
		
		/* if($val3!="")
		{
			$mnths=$val3;
		}
		else{
			$mnths=null;
		} */

		
		
		$query = DB::table('progress_report')
            ->leftJoin('studentregistrations', 'progress_report.student_id', '=', 'studentregistrations.id');
			//->where(['report_type' =>$val1,'report_year'=>$val2,'report_month' =>$mnths,])
			
			if($inst!=""){
			$query = $query->where('institute_details_id',$inst);
			}
			
			if($val1!=""){
			$query = $query->where('report_type',$val1);
			}
			
			if($val2!=""){
			$query = $query->where('report_year',$val2);
			}
			
			if($val3!=""){
			$query = $query->where('report_month',$val3);
			}
			
			$attendanceList = $query->orderBy('student_id','desc')->get();
			
			
		
        /* $attendanceList = DB::table('progress_report')
            ->leftJoin('studentregistrations', 'progress_report.student_id', '=', 'studentregistrations.id')
			->where(['report_type' =>$val1,'report_year'=>$val2,'report_month' =>$mnths,])
			->orderBy('student_id','desc')
            ->get(); */
		return view('backend/nref/Admin.admin_progressReport.reportAjax',compact('attendanceList'));
	 
 
	}


}
