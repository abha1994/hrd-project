<?php

namespace App\Http\Controllers\Nref;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use DateTime,Session;
use Illuminate\Support\Facades\Hash;
use PDF;
use Illuminate\Mail\Message;
use Validator,Redirect;
use App\Nref\Institute;

class InstituteController extends Controller
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
		$data = Institute::index();
		return view('backend/nref/institute_form',compact('data'));
	}
	
	public function index2(Request $request)
    { 
		$data = Institute::index();
		return view('backend/nref/finalForm',compact('data'));
	}
	
	public function previewIndex(Request $request)
    {
        $data = $request->all();
        return view('backend/nref/preview', $data);
    }
	
	/**
     * Institute form post.
     *
     * @institute_form_post
	 Form_validation
     */
	 
	 /* Final Submit */
	 
	public function institute_form_post_final(Request $request) {
		
		 
		$transactionResult = DB::transaction(function() use ($request) {
				date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s');
				
				$device = $_SERVER['HTTP_USER_AGENT'];
				$ip_address = $_SERVER['REMOTE_ADDR']; 
			   
				$user_id = Auth::user()->id;
				
				//echo $user_id."==="; die;
			
			    
				$existRecords = DB::table('institute_details')->where('user_id', $user_id)->get();
				
				//echo "<pre>"; print_r($existRecords); echo $existRecords[0]->institute_id; die;
			    $RecordsCount = $existRecords->count();
			    if($RecordsCount==1)
			       {
					/* Details of placement of previous students  CODE START ROCKY*/
					 if($request->hasFile('file_upload_signature')) {
						$image = $request->file('file_upload_signature');
						$file_upload_signature = $user_id.'_fileupload_sign.'.$image->getClientOriginalExtension();
						$destinationPath = public_path('/../public/uploads/nref');
						$imagePath = $destinationPath. "/".  $file_upload_signature;
						$image->move($destinationPath, $file_upload_signature);
						
						$filedata['file_upload_signature'] = $file_upload_signature;
						$filedata['final_submit'] = 1;
					}
					else
					{
					
					$filedata['file_upload_signature'] = "";
					$filedata['final_submit'] = 0;
					}
				
				/* Details of placement of previous students CODE ENDED ROCKY */
				$curr_year = date('Y');
				$filedata['application_cd'] =  'NREF/'.$curr_year.'/'.$existRecords[0]->institute_id;
				$filedata['created_date'] = $date;
				DB::table('institute_details')->where('user_id',$user_id)->update($filedata); 
				
			
			//return back()->with('success',"Form Completely Submitted successfully");
			return redirect()->to('institute/')->with('success',"Form Completely Submitted successfully");
			} 
			 else
			{
				return back()->with('error',"You are not allowed to update data");
			} 
			
			
		 
		    });
	   return $transactionResult;
	 }
	 
	 /* Final Submit */

     public function institute_form_post(Request $request) {
		 
		 
		 //dd($request); die;
		 
		/* if($request->countrycd == "99"){
			$validatedData = $request->validate([
				'annual_report' => 'required',

			]);
		}else{
			$validatedData = $request->validate([
				'annual_report' => 'required',

			]);
		} */

		
	
		$transactionResult = DB::transaction(function() use ($request) {
      	    date_default_timezone_set('Asia/Kolkata');
			$date = date('Y-m-d H:i:s');
			
			$device = $_SERVER['HTTP_USER_AGENT'];
		    $ip_address = $_SERVER['REMOTE_ADDR']; 
		   
			$user_id = Auth::user()->id;;
			$postdata['scheme_code'] = 3;
			$postdata['user_id'] = $user_id;
			$postdata['department_name'] = $request->dept_name;
			$postdata['coordinate_prog'] = $request->coordinate_prog;
			$postdata['institute_type_id'] = $request->type_of_institute;
			$postdata['university_rank'] = $request->university_rank;
			$postdata['year_establishment'] = $request->yr_est;
			$postdata['no_student'] = $request->apx_stdnt;
			$postdata['any_collaboration'] = $request->collab_inst;
			$postdata['energy_experience'] = $request->exp_energy_course;
			$postdata['course_start_date'] = $request->course_run;
			$postdata['no_of_seat'] = $request->no_seat_course;
			$postdata['specialization_offered'] = $request->spl_offer;
			$postdata['industry_collaboration'] = $request->indus_collab;
			$postdata['placement_details'] = $request->place_service;
			$postdata['other_details'] = $request->other_details;
			$postdata['spon_project'] = $request->spon_project;
			
			$postdata['fellowship_period'] = $request->fellowship_period;
			$postdata['collab_institute'] = $request->collab_institute;
			$postdata['fellowship_mtech'] = $request->mtech; 
			$postdata['fellowship_jrf'] = $request->jrf;
			$postdata['fellowship_srf'] = $request->srf;
			$postdata['fellowship_msc'] = $request->msc;
			$postdata['fellowship_ra'] = $request->ra;
			$postdata['fellowship_pdf'] = $request->pdf;
			$postdata['fellowship_total'] = $request->ftotal;
			$postdata['certified_status'] = $request->certified;
			if(isset($request->resrch_phd)) {
			$postdata['research_phd'] = implode(',',$request->resrch_phd);
			}
			
			  
			
			
			$existRecords = DB::table('institute_details')->where('user_id', $user_id)->get();
			$RecordsCount = $existRecords->count();
			
			//echo $RecordsCount; die;
			
			//dd($existRecords); 
		
			
			 if($RecordsCount<1)
			{
				
				//echo "==="; die;
				
				
				DB::table('institute_details')->insert($postdata); 
				$last_id = DB::getPDO()->lastInsertId();
				if(!empty($last_id)){
				
				/* Last Annual Report code start ROCKY */
				 if($request->hasFile('annual_report')) {
					$image = $request->file('annual_report');
					$annual_report = $last_id.'_file_photo.'.$image->getClientOriginalExtension();
					$destinationPath = public_path('/../public/uploads/nref/annual_report');
					$imagePath = $destinationPath. "/".  $annual_report;
					$image->move($destinationPath, $annual_report);
					
					$filedata['annual_report'] = $annual_report;
					
				}
				
				else
				{
					$filedata['annual_report'] = "";
				}
				
				
				/* Last Annual Report code ended */
				
				/* Name & qualificATION OF FACULTY MEMBERS  CODE START ROCKY*/
				
				 if($request->hasFile('file_course_proof')) {
					$image = $request->file('file_course_proof');
					$file_course_proof = $last_id.'_faculty_details.'.$image->getClientOriginalExtension();
					$destinationPath = public_path('/../public/uploads/nref');
					$imagePath = $destinationPath. "/".  $file_course_proof;
					$image->move($destinationPath, $file_course_proof);
					
					$filedata['faculty_details'] = $file_course_proof;
				}
				else
				{
				$filedata['faculty_details'] = "";
				}
				
				
				/* NAME & QUALIFICATION OF FACULTY MEMBERS CODE ENDED ROCKY */
				
				
				/* Details of placement of previous students  CODE START ROCKY*/
				
				if($request->hasFile('file_prevStudent_proof')) {
					$image = $request->file('file_prevStudent_proof');
					$file_prevStudent_proof = $last_id.'_fileprevstudent_proof.'.$image->getClientOriginalExtension();
					$destinationPath = public_path('/../public/uploads/nref');
					$imagePath = $destinationPath. "/".  $file_prevStudent_proof;
					$image->move($destinationPath, $file_prevStudent_proof);
					$filedata['file_prevStudent_proof'] = $file_prevStudent_proof;
				}
				else
				{
				$filedata['file_prevStudent_proof'] = "";
				}
				
				/* Details of placement of previous students CODE ENDED ROCKY */
				
				
				/* Details of placement of previous students  CODE START ROCKY*/
				
				 if($request->hasFile('file_upload_signature')) {
					$image = $request->file('file_upload_signature');
					$file_upload_signature = $last_id.'_fileupload_sign.'.$image->getClientOriginalExtension();
					$destinationPath = public_path('/../public/uploads/nref');
					$imagePath = $destinationPath. "/".  $file_upload_signature;
					$image->move($destinationPath, $file_upload_signature);
					
					$filedata['file_upload_signature'] = $file_upload_signature;
				}
				else
				{
				$filedata['file_upload_signature'] = "";
				}
				
				/* Details of placement of previous students CODE ENDED ROCKY */
				
				
				
				 DB::table('institute_details')->where('institute_id',$last_id)->update($filedata); 
				
				}
				
				
				
			
			
			////return back()->with('success',"Form Submitted successfully")->with($postdata);

			return redirect()->to('instituteFinal/'.$last_id);
			} 
			 else
			{
				
				//echo "<pre>"; print_r($inst_data); die;
				
				// Update University Form
				
				if($request->editID!=""){
				
				/* Last Annual Report code start ROCKY */
				 if($request->hasFile('annual_report')) {
					$image = $request->file('annual_report');
					$annual_report = $request->editID.'_file_photo.'.$image->getClientOriginalExtension();
					$destinationPath = public_path('/../public/uploads/nref/annual_report');
					$imagePath = $destinationPath. "/".  $annual_report;
					$image->move($destinationPath, $annual_report);
					
					$filedata['annual_report'] = $annual_report;
					
				}
				
				else
				{
					$filedata['annual_report'] = $existRecords[0]->annual_report;
				}
				
				
				/* Last Annual Report code ended */
				
				/* Name & qualificATION OF FACULTY MEMBERS  CODE START ROCKY*/
				
				 if($request->hasFile('file_course_proof')) {
					$image = $request->file('file_course_proof');
					$file_course_proof = $request->editID.'_faculty_details.'.$image->getClientOriginalExtension();
					$destinationPath = public_path('/../public/uploads/nref');
					$imagePath = $destinationPath. "/".  $file_course_proof;
					$image->move($destinationPath, $file_course_proof);
					
					$filedata['faculty_details'] = $file_course_proof;
				}
				else
				{
				$filedata['faculty_details'] = $existRecords[0]->faculty_details;
				}
				
				
				/* NAME & QUALIFICATION OF FACULTY MEMBERS CODE ENDED ROCKY */
				
				
				/* Details of placement of previous students  CODE START ROCKY*/
				
				if($request->hasFile('file_prevStudent_proof')) {
					$image = $request->file('file_prevStudent_proof');
					$file_prevStudent_proof = $request->editID.'_fileprevstudent_proof.'.$image->getClientOriginalExtension();
					$destinationPath = public_path('/../public/uploads/nref');
					$imagePath = $destinationPath. "/".  $file_prevStudent_proof;
					$image->move($destinationPath, $file_prevStudent_proof);
					$filedata['file_prevStudent_proof'] = $file_prevStudent_proof;
				}
				else
				{
				$filedata['file_prevStudent_proof'] = $existRecords[0]->file_prevStudent_proof;
				}
				
				/* Details of placement of previous students CODE ENDED ROCKY */
				
				
				/* Details of placement of previous students  CODE START ROCKY*/
				
				
				/* Details of placement of previous students CODE ENDED ROCKY */
				
				DB::table('institute_details')->where('institute_id',$request->editID)->update($postdata); 
				
				 DB::table('institute_details')->where('institute_id',$request->editID)->update($filedata); 
				
				}
				
				
				
			
			
			////return back()->with('success',"Form Submitted successfully")->with($postdata);

			return redirect()->to('instituteFinal/'.$request->editID);
			
				
				////return back()->with('error',"You are not allowed to update data")->with($postdata);
			} 
			
			
		 
		    });
	   return $transactionResult;
	 }
	
	/* Preview Post */
	
	public function institute_preview_post(Request $request) {
		
		 
		if($request->countrycd == "99"){
			$validatedData = $request->validate([
				'annual_report' => 'required',

			]);
		}else{
			$validatedData = $request->validate([
				'annual_report' => 'required',

			]);
		}

	$transactionResult = DB::transaction(function() use ($request) {
      	    date_default_timezone_set('Asia/Kolkata');
			$date = date('Y-m-d H:i:s');
			
			$device = $_SERVER['HTTP_USER_AGENT'];
		    $ip_address = $_SERVER['REMOTE_ADDR']; 
		   
			 $user_id = Auth::user()->id;
			
			$postdata['user_id'] = $user_id;
			$postdata['department_name'] = $request->dept_name;
			$postdata['coordinate_prog'] = $request->coordinate_prog;
			$postdata['institute_type_id'] = $request->type_of_institute;
			$postdata['university_rank'] = $request->university_rank;
			$postdata['year_establishment'] = $request->yr_est;
			$postdata['no_student'] = $request->apx_stdnt;
			$postdata['any_collaboration'] = $request->collab_inst;
			$postdata['energy_experience'] = $request->exp_energy_course;
			$postdata['course_start_date'] = $request->course_run;
			$postdata['no_of_seat'] = $request->no_seat_course;
			$postdata['specialization_offered'] = $request->spl_offer;
			$postdata['industry_collaboration'] = $request->indus_collab;
			$postdata['placement_details'] = $request->place_service;
			$postdata['other_details'] = $request->other_details;
			$postdata['spon_project'] = $request->spon_project;
			
			
			$postdata['fellowship_mtech'] = $request->mtech; 
			$postdata['fellowship_jrf'] = $request->jrf;
			$postdata['fellowship_srf'] = $request->srf;
			$postdata['fellowship_msc'] = $request->msc;
			$postdata['certified_status'] = $request->certified;
			if(isset($request->resrch_phd)) {
			$postdata['research_phd'] = implode(',',$request->resrch_phd);
			}
			
			  
			
			
			$existRecords = DB::table('institute_details')->where('user_id', $user_id)->get();
			$RecordsCount = $existRecords->count();
			
			//echo $RecordsCount; die;
		
			
			 if($RecordsCount<1)
			{
				
				
				DB::table('institute_details')->insert($postdata); 
				$last_id = DB::getPDO()->lastInsertId();
				if(!empty($last_id)){
				
				/* Last Annual Report code start ROCKY */
				 if($request->hasFile('annual_report')) {
					$image = $request->file('annual_report');
					$annual_report = $user_id.'_file_photo.'.$image->getClientOriginalExtension();
					$destinationPath = public_path('/../public/uploads/nref');
					$imagePath = $destinationPath. "/".  $annual_report;
					$image->move($destinationPath, $annual_report);
					
					$filedata['annual_report'] = $annual_report;
					
				}
				
				else
				{
					$filedata['annual_report'] = "";
				}
				
				
				/* Last Annual Report code ended */
				
				/* Name & qualificATION OF FACULTY MEMBERS  CODE START ROCKY*/
				
				 if($request->hasFile('file_course_proof')) {
					$image = $request->file('file_course_proof');
					$file_course_proof = $user_id.'_faculty_details.'.$image->getClientOriginalExtension();
					$destinationPath = public_path('/../public/uploads/nref');
					$imagePath = $destinationPath. "/".  $file_course_proof;
					$image->move($destinationPath, $file_course_proof);
					
					$filedata['faculty_details'] = $file_course_proof;
				}
				else
				{
				$filedata['faculty_details'] = "";
				}
				
				
				/* NAME & QUALIFICATION OF FACULTY MEMBERS CODE ENDED ROCKY */
				
				
				/* Details of placement of previous students  CODE START ROCKY*/
				
				if($request->hasFile('file_prevStudent_proof')) {
					$image = $request->file('file_prevStudent_proof');
					$file_prevStudent_proof = $user_id.'_fileprevstudent_proof.'.$image->getClientOriginalExtension();
					$destinationPath = public_path('/../public/uploads/nref');
					$imagePath = $destinationPath. "/".  $file_prevStudent_proof;
					$image->move($destinationPath, $file_prevStudent_proof);
					$filedata['file_prevStudent_proof'] = $file_prevStudent_proof;
				}
				else
				{
				$filedata['file_prevStudent_proof'] = "";
				}
				
				/* Details of placement of previous students CODE ENDED ROCKY */
				
				
				/* Details of placement of previous students  CODE START ROCKY*/
				
				 if($request->hasFile('file_upload_signature')) {
					$image = $request->file('file_upload_signature');
					$file_upload_signature = $user_id.'_fileupload_sign.'.$image->getClientOriginalExtension();
					$destinationPath = public_path('/../public/uploads/nref');
					$imagePath = $destinationPath. "/".  $file_upload_signature;
					$image->move($destinationPath, $file_upload_signature);
					
					$filedata['file_upload_signature'] = $file_upload_signature;
				}
				else
				{
				$filedata['file_upload_signature'] = "";
				}
				
				/* Details of placement of previous students CODE ENDED ROCKY */
				
				 DB::table('institute_details')->where('institute_id',$last_id)->update($filedata); 
				
				}
				
				
				
			
			
			return back()->with('success',"Form Submitted successfully")->with($postdata);
			} 
			 else
			{
				return back()->with('error',"You are not allowed to update data")->with($postdata);
			} 
			
			
		 
		    });
	   return $transactionResult;
	  }
	
	/* Preview Post */
	
	
	
	
	public function pdfview(Request $request)
    {

		$candidate_id = Auth::user()->id;
		$registeration_id = DB::table('user_credential')->where('id',$candidate_id)->get()->first();
		$loginuser = DB::table('registration')->where('candidate_id',$registeration_id->registeration_id)->get()->first();
		view()->share('logindetails',$loginuser);
		
		$type_institute = DB::table('institute_type')->orderBy('institute_type_id','asc')->get();
		view()->share('type_institute',$type_institute);
		
		$items = DB::table('institute_details')->where('user_id', $candidate_id)->get();
	    
		 view()->share('items',$items);


        if($request->has('download')){
            $pdf = PDF::loadview('backend/nref/pdfview');
            return $pdf->download('pdfview.pdf');
        }
      return view('backend/nref/pdfview');
    }
	
	public function preview(Request $request)
    {
		
		$data['myForm'] =array('1'=>'rohan','2'=>'sohan');
		return loadview('backend/nref/preview', $data);
		
	}
	
	public function preview123(Request $request)
    {
	$transactionResult = DB::transaction(function() use ($request) {
      	    date_default_timezone_set('Asia/Kolkata');
			$date = date('Y-m-d H:i:s');
			
			$device = $_SERVER['HTTP_USER_AGENT'];
		    $ip_address = $_SERVER['REMOTE_ADDR']; 
		   
			$user_id = Auth::user()->id;
			
			$postdata['user_id'] = $user_id;
			$postdata['department_name'] = $request->dept_name;
			$postdata['coordinate_prog'] = $request->coordinate_prog;
			$postdata['institute_type_id'] = $request->type_of_institute;
			$postdata['university_rank'] = $request->university_rank;
			$postdata['year_establishment'] = $request->yr_est;
			$postdata['no_student'] = $request->apx_stdnt;
			$postdata['any_collaboration'] = $request->collab_inst;
			$postdata['energy_experience'] = $request->exp_energy_course;
			$postdata['course_start_date'] = $request->course_run;
			$postdata['no_of_seat'] = $request->no_seat_course;
			$postdata['specialization_offered'] = $request->spl_offer;
			$postdata['industry_collaboration'] = $request->indus_collab;
			$postdata['placement_details'] = $request->place_service;
			$postdata['other_details'] = $request->other_details;
			$postdata['spon_project'] = $request->spon_project;
			
			$postdata['fellowship_mtech'] = $request->mtech; 
			$postdata['fellowship_jrf'] = $request->jrf;
			$postdata['fellowship_srf'] = $request->srf;
			$postdata['fellowship_msc'] = $request->msc;
			$postdata['certified_status'] = $request->certified;
			
			$postdata['research_phd'] = implode(',',$request->resrch_phd);
			
			  
			
			
			$existRecords = DB::table('institute_details')->where('user_id', $user_id)->get();
			$RecordsCount = $existRecords->count();
			
			//echo $RecordsCount; die;
			
			if($RecordsCount<1)
			{
				
				
				DB::table('institute_details')->insert($postdata); 
				$last_id = DB::getPDO()->lastInsertId();
				if(!empty($last_id)){
				
				/* Last Annual Report code start ROCKY */
				if($request->hasFile('annual_report')) {
					$image = $request->file('annual_report');
					$annual_report = $user_id.'_file_photo.'.$image->getClientOriginalExtension();
					$destinationPath = public_path('/../public/uploads/nref');
					$imagePath = $destinationPath. "/".  $annual_report;
					$image->move($destinationPath, $annual_report);
				}
				$filedata['annual_report'] = $annual_report;
				
				/* Last Annual Report code ended */
				
				/* Name & qualificATION OF FACULTY MEMBERS  CODE START ROCKY*/
				
				if($request->hasFile('file_course_proof')) {
					$image = $request->file('file_course_proof');
					$file_course_proof = $user_id.'_faculty_details.'.$image->getClientOriginalExtension();
					$destinationPath = public_path('/../public/uploads/nref');
					$imagePath = $destinationPath. "/".  $file_course_proof;
					$image->move($destinationPath, $file_course_proof);
				}
				$filedata['faculty_details'] = $file_course_proof;
				
				/* NAME & QUALIFICATION OF FACULTY MEMBERS CODE ENDED ROCKY */
				
				
				/* Details of placement of previous students  CODE START ROCKY*/
				
				if($request->hasFile('file_prevStudent_proof')) {
					$image = $request->file('file_prevStudent_proof');
					$file_prevStudent_proof = $user_id.'_fileprevstudent_proof.'.$image->getClientOriginalExtension();
					$destinationPath = public_path('/../public/uploads/nref');
					$imagePath = $destinationPath. "/".  $file_prevStudent_proof;
					$image->move($destinationPath, $file_prevStudent_proof);
				}
				$filedata['file_prevStudent_proof'] = $file_prevStudent_proof;
				
				/* Details of placement of previous students CODE ENDED ROCKY */
				
				
				/* Details of placement of previous students  CODE START ROCKY*/
				
				if($request->hasFile('file_upload_signature')) {
					$image = $request->file('file_upload_signature');
					$file_upload_signature = $user_id.'_fileupload_sign.'.$image->getClientOriginalExtension();
					$destinationPath = public_path('/../public/uploads/nref');
					$imagePath = $destinationPath. "/".  $file_upload_signature;
					$image->move($destinationPath, $file_upload_signature);
				}
				$filedata['file_upload_signature'] = $file_upload_signature;
				
				/* Details of placement of previous students CODE ENDED ROCKY */
				
				DB::table('institute_details')->where('institute_id',$last_id)->update($filedata); 
				
				}
				
				
				
			
			
			return back()->with('success',"Form Submitted successfully")->with($postdata);
			}
			else
			{
				return back()->with('error',"You are not allowed to update data")->with($postdata);
			}
			
			
		 
		    });
	   return $transactionResult;
	 }
	
	public function institute_status($id,Request $request)
    {
		$data['data']  = DB::table('institute_details')->where('user_id',$id)->get()->first();
	    return view('backend/nref/institute_status',$data);
	}
	
	
}
