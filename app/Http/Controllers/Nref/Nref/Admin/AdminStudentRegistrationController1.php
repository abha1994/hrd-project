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
	 function __construct()
    {
         $this->middleware('permission:studentregistration-list|studentregistration-create|studentregistration-edit|studentregistration-delete', ['only' => ['index','show']]);
         $this->middleware('permission:studentregistration-create', ['only' => ['create','store']]);
         $this->middleware('permission:studentregistration-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:studentregistration-delete', ['only' => ['destroy']]);


    }
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $country = DB::table('country')->get();
        $states = DB::table('state_master')->get();
        $distric = DB::table('district_master')->get();
        $courses = DB::table('courses')->where('display',1)->get();

        return view('backend.nref.studentRregistration.create',compact('country','states','distric','courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         
       // dd($request->all());
         $this->validate($request,[
            'firstname'  =>  'required|min:4|max:50',
            'gender'=> 'required|in:male,female',
           // 'email_id' => 'required|email|unique:studentregistrations',
            // 'mobile' => 'required|numeric|min:10|max:10|unique:users,mobile_number,'.$user->id,
            'mobile' => 'required|numeric|min:10|unique:studentregistrations',
            'address' => 'required|min:20|max:150',
            'dob' => 'required',
            //'bankName' =>'required',
            'state' => 'required|not_in:0',
            'distric' => 'required|not_in:Select',
            'pincode' => 'required|regex:/\b\d{6}\b/',
            //'accountNo' => 'required|digits:10',
            //'ifscCode' =>'required|regex:/^[A-Za-z]{4}\d{7}$/',             
            //'gate_neet' => 'required|max:1024|mimes:doc,docx,pdf',
            'highest_qulification' => 'required|max:1024|mimes:doc,docx,pdf',
            'aadhar' => 'required|string|max:14',
            'bankMandate' => 'required|max:1024|mimes:doc,docx,pdf',
            //'publication' => 'required|max:1024|mimes:doc,docx,pdf',

         ]);
        
         $records = $request->all();
 
         if ($request->hasFile('gate_neet')) {
            if ($request->file('gate_neet')->isValid()) {
             
                $fileName=$request->file('gate_neet')->getClientOriginalName();
                $fileName =time()."_".$fileName;
                    //upload
                $request->file('gate_neet')->move('uploads/nref/student_registration', $fileName);
                    //column name 
                $records['gate_neet']=$fileName;
                
            }
        } //Gate and Neet Document

        if ($request->hasFile('highest_qulification')) {
            if ($request->file('highest_qulification')->isValid()) {
             
                $fileName=$request->file('highest_qulification')->getClientOriginalName();
                $fileName =time()."_".$fileName;
                    //upload
                $request->file('highest_qulification')->move('uploads/nref/student_registration', $fileName);
                    //column name 
                $records['highest_qulification']=$fileName;
                
            }
        } //highest Qulification Document

         if ($request->hasFile('aadhar')) {
            if ($request->file('aadhar')->isValid()) {
             
                $fileName=$request->file('aadhar')->getClientOriginalName();
                $fileName =time()."_".$fileName;
                    //upload
                $request->file('aadhar')->move('uploads/nref/student_registration', $fileName);
                    //column name 
                $records['aadhar']=$fileName;
                
            }
        } //Aadhar Document

        if ($request->hasFile('bankMandate')) {
            if ($request->file('bankMandate')->isValid()) {
             
                $fileName=$request->file('bankMandate')->getClientOriginalName();
                $fileName =time()."_".$fileName;
                    //upload
                $request->file('bankMandate')->move('uploads/nref/student_registration', $fileName);
                    //column name 
                $records['bankMandate']=$fileName;
                
            }
        } //Bank Mandate Document

        if ($request->hasFile('publication')) {
            if ($request->file('publication')->isValid()) {
             
                $fileName=$request->file('publication')->getClientOriginalName();
                $fileName =time()."_".$fileName;
                    //upload
                $request->file('publication')->move('uploads/nref/student_registration', $fileName);
                    //column name 
                $records['publication']=$fileName;
                
            }
        } //Bank Mandate Document

        //$all_data =  Session::get('userdata');       
 

        $records['nref_id'] = Auth::id();
        $records['dob']= date('Y-m-d', strtotime($request->dob));
         
        studentRegistration::create($records);
         return redirect()->route('student-registration.index')
                        ->with('message','Your registration  created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recorde = studentRegistration::findOrFail($id);
        //dd($recorde->state);
        //dd($recorde);
        $stateName = DB::table('state_master')->where('statecd',$recorde->state)->distinct('statecd')->get();
        $disticName = DB::table('district_master')->where('districtcd',$recorde->distric)->distinct('statecd')->get();         
         
        return view('backend.nref.Admin.studentInstitute.show',compact('recorde','stateName','disticName'));
    }

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

        $records = studentRegistration::find($id);

          
        $this->validate($request,[
            'firstname'  =>  'required|min:4|max:50',
            'gender'=> 'required|in:male,female',
            //'email_id' => 'required|email|unique:studentregistrations,email_id,'.$records->id,
            //'mobile' => 'required|numeric|min:10|max:10|unique:users,mobile_number,'.$user->id,
            //'mobile' => 'required|numeric|min:10|unique:studentregistrations,mobile,'.$records->id,
            'address' => 'required|min:20|max:150',
            'dob' => 'required',
            //'bankName' =>'required',
            'state' => 'required|not_in:0',
            'distric' => 'required|not_in:Select',
            'pincode' => 'required|regex:/\b\d{6}\b/',
            //'accountNo' => 'required|digits:10',
            //'ifscCode' =>'required|regex:/^[A-Za-z]{4}\d{7}$/',             
            //'gate_neet' => 'required|max:1024|mimes:doc,docx,pdf',
            //'highest_qulification' => 'required|max:1024|mimes:doc,docx,pdf',
            'aadhar' => 'required|string|max:14',
            //'bankMandate' => 'required|max:1024|mimes:doc,docx,pdf',
           // 'publication' => 'required|max:1024|mimes:doc,docx,pdf',

         ]);
          
      if ($request->hasFile('gate_neet')) {
            if ($request->file('gate_neet')->isValid()) {
             
                $fileName=$request->file('gate_neet')->getClientOriginalName();
                $fileName =time()."_".$fileName;
                    //upload
                $request->file('gate_neet')->move('uploads/nref/student_registration', $fileName);
                    //column name 
                $records['gate_neet']=$fileName;
                
            }
        } //Gate and Neet Document

        if ($request->hasFile('highest_qulification')) {
            if ($request->file('highest_qulification')->isValid()) {
             
                $fileName=$request->file('highest_qulification')->getClientOriginalName();
                $fileName =time()."_".$fileName;
                    //upload
                $request->file('highest_qulification')->move('uploads/nref/student_registration', $fileName);
                    //column name 
                $records['highest_qulification']=$fileName;
                
            }
        } //highest Qulification Document

         if ($request->hasFile('aadhar')) {
            if ($request->file('aadhar')->isValid()) {
             
                $fileName=$request->file('aadhar')->getClientOriginalName();
                $fileName =time()."_".$fileName;
                    //upload
                $request->file('aadhar')->move('uploads/nref/student_registration', $fileName);
                    //column name 
                $records['aadhar']=$fileName;
                
            }
        } //Aadhar Document

        if ($request->hasFile('bankMandate')) {
            if ($request->file('bankMandate')->isValid()) {
             
                $fileName=$request->file('bankMandate')->getClientOriginalName();
                $fileName =time()."_".$fileName;
                    //upload
                $request->file('bankMandate')->move('uploads/nref/student_registration', $fileName);
                    //column name 
                $records['bankMandate']=$fileName;
                
            }
        } //Bank Mandate Document

        if ($request->hasFile('publication')) {
            if ($request->file('publication')->isValid()) {
             
                $fileName=$request->file('publication')->getClientOriginalName();
                $fileName =time()."_".$fileName;
                    //upload
                $request->file('publication')->move('uploads/nref/student_registration', $fileName);
                    //column name 
                $records['publication']=$fileName;
                
            }
        } //Bank Mandate Document

        $records->firstname = $request->firstname;
        $records->middlename = $request->middlename;
        $records->lastname = $request->lastname;
        $records->gender = $request->gender;
        $records->email_id = $request->email_id;
        $records->mobile = $request->mobile;
        $records->address = $request->address;
        $records->dob = $request->dob;
        $records->country = $request->country;
        $records->state = $request->state;
        $records->distric = $request->distric;
        $records->gate_neet = $records['gate_neet'];
        $records->highest_qulification = $records['highest_qulification'];
        $records->bankMandate = $records['bankMandate'];
        $records->publication = $records['publication'];
        $records->aadhar = $request->aadhar;
        //$records->nref_id = $request->nref_id;
           
        $records->save();

        //return redirect()->route('get-instituteId.$ids')->with('message','Student registration updated successfully.');
        $history = array('studentregistration_id'=>$records->id,'institute_id'=>$records->institute_id,'user_id'=>4,'firstname'=>$request->firstname,'middlename'=>$request->middlename,'lastname'=>$request->lastname,'gender'=>$request->gender,'email_id'=>$request->email_id,'mobile'=>$request->mobile,'address'=>$request->address,'dob'=>$request->dob,'country'=>$request->country,'state'=>$request->state,'distric'=>$request->distric,'gate_neet'=>$records['gate_neet'],'highest_qulification'=>$records['highest_qulification'],'bankMandate'=>$records['bankMandate'],'publication'=>$records['publication'],'aadhar'=>$request->aadhar,'modified_by'=>Auth::user()->id,'modified_date'=>date("Y-m-d H:i:s"),'status'=>1);
         
         
            DB::table('studentregistrations_history')->insert($history);
         
        


        //return Redirect::to('route_name?q='.$append_data)
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
         
        if($data){
            $result =DB::table('studentregistrations')->where('email_id',$data)->count();

            if($result>0){
                return Response::json('Email id all ready exit in database');
            }else{
                return Response::json('<span style="color:green">Congratulation email id not exit in database</span>');   
            }
        }      
 
    }

    public function validateMobile(Request $request){
        //echo 'amresh';
        $data = $request->mobile;
         
        if($data){
            $result =DB::table('studentregistrations')->where('mobile',$data)->count();

            if($result>0){
                return Response::json('Mobile all ready exit in database');
            }else{
                return Response::json('<span style="color:green">Congratulation mobile not exit in database</span>');   
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
         $inst = DB::table('institute_details')->get();
        $students = DB::table('studentregistrations')->where('institute_id',$id)->get();

        return view('backend.nref.Admin.studentInstitute.list',compact('students','inst','id'));
    }


    public function showInstitueStudent($id, $ids){
        
        $recorde = studentRegistration::findOrFail($id);
        //dd($recorde->state);
        //dd($recorde);
        $stateName = DB::table('state_master')->where('statecd',$recorde->state)->distinct('statecd')->get();
        $disticName = DB::table('district_master')->where('districtcd',$recorde->distric)->distinct('statecd')->get();         
         
        return view('backend.nref.Admin.studentInstitute.show',compact('recorde','stateName','disticName','ids'));
    }

    public function consider(Request $request){
          
        $condidate_id = $request->studentId;
        $backPage = $request->backPage;
        $condidateRecord = studentRegistration::findOrFail($condidate_id);
          
        $officer_id = Auth::id();
        $roleid = \App\User::with('roles')->find($officer_id);
         
        $studentVerification = array(
            'candidate_id'=>$condidateRecord->id,
            'institute_id'=>$condidateRecord->institute_id,
            'officer_id'=>$officer_id,
            'officer_role_id'=>$roleid->role,
            'status_application'=>'1',
            'remarks'=>$request->remarks,
            'scheme_code'=>'3',
            'verified_date'=>date('Y-m-d')
            
        );
        $student = array('officer_id'=>$officer_id,
            'officer_role_id'=>$roleid->role,'status_id'=>'1',);

        DB::table('studentregistrations')->where('id',$condidateRecord->id)->update($student);
        DB::table('student_verification')->insert($studentVerification);
        return \Redirect::route('get-instituteId', [$request->backPage])->with('message', 'Student consider status updated successfully.!!!');
    }

    public function nonConsider(Request $request){
         
        $condidate_id = $request->studentId;
        $backPage = $request->backPage;
        $condidateRecord = studentRegistration::findOrFail($condidate_id);
          
        $officer_id = Auth::id();
        $roleid = \App\User::with('roles')->find($officer_id);
         
        $studentVerification = array(
            'candidate_id'      =>$condidateRecord->id,
            'institute_id'      =>$condidateRecord->institute_id,
            'officer_id'        =>$officer_id,
            'officer_role_id'   =>$roleid->role,
            'status_application'=>'2',
            'reason'            => $request->reason,
            'remarks'           =>$request->remarks,
            'scheme_code'       =>'3',
            'verified_date'     =>date('Y-m-d')
            
        );
         $student = array('officer_id'=>$officer_id,
            'officer_role_id'=>$roleid->role,'status_id'=>'2',);

        DB::table('studentregistrations')->where('id',$condidateRecord->id)->update($student);
        DB::table('student_verification')->insert($studentVerification);
        return \Redirect::route('get-instituteId', [$request->backPage])->with('message', 'Student Non consider status updated successfully.!!!');
        //return view('backend.nref.Admin.studentInstitute.list',compact('students','inst','id'));
    }
}
