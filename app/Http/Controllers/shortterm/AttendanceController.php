<?php

namespace App\Http\Controllers\shortterm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;
use Auth;
use PDF;
use Validator,Redirect;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$institute_id =  Auth::id(); // Institute login id

        $candidates = DB::table('candidate_attendence')->where(['user_id' =>$institute_id,'scheme_code'=>4])->orderBy('attendence_id','desc')->get();
		
		
		$short_term_program = DB::table('short_term_program')
		->select('short_term_id','scheme_code','name_proposed_training_program')
		->where('user_id',$institute_id)->first();
		
		$students = DB::table('studentregistrations')
			->where('user_id',$institute_id)
			->orderBy('id','desc')
            ->get();
		return view('backend.shortterm.shortTermAttandance',compact('students','candidates','short_term_program'));
    }

    public function attendance_shortterm_post(Request $request)
    {
		$this->validate($request,[
     		'short_term_attandance' => 'required|mimes:pdf',
		]); 
        $records = $request->all();
		
		//dd($request);
		    $transactionResult = DB::transaction(function() use ($request) {
			$user_id =  Auth::id();
			$existRecords = DB::table('candidate_attendence')
							->where(['institute_id' => $request->inst_id,'student_id' => $request->student_id,'user_id' =>$request->inst_log_id,'course_type' =>$request->report_type,'scheme_code' =>$request->scheme_code])
							->get();
			$RecordsCount = $existRecords->count();
			
			//echo $RecordsCount; die;
			if($RecordsCount>0) {
					return back()->with('message','Attendace ALready Exists!');

			}else{

				$postdata['user_id']=$request->inst_log_id;
				$postdata['student_id']=$request->student_id;
				$postdata['course_type']=$request->report_type;
				$postdata['scheme_code']=$request->scheme_code;
				$postdata['institute_id']=$request->inst_id;
				$postdata['shortTerm_frmdate']=date('Y-m-d',strtotime($request->frmDate));
				$postdata['shortTerm_todate']=date('Y-m-d',strtotime($request->toDate));
				
				
				if($request->hasFile('short_term_attandance')) {
						$image = $request->file('short_term_attandance');
						$short_term_attandance = $user_id.'_'.$request->student_id.'_attandance_shortTerm.'.$image->getClientOriginalName();
						$destinationPath = public_path('/../public/uploads/shortterm/attadance');
						$imagePath = $destinationPath. "/".  $short_term_attandance;
						$image->move($destinationPath, $short_term_attandance);
						
						$postdata['short_term_attandance'] = $short_term_attandance;
				}
				
				DB::table('candidate_attendence')->insert($postdata);
				return back()->with('message','Short Term Attendace Uploaded successfully!');
		    }
	    });
		return $transactionResult;
	}

	
	public function getAttandanceAjax(Request $request)
	{
		$std=$request->input('std');
		$course_type=$request->input('course_type');

 $short_term_attandance = DB::table('candidate_attendence')->select('short_term_attandance')

->where(['student_id' => $std,'course_type' =>$course_type])
->get()->first();

 
 if(isset($short_term_attandance->short_term_attandance))
 {
      return $short_term_attandance->short_term_attandance;
 }
 else{
	 return 0;
 }
	 
 
	}
	
	
	
	// Get Report AJax For Main Filter
	
	
	public function getAttandanceAjaxnew(Request $request)
	{
		
		$val1=$request->input('reportType');
		
		  $startDate = $request->input('frmdate');
	      $enddate = $request->input('todate');
		  
		  $a = date("Y-m-d",strtotime($startDate));
	      $b = date("Y-m-d",strtotime($enddate));
		  
		  //echo $startDate; die;
	
		
        $query = DB::table('candidate_attendence')
            ->leftJoin('studentregistrations', 'candidate_attendence.student_id', '=', 'studentregistrations.id');
			
			if($val1!=""){
			$query=$query->where('course_type',$val1);
			}
			
			if($startDate !="")
			{
			$query= $query->where('candidate_attendence.shortTerm_frmdate','>=',$a);
			}

			if($enddate !="")
			{
			$query= $query->where('candidate_attendence.shortTerm_todate','<=',$b);
			} 
			
			$query=$query->where('candidate_attendence.scheme_code',4);
			
			$attendanceList = $query->orderBy('student_id','desc')->get();
			
            
			
			//echo "<pre>"; print_r($attendanceList); die;
		return view('backend.shortterm.attandanceAjax',compact('attendanceList'));
	 
 
	}


}
