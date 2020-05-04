<?php

namespace App\Http\Controllers\Nres;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Nres\studentAttendanceModel;
use Illuminate\Support\Facades\Input;
use Session;
use DB;
use Auth ;
class AttendanceController extends Controller
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
		
        $login_user_id = Auth::id();
        $students = DB::table('studentregistrations')->orderBy('id','desc')->get();
		
		$attendanceStudent = DB::table('candidate_attendence')
            ->where(['student_id' =>$login_user_id,'scheme_code'=>2,'month_atten'=>$curMonth,'year_atten'=>$currentYear])
			->orderBy('attendence_id','desc')
            ->get();
         

        return view('backend.nres.attendance_student',compact('students','attendanceStudent'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_attendance()
    {

		
		//$StdID = last(request()->segments());
		//echo '=='.$key; die;
        $country = DB::table('country')->get();
        $states = DB::table('state_master')->get();
        $distric = DB::table('district_master')->get();
        $courses = DB::table('courses')->where('display',1)->get();
		//$singleRecord = DB::table('candidate_attendence')->where('attendence_id',$StdID)->get();

        return view('backend.nres.add_attendance',compact('country','states','distric','courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		
		//echo "<pre>"; dd($request);
        
         $this->validate($request,[
            'working_days'  =>  'required|min:0|max:2',
            'holiday'=> 'required|min:0|max:2',
            'present_days' => 'required|min:0|max:2',
            'leave_approval' => 'required|min:0|max:2',

         ]);
		 
		 $login_user_id = Auth::id();
        
        $records['institute_id'] = $login_user_id;
		$records['student_id'] = $login_user_id;
		$records['scheme_code'] = 2;
		
		$records['month_atten'] = $request->month;
		$records['year_atten'] = $request->year;
		$records['working_days'] = $request->working_days;
		$records['holidays'] = $request->holiday;
		$records['present_days'] = $request->present_days;
		$records['absent_days'] = $request->absent_days;
		$records['remarks'] = $request->remarks;
		$records['leave_approved_days'] = $request->leave_approval;
		$records['total_days'] = $request->total_days;
		
			//echo "<pre>"; print_r($records); die;
			
	$existUser = DB::table('candidate_attendence')->where(['institute_id' => $login_user_id,'student_id' => $login_user_id,'month_atten' =>$request->month,'year_atten'=>$request->year])->count();

	
	if($existUser>0)
			 {
				 return redirect()->route('/attendance-solar-form')
                        ->with('message','Your attendance  already submitted!!');
			 }
		else
		{
         
        studentAttendanceModel::create($records);
         return redirect()->route('/attendance-solar-form')
                        ->with('message','Your attendance  submitted successfully.');
		}

        

         

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
         //$recorde = studentRegistrationModel::findOrFail($id);
		 $StdID = last(request()->segments());
		 $singleRecord = DB::table('candidate_attendence')->where('attendence_id',$StdID)->get();
         
          return view('backend.nres.view_attendance',compact('singleRecord'));
    }
	
	
	public function attendanceStudentAjax(Request $request)
	{
		//echo 'Hello'; die;
	    $all_data =  Session::get('userdata');
		$val1=$request->input('monthVal');
		$val2=$request->input('yearr');
		
$attendanceList = DB::table('candidate_attendence')
            //->leftJoin('candidate_attendence', 'student_registration.id', '=', 'candidate_attendence.student_id')
			->where(['student_id' =>$all_data['candidate_id'],'scheme_code'=>2,'month_atten' =>$val1,'year_atten'=>$val2])
			->orderBy('attendence_id','desc')
            ->get();
  return view('backend.nres.attendanceStudentAjax',compact('attendanceList'));
	}

}
