<?php

namespace App\Http\Controllers\Nref;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Nref\studentRegistrationModel;
use Session;
use DB;
use Auth;
use Validator,Redirect;

class AttendanceController extends Controller
{
    public function index()
    {
		$institute_id =  Auth::id(); //login user id
		$students = DB::table('studentregistrations')->where('institute_id',$institute_id)->orderBy('id','desc')->get();
		$attendanceList = DB::table('candidate_attendence')->where(['month_atten' =>date("n"),'year_atten'=>date("Y")])->orderBy('attendence_id','asc')->get();
        return view('backend.nref.attendance',compact('students','attendanceList'));
    }
	
	public function attendanceAjax(Request $request)
	{
		
		$val1=$request->input('monVal');
		$val2=$request->input('yrVal');
		$currentmonth=$request->input('currentMonth');
		$monthValueArray=array('0'=>$val1,'1'=>$currentmonth);
		$institute_id =  Auth::id();
        $students = DB::table('studentregistrations')->where('institute_id',$institute_id)->orderBy('id','desc')->get();

        $attendanceList = DB::table('studentregistrations')
							->leftJoin('candidate_attendence', 'studentregistrations.id', '=', 'candidate_attendence.student_id')
							->where(['month_atten' =>$val1,'year_atten'=>$val2])
							->where('studentregistrations.institute_id',$institute_id)
							->orderBy('attendence_id','asc')
							->get();
		return view('backend.nref.attendanceAjax',compact('attendanceList','monthValueArray','students'));
	}

 

   
    public function attendance_form_post(Request $request)
    {
		// $all_data =  Session::get('userdata');
		// $user_id = $all_data['candidate_id'];
		$user_id =  Auth::id();	
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
				$postdata['scheme_code']=3;
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