<?php

namespace App\Http\Controllers\shortterm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\shortterm\studentRegistration;
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
		try{
			$login_user_id = Auth::id();
			$short_term_data = DB::table('short_term_program')->where('user_id',$login_user_id)->where('status_id','3')->get()->first();
			$short_term_id = $short_term_data->short_term_id;
			
			$students = DB::table('studentregistrations')->where('institute_id',$short_term_id)->where('user_id',$login_user_id)->where('scheme_code','4')->orderBy('id','desc')->get();
			
			//**********Save Data into audtitrail_tbl************//
				$audtitrail_tbl_post = array('status'=>'0','scheme_code'=>'4','action_type1'=>'5','desc'=>'List Of Student Registration Form');
				audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************// 
			
			return view('backend.shortterm.studentRregistration.index',compact('students'));
        }catch(\Exception $ex) {
			//**********Save Data into audtitrail_tbl************//
				$audtitrail_tbl_post = array('status'=>'1','scheme_code'=>'4','action_type1'=>'5','desc'=>'List Of Student Registration Form Not Working');
				audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************// 

	      return redirect('error');// dd('Message', $ex->getMessage());
	    }
    }
	
	 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		try{
			$country = DB::table('country')->get();
			$states = DB::table('state_master')->get();
			$distric = DB::table('district_master')->get();
			
			//**********Save Data into audtitrail_tbl************//
				$audtitrail_tbl_post = array('status'=>'0','scheme_code'=>'4','action_type1'=>'2','desc'=>'Add Student Registration Form View');
				audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************// 
			
			return view('backend.shortterm.studentRregistration.create',compact('country','states','distric'));
		}catch(\Exception $ex) {
			//**********Save Data into audtitrail_tbl************//
				$audtitrail_tbl_post = array('status'=>'1','scheme_code'=>'4','action_type1'=>'2','desc'=>'Add Student Registration Form View Not Working');
				audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************// 

	        return redirect('error');// dd('Message', $ex->getMessage());
	    }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		try{
		$transactionResult = DB::transaction(function() use ($request) {
		$logID=Auth::id();
		$short_term_id = DB::table('short_term_program')->where('user_id',$logID)->where('status_id','3')->get()->first()->short_term_id;
		
		
		if(count(array($short_term_id))>0)
		{
			$institiuteID=$short_term_id;
		}
		else{
			$institiuteID=="";
		}
         
       
         $this->validate($request,[
            'firstname'  =>  'required|max:50',
            'gender'=> 'required',
			'participant_status'=> 'required',
			'email_id' => 'required|email|unique:studentregistrations',
            'mobile' => 'required|numeric|min:10|unique:studentregistrations',
            'address' => 'required|max:150',
			'dob' => 'required',
            'statecd' => 'required|not_in:0',
            'districtcd' => 'required|not_in:Select',
            'pincode' => 'required|regex:/\b\d{6}\b/',
            'aadhar' => 'required|string|max:14|unique:studentregistrations',
            

         ]);
         
        $records = $request->all();
        date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s');
			
        $records['institute_id'] = $institiuteID;
		$records['user_id'] = $logID;
		$records['dob']= $request->dob;
      
		

        studentRegistration::create($records);
		$last_id = DB::getPDO()->lastInsertId();
		if(!empty($last_id)){
		 
				
        if($request->hasFile('upload_aadhar')) {
				$image = $request->file('upload_aadhar');
				$upload_aadhar = $institiuteID.'_'.$last_id.'_'.'4'.'_upload_aadhar.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/../public/uploads/shortterm/student_registration/upload_aadhar');
				$imagePath = $destinationPath. "/".  $upload_aadhar;
				$image->move($destinationPath, $upload_aadhar);
				$records1['upload_aadhar'] = $upload_aadhar;
		}
		 if($request->hasFile('student_image')) {
				$image = $request->file('student_image');
				$student_image = $institiuteID.'_'.$last_id.'_'.'4'.'_student_image.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/../public/uploads/shortterm/student_registration/student_photo');
				$imagePath = $destinationPath. "/".  $student_image;
				$image->move($destinationPath, $student_image);
				$records1['student_image'] = $student_image;
		}
		
		
		$records1['created_date']= $date;
		$records1['scheme_code']= "4";
		    DB::table('studentregistrations')->where('id',$last_id)->update($records1); 
            		
		}
		//**********Save Data into audtitrail_tbl************//
			$audtitrail_tbl_post = array('status'=>'0','scheme_code'=>'4','action_type1'=>'2','desc'=>'Student Registration Form Submit Successfully');
			audtitrail_tbl_history($audtitrail_tbl_post);
		//**********Save Data into audtitrail_tbl************// 
		return redirect()->route('st-student-registration.index')
                          ->with('message','Your registration  created successfully.');
		  });
	       return $transactionResult;
	    }catch(\Exception $ex) {
			//**********Save Data into audtitrail_tbl************//
				$audtitrail_tbl_post = array('status'=>'1','scheme_code'=>'4','action_type1'=>'2','desc'=>'Student Registration Form Submission Not Working');
				audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************// 

	        return redirect('error');// dd('Message', $ex->getMessage());
	    }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
			$recorde = studentRegistration::findOrFail($id);
			$stateName = DB::table('state_master')->where('statecd',$recorde->statecd)->distinct('statecd')->get();
			$disticName = DB::table('district_master')->where('districtcd',$recorde->districtcd)->distinct('statecd')->get();         
			//**********Save Data into audtitrail_tbl************//
				$audtitrail_tbl_post = array('status'=>'0','scheme_code'=>'4','action_type1'=>'1','desc'=>'Student Registration Form view');
				audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************// 
			return view('backend.shortterm.studentRregistration.show',compact('recorde','stateName','disticName'));
	    }catch(\Exception $ex) {
			//**********Save Data into audtitrail_tbl************//
				$audtitrail_tbl_post = array('status'=>'1','scheme_code'=>'4','action_type1'=>'1','desc'=>'Student Registration Form view not working');
				audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************// 

	        return redirect('error');// dd('Message', $ex->getMessage());
	    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
			$student = studentRegistration::findOrFail($id);
			$country = DB::table('country')->get();
			$states = DB::table('state_master')->get();
			$distric = DB::table('district_master')->get();
            //**********Save Data into audtitrail_tbl************//
				$audtitrail_tbl_post = array('status'=>'0','scheme_code'=>'4','action_type1'=>'3','desc'=>'Edit Student Registration Form view');
				audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************// 
            return view('backend.shortterm.studentRregistration.edit',compact('student','country','states','distric'));
		}catch(\Exception $ex) {
			//**********Save Data into audtitrail_tbl************//
				$audtitrail_tbl_post = array('status'=>'1','scheme_code'=>'4','action_type1'=>'3','desc'=>'Edit Student Registration Form view not working');
				audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************// 

	        return redirect('error');// dd('Message', $ex->getMessage());
	    }
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
		try{
		$logID=Auth::id();
		
		$short_term_id = DB::table('short_term_program')->where('user_id',$logID)->where('status_id','3')->get()->first()->short_term_id;
		
		
		if(count(array($short_term_id))>0)
		{
			$institiuteID=$short_term_id;
		}
		else{
			$institiuteID=="";
		}
		
        $records = studentRegistration::find($id);
		$last_id = DB::getPDO()->lastInsertId();
		   
        $this->validate($request,[
            'firstname'  =>  'required|max:50',
            'gender'=> 'required',
			'participant_status'=> 'required',
			 'email_id' => 'required|email|unique:studentregistrations,email_id,'.$records->id,
            'mobile' => 'required|numeric|min:10|unique:studentregistrations,mobile,'.$records->id,
            'address' => 'required|max:150',
            'dob' => 'required',
            'statecd' => 'required|not_in:0',
            'districtcd' => 'required|not_in:Select',
            'pincode' => 'required|regex:/\b\d{6}\b/',
            'aadhar' => 'required|string|max:14|unique:studentregistrations,aadhar,'.$records->id,
          
         ]);
         	
        if($request->hasFile('upload_aadhar')) {
				$image = $request->file('upload_aadhar');
				$upload_aadhar = $institiuteID.'_'.$last_id.'_'.'4'.'_upload_aadhar.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/../public/uploads/shortterm/student_registration/upload_aadhar');
				$imagePath = $destinationPath. "/".  $upload_aadhar;
				$image->move($destinationPath, $upload_aadhar);
				$records['upload_aadhar'] = $upload_aadhar;
		}
		if($request->hasFile('student_image')) {
				$image = $request->file('student_image');
				$student_image = $institiuteID.'_'.$last_id.'_'.'4'.'_student_image.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/../public/uploads/shortterm/student_registration/student_photo');
				$imagePath = $destinationPath. "/".  $student_image;
				$image->move($destinationPath, $student_image);
				$records['student_image'] = $student_image;
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
				'participant_status'=>$request->participant_status,
				'address'=>$request->address,
				'dob'=>$request->dob,
				'pincode'=>$request->pincode,
				
				'countrycd'=>$request->countrycd,
				'statecd'=>$request->statecd,
				'districtcd'=>$request->districtcd,
				'aadhar'=>$request->aadhar,
				'category'=>$request->category,
				'student_image'=> $records['student_image'],
				
				'upload_aadhar'=>$records['upload_aadhar'],
				'user_id' =>Auth::id(),
				
				'modified_date'=>$date,
				'modified_by'=>Auth::id(),
				'scheme_code'=>4,
			);
			//**********Save Data into audtitrail_tbl************//
				$audtitrail_tbl_post = array('status'=>'0','scheme_code'=>'4','action_type1'=>'3','desc'=>'Edit Student Registration Form submit successfully');
				audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************// 
			DB::table('studentregistrations')->where('id',$id)->update($row); 
		    return redirect()->route('st-student-registration.index')
                        ->with('message','Student registration updated successfully.');
		}catch(\Exception $ex) {
			//**********Save Data into audtitrail_tbl************//
				$audtitrail_tbl_post = array('status'=>'1','scheme_code'=>'4','action_type1'=>'3','desc'=>'Edit Student Registration Form submission is not working');
				audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************// 

	        return redirect('error');// dd('Message', $ex->getMessage());
	    }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		try{
			 studentRegistration::destroy($id);
			 //**********Save Data into audtitrail_tbl************//
				$audtitrail_tbl_post = array('status'=>'0','scheme_code'=>'4','action_type1'=>'4','desc'=>'Delete Student Registration records successfully');
				audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************// 
			 return redirect()->route('st-student-registration.index')->with('message','Student detail deleted successfully !');
		}catch(\Exception $ex) {
			//**********Save Data into audtitrail_tbl************//
				$audtitrail_tbl_post = array('status'=>'1','scheme_code'=>'4','action_type1'=>'4','desc'=>'Delete Student Registration details is not working');
				audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************// 

	        return redirect('error');// dd('Message', $ex->getMessage());
	    }
    }

     public function getDisticList(Request $request)
    {  
        $districs = DB::table("district_master")
                    ->where("statecd",$request->statecd)
                    ->pluck("district_name","districtcd");
        return response()->json($districs);
    }

  

    public function validateMobile(Request $request){
        $data = $request->mobile;
		$hidden_id = $request->hidden_id;
         if($data){
			 if($hidden_id == null){
                $result =DB::table('studentregistrations')->where('mobile',$data)->where('scheme_code','4')->count();
			 }else{
				$result =DB::table('studentregistrations')->where('mobile',$data)->where('scheme_code','4')->where('id','!=',$hidden_id)->count();  
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
                 $result =DB::table('studentregistrations')->where('aadhar',$data)->where('scheme_code','4')->count();
			 }else{
				$result =DB::table('studentregistrations')->where('aadhar',$data)->where('scheme_code','4')->where('id','!=',$hidden_id)->count();  
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
