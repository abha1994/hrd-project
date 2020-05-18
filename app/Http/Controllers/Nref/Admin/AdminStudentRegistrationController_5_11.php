<?php

namespace App\Http\Controllers\Nref\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\studentRegistration;
use App\User;
use DB;
use Response;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;

class AdminStudentRegistrationController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //dd($request);
        $inst = DB::table('institute_details')->get();
        $students = DB::table('studentregistrations')->orderBy('id','desc')->get();
       return view('backend.nref.Admin.studentInstitute.index',compact('inst'));
       
    }

     
    // public function show($id)
    // {
        // $recorde = studentRegistration::findOrFail($id);
         // $courses = DB::table('courses')->where('display',1)->get();
       
        // $stateName = DB::table('state_master')->where('statecd',$recorde->state)->distinct('statecd')->get();
        // $disticName = DB::table('district_master')->where('districtcd',$recorde->distric)->distinct('statecd')->get();    
         // $course = DB::table('courses')->where('course_id',$recorde->course)->distinct('course_id')->get();      
          
        // return view('backend.nref.Admin.studentInstitute.show',compact('recorde','stateName','disticName','course','country','courses'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$ids)
    {

        $student = studentRegistration::findOrFail($id);
        //dd($stuent);
        $country = DB::table('country')->get();
        $states = DB::table('state_master')->get();
        $distric = DB::table('district_master')->get();
        $courses = DB::table('courses')->where('display',1)->get();
         return view('backend.nref.Admin.studentInstitute/.edit',compact('student','country','states','distric','courses','ids'));
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

        $record = studentRegistration::find($id);
         if ($request->hasFile('student_image')) {
            if ($request->file('student_image')->isValid()) {             
                $fileName=$request->file('student_image')->getClientOriginalName();
                $fileName =time()."_".$fileName;
                $request->file('student_image')->move('public/uploads/nref/student_registration/student_photo', $fileName);
                $record['student_image']=$fileName;                
            }
        } //student Image   
        if ($request->hasFile('commiteedocument')) {
            if ($request->file('commiteedocument')->isValid()) {             
                $fileName=$request->file('commiteedocument')->getClientOriginalName();
                $fileName =time()."_".$fileName;
                $request->file('commiteedocument')->move('public/uploads/nref/student_registration/commitee_recommanded/', $fileName);
                $record['commiteedocument']=$fileName;                
            }
        } //Selection Committee Recommandation document 
         if ($request->hasFile('highest_qulification')) {
            if ($request->file('highest_qulification')->isValid()) {             
                $fileName=$request->file('highest_qulification')->getClientOriginalName();
                $fileName =time()."_".$fileName;
                $request->file('highest_qulification')->move('public/uploads/nref/student_registration/qulification', $fileName);
                $record['highest_qulification']=$fileName;
                
            }
        } //highest Qulification Document
        // if ($request->hasFile('bankMandate')) {
            // if ($request->file('bankMandate')->isValid()) {
                // $fileName=$request->file('bankMandate')->getClientOriginalName();
                // $fileName =time()."_".$fileName;
                // $request->file('bankMandate')->move('public/uploads/nref/student_registration/bankMandate', $fileName);
                // $record['bankMandate']=$fileName;
                
            // }
        // } //Bank Mandate Document
        if ($request->hasFile('publication')) {
            if ($request->file('publication')->isValid()) {             
                $fileName=$request->file('publication')->getClientOriginalName();
                $fileName =time()."_".$fileName;
                $request->file('publication')->move('public/uploads/nref/student_registration/publication', $fileName);
                $record['publication']=$fileName;
                
            }
        } //Gate and Neet Document
        if ($request->hasFile('gate')) {
            if ($request->file('gate')->isValid()) {             
                $fileName=$request->file('gate')->getClientOriginalName();
                $fileName =time()."_".$fileName;
                $request->file('gate')->move('public/uploads/nref/student_registration/gate', $fileName);
                $record['gate']=$fileName;                
            }
        } //Gate 
         //NET
        if ($request->hasFile('net')) {
            if ($request->file('net')->isValid()) {             
                $fileName=$request->file('net')->getClientOriginalName();
                $fileName =time()."_".$fileName;
                $request->file('net')->move('public/uploads/nref/student_registration/net', $fileName);
                $record['net']=$fileName;                
            }
        } //Gate 

        if ($request->hasFile('experience')) {
            if ($request->file('experience')->isValid()) {             
                $fileName=$request->file('experience')->getClientOriginalName();
                $fileName =time()."_".$fileName;
                $request->file('experience')->move('public/uploads/nref/student_registration/experience', $fileName);
                $record['experience']=$fileName;                
            }
        } //Gate 
		
		 if ($request->hasFile('candidate_declaration')) {
            if ($request->file('candidate_declaration')->isValid()) {
             
                $fileName=$request->file('candidate_declaration')->getClientOriginalName();
                $fileName =time()."_".$fileName;
                    //upload
                $request->file('candidate_declaration')->move('public/uploads/nref/student_registration/candidate_declaration', $fileName);
                    //column name 
                $records['candidate_declaration']=$fileName;
                
            }
        } //candidate_declaration Document
		$logID = Auth::id();
	// dd($record);
		
       $row = array('firstname'=>$request->firstname,
            'firstname'=>$request->firstname,
            'middlename'=>$request->middlename,
            'lastname'=>$request->lastname,
            'mobile'=>$request->mobile,
            'email_id'=>$request->email_id,
            'gender'=>$request->gender,
            'address'=>$request->address,
            'dob'=>$request->dob,
            'pincode'=>$request->pincode,
            'course'=>$request->course,
            'country'=>$request->country,
            'state'=>$request->state,
            'distric'=>$request->distric,
            'gate_neet'=>$record['gate_neet'],
            'aadhar'=>$request->aadhar,
            'category'=>$request->category,
			'doj'=>$request->doj,
            'highest_qulification'=>$record['highest_qulification'],
            
            // 'bankMandate'=>$record['bankMandate'],
            'student_image'=> $record['student_image'],
            'commiteedocument'=> $record['commiteedocument'],
            'gate'=>$record['gate'],
            'net'=>$record['net'],
            'experience'=>$record['experience'],
			'candidate_declaration'=>$record['candidate_declaration'],
            'institute_id' =>$record->institute_id,
			'user_id' =>$record->user_id,
        );
         DB::table('studentregistrations')->where('id',$id)->update($row); 
        $history = array('studentregistration_id'=>$record->id,'institute_id'=>$record->institute_id,'user_id'=>Auth::id(),'firstname'=>$request->firstname,'middlename'=>$request->middlename,'lastname'=>$request->lastname,'gender'=>$request->gender,'email_id'=>$request->email_id,'mobile'=>$request->mobile,'address'=>$request->address,'dob'=>$request->dob,'country'=>$request->country,'state'=>$request->state,'distric'=>$request->distric,'gate_neet'=>$record['gate_neet'],'highest_qulification'=>$record['highest_qulification'],'bankMandate'=>$record['bankMandate'],'publication'=>$record['publication'],'aadhar'=>$request->aadhar,'modified_by'=>Auth::user()->id,'modified_date'=>date("Y-m-d H:i:s"),'status'=>1);
         
         
        DB::table('studentregistrations_history')->insert($history);
          
         
         
       
        return \Redirect::route('get-instituteId', [$request->redirectid])->with('message', 'Student record updated successfully.!!!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //studentRegistration::destroy($id);

         
        $records =  studentRegistration::findOrFail($id);

        $history = array('studentregistration_id'=>$records->id,'institute_id'=>$records->institute_id,'user_id'=>4,'firstname'=>$records->firstname,'middlename'=>$records->middlename,'lastname'=>$records->lastname,'gender'=>$records->gender,'email_id'=>$records->email_id,'mobile'=>$records->mobile,'address'=>$records->address,'dob'=>$records->dob,'country'=>$records->country,'state'=>$records->state,'distric'=>$records->distric,'gate_neet'=>$records->gate_neet,'highest_qulification'=>$records->highest_qulification,'bankMandate'=>$records->bankMandate,'publication'=>$records->publication,'aadhar'=>$records->aadhar,'modified_by'=>Auth::user()->id,'modified_date'=>date("Y-m-d H:i:s"),'status'=>2);

         
            DB::table('studentregistrations_history')->insert($history);
            studentRegistration::destroy($id);


          return \Redirect::route('get-instituteId', [$request->redirecturl])->with('message', 'Student record deleted successfully.!!!');
    }

     public function getDisticList(Request $request)
    {  
        $districs = DB::table("district_master")
                    ->where("statecd",$request->statecd)
                    ->pluck("district_name","districtcd");
        return response()->json($districs);
    }

    public function validateEmail(Request $request){
        //echo 'amresh';
        $data = $request->email_id;
        $row = DB::table('studentregistrations')->where('email_id',$data)->get() ;

        if($data){
            $result =DB::table('studentregistrations')->where([['email_id',$data],['id','!=',$row[0]->id]])->count();
            

            if($result>0){
                return Response::json('Email id all ready exit in database');
            }else{
                //return Response::json('<span style="color:green">Congratulation email id not exit in database</span>');   
            }
        }      
 
    }

    public function validateMobile(Request $request){
        //echo 'amresh';
        $data = $request->mobile;
        $row = DB::table('studentregistrations')->where('mobile',$data)->get() ;

        if($data){
            $result =DB::table('studentregistrations')->where([['mobile',$data],['id','!=',$row[0]->id]])->count();
            //return $result;
            if($result>0){
                return Response::json('Mobile all ready exit in database');
            }else{
                return Response::json('<span style="color:green">Congratulation mobile not exit in database</span>');   
            }
        }      
 
    }
    public function validateAadhar(Request $request){
        //echo 'amresh';
        $data = $request->aadhar;
         $row = DB::table('studentregistrations')->where('aadhar',$data)->get() ;
        if($data){
            $result =DB::table('studentregistrations')->where([['aadhar',$data],['id','!=',$row[0]->id]])->count();

            if($result>0){
                return Response::json('Aadhar all ready exit in database');
            }else{
               // return Response::json('<span style="color:green">Congratulation aadhar not exit in database</span>');   
            }
        }      
 
    }

    public function getInstitute(Request $request)
    {
        //dd($request->findStudentInst);
       $id = $request->findStudentInst;
        
        if(!empty($request->findStudentInst)){
            //dd(123);

            
             
        $inst = DB::table('institute_details')->get();
        $students = DB::table('studentregistrations')->where('institute_id',$request->findStudentInst)->get();

        return view('backend.nref.Admin.studentInstitute.list',compact('students','inst','id'));
        }else{

        }
    }

    public function getInstitutebyid($id){
        //dd(123);
         $inst = DB::table('institute_details')->get();
        $students = DB::table('studentregistrations')->where('institute_id',$id)->orderBy('id','desc')->get();

        return view('backend.nref.Admin.studentInstitute.list',compact('students','inst','id'));
    }


    public function show($id, $ids){
        //dd(123);
        $recorde = studentRegistration::findOrFail($id);
        $courses = DB::table('courses')->where('display',1)->get();
        $stateName = DB::table('state_master')->where('statecd',$recorde->state)->distinct('statecd')->get();
        $disticName = DB::table('district_master')->where('districtcd',$recorde->distric)->distinct('statecd')->get();         
        $country = DB::table('country')->where('countrycd',$recorde->country)->get();   
        $course = DB::table('courses')->where('course_id',$recorde->course)->distinct('course_id')->get();     
        
        return view('backend.nref.Admin.studentInstitute.show',compact('recorde','stateName','disticName','ids','country','course','courses'));
    }

 public function student_consider(Request $request)
    { 
	    $postdata['status_application'] = $request->status_application;
	
	    date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s');
		
		$postdata['remarks'] = $request->remarks;
		$postdata['candidate_id'] = $request->student_id;
		$postdata['institute_id'] = $request->institute_id;
		$postdata['officer_id'] = $request->officer_id; 
		$postdata['officer_role_id'] = $request->role_id;
		$postdata['reason'] = $request->reason;
		$postdata['verified_date'] = $date;
		$postdata['scheme_code'] = "1";
			// dd($postdata);
		$a = DB::table('internship_verification')->insert($postdata);
		$backPage = $request->backPage;
		$status_application['status_id'] = $postdata['status_application'];
		$status_application['officer_role_id'] = $request->role_id;
		$status_application['officer_id'] = $request->officer_id;
		DB::table('studentregistrations')->where('id',$postdata['candidate_id'])->update($status_application);
		echo $a;
		 // return \Redirect::route('get-instituteId', [$request->backPage])->with('message', 'Student consider status updated successfully.!!!');
   }
	
    // public function consider(Request $request){
           
        // $condidate_id = $request->studentId;

        // $backPage = $request->backPage;
        // $condidateRecord = studentRegistration::findOrFail($condidate_id);
          
        // $officer_id = Auth::id();
        // $roleid = \App\User::with('roles')->find($officer_id);
         
        // $studentVerification = array(
            // 'candidate_id'=>$condidateRecord->id,
            // 'institute_id'=>$condidateRecord->institute_id,
            // 'officer_id'=>$officer_id,
            // 'officer_role_id'=>$roleid->role,
            // 'status_application'=>'1',
            // 'remarks'=>$request->remarks,
            // 'scheme_code'=>'3',
            // 'verified_date'=>date('Y-m-d')
            
        // );

        // $student = array('officer_id'=>$officer_id,
            // 'officer_role_id'=>$roleid->role,'status_id'=>'1',);

        // DB::table('studentregistrations')->where('id',$condidateRecord->id)->update($student);
        // DB::table('student_verification')->insert($studentVerification);
        // return \Redirect::route('get-instituteId', [$request->backPage])->with('message', 'Student consider status updated successfully.!!!');
    // }

    // public function nonConsider(Request $request){
         
        // $condidate_id = $request->studentId;
        // $backPage = $request->backPage;
        // $condidateRecord = studentRegistration::findOrFail($condidate_id);
          
        // $officer_id = Auth::id();
        // $roleid = \App\User::with('roles')->find($officer_id);
         
        // $studentVerification = array(
            // 'candidate_id'      =>$condidateRecord->id,
            // 'institute_id'      =>$condidateRecord->institute_id,
            // 'officer_id'        =>$officer_id,
            // 'officer_role_id'   =>$roleid->role,
            // 'status_application'=>'2',
            // 'reason'            => $request->reason,
            // 'remarks'           =>$request->remarks,
            // 'scheme_code'       =>'3',
            // 'verified_date'     =>date('Y-m-d')
            
        // );
         // $student = array('officer_id'=>$officer_id,
            // 'officer_role_id'=>$roleid->role,'status_id'=>'2',);

        // DB::table('studentregistrations')->where('id',$condidateRecord->id)->update($student);
        // DB::table('student_verification')->insert($studentVerification);
        // return \Redirect::route('get-instituteId', [$request->backPage])->with('message', 'Student Non consider status updated successfully.!!!');
    // }
}
