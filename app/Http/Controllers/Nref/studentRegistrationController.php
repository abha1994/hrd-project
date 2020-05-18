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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bank_mandate_form(Request $request)
    {
		 
		   $transactionResult = DB::transaction(function() use ($request) { 
		   $records = $request->all();
		   $institute_id =  Auth::id();
			   if($request->hasFile('bankMandate')) {
						$image = $request->file('bankMandate');
						$bankMandate = $institute_id.'_'.$request->student_id.'_'.'3'.'_bankMandate.'.$image->getClientOriginalExtension();
						$destinationPath = public_path('/../public/uploads/nref/student_registration/bankMandate');
						$imagePath = $destinationPath. "/".  $bankMandate;
						$image->move($destinationPath, $bankMandate);
						$records1['bankMandate'] = $bankMandate;
				}
				$records1['is_bank_details_fill'] = "2";
				$updateQuery=DB::table('studentregistrations')
					->where(['id' => $request->student_id,'institute_id' =>$request->institute_id,'user_id' =>$request-> user_id])
					->update($records1);
					
			    
					
					
				if($updateQuery)
				{
				 	return back()->with('message','Bank Mandate Form Uploaded successfully !');
				}else{
					return back()->with('error','Bank Mandate Form Not uploaded');
				}
			
	    });
		return $transactionResult;
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
		 $transactionResult = DB::transaction(function() use ($request) {
		$logID=Auth::id();
		// dd($logID);
		$instID= DB::table('institute_details')->where('user_id', $logID)->first();
		// dd($instID);
		if(count(array($instID))>0)
		{
			$institiuteID=$instID->institute_id;
		}
		else{
			$institiuteID=="";
		}
         
       // dd($request->all());
         $this->validate($request,[
            'firstname'  =>  'required|max:50',
            'gender'=> 'required',
            'email_id' => 'required|email|unique:studentregistrations',
            // 'mobile' => 'required|numeric|min:10|max:10|unique:users,mobile_number,'.$user->id,
            'mobile' => 'required|numeric|min:10|unique:studentregistrations',
            'address' => 'required|max:150',
            'dob' => 'required',
            'doj' =>'required',
            'state' => 'required|not_in:0',
            'distric' => 'required|not_in:Select',
            'pincode' => 'required|regex:/\b\d{6}\b/',
            //'accountNo' => 'required|digits:10',
            //'ifscCode' =>'required|regex:/^[A-Za-z]{4}\d{7}$/',             
            //'gate_neet' => 'required|max:1024|mimes:doc,docx,pdf',
            'highest_qulification' => 'required|max:1024|mimes:doc,docx,pdf',
            'aadhar' => 'required|string|max:14|unique:studentregistrations',
            // 'bankMandate' => 'required|max:1024|mimes:doc,docx,pdf',
            //'publication' => 'required|max:1024|mimes:doc,docx,pdf',

         ]);
         
        $records = $request->all();
        date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s');
			
        $records['institute_id'] = $institiuteID;
		$records['user_id'] = $logID;
        $records['dob']= $request->dob;
		$records['doj']= $request->doj;
		
// dd($records);
        studentRegistration::create($records);
		$last_id = DB::getPDO()->lastInsertId();
		if(!empty($last_id)){
		 if($request->hasFile('highest_qulification')) {
				$image = $request->file('highest_qulification');
				$highest_qulification = $institiuteID.'_'.$last_id.'_'.'3'.'_qulification.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/../public/uploads/nref/student_registration/qulification');
				$imagePath = $destinationPath. "/".  $highest_qulification;
				$image->move($destinationPath, $highest_qulification);
				$records1['highest_qulification'] = $highest_qulification;
		}
				
        if($request->hasFile('candidate_declaration')) {
				$image = $request->file('candidate_declaration');
				$candidate_declaration = $institiuteID.'_'.$last_id.'_'.'3'.'_candidate_declaration.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/../public/uploads/nref/student_registration/candidate_declaration');
				$imagePath = $destinationPath. "/".  $candidate_declaration;
				$image->move($destinationPath, $candidate_declaration);
				$records1['candidate_declaration'] = $candidate_declaration;
		}
		
		if($request->hasFile('publication')) {
				$image = $request->file('publication');
				$publication = $institiuteID.'_'.$last_id.'_'.'3'.'_publication.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/../public/uploads/nref/student_registration/publication');
				$imagePath = $destinationPath. "/".  $publication;
				$image->move($destinationPath, $publication);
				$records1['publication'] = $publication;
		}

        if($request->hasFile('student_image')) {
				$image = $request->file('student_image');
				$student_image = $institiuteID.'_'.$last_id.'_'.'3'.'_student_image.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/../public/uploads/nref/student_registration/student_photo');
				$imagePath = $destinationPath. "/".  $student_image;
				$image->move($destinationPath, $student_image);
				$records1['student_image'] = $student_image;
		}
		
		if($request->hasFile('commiteedocument')) {
				$image = $request->file('commiteedocument');
				$commiteedocument = $institiuteID.'_'.$last_id.'_'.'3'.'_commiteedocument.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/../public/uploads/nref/student_registration/commitee_recommanded');
				$imagePath = $destinationPath. "/".  $commiteedocument;
				$image->move($destinationPath, $commiteedocument);
				$records1['commiteedocument'] = $commiteedocument;
		}

        if($request->hasFile('gate')) {
			if ($request->file('gate')->isValid()) {  
				$image = $request->file('gate');
				$gate = $institiuteID.'_'.$last_id.'_'.'3'.'_gate.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/../public/uploads/nref/student_registration/gate');
				$imagePath = $destinationPath. "/".  $gate;
				$image->move($destinationPath, $gate);
				$records1['gate'] = $gate;
			}
		}
		
		if($request->hasFile('net')) {
				$image = $request->file('net');
				$net = $institiuteID.'_'.$last_id.'_'.'3'.'_net.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/../public/uploads/nref/student_registration/net');
				$imagePath = $destinationPath. "/".  $net;
				$image->move($destinationPath, $net);
				$records1['net'] = $net;
		}
		
		if($request->hasFile('experience')) {
				$image = $request->file('experience');
				$experience = $institiuteID.'_'.$last_id.'_'.'3'.'_experience.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/../public/uploads/nref/student_registration/experience');
				$imagePath = $destinationPath. "/".  $experience;
				$image->move($destinationPath, $experience);
				$records1['experience'] = $experience;
		}
		$records1['created_date']= $date;
		$records1['scheme_code']= "3";
		    DB::table('studentregistrations')->where('id',$last_id)->update($records1); 
            		
		}
		return redirect()->route('student-registration.index')
                          ->with('message','Your registration  created successfully.');
		  });
	   return $transactionResult;
        
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
        $courses = DB::table('courses')->where('display',1)->get();
        $stateName = DB::table('state_master')->where('statecd',$recorde->state)->distinct('statecd')->get();
        $disticName = DB::table('district_master')->where('districtcd',$recorde->distric)->distinct('statecd')->get();         
         
        return view('backend.nref.studentRregistration.show',compact('recorde','stateName','disticName','courses'));
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
            'firstname'  =>  'required|max:50',
            'gender'=> 'required',
            'email_id' => 'required|email|unique:studentregistrations,email_id,'.$records->id,
            ////'mobile' => 'required|numeric|min:10|max:10|unique:users,mobile_number,'.$user->id,
            'mobile' => 'required|numeric|min:10|unique:studentregistrations,mobile,'.$records->id,
            'address' => 'required|max:150',
            'dob' => 'required',
            'doj' =>'required',
            'state' => 'required|not_in:0',
            'distric' => 'required|not_in:Select',
            'pincode' => 'required|regex:/\b\d{6}\b/',
            //'accountNo' => 'required|digits:10',
            //'ifscCode' =>'required|regex:/^[A-Za-z]{4}\d{7}$/',             
            //'gate_neet' => 'required|max:1024|mimes:doc,docx,pdf',
            //'highest_qulification' => 'required|max:1024|mimes:doc,docx,pdf',
            'aadhar' => 'required|string|max:14|unique:studentregistrations,aadhar,'.$records->id,
            //'bankMandate' => 'required|max:1024|mimes:doc,docx,pdf',
           // 'publication' => 'required|max:1024|mimes:doc,docx,pdf',

         ]);
          
	 if($request->hasFile('highest_qulification')) {
				$image = $request->file('highest_qulification');
				$highest_qulification = $institiuteID.'_'.$last_id.'_'.'3'.'_qulification.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/../public/uploads/nref/student_registration/qulification');
				$imagePath = $destinationPath. "/".  $highest_qulification;
				$image->move($destinationPath, $highest_qulification);
				$records['highest_qulification'] = $highest_qulification;
		}
				
        if($request->hasFile('candidate_declaration')) {
				$image = $request->file('candidate_declaration');
				$candidate_declaration = $institiuteID.'_'.$last_id.'_'.'3'.'_candidate_declaration.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/../public/uploads/nref/student_registration/candidate_declaration');
				$imagePath = $destinationPath. "/".  $candidate_declaration;
				$image->move($destinationPath, $candidate_declaration);
				$records['candidate_declaration'] = $candidate_declaration;
		}
		
		if($request->hasFile('publication')) {
				$image = $request->file('publication');
				$publication = $institiuteID.'_'.$last_id.'_'.'3'.'_publication.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/../public/uploads/nref/student_registration/publication');
				$imagePath = $destinationPath. "/".  $publication;
				$image->move($destinationPath, $publication);
				$records['publication'] = $publication;
		}

        if($request->hasFile('student_image')) {
				$image = $request->file('student_image');
				$student_image = $institiuteID.'_'.$last_id.'_'.'3'.'_student_image.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/../public/uploads/nref/student_registration/student_photo');
				$imagePath = $destinationPath. "/".  $student_image;
				$image->move($destinationPath, $student_image);
				$records['student_image'] = $student_image;
		}
		
		if($request->hasFile('commiteedocument')) {
				$image = $request->file('commiteedocument');
				$commiteedocument = $institiuteID.'_'.$last_id.'_'.'3'.'_commiteedocument.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/../public/uploads/nref/student_registration/commitee_recommanded');
				$imagePath = $destinationPath. "/".  $commiteedocument;
				$image->move($destinationPath, $commiteedocument);
				$records['commiteedocument'] = $commiteedocument;
		}

        if($request->hasFile('gate')) {
			if ($request->file('gate')->isValid()) {  
				$image = $request->file('gate');
				$gate = $institiuteID.'_'.$last_id.'_'.'3'.'_gate.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/../public/uploads/nref/student_registration/gate');
				$imagePath = $destinationPath. "/".  $gate;
				$image->move($destinationPath, $gate);
				$records['gate'] = $gate;
			}
		}
		
		if($request->hasFile('net')) {
				$image = $request->file('net');
				$net = $institiuteID.'_'.$last_id.'_'.'3'.'_net.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/../public/uploads/nref/student_registration/net');
				$imagePath = $destinationPath. "/".  $net;
				$image->move($destinationPath, $net);
				$records['net'] = $net;
		}
		
		if($request->hasFile('experience')) {
				$image = $request->file('experience');
				$experience = $institiuteID.'_'.$last_id.'_'.'3'.'_experience.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/../public/uploads/nref/student_registration/experience');
				$imagePath = $destinationPath. "/".  $experience;
				$image->move($destinationPath, $experience);
				$records['experience'] = $experience;
		}

        date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s');
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
				'aadhar'=>$request->aadhar,
				'category'=>$request->category,
				'highest_qulification'=>$records['highest_qulification'],
				'publication'=>$records['publication'],
				// 'bankMandate'=>$record['bankMandate'],
				'student_image'=> $records['student_image'],
				'commiteedocument'=> $records['commiteedocument'],
				'gate'=>$records['gate'],
				'net'=>$records['net'],
				'experience'=>$records['experience'],
				'candidate_declaration'=>$records['candidate_declaration'],
				'user_id' =>Auth::id(),
				'doj'=>$request->doj,
				'modified_date'=>$date,
				'modified_by'=>Auth::id(),
				'scheme_code'=>3,
			);
			 DB::table('studentregistrations')->where('id',$id)->update($row); 
		 
            return redirect()->route('student-registration.index')
                        ->with('message','Student registration updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
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
     
        $data = $request->email_id;
		$hidden_id = $request->hidden_id;
		// dd($hidden_id);
		 if($data){
			 if($hidden_id == null){
               $result =DB::table('studentregistrations')->where('email_id',$data)->count(); 
			 }else{
				$result =DB::table('studentregistrations')->where('email_id',$data)->where('id','!=',$hidden_id)->count();  
			 }
			if($result>0){
               echo "<span style='color:red'>Email id all ready exit in database</span>" ;// 
			   // return Response::json('Email id all ready exit in database');
			   // return false;
            }else{
               echo "<span style='color:green'>Congratulation email id not exit in database</span>"; 
			   // return true;
			   // return Response::json('<span style="color:green">Congratulation email id not exit in database</span>');   
            }
        }      
 
    }

    public function validateMobile(Request $request){
        $data = $request->mobile;
		$hidden_id = $request->hidden_id;
         if($data){
			 if($hidden_id == null){
                $result =DB::table('studentregistrations')->where('mobile',$data)->count();
			 }else{
				$result =DB::table('studentregistrations')->where('mobile',$data)->where('id','!=',$hidden_id)->count();  
			 }
           
            if($result != 0){
				 echo "<span style='color:red'>Mobile all ready exit in database</span>" ;// 
                // return Response::json('Mobile all ready exit in database');
            }else{
				 echo "<span style='color:green'>Congratulation mobile not exit in database</span>"; 
                // return Response::json('<span style="color:green">Congratulation mobile not exit in database</span>');   
            }
        }      
 
    }
	
	 public function validateAadhar(Request $request){
        $data = $request->aadhar;
		$hidden_id = $request->hidden_id;
         $row = DB::table('studentregistrations')->where('aadhar',$data)->get() ;
        if($data){
			 if($hidden_id == null){
                 $result =DB::table('studentregistrations')->where('aadhar',$data)->count();
			 }else{
				$result =DB::table('studentregistrations')->where('aadhar',$data)->where('id','!=',$hidden_id)->count();  
			 }
           
            if($result>0){
				 echo "<span style='color:red'>Aadhar all ready exit in database</span>" ;// 
                // return Response::json('Aadhar all ready exit in database');
            }else{
				 echo "<span style='color:green'>Congratulation aadhar not exit in database</span>"; 
               // return Response::json('<span style="color:green">Congratulation aadhar not exit in database</span>');   
            }
        }      
 
    }
	
}
