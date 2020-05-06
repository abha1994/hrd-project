<?php

namespace App\Http\Controllers\Nref;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Nref\studentRegistration;
use App\User;
use DB;
use Response;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;
class studentRegistrationController extends Controller
{
    function __construct()
    {
         

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$login_institute_id = Auth::id();//dd($login_institute_id);
        $students = DB::table('studentregistrations')->where('user_id',$login_institute_id)->orderBy('id','desc')->get();
        return view('backend.nref.studentRregistration.index',compact('students'));
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
		
		$logID=Auth::id();
		
		$instID= DB::table('institute_details')->where('user_id', $logID)->first();
		
		if(count(array($instID))>0)
		{
			$institiuteID=$instID->institute_id;
		}
		else{
			$institiuteID=="";
		}
         
       // dd($request->all());
         $this->validate($request,[
            'firstname'  =>  'required|min:4|max:50',
            'gender'=> 'required|in:male,female',
            'email_id' => 'required|email|unique:studentregistrations',
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
                $request->file('gate_neet')->move('public/uploads/nref/student_registration', $fileName);
                    //column name 
                $records['gate_neet']=$fileName;
                
            }
        } //Gate and Neet Document

        if ($request->hasFile('highest_qulification')) {
            if ($request->file('highest_qulification')->isValid()) {
             
                $fileName=$request->file('highest_qulification')->getClientOriginalName();
                $fileName =time()."_".$fileName;
                    //upload
                $request->file('highest_qulification')->move('public/uploads/nref/student_registration', $fileName);
                    //column name 
                $records['highest_qulification']=$fileName;
                
            }
        } //highest Qulification Document

         if ($request->hasFile('aadhar')) {
            if ($request->file('aadhar')->isValid()) {
             
                $fileName=$request->file('aadhar')->getClientOriginalName();
                $fileName =time()."_".$fileName;
                    //upload
                $request->file('aadhar')->move('public/uploads/nref/student_registration', $fileName);
                    //column name 
                $records['aadhar']=$fileName;
                
            }
        } //Aadhar Document

        if ($request->hasFile('bankMandate')) {
            if ($request->file('bankMandate')->isValid()) {
             
                $fileName=$request->file('bankMandate')->getClientOriginalName();
                $fileName =time()."_".$fileName;
                    //upload
                $request->file('bankMandate')->move('public/uploads/nref/student_registration', $fileName);
                    //column name 
                $records['bankMandate']=$fileName;
                
            }
        } //Bank Mandate Document

        if ($request->hasFile('publication')) {
            if ($request->file('publication')->isValid()) {
             
                $fileName=$request->file('publication')->getClientOriginalName();
                $fileName =time()."_".$fileName;
                    //upload
                $request->file('publication')->move('public/uploads/nref/student_registration', $fileName);
                    //column name 
                $records['publication']=$fileName;
                
            }
        } //Bank Mandate Document

        //$all_data =  Session::get('userdata');
        
 

        
		$records['institute_id'] = $institiuteID;
		$records['user_id'] = $logID;
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
         
        return view('backend.nref.studentRregistration.show',compact('recorde','stateName','disticName'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $student = studentRegistration::findOrFail($id);
         //dd($stuent);
         $country = DB::table('country')->get();
        $states = DB::table('state_master')->get();
        $distric = DB::table('district_master')->get();
        $courses = DB::table('courses')->where('display',1)->get();
         return view('backend.nref.studentRregistration.edit',compact('student','country','states','distric','courses'));
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
		
		$logID=Auth::id();
		
		$instID= DB::table('institute_details')->where('user_id', $logID)->first();
		
		if(count(array($instID))>0)
		{
			$institiuteID=$instID->institute_id;
		}
		else{
			$institiuteID=="";
		}
		
        $records = studentRegistration::find($id);
		
          
        $this->validate($request,[
            'firstname'  =>  'required|min:4|max:50',
            'gender'=> 'required|in:male,female',
            'email_id' => 'required|email|unique:studentregistrations,email_id,'.$records->id,
            ////'mobile' => 'required|numeric|min:10|max:10|unique:users,mobile_number,'.$user->id,
            'mobile' => 'required|numeric|min:10|unique:studentregistrations,mobile,'.$records->id,
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
                $request->file('gate_neet')->move('public/uploads/nref/student_registration', $fileName);
                    //column name 
                $records['gate_neet']=$fileName;
                
            }
        } //Gate and Neet Document

        if ($request->hasFile('highest_qulification')) {
            if ($request->file('highest_qulification')->isValid()) {
             
                $fileName=$request->file('highest_qulification')->getClientOriginalName();
                $fileName =time()."_".$fileName;
                    //upload
                $request->file('highest_qulification')->move('public/uploads/nref/student_registration', $fileName);
                    //column name 
                $records['highest_qulification']=$fileName;
                
            }
        } //highest Qulification Document

         if ($request->hasFile('aadhar')) {
            if ($request->file('aadhar')->isValid()) {
             
                $fileName=$request->file('aadhar')->getClientOriginalName();
                $fileName =time()."_".$fileName;
                    //upload
                $request->file('aadhar')->move('public/uploads/nref/student_registration', $fileName);
                    //column name 
                $records['aadhar']=$fileName;
                
            }
        } //Aadhar Document

        if ($request->hasFile('bankMandate')) {
            if ($request->file('bankMandate')->isValid()) {
             
                $fileName=$request->file('bankMandate')->getClientOriginalName();
                $fileName =time()."_".$fileName;
                    //upload
                $request->file('bankMandate')->move('public/uploads/nref/student_registration', $fileName);
                    //column name 
                $records['bankMandate']=$fileName;
                
            }
        } //Bank Mandate Document

        if ($request->hasFile('publication')) {
            if ($request->file('publication')->isValid()) {
             
                $fileName=$request->file('publication')->getClientOriginalName();
                $fileName =time()."_".$fileName;
                    //upload
                $request->file('publication')->move('public/uploads/nref/student_registration', $fileName);
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
        $records->institute_id = $institiuteID;
		$records->user_id = Auth::id();
          
        $records->save();
        return redirect()->route('student-registration.index')
                        ->with('message','Student registration updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         studentRegistration::destroy($id);
         return redirect()->route('student-registration.index')->with('message','Student detail deleted successfully !');
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
}
