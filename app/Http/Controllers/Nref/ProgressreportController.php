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
							->where(['student_id' => $request->student_id,'institute_login_id' =>$request->inst_log_id,'report_type' =>$request->report_type])
							->get();
			$RecordsCount = $existRecords->count();
			if($RecordsCount>0) {
				if($request->hasFile('fileSign')) {
						$image = $request->file('fileSign');
						$fileSign = $user_id.'_'.$request->student_id.'_file_photo.'.$image->getClientOriginalExtension();
						$destinationPath = public_path('/../public/uploads/nref/progress_report');
						$imagePath = $destinationPath. "/".  $fileSign;
						$image->move($destinationPath, $fileSign);
						
						$filedata['report_file'] = $fileSign;
				}
					
				$updateQuery=DB::table('progress_report')
					->where(['student_id' => $request->student_id,'institute_login_id' =>$request->inst_log_id,'report_type' =>$request->report_type])
					->update($filedata);
				if($updateQuery)
				{
					return back()->with('message','Report Uploaded successfully!');
				}else{
					return back()->with('error','Report Not uploaded');
				}
			}else{
			    ////return back()->with('error','Attendace Not Available');
				
				
				$postdata['institute_login_id']=$request->inst_log_id;
				$postdata['student_id']=$request->student_id;
				$postdata['report_type']=$request->report_type;
				$postdata['institute_details_id']=$request->inst_id;
				
				
				if($request->hasFile('fileSign')) {
						$image = $request->file('fileSign');
						$fileSign = $user_id.'_'.$request->student_id.'_file_photo.'.$image->getClientOriginalExtension();
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
	
	public function acknowledgeAjax(Request $request)
	{
		$val1=$request->input('monthVal');
		$val2=$request->input('yearr');
		$institute_id =  Auth::id(); // Institute login id
        $students = DB::table('studentregistrations')->where('institute_id',$institute_id)->orderBy('id','desc')->get();
        $candidates = DB::table('candidate_attendence')->where('institute_id',$institute_id)->orderBy('attendence_id','desc')->get();

        $attendanceList = DB::table('studentregistrations')
            ->leftJoin('candidate_attendence', 'studentregistrations.id', '=', 'candidate_attendence.student_id')
			->where(['month_atten' =>$val1,'year_atten'=>$val2])
			->where('candidate_attendence.institute_id',$institute_id)
			->orderBy('attendence_id','asc')
            ->get();
		return view('backend.nref.progressReportAjax',compact('attendanceList','students','candidates','val1'));
	}


}
