<?php

namespace App\Http\Controllers\Internship;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use DateTime,Session;
use Illuminate\Support\Facades\Hash;
use Mail;
use Illuminate\Mail\Message;
use Validator,Redirect;
use App\Internship\Internship;
use App\Http\Requests\Form_validation;
class InternshipController extends Controller
{  
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		
    }

    /**
     *  Show the Internship Form List.
     *
     * @index
     */
    
	public function index(Request $request)
    { 
	    $data = Internship::index();
		if($data['internship_data'] ==  null){
		   return view('backend/internship/internship/internship_form',compact('data'));
		}else{
		   return view('backend/internship/internship/internship_view',compact('data'));
		}
	}
	/**
     * Internship form post.
     *
     * @internship_form_post
	 Form_validation
     */

     public function internship_form_post(Form_validation $request) {
	 $transactionResult = DB::transaction(function() use ($request) {
      	    date_default_timezone_set('Asia/Kolkata');
			$date = date('Y-m-d H:i:s');
			
			$device = $_SERVER['HTTP_USER_AGENT'];
		    $ip_address = $_SERVER['REMOTE_ADDR']; 
		   
			$user_id = Auth::user()->id;
			$curr_year = date('Y');
		
			
			
			$postdata['user_id'] = $user_id;
			$postdata['first_name'] = $request->first_name;
			$postdata['middle_name'] = $request->middle_name;
			$postdata['last_name'] = $request->last_name;
			$postdata['date_birth'] = $request->dob;
			$postdata['gender'] = $request->gender;
			$postdata['mob_number'] = $request->mobile_no;
			$postdata['email'] = $request->email_id;
			$postdata['countrycd'] = $request->countrycd;
			$postdata['statecd'] = $request->statecd;
			$postdata['districtcd'] = $request->districtcd;
			
			$postdata['father'] = $request->father_name;
			$postdata['phone'] = $request->std_code.'-'.$request->landline;
			$postdata['pincode'] = ($postdata['countrycd'] == "99") ?  $request->pincode : $request->sipcode;
			$postdata['categories'] = $request->categories;
			$postdata['address'] = $request->address;
			
		    $catg = $request->catg ;
			if($catg == "2"){
				$postdata['work_status'] = $request->work_status;
				$postdata['organization'] = $request->organization;
				$postdata['designation'] = $request->designation;
				$postdata['organization_address'] = $request->organization_address;
				$postdata['nature_area'] = $request->nature_area;
				$postdata['focus_work'] = $request->focus_work;
			}
			
			$postdata['area_interest'] = $request->area_interest;
			$postdata['intern_place'] = $request->intern_place;
			$postdata['intern_duration'] = $request->intern_duration;
		
			$postdata['writeup_interest'] = $request->writeup_interest;
			$postdata['remarks'] = $request->remarks;
			
			$postdata['ip_address'] = $ip_address;
			$postdata['browser'] = $device;
			$postdata['device'] = $device;
			$postdata['date_entry'] = $date;
			
			$postdata['id_proof_type'] = $request->id_proof;
			// if($postdata['id_proof_type'] == "1"){
				  // $path = "voter_id";
			// }else if($postdata['id_proof_type'] == "2"){
			      // $path = "driving_licence";
			// }else if($postdata['id_proof_type'] == "3"){
				  // $path = "passport";
			// }else if($postdata['id_proof_type'] == "4"){
		          // $path = "college_id_card";
			// }
			
			
		    $desired_month_year = $request->desired_month_year;
		    $start_month_year = explode('-',$desired_month_year);
			
			$comp_date = strtotime(date("Y-m", strtotime($desired_month_year)) . " +".$postdata['intern_duration']." month");
			$end_date = date("m-Y",$comp_date);
            $end_month_year = explode('-',$end_date);
		   
		
			$postdata['intern_start_month'] = $start_month_year['1'];
			$postdata['intern_start_year'] = $start_month_year['0'];
			$postdata['intern_end_month'] = $end_month_year['0'];
			$postdata['intern_end_year'] = $end_month_year['1'];
			
			
			
	        // $postdata['institute'] = "0";
			// $postdata['institute_address'] = "0";
			DB::table('internship_tbl')->insert($postdata); 
			$last_id = DB::getPDO()->lastInsertId();
		
			if(!empty($last_id)){
				
				if($request->hasFile('file_photo')) {
					$image = $request->file('file_photo');
					$file_photo = $last_id.'_file_photo.'.$image->getClientOriginalExtension();
					$destinationPath = public_path('/../public/uploads/internship/photo');
					$imagePath = $destinationPath. "/".  $file_photo;
					$image->move($destinationPath, $file_photo);
					
				}
			    $filedata['file_photo'] = $file_photo;
				
				if($request->hasFile('file_id_proof')) {
					$image = $request->file('file_id_proof');
					$file_id_proof = $last_id.'_file_id_proof.'.$image->getClientOriginalExtension();
					$destinationPath = public_path('/../public/uploads/internship/id_proof/');
					$imagePath = $destinationPath. "/".  $file_id_proof;
					$image->move($destinationPath, $file_id_proof);
				}
				$filedata['file_id_proof'] = $file_id_proof;
				
				if($request->hasFile('file_experience')) {
					$image = $request->file('file_experience');
					$file_experience = $last_id.'_file_experience.'.$image->getClientOriginalExtension();
					$destinationPath = public_path('/../public/uploads/internship/experience/');
					$imagePath = $destinationPath. "/".  $file_experience;
					$image->move($destinationPath, $file_experience);
				}
				$filedata['file_experience'] = $file_experience;
				$filedata['scheme_code'] = 1;
				$filedata['application_cd'] =  'NREI/'.$curr_year.'/'.$last_id;
				
				DB::table('internship_tbl')->where('candidate_id',$last_id)->update($filedata); 	
					
				foreach($request->year_completion as $v){if($v == null){$d = "0";}else{$d  = $v;}	 $year_completion[] = $d;}
				$ques_count = count($request->course_id);
				// dd($request->course_id,$ques_count);
				// dd($ques_count);
				for ($i = 0; $i < $ques_count; $i++) {
					$array = array(
					 'candidate_id'=>$last_id,
					 'course_id' => $request->course_id[$i],
					 'institute' => $request->institute[$i],
					 'stream' => $request->stream[$i],
					 'pass_status' => $request->pass_status[$i],
					 'year_completion' => $year_completion[$i],
					 'marks_percentage' => $request->marks_percentage[$i]
					 );
					
				 DB::table('intern_course_details')->insert($array); 
				}
		    }
		     return back()->with('success',"Form Submitted successfully")->with($postdata);
		    });
	   return $transactionResult;
	 }
	
	public function contact_us()
    { 
	   return view('backend/internship/internship/contact_us');
    }
    public function who_is_eligible()
    { 
	  return view('backend/internship/internship/eligible');
    }
    public function how_to_apply()
    { 
	  return view('backend/internship/internship/how_to_apply');
    }
     public function internship_form_print(Request $request)
    {
	  $data = Internship::index();
	  return view('backend/internship/internship/internship_print',compact('data'));
    }
	 
	public function guidelines(Request $request)
    {
	 return view('backend/internship/internship/scheme_final');
    }
	
	public function intern_status($id,Request $request)
    {
	// dd($id);	
		 $data['data']  = DB::table('internship_tbl')->where('user_id',$id)->get()->first();
	     return view('backend/internship/internship/intern_status',$data);
	}
	
	
}
