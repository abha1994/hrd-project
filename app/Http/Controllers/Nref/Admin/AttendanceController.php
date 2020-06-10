<?php

namespace App\Http\Controllers\Nref\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Nref\studentRegistrationModel;
use Session;
use DB;
use Validator,Redirect;
use App\Http\Requests\Form_validation;
class AttendanceController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:nref-student-attendance', ['only' => ['index','show']]);
      

    }
    public function index()
    {
		
		$institute_data =DB::table('institute_details')
		     ->leftJoin('user_credential', 'institute_details.user_id', '=', 'user_credential.id')
             ->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
			 ->select('registration.institute_name','institute_details.institute_id')
			->where('institute_details.status_id',3)
            ->get();
			
			////echo "<pre>"; print_r($institute_data); die;

        return view('backend/nref/Admin.admin_attendance.attendance',compact('institute_data'));
    }
	
	
	public function attendanceAjax(Request $request)
	{
		//echo 'Hello'; die;
		
		//echo "<pre>"; dd($request); die;
		$val1=$request->input('monVal');
		$val2=$request->input('yrVal');
		$val3=$request->input('uni1');

		
		$query = DB::table('candidate_attendence')
		->leftJoin('studentregistrations', 'candidate_attendence.student_id', '=', 'studentregistrations.id')
		->leftJoin('courses', 'studentregistrations.course', '=', 'courses.course_id')
		->select('studentregistrations.firstname','studentregistrations.middlename','studentregistrations.lastname','studentregistrations.course','candidate_attendence.*','courses.course_name');
		
		
   if($val1!="")
	{

	$query= $query->where(['month_atten' =>$val1,'candidate_attendence.scheme_code'=>3]);
	}
	
	 if($val2!="")
	{
		$query= $query->where(['year_atten'=>$val2,'candidate_attendence.scheme_code'=>3]);
	} 
	
	if($val3!="")
	{
		$query= $query->where(['candidate_attendence.institute_id'=>$val3,'candidate_attendence.scheme_code'=>3]);
	
	}
	
	if($val1=="" && $val2=="" && $val3=="")
	{
		$query= $query->where(['month_atten'=>'','year_atten'=>'','candidate_attendence.institute_id'=>'','candidate_attendence.scheme_code'=>3]);
	}
	
	
	$query = $query->orderBy('attendence_id','asc');
	$attendanceList = $query->get();
	
		return view('backend.nref.Admin.admin_attendance.attendanceAjax',compact('attendanceList'));

	}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $recorde = studentRegistrationModel::findOrFail($id);
         
          return view('backend.nref.studentRregistration.show',compact('recorde'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


}
