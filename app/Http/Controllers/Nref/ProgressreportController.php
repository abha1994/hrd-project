<?php

namespace App\Http\Controllers\Nref;

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
        $curMonth=date("n"); 
		$currentYear= date("Y");
		$institute_id =  Auth::id(); // Institute login id
        $candidates = DB::table('candidate_attendence')->where('institute_id',$institute_id)->orderBy('attendence_id','desc')->get();
		
		$reports = DB::table('progress_report')->where('institute_login_id',$institute_id)->orderBy('id','desc')->get();
		
		$institute_detailID = DB::table('candidate_attendence')->where('user_id',$institute_id)->first();
		
		$students = DB::table('studentregistrations')
			->where('user_id',$institute_id)
			->orderBy('id','desc')
            ->get();
		return view('backend.nref.progressReport',compact('students','candidates','reports','institute_detailID'));
    }

    public function report_progress_post(Request $request)
    {
		$this->validate($request,[
     		'fileSign' => 'required',
		]); 
        $records = $request->all();
		    $transactionResult = DB::transaction(function() use ($request) {
			$user_id =  Auth::id();
			$existRecords = DB::table('progress_report')
							->where(['student_id' => $request->student_id,'institute_login_id' =>$request->inst_log_id,'report_type' =>$request->report_type,'report_month' =>$request->report_month,'report_year' =>$request->report_year])
							->get();
			$RecordsCount = $existRecords->count();
			if($RecordsCount>0) {
				if($request->hasFile('fileSign')) {
						$image = $request->file('fileSign');
						$fileSign = $user_id.'_'.$request->student_id.'_file_photo.'.$image->getClientOriginalName();
						$destinationPath = public_path('/../public/uploads/nref/progress_report');
						$imagePath = $destinationPath. "/".  $fileSign;
						$image->move($destinationPath, $fileSign);
						
						$filedata['report_file'] = $fileSign;
				}
					
				$updateQuery=DB::table('progress_report')
					->where(['student_id' => $request->student_id,'institute_login_id' =>$request->inst_log_id,'report_type' =>$request->report_type,'report_month' =>$request->report_month,'report_year' =>$request->report_year])
					->update($filedata);
				if($updateQuery)
				{
					
					//echo "=="; die;
					return back()->with('message','Report Uploaded successfully!');
				}else{
					
					//echo "==--"; die;
					return back()->with('message','Report uploaded');
				}
				
				//echo "---=="; die;
			}else{
			    ////return back()->with('error','Attendace Not Available');
				
				
				$postdata['institute_login_id']=$request->inst_log_id;
				$postdata['student_id']=$request->student_id;
				$postdata['report_type']=$request->report_type;
				$postdata['report_month']=$request->report_month;
				$postdata['report_year']=$request->report_year;
				$postdata['institute_details_id']=$request->inst_id;
				
				
				if($request->hasFile('fileSign')) {
						$image = $request->file('fileSign');
						$fileSign = $user_id.'_'.$request->student_id.'_file_photo.'.$image->getClientOriginalName();
						$destinationPath = public_path('/../public/uploads/nref/progress_report');
						$imagePath = $destinationPath. "/".  $fileSign;
						$image->move($destinationPath, $fileSign);
						
						$postdata['report_file'] = $fileSign;
				}
				
				DB::table('progress_report')->insert($postdata);
				return back()->with('message','Report Uploaded successfully!');
		    }
	    });
		return $transactionResult;
	}
	
	public function pdfdown(Request $request)
    {
		// $all_data =  Session::get('userdata');
		// $user_id = $all_data['candidate_id'];
		$user_id =  Auth::id(); // Institute login id
		$registeration_id = DB::table('user_credential')->select('registeration_id')->where('id',$user_id)->get()->first();
		
		$loginuser = DB::table('registration')->where('candidate_id',$registeration_id->registeration_id)->get()->first();
		view()->share('logindetails',$loginuser);
		
		$type_institute = DB::table('institute_type')->orderBy('institute_type_id','asc')->get();
		view()->share('type_institute',$type_institute);
		
		$items = DB::table('institute_details')->where('user_id', $user_id)->get();
	    view()->share('items',$items);

        if($request->has('download')){
            $pdf = PDF::loadview('backend/Nref/Admin/nref/pdfdown');
            return $pdf->download('pdfdown.pdf');
        }
        return view('backend/Nref/Admin/nref/pdfdown');
    }
	
	public function getReportAjax(Request $request)
	{
		$std=$request->input('std');
		$reportType=$request->input('reportType');
		$reportMonth=$request->input('reportMonth');
		$reportYear=$request->input('reportYear');
		if($reportMonth!="")
		{
			$mnth=$reportMonth;
		}
		else{
			$mnth=null;
		}

 $report_file = DB::table('progress_report')->select('report_file')
// ->where('student_id',$std)

->where(['student_id' => $std,'report_type' =>$reportType,'report_month' =>$mnth,'report_year' =>$reportYear])
->get()->first();

//echo "<pre>"; print_r($report_file); die;
 
 if(isset($report_file->report_file))
 {
      return $report_file->report_file;
 }
 else{
	 return 0;
 }
	 
 
	}
	
	
	
	// Get Report AJax For Main Filter
	
	
	public function getReportAjaxnew(Request $request)
	{
		
		$val1=$request->input('reportType');
		$val2=$request->input('reportYear');
		$val3=$request->input('reportMonth');
		
		if($val3!="")
		{
			$mnths=$val3;
		}
		else{
			$mnths=null;
		}

		
		
        $attendanceList = DB::table('progress_report')
            ->leftJoin('studentregistrations', 'progress_report.student_id', '=', 'studentregistrations.id')
			->where(['report_type' =>$val1,'report_year'=>$val2,'report_month' =>$mnths,])
			->orderBy('student_id','desc')
            ->get();
			
			//echo "<pre>"; print_r($attendanceList); die;
		return view('backend.nref.reportAjax',compact('attendanceList'));
	 
 
	}


}
