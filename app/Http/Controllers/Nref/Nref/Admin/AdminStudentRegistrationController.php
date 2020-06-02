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
   
   public function __construct()
    {
		$current_url =  \Request::segment(1);
		if($current_url == 'get-institute'){
			
			$this->middleware('permission:nref-pending-student-list|nref-pending-student-edit|nref-pending-student-delete', ['only' => ['getInstitute','show','getInstitutebyid']]);
			$this->middleware('permission:nref-pending-student-edit', ['only' => ['edit','update']]);
			$this->middleware('permission:nref-pending-student-delete', ['only' => ['destroy']]);
			
		}else if($current_url == 'admin-student-considered'){
			
			$this->middleware('permission:nref-considered-by-1-student-list|nref-considered-by-1-student-edit|nref-considered-by-1-student-delete', ['only' => ['considered_level_1','consider_show','considered_level_1_ins']]);
			$this->middleware('permission:nref-considered-by-1-student-edit', ['only' => ['edit','update']]);
			$this->middleware('permission:nref-considered-by-1-student-delete', ['only' => ['considered_delete']]);

		}else if($current_url == 'admin-student-rejected'){
			
			$this->middleware('permission:nref-rejected-student-list|nref-rejected-student-edit|nref-rejected-student-delete', ['only' => ['rejected_student','reject_show','reject_ins']]);
			$this->middleware('permission:nref-rejected-student-edit', ['only' => ['edit','update']]);
			$this->middleware('permission:nref-rejected-student-delete', ['only' => ['reject_delete']]);
			
		}else if($current_url == 'admin-student-forward-to-committee'){
			
			$this->middleware('permission:nref-forward-committee-student-list|nref-forward-committee-student-edit|nref-forward-committee-student-delete', ['only' => ['forward_to_committee','committee_show','forward_committee_ins']]);
			$this->middleware('permission:nref-forward-committee-student-edit', ['only' => ['edit','update']]);
			$this->middleware('permission:nref-forward-committee-student-delete', ['only' => ['committee_delete']]);
			
		}else if($current_url == 'admin-student-final-selected'){
			
			$this->middleware('permission:nref-final-selected-student-list|nref-final-selected-student-edit|nref-final-selected-student-delete', ['only' => ['final_selected','final_selected_show','final_selected_ins']]);
			$this->middleware('permission:nref-final-selected-student-edit', ['only' => ['edit','update']]);
			$this->middleware('permission:nref-final-selected-student-delete', ['only' => ['final_selecte_delete']]);
		
		}else if($current_url == 'admin-student-final-rejected'){
			
			$this->middleware('permission:nref-final-rejected-student-list|nref-final-rejected-student-edit|nref-final-rejected-student-delete', ['only' => ['final_rejected','final_rejected_show','final_rejected_ins']]);
			$this->middleware('permission:nref-final-rejected-student-edit', ['only' => ['edit','update']]);
			$this->middleware('permission:nref-final-rejected-student-delete', ['only' => ['final_reject_delete']]);
		}
		else if($current_url == 'admin-student-committee-rec'){
			
			$this->middleware('permission:nref-commitee-recom-student-list|nref-commitee-recom-student-edit|nref-commitee-recom-student-delete', ['only' => ['committee_recom','committee_recom_show','committee_recom_ins']]);
			$this->middleware('permission:nref-commitee-recom-student-edit', ['only' => ['edit','update']]);
			$this->middleware('permission:nref-commitee-recom-student-delete', ['only' => ['committee_recom_delete']]);
		}
		
	}
	
	
	
	
    public function index()
    {
        // $inst = DB::table('institute_details')->get();
        // $students = DB::table('studentregistrations')->orderBy('id','desc')->get();
        // return view('backend.nref.Admin.studentInstitute.index',compact('inst'));
		
	    $students = DB::table('studentregistrations')->where('status_id',NULL)->orderBy('id','desc')->get();
	    $inst =DB::table('institute_details')
						->leftJoin('user_credential', 'institute_details.user_id', '=', 'user_credential.id')
						->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
						->select('registration.institute_name','institute_details.institute_id')
						->where('institute_details.status_id',3)
						->get();
					return view('backend.nref.Admin.studentInstitute.index',compact('students','inst'));
	   
       
    }

    public function edit($id,$ids)
    {
       $student = studentRegistration::findOrFail($id);
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
		$institiuteID = $record->institute_id;
		$redirect_url = $request->redirect_url;
		// dd($redirect_url);
        if($request->hasFile('highest_qulification')) {
				$image = $request->file('highest_qulification');
				$highest_qulification = $institiuteID.'_'.$id.'_'.'3'.'_qulification.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/../public/uploads/nref/student_registration/qulification');
				$imagePath = $destinationPath. "/".  $highest_qulification;
				$image->move($destinationPath, $highest_qulification);
				$record['highest_qulification'] = $highest_qulification;
		}
				
        if($request->hasFile('candidate_declaration')) {
				$image = $request->file('candidate_declaration');
				$candidate_declaration = $institiuteID.'_'.$id.'_'.'3'.'_candidate_declaration.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/../public/uploads/nref/student_registration/candidate_declaration');
				$imagePath = $destinationPath. "/".  $candidate_declaration;
				$image->move($destinationPath, $candidate_declaration);
				$record['candidate_declaration'] = $candidate_declaration;
		}
		
		if($request->hasFile('publication')) {
				$image = $request->file('publication');
				$publication = $institiuteID.'_'.$id.'_'.'3'.'_publication.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/../public/uploads/nref/student_registration/publication');
				$imagePath = $destinationPath. "/".  $publication;
				$image->move($destinationPath, $publication);
				$record['publication'] = $publication;
		}

        if($request->hasFile('student_image')) {
				$image = $request->file('student_image');
				$student_image = $institiuteID.'_'.$id.'_'.'3'.'_student_image.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/../public/uploads/nref/student_registration/student_photo');
				$imagePath = $destinationPath. "/".  $student_image;
				$image->move($destinationPath, $student_image);
				$record['student_image'] = $student_image;
		}
		
		if($request->hasFile('commiteedocument')) {
				$image = $request->file('commiteedocument');
				$commiteedocument = $institiuteID.'_'.$id.'_'.'3'.'_commiteedocument.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/../public/uploads/nref/student_registration/commitee_recommanded');
				$imagePath = $destinationPath. "/".  $commiteedocument;
				$image->move($destinationPath, $commiteedocument);
				$record['commiteedocument'] = $commiteedocument;
		}

        if($request->hasFile('gate')) {
			if ($request->file('gate')->isValid()) {  
				$image = $request->file('gate');
				$gate = $institiuteID.'_'.$id.'_'.'3'.'_gate.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/../public/uploads/nref/student_registration/gate');
				$imagePath = $destinationPath. "/".  $gate;
				$image->move($destinationPath, $gate);
				$record['gate'] = $gate;
			}
		}
		
		if($request->hasFile('net')) {
				$image = $request->file('net');
				$net = $institiuteID.'_'.$id.'_'.'3'.'_net.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/../public/uploads/nref/student_registration/net');
				$imagePath = $destinationPath. "/".  $net;
				$image->move($destinationPath, $net);
				$record['net'] = $net;
		}
		
		if($request->hasFile('experience')) {
				$image = $request->file('experience');
				$experience = $institiuteID.'_'.$id.'_'.'3'.'_experience.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/../public/uploads/nref/student_registration/experience');
				$imagePath = $destinationPath. "/".  $experience;
				$image->move($destinationPath, $experience);
				$record['experience'] = $experience;
		}

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
            'countrycd'=>$request->countrycd,
            'statecd'=>$request->statecd,
            'districtcd'=>$request->districtcd,
            // 'gate_neet'=>$record['gate_neet'],
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
		 
	
        // $history = array('studentregistration_id'=>$record->id,'institute_id'=>$record->institute_id,'user_id'=>Auth::id(),'firstname'=>$request->firstname,'middlename'=>$request->middlename,'lastname'=>$request->lastname,'gender'=>$request->gender,'email_id'=>$request->email_id,'mobile'=>$request->mobile,'address'=>$request->address,'dob'=>$request->dob,'country'=>$request->country,'state'=>$request->state,'distric'=>$request->distric,'highest_qulification'=>$record['highest_qulification'],'bankMandate'=>$record['bankMandate'],'publication'=>$record['publication'],'aadhar'=>$request->aadhar,'pincode'=>$request->pincode,'modified_by'=>Auth::user()->id,'modified_date'=>date("Y-m-d H:i:s"),'status'=>1);
         
        // DB::table('studentregistrations_history')->insert($history);
       // return \Redirect::route('get-instituteId', [$request->redirectid])->with('message', 'Student record updated successfully.!!!');
        // return redirect($redirect_url.'/'.$id.'/edit/'.$request->redirectid)->with('success','Student record updated successfully!!..');
		return redirect($redirect_url.'/'.$request->redirectid)->with('success','Student record updated successfully!!..');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $records =  studentRegistration::findOrFail($id);
		
        // $history = array('studentregistration_id'=>$records->id,'institute_id'=>$records->institute_id,'user_id'=>4,'firstname'=>$records->firstname,'middlename'=>$records->middlename,'lastname'=>$records->lastname,'gender'=>$records->gender,'email_id'=>$records->email_id,'mobile'=>$records->mobile,'address'=>$records->address,'dob'=>$records->dob,'country'=>$records->country,'state'=>$records->state,'distric'=>$records->distric,'highest_qulification'=>$records->highest_qulification,'bankMandate'=>$records->bankMandate,'publication'=>$records->publication,'aadhar'=>$records->aadhar,'modified_by'=>Auth::user()->id,'modified_date'=>date("Y-m-d H:i:s"),'status'=>2);
       // DB::table('studentregistrations_history')->insert($history);
	   
        studentRegistration::destroy($id);
        return redirect('get-institute')->with('success','Student record deleted successfully!!..');
    }
	
	 public function final_reject_delete(Request $request,$id)
    {
        $records =  studentRegistration::findOrFail($id);
		studentRegistration::destroy($id);
        return redirect('admin-student-final-rejected')->with('success','Student record deleted successfully!!..');
    }
	
	public function final_selecte_delete(Request $request,$id)
    {
        $records =  studentRegistration::findOrFail($id);
		studentRegistration::destroy($id);
        return redirect('admin-student-final-selected')->with('success','Student record deleted successfully!!..');
    }
	
    public function committee_delete(Request $request,$id)
    {
        $records =  studentRegistration::findOrFail($id);
		studentRegistration::destroy($id);
        return redirect('admin-student-forward-to-committee')->with('success','Student record deleted successfully!!..');
    }
	
	public function considered_delete(Request $request,$id)
    {
        $records =  studentRegistration::findOrFail($id);
		studentRegistration::destroy($id);
        return redirect('admin-student-considered')->with('success','Student record deleted successfully!!..');
    }
	
	public function reject_delete(Request $request,$id)
    {
        $records =  studentRegistration::findOrFail($id);
		studentRegistration::destroy($id);
        return redirect('admin-student-rejected')->with('success','Student record deleted successfully!!..');
    }
	public function committee_recom_delete(Request $request,$id)
    {
        $records =  studentRegistration::findOrFail($id);
		studentRegistration::destroy($id);
        return redirect('admin-student-committee-rec')->with('success','Student record deleted successfully!!..');
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
	
	// /***********************All Pending Application*********************//

    public function getInstitute(Request $request)
    {
        $id = $request->findStudentInst;
        if(!empty($request->findStudentInst)){
            $inst = DB::table('institute_details')
						->leftJoin('user_credential', 'institute_details.user_id', '=', 'user_credential.id')
						->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
						->select('registration.institute_name','institute_details.institute_id')
						->where('institute_details.status_id',3)
						->get();
            $students = DB::table('studentregistrations')->where('institute_id',$request->findStudentInst)->where('status_id',null)->orderBy('id','desc')->get();

        
        }else{
            $inst = DB::table('institute_details')
						->leftJoin('user_credential', 'institute_details.user_id', '=', 'user_credential.id')
						->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
						->select('registration.institute_name','institute_details.institute_id')
						->where('institute_details.status_id',3)
						->get();
            $students = DB::table('studentregistrations')->where('status_id',null)->orderBy('id','desc')->get();
		
        }
		return view('backend.nref.Admin.studentInstitute.pending.list',compact('students','inst','id'));
    }
	
	public function show($id, $ids){
        $recorde = studentRegistration::findOrFail($id);
        $courses = DB::table('courses')->where('display',1)->get();
        $stateName = DB::table('state_master')->where('statecd',$recorde->statecd)->distinct('statecd')->get();
        $disticName = DB::table('district_master')->where('districtcd',$recorde->districtcd)->distinct('statecd')->get();         
        $country = DB::table('country')->where('countrycd',$recorde->country)->get();   
        $course = DB::table('courses')->where('course_id',$recorde->course)->distinct('course_id')->get();     
        return view('backend.nref.Admin.studentInstitute.pending.show',compact('recorde','stateName','disticName','ids','country','course','courses'));
    }
	
	 public function getInstitutebyid($id){
         $inst = DB::table('institute_details')
						->leftJoin('user_credential', 'institute_details.user_id', '=', 'user_credential.id')
						->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
						->select('registration.institute_name','institute_details.institute_id')
						->where('institute_details.status_id',3)
						->get();
        $students = DB::table('studentregistrations')->where('status_id',null)->where('institute_id',$id)->orderBy('id','desc')->get();

        return view('backend.nref.Admin.studentInstitute.pending.list',compact('students','inst','id'));
    }

   
	// /***********************All Pending Application End *********************//
	
	// /***********************All Consider Application BY Level 1*********************//
    public function considered_level_1(Request $request)
   {
        $id = $request->findStudentInst;
        if(!empty($request->findStudentInst)){
            $inst = DB::table('institute_details')
						->leftJoin('user_credential', 'institute_details.user_id', '=', 'user_credential.id')
						->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
						->select('registration.institute_name','institute_details.institute_id')
						->where('institute_details.status_id',3)
						->get();
            $students = DB::table('studentregistrations')->where('institute_id',$request->findStudentInst)->where('officer_role_id',3)->where('status_id',"1")->orderBy('id','desc')->get();

        
        }else{
            $inst = DB::table('institute_details')
						->leftJoin('user_credential', 'institute_details.user_id', '=', 'user_credential.id')
						->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
						->select('registration.institute_name','institute_details.institute_id')
						->where('institute_details.status_id',3)
						->get();
            $students = DB::table('studentregistrations')->where('officer_role_id',3)->where('status_id',"1")->orderBy('id','desc')->get();
		
        }
		return view('backend.nref.Admin.studentInstitute.considered.considered_list',compact('students','inst','id'));
    }
	
	 public function consider_show($id, $ids){
        $recorde = studentRegistration::findOrFail($id);
        $courses = DB::table('courses')->where('display',1)->get();
        $stateName = DB::table('state_master')->where('statecd',$recorde->statecd)->distinct('statecd')->get();
        $disticName = DB::table('district_master')->where('districtcd',$recorde->districtcd)->distinct('statecd')->get();         
        $country = DB::table('country')->where('countrycd',$recorde->country)->get();   
        $course = DB::table('courses')->where('course_id',$recorde->course)->distinct('course_id')->get();     
        return view('backend.nref.Admin.studentInstitute.considered.show',compact('recorde','stateName','disticName','ids','country','course','courses'));
    }
	
	 public function considered_level_1_ins($id){
         $inst = DB::table('institute_details')
						->leftJoin('user_credential', 'institute_details.user_id', '=', 'user_credential.id')
						->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
						->select('registration.institute_name','institute_details.institute_id')
						->where('institute_details.status_id',3)
						->get();
        $students = DB::table('studentregistrations')->where('officer_role_id',3)->where('status_id',"1")->where('institute_id',$id)->orderBy('id','desc')->get();

        return view('backend.nref.Admin.studentInstitute.considered.considered_list',compact('students','inst','id'));
    }
	// /***********************All Consider Application BY Level 1 End*********************//
	
	// /***********************All Rejected Application BY Level 1 ,2, Admin*********************//
	public function rejected_student(Request $request)
   {
        $id = $request->findStudentInst;
        if(!empty($request->findStudentInst)){
            $inst = DB::table('institute_details')
						->leftJoin('user_credential', 'institute_details.user_id', '=', 'user_credential.id')
						->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
						->select('registration.institute_name','institute_details.institute_id')
						->where('institute_details.status_id',3)
						->get();
            $students = DB::table('studentregistrations')->where('institute_id',$request->findStudentInst)->where('officer_role_id',3)->where('status_id',"2")->orderBy('id','desc')->get();

        
        }else{
            $inst = DB::table('institute_details')
						->leftJoin('user_credential', 'institute_details.user_id', '=', 'user_credential.id')
						->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
						->select('registration.institute_name','institute_details.institute_id')
						->where('institute_details.status_id',3)
						->get();
            $students = DB::table('studentregistrations')->where('officer_role_id',3)->where('status_id',"2")->orderBy('id','desc')->get();
		
        }
		return view('backend.nref.Admin.studentInstitute.rejected.reject_list',compact('students','inst','id'));
    }
	
	 public function reject_show($id, $ids){
        $recorde = studentRegistration::findOrFail($id);
        $courses = DB::table('courses')->where('display',1)->get();
        $stateName = DB::table('state_master')->where('statecd',$recorde->statecd)->distinct('statecd')->get();
        $disticName = DB::table('district_master')->where('districtcd',$recorde->districtcd)->distinct('statecd')->get();         
        $country = DB::table('country')->where('countrycd',$recorde->country)->get();   
        $course = DB::table('courses')->where('course_id',$recorde->course)->distinct('course_id')->get();     
        return view('backend.nref.Admin.studentInstitute.rejected.show',compact('recorde','stateName','disticName','ids','country','course','courses'));
    }
	
    public function reject_ins($id){
         $inst = DB::table('institute_details')
						->leftJoin('user_credential', 'institute_details.user_id', '=', 'user_credential.id')
						->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
						->select('registration.institute_name','institute_details.institute_id')
						->where('institute_details.status_id',3)
						->get();
        $students = DB::table('studentregistrations')->where('officer_role_id',3)->where('status_id',"2")->where('institute_id',$id)->orderBy('id','desc')->get();

        return view('backend.nref.Admin.studentInstitute.rejected.reject_list',compact('students','inst','id'));
    }

// /***********************All Rejected Application BY Level 1 ,2, Admin*********************//

   
// /***********************Application Forward to committe End*********************//
	public function forward_to_committee(Request $request)
   {
        $id = $request->findStudentInst;
        if(!empty($request->findStudentInst)){
            $inst = DB::table('institute_details')
						->leftJoin('user_credential', 'institute_details.user_id', '=', 'user_credential.id')
						->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
						->select('registration.institute_name','institute_details.institute_id')
						->where('institute_details.status_id',3)
						->get();
            $students = DB::table('studentregistrations')->where('institute_id',$request->findStudentInst)->where('officer_role_id','!=',3)->where('officer_role_id','!=',5)->where('status_id',"1")->orderBy('id','desc')->get();

        
        }else{
            $inst = DB::table('institute_details')
						->leftJoin('user_credential', 'institute_details.user_id', '=', 'user_credential.id')
						->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
						->select('registration.institute_name','institute_details.institute_id')
						->where('institute_details.status_id',3)
						->get();
            $students = DB::table('studentregistrations')->where('officer_role_id','!=',3)->where('officer_role_id','!=',5)->where('status_id',"1")->orderBy('id','desc')->get();
		
        }
		return view('backend.nref.Admin.studentInstitute.committee.list',compact('students','inst','id'));
    }
	
	 public function committee_show($id, $ids){
        $recorde = studentRegistration::findOrFail($id);
        $courses = DB::table('courses')->where('display',1)->get();
        $stateName = DB::table('state_master')->where('statecd',$recorde->statecd)->distinct('statecd')->get();
        $disticName = DB::table('district_master')->where('districtcd',$recorde->districtcd)->distinct('statecd')->get();         
        $country = DB::table('country')->where('countrycd',$recorde->country)->get();   
        $course = DB::table('courses')->where('course_id',$recorde->course)->distinct('course_id')->get();     
        return view('backend.nref.Admin.studentInstitute.committee.show',compact('recorde','stateName','disticName','ids','country','course','courses'));
    }
	
    public function forward_committee_ins($id){
         $inst = DB::table('institute_details')
						->leftJoin('user_credential', 'institute_details.user_id', '=', 'user_credential.id')
						->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
						->select('registration.institute_name','institute_details.institute_id')
						->where('institute_details.status_id',3)
						->get();
        $students = DB::table('studentregistrations')->where('officer_role_id','!=',3)->where('officer_role_id','!=',5)->where('status_id',"1")->where('institute_id',$id)->orderBy('id','desc')->get();

        return view('backend.nref.Admin.studentInstitute.committee.list',compact('students','inst','id'));
    }

// /***********************Application Forward to committe End*********************//

// /***********************Application Committee recommanded Student*********************//
   public function committee_recom(Request $request)
   {

        $id = $request->findStudentInst;
        if(!empty($request->findStudentInst)){
            $inst = DB::table('institute_details')
						->leftJoin('user_credential', 'institute_details.user_id', '=', 'user_credential.id')
						->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
						->select('registration.institute_name','institute_details.institute_id')
						->where('institute_details.status_id',1)
						->get();
            $students = DB::table('studentregistrations')->where('institute_id',$request->findStudentInst)->where('officer_role_id',5)->where('status_id',"1")->orderBy('id','desc')->get();

        
        }else{
            $inst = DB::table('institute_details')
						->leftJoin('user_credential', 'institute_details.user_id', '=', 'user_credential.id')
						->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
						->select('registration.institute_name','institute_details.institute_id')
						->where('institute_details.status_id',1)
						->get();
            $students = DB::table('studentregistrations')->where('officer_role_id',5)->where('status_id',"1")->orderBy('id','desc')->get();
		
        }
		return view('backend.nref.Admin.studentInstitute.committee_recom.list',compact('students','inst','id'));
    }
	
   public function committee_recom_show($id, $ids){
        $recorde = studentRegistration::findOrFail($id);
        $courses = DB::table('courses')->where('display',1)->get();
        $stateName = DB::table('state_master')->where('statecd',$recorde->statecd)->distinct('statecd')->get();
        $disticName = DB::table('district_master')->where('districtcd',$recorde->districtcd)->distinct('statecd')->get();         
        $country = DB::table('country')->where('countrycd',$recorde->country)->get();   
        $course = DB::table('courses')->where('course_id',$recorde->course)->distinct('course_id')->get();     
        return view('backend.nref.Admin.studentInstitute.committee_recom.show',compact('recorde','stateName','disticName','ids','country','course','courses'));
    }
	
    public function committee_recom_ins($id){
         $inst = DB::table('institute_details')
						->leftJoin('user_credential', 'institute_details.user_id', '=', 'user_credential.id')
						->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
						->select('registration.institute_name','institute_details.institute_id')
						->where('institute_details.status_id',1)
						->get();
        $students = DB::table('studentregistrations')->where('officer_role_id',5)->where('status_id',"1")->where('institute_id',$id)->orderBy('id','desc')->get();

        return view('backend.nref.Admin.studentInstitute.committee_recom.list',compact('students','inst','id'));
    }

// /***********************Application Committee recommanded Student End*********************//
   
// /***********************Application Final Selected Student*********************//
	public function final_selected(Request $request)
   {
        $id = $request->findStudentInst;
        if(!empty($request->findStudentInst)){
            $inst = DB::table('institute_details')
						->leftJoin('user_credential', 'institute_details.user_id', '=', 'user_credential.id')
						->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
						->select('registration.institute_name','institute_details.institute_id')
						->where('institute_details.status_id',3)
						->get();
            $students = DB::table('studentregistrations')->where('institute_id',$request->findStudentInst)->where('status_id',"3")->orderBy('id','desc')->get();

        
        }else{
            $inst = DB::table('institute_details')
						->leftJoin('user_credential', 'institute_details.user_id', '=', 'user_credential.id')
						->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
						->select('registration.institute_name','institute_details.institute_id')
						->where('institute_details.status_id',3)
						->get();
            $students = DB::table('studentregistrations')->where('status_id',"3")->orderBy('id','desc')->get();
		
        }
		return view('backend.nref.Admin.studentInstitute.final-selected.list',compact('students','inst','id'));
    }
	
	 public function final_selected_show($id, $ids){
        $recorde = studentRegistration::findOrFail($id);
        $courses = DB::table('courses')->where('display',1)->get();
        $stateName = DB::table('state_master')->where('statecd',$recorde->statecd)->distinct('statecd')->get();
        $disticName = DB::table('district_master')->where('districtcd',$recorde->districtcd)->distinct('statecd')->get();         
        $country = DB::table('country')->where('countrycd',$recorde->country)->get();   
        $course = DB::table('courses')->where('course_id',$recorde->course)->distinct('course_id')->get();     
        return view('backend.nref.Admin.studentInstitute.final-selected.show',compact('recorde','stateName','disticName','ids','country','course','courses'));
    }
	
    public function final_selected_ins($id){
         $inst = DB::table('institute_details')
						->leftJoin('user_credential', 'institute_details.user_id', '=', 'user_credential.id')
						->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
						->select('registration.institute_name','institute_details.institute_id')
						->where('institute_details.status_id',3)
						->get();
        $students = DB::table('studentregistrations')->where('status_id',"3")->where('institute_id',$id)->orderBy('id','desc')->get();

        return view('backend.nref.Admin.studentInstitute.final-selected.list',compact('students','inst','id'));
    }

// /***********************Application Final Selected Student End*********************//

  
// /***********************Application Final Rejected Student*********************//
	public function final_rejected(Request $request)
   {
        $id = $request->findStudentInst;
        if(!empty($request->findStudentInst)){
            $inst = DB::table('institute_details')
						->leftJoin('user_credential', 'institute_details.user_id', '=', 'user_credential.id')
						->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
						->select('registration.institute_name','institute_details.institute_id')
						->where('institute_details.status_id',3)
						->get();
            $students = DB::table('studentregistrations')->where('institute_id',$request->findStudentInst)->where('status_id',"2")->where('officer_role_id','!=',3)->orderBy('id','desc')->get();

        
        }else{
            $inst = DB::table('institute_details')
						->leftJoin('user_credential', 'institute_details.user_id', '=', 'user_credential.id')
						->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
						->select('registration.institute_name','institute_details.institute_id')
						->where('institute_details.status_id',3)
						->get();
            $students = DB::table('studentregistrations')->where('status_id',"2")->where('officer_role_id','!=',3)->orderBy('id','desc')->get();
		
        }
		return view('backend.nref.Admin.studentInstitute.final-rejected.list',compact('students','inst','id'));
    }
	
	 public function final_rejected_show($id, $ids){
        $recorde = studentRegistration::findOrFail($id);
        $courses = DB::table('courses')->where('display',1)->get();
        $stateName = DB::table('state_master')->where('statecd',$recorde->statecd)->distinct('statecd')->get();
        $disticName = DB::table('district_master')->where('districtcd',$recorde->districtcd)->distinct('statecd')->get();         
        $country = DB::table('country')->where('countrycd',$recorde->country)->get();   
        $course = DB::table('courses')->where('course_id',$recorde->course)->distinct('course_id')->get();     
        return view('backend.nref.Admin.studentInstitute.final-rejected.show',compact('recorde','stateName','disticName','ids','country','course','courses'));
    }
	
    public function final_rejected_ins($id){
         $inst = DB::table('institute_details')
						->leftJoin('user_credential', 'institute_details.user_id', '=', 'user_credential.id')
						->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
						->select('registration.institute_name','institute_details.institute_id')
						->where('institute_details.status_id',3)
						->get();
        $students = DB::table('studentregistrations')->where('status_id',"2")->where('officer_role_id','!=',3)->where('institute_id',$id)->orderBy('id','desc')->get();

        return view('backend.nref.Admin.studentInstitute.final-rejected.list',compact('students','inst','id'));
    }

// /***********************Application Final Selected Student End*********************//
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
	
    public function consider(Request $request){
           
        $condidate_id = $request->studentId;
		$status_id = $request->status_id;
        $redirect_url = $request->redirect_url;
        $backPage = $request->backPage;
        $condidateRecord = studentRegistration::findOrFail($condidate_id);
          
        $officer_id = Auth::id();
        $roleid = \App\User::with('roles')->find($officer_id);
         
		 if($status_id == "3"){
		 $student_data = DB::table('studentregistrations')->where('id', $condidate_id)->get()->first();
			$loginuseer  = Auth::user();
			$student_data->selected_by = $loginuseer->id;
			$student_data->status = $status_id; 
			$student_data->selected_by_role = $roleid->role;
			$student_data->scheme_code = "3"; 
			$student_data->modified_by = $loginuseer->id;
			$student_data->modified_by = $loginuseer->id;
			$student_data->modified_date = date('Y-m-d');
			$user = DB::table("selected_student_application")->insert(get_object_vars($student_data));
		 }
        $studentVerification = array(
            'candidate_id'=>$condidateRecord->id,
            'institute_id'=>$condidateRecord->institute_id,
            'officer_id'=>$officer_id,
            'officer_role_id'=>$roleid->role,
            'status_application'=>$status_id,
            'remarks'=>$request->remarks,
            'scheme_code'=>'3',
            'verified_date'=>date('Y-m-d')
            
        );

        $student = array('officer_id'=>$officer_id,
            'officer_role_id'=>$roleid->role,'status_id'=>$status_id);

        DB::table('studentregistrations')->where('id',$condidateRecord->id)->update($student);
        DB::table('internship_verification')->insert($studentVerification);
        // return \Redirect::route('get-instituteId', [$request->backPage])->with('message', 'Student consider status updated successfully.!!!');
		return redirect($redirect_url)->with('success','Student consider status updated successfully.!!!');
    }

    public function nonConsider(Request $request){
         
        $condidate_id = $request->studentId;
        $backPage = $request->backPage;
		$status_id = $request->status_id;
		$redirect_url = $request->redirect_url;
		// dd($redirect_url);
        $condidateRecord = studentRegistration::findOrFail($condidate_id);
          
        $officer_id = Auth::id();
        $roleid = \App\User::with('roles')->find($officer_id);
         
        $studentVerification = array(
            'candidate_id'      =>$condidateRecord->id,
            'institute_id'      =>$condidateRecord->institute_id,
            'officer_id'        =>$officer_id,
            'officer_role_id'   =>$roleid->role,
            'status_application'=>$status_id,
            'reason'            => $request->reason,
            'remarks'           =>$request->remarks,
            'scheme_code'       =>'3',
            'verified_date'     =>date('Y-m-d')
            
        );
         $student = array('officer_id'=>$officer_id,
            'officer_role_id'=>$roleid->role,'status_id'=>$status_id,);

        DB::table('studentregistrations')->where('id',$condidateRecord->id)->update($student);
        DB::table('internship_verification')->insert($studentVerification);
		return redirect($redirect_url)->with('success','Student Non consider status updated successfully.!!!');
        // return \Redirect::route('get-instituteId', [$request->backPage])->with('message', 'Student Non consider status updated successfully.!!!');
    }
}
