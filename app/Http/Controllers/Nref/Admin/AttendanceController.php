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
			
			//echo "<pre>"; print_r($institute_data); die;

        return view('backend.nref.admin.admin_attendance.attendance',compact('institute_data'));
    }
	
	
	public function attendanceAjax(Request $request)
	{
		//echo 'Hello'; die;
		
		//echo "<pre>"; dd($request); die;
		$val1=$request->input('monVal');
		$val2=$request->input('yrVal');
		$val3=$request->input('uni1');
		
		//echo $val1; die;
	
	if($val1)
	{
		
			$attendanceList = DB::table('candidate_attendence')
            ->leftJoin('studentregistrations', 'candidate_attendence.student_id', '=', 'studentregistrations.id')
			->select('studentregistrations.firstname','studentregistrations.middlename','studentregistrations.lastname','studentregistrations.course','candidate_attendence.*')
			->where(['month_atten' =>$val1,'year_atten'=>$val2])
			->orderBy('attendence_id','asc')
            ->get();
			
			//echo $attendanceList; die;
	}
	
	if($val3)
	{
		$attendanceList = DB::table('candidate_attendence')
            ->leftJoin('studentregistrations', 'candidate_attendence.student_id', '=', 'studentregistrations.id')
			->select('studentregistrations.firstname','studentregistrations.middlename','studentregistrations.lastname','studentregistrations.course','candidate_attendence.*')
			->where(['studentregistrations.institute_id' =>$val3,'year_atten'=>$val2])
			->orderBy('attendence_id','asc')
            ->get();
			
			//echo $val3; die;
			
			//echo $attendanceList;
			
			//echo "<pre>"; print_r($attendanceList); die;
	}
	
	 if($val1 && $val3)
	{
		$attendanceList = DB::table('candidate_attendence')
            ->leftJoin('studentregistrations', 'candidate_attendence.student_id', '=', 'studentregistrations.id')
			->select('studentregistrations.firstname','studentregistrations.middlename','studentregistrations.lastname','studentregistrations.course','candidate_attendence.*')
			->where(['month_atten' =>$val1,'year_atten'=>$val2])
			->where(['studentregistrations.institute_id' =>$val3,'year_atten'=>$val2])
			->orderBy('attendence_id','asc')
            ->get();
	} 
	
	if($val1=="" && $val3=="")
	{
		$attendanceList=array();
	}
	
	//echo "<pre>"; print_r($attendanceList); die;
	
		
		return view('backend.nref.admin.admin_attendance.attendanceAjax',compact('attendanceList'));
	}

 

   
    /* public function attendance_form_post(Request $request)
    {
		//echo $request->month_atten;
		//dd($request);
		
		$all_data =  Session::get('userdata');
			$user_id = $all_data['candidate_id'];
			
			//echo $user_id; die;
        
         $this->validate($request,[
            'working_days' => 'required',
            'holiday' => 'required',
            'present_days' =>'required',
            'absent_days' => 'required',
             'remarks' => 'required',
            'leave_approval' => 'required',

         ]); 
 
         $records = $request->all();
		 
		 for($i=0;$i<count($request->working_days);$i++)
		 {
		
			 $postdata['institute_id']=$user_id;
			 $postdata['student_id']=$request->user_id[$i];
			 $postdata['month_atten']=$request->month_atten;
			 $postdata['year_atten']=$request->year_atten;
			 $postdata['working_days']=$request->working_days[$i];
			 $postdata['holidays']=$request->holiday[$i];
			 $postdata['present_days']=$request->present_days[$i];
			 $postdata['absent_days']=$request->absent_days[$i];
			 $postdata['remarks']=$request->remarks[$i];
			 $postdata['leave_approved_days']=$request->leave_approval[$i];
			 $postdata['total_days']=$request->total_days[$i];
			 
			 //echo $request->leave_approval[$i];
			 
			 
			 $existUser = DB::table('candidate_attendence')->where(['institute_id' => $user_id,'student_id' => $request->user_id[$i],'month_atten' =>$request->month_atten,'year_atten'=>$request->year_atten])->count();
			 
			 if($existUser>0)
			 {
				 DB::table('candidate_attendence')->where(['institute_id' => $user_id,'student_id' => $request->user_id[$i],'month_atten' =>$request->month_atten,'year_atten'=>$request->year_atten])->update($postdata);
				 $msg="Your Attandace Updated successfully.";
			 }
			 else{
				 DB::table('candidate_attendence')->insert($postdata);
				 $msg="Your Attandace created successfully.";
			 }
			 
			
		 }
		 
		 return redirect()->route('/attendance')->with('message',$msg);
		     

    } */

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
