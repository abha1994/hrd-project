<?php

namespace App\Http\Controllers\Nref\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\DB;
use DateTime;
use Illuminate\Support\Facades\Hash;
use Mail;
use File;
use PDF;
use Illuminate\Mail\Message;
use Validator,Redirect;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Nref\admin\Admin_institute;
use App\AdminInternship;
use Session;

class UniversityController extends Controller
{  
    /**
     * Create a new controller instance.
     *
     * @return void
     */
	 
    public function __construct()
    {
	    $current_url =  \Request::segment(1);//dd($current_url);
		if($current_url == 'university'){
			
			$this->middleware('permission:admin-nref-institute-list|admin-nref-institute-edit|admin-nref-institute-delete', ['only' => ['index','view']]);
			$this->middleware('permission:admin-nref-institute-edit', ['only' => ['edit','update']]);
			$this->middleware('permission:admin-nref-institute-delete', ['only' => ['destroy']]);
			
		 }else if($current_url == 'universityCons'){
			
			$this->middleware('permission:considered-nref-institute-by-level1-list|considered-nref-institute-by-level1-edit|considered-nref-institute-by-level1-delete', ['only' => ['considered_level_1','view']]);
			$this->middleware('permission:considered-nref-institute-by-level1-edit', ['only' => ['edit','update']]);
			$this->middleware('permission:considered-nref-institute-by-level1-delete', ['only' => ['destroy']]);

		 }else if($current_url == 'universityNocons'){
			
			$this->middleware('permission:rejected-nref-institute-list|rejected-nref-institute-edit|rejected-nref-institute-delete', ['only' => ['rejected_internship','view']]);
			$this->middleware('permission:rejected-nref-institute-edit', ['only' => ['edit','update']]);
			$this->middleware('permission:rejected-nref-institute-delete', ['only' => ['destroy']]);
			
		 }else if($current_url == 'universityConsAdmin'){
			
			$this->middleware('permission:forward-to-committee-nref-institute-list|forward-to-committee-nref-institute-edit|forward-to-committee-nref-institute-delete', ['only' => ['forword_to_committee','view']]);
			$this->middleware('permission:forward-to-committee-nref-institute-edit', ['only' => ['edit','update']]);
			$this->middleware('permission:forward-to-committee-nref-institute-delete', ['only' => ['destroy']]);
			
		 }else if($current_url == 'universitySelected'){
			
			$this->middleware('permission:Selected-nref-institute-list|Selected-nref-institute-edit|Selected-nref-institute-delete', ['only' => ['selected_internship','view']]);
			$this->middleware('permission:Selected-nref-institute-edit', ['only' => ['edit','update']]);
			$this->middleware('permission:Selected-nref-institute-delete', ['only' => ['destroy']]);
		}	
    }

  
	 
    /**
     *  Show the Officer Form List.
     *
     * @index
     */
   

	public function index(Request $request)
    { 
		$data = Admin_institute::index();

		return view('backend/nref/Admin/admin_institute/university_list',compact('data'));
	}
	
	public function index2(Request $request)
    { 
		$data = Admin_institute::considered_by_level1();
		return view('backend/nref/Admin/admin_institute/university_level1_list',compact('data'));
	}
	
	
	public function index3(Request $request)
    { 
		$data = Admin_institute::forward_to_committee();
		return view('backend/nref/Admin/admin_institute/university_forward_to_committee_list',compact('data'));
	}
	
	public function index4(Request $request)
    { 
		$data = Admin_institute::rejected();
		return view('backend/nref/Admin/admin_institute/university_reject_list',compact('data'));
	}
	
    public function index5(Request $request)
    { 
		$data = Admin_institute::selected();
		return view('backend/nref/Admin/admin_institute/university_selected_list',compact('data'));
	}
	
	/**
     *View Edit Officer Page by id.
     *
     * @edit
     */
	
	public function edit($id)
    { 
	    $data = Admin_institute::edit($id);
		return view('backend/nref/Admin/admin_institute/university_edit',compact('data'));
	}
	
	public function finalSubmit($id)
    { 
	
	   $data = Admin_institute::edit($id);
	   // dd($data);
	   return view('backend/nref/Admin/admin_institute/university_final',compact('data'));
	}
	
	 /**
     * update Add Officer Form Data by id.
     *
     * @update
     */
	 
	 public function pdfviewAdmin(Request $request)
    {
		$candiId=$request->input('candiID');
		//echo '=='.$request->candi_id;
		//dd($request); die;
		
		$all_data =  Session::get('userdata');
		
		//echo "<pre>"; print_r($all_data); die;
		
  $registeration_id = DB::table('user_credential')->where('registeration_id',$candiId)->get()->first();
 
		
		$user_id = $all_data['candidate_id'];
		$loginuser = DB::table('registration')->where('candidate_id',$candiId)->get()->first();
		view()->share('logindetails',$loginuser);
		
		$type_institute = DB::table('institute_type')->orderBy('institute_type_id','asc')->get();
		view()->share('type_institute',$type_institute);
		
		$items = DB::table('institute_details')->where('user_id', $registeration_id->id)->get();
	    
		 view()->share('items',$items);


        if($request->has('download')){
            $pdf = PDF::loadView('backend/nref/Admin/admin_institute/pdfview');
            return $pdf->download('pdfview.pdf');
        }


        return view('backend/nref/Admin/admin_institute/pdfview');
    }
	 
	 public function updateFinalSubmit($id, Request $request)
	 {
		
		 $fetchRecord = Admin_institute::fetch_details($id);
		 
		
		 
		 if(count($fetchRecord['existRecords'])>0)
		{
		 if($request->hasFile('file_upload_signature')) {
			$image = $request->file('file_upload_signature');
			$file_upload_signature = $id.'_file_upload_signature_'.$image->getClientOriginalName();
			$destinationPath = public_path('/../public/uploads/nref');
			$imagePath = $destinationPath. "/".  $file_upload_signature;
			$image->move($destinationPath, $file_upload_signature);

			$filedata1['file_upload_signature'] = $file_upload_signature;

			}
			
			else
			{
				$filedata1['file_upload_signature']= $fetchRecord['existRecords'][0]->file_upload_signature;
			}
			
			DB::table('institute_details')->where('institute_id',$id)->update(['file_upload_signature' => $filedata1['file_upload_signature'],'final_submit'=>1]);
			
			
			if($fetchRecord['existRecords'][0]->file_upload_signature!=""){
			
			$source_file = public_path('/../public/uploads/nref/'.$fetchRecord['existRecords'][0]->file_upload_signature);
			$destination_path = public_path('/../public/uploads/nref_history/'.$fetchRecord['existRecords'][0]->file_upload_signature);
			
			$isExists = File::exists($source_file);
			//dd($isExists);
			if($isExists)
			{
				\File::copy($source_file , $destination_path);
			}
			}
			
			
		}
		
		return redirect('university')->with('success','Institute Details are updated successfully');
	 }
	 
	public function update($id, Request $request)
    { 
	
	//$path= public_path('uploads/nref_history/');
	
	$fetchRecord = Admin_institute::fetch_details($id);
	
	$validatedData = $request->validate([
	        'institute_name' => 'required',
			'dept_name' => 'required',
			'coordinate_prog' => 'required',
			'type_of_institute' => 'required',
			'university_rank' => 'required',
		]);
		
		
		//2020-01-16 24-Jan-2020'
		
		
		date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s');
		
		    $institute_name = $request->institute_name;
			
			// $postdata['user_id'] = $id;
			$postdata['department_name'] = $request->dept_name;
			$postdata['coordinate_prog'] = $request->coordinate_prog;
			$postdata['institute_type_id'] = $request->type_of_institute;
			$postdata['university_rank'] = $request->university_rank;
			
			if(isset($request->annual_report)) {
			$postdata['annual_report'] = $request->annual_report;
			}

			$postdata['year_establishment'] = $request->yr_est;
			$postdata['no_student'] = $request->apx_stdnt;
			
			if(isset($request->file_course_proof)) {
			$postdata['faculty_details'] = $request->file_course_proof;
			}

			$postdata['any_collaboration'] = $request->collab_inst;
			if(isset($request->resrch_phd)) {
			$postdata['research_phd'] = implode(',',$request->resrch_phd);
			}
			$postdata['energy_experience'] = $request->exp_energy_course;
			$postdata['course_start_date'] = $request->course_run;
			$postdata['no_of_seat'] = $request->no_seat_course;
			$postdata['specialization_offered'] = $request->spl_offer;
			$postdata['industry_collaboration'] = $request->indus_collab;
			$postdata['placement_details'] = $request->place_service;
			$postdata['collab_institute'] = $request->collab_institute;
			
			if(isset($request->file_prevStudent_proof)) {
			$postdata['file_prevStudent_proof'] = $request->file_prevStudent_proof;
			}
			

			$postdata['other_details'] = $request->other_details;
			$postdata['spon_project'] = $request->spon_project;
			$postdata['fellowship_period'] = $request->fellowship_period;
			$postdata['fellowship_mtech'] = $request->mtech; 
			$postdata['fellowship_jrf'] = $request->jrf;
			$postdata['fellowship_srf'] = $request->srf;
			$postdata['fellowship_msc'] = $request->msc;
			$postdata['fellowship_ra'] = $request->ra;
			$postdata['fellowship_pdf'] = $request->pdf;
			$postdata['fellowship_total'] = $request->ftotal;
			$postdata['certified_status'] = $request->certified;
			
			// echo "<pre>"; print_r($fetchRecord); 
			//echo $fetchRecord['existRecords'][0]->faculty_details;
			
			//echo count($fetchRecord['existRecords']);
			//die;
			
			
			if(count($fetchRecord['existRecords'])>0)
		{
			$insertRecord['institute_id']=$fetchRecord['existRecords'][0]->institute_id;
			$insertRecord['user_id']=$fetchRecord['existRecords'][0]->user_id;
			$insertRecord['application_cd']=$fetchRecord['existRecords'][0]->application_cd;
			$insertRecord['scheme_code']=$fetchRecord['existRecords'][0]->scheme_code;
			$insertRecord['officer_id']=$fetchRecord['existRecords'][0]->officer_id;
			$insertRecord['officer_role_id']=$fetchRecord['existRecords'][0]->officer_role_id;
			$insertRecord['status_id']=$fetchRecord['existRecords'][0]->status_id;
			$insertRecord['department_name']=$fetchRecord['existRecords'][0]->department_name;
			$insertRecord['coordinate_prog']=$fetchRecord['existRecords'][0]->coordinate_prog;
			$insertRecord['institute_type_id']=$fetchRecord['existRecords'][0]->institute_type_id;
			$insertRecord['university_rank']=$fetchRecord['existRecords'][0]->university_rank;
			
			$insertRecord['annual_report']=$fetchRecord['existRecords'][0]->annual_report;
			
			$insertRecord['year_establishment']=$fetchRecord['existRecords'][0]->year_establishment;
			$insertRecord['no_student']=$fetchRecord['existRecords'][0]->no_student;
			$insertRecord['faculty_details']=$fetchRecord['existRecords'][0]->faculty_details;
			$insertRecord['any_collaboration']=$fetchRecord['existRecords'][0]->any_collaboration;
			$insertRecord['research_phd']=$fetchRecord['existRecords'][0]->research_phd;
			$insertRecord['energy_experience']=$fetchRecord['existRecords'][0]->energy_experience;
			$insertRecord['course_start_date']=$fetchRecord['existRecords'][0]->course_start_date;
			$insertRecord['no_of_seat']=$fetchRecord['existRecords'][0]->no_of_seat;
			$insertRecord['specialization_offered']=$fetchRecord['existRecords'][0]->specialization_offered;
			$insertRecord['industry_collaboration']=$fetchRecord['existRecords'][0]->industry_collaboration;
			$insertRecord['placement_details']=$fetchRecord['existRecords'][0]->placement_details;
			$insertRecord['collab_institute']=$fetchRecord['existRecords'][0]->collab_institute;	
			$insertRecord['file_prevStudent_proof']=$fetchRecord['existRecords'][0]->file_prevStudent_proof;
			$insertRecord['other_details']=$fetchRecord['existRecords'][0]->other_details;
			$insertRecord['spon_project']=$fetchRecord['existRecords'][0]->spon_project;
			$insertRecord['fellowship_period']=$fetchRecord['existRecords'][0]->fellowship_period;
			$insertRecord['fellowship_mtech']=$fetchRecord['existRecords'][0]->fellowship_mtech;
			$insertRecord['fellowship_jrf']=$fetchRecord['existRecords'][0]->fellowship_jrf;
			$insertRecord['fellowship_srf']=$fetchRecord['existRecords'][0]->fellowship_srf;
			$insertRecord['fellowship_msc']=$fetchRecord['existRecords'][0]->fellowship_msc;
			$insertRecord['fellowship_ra']=$fetchRecord['existRecords'][0]->fellowship_ra;
			$insertRecord['fellowship_pdf']=$fetchRecord['existRecords'][0]->fellowship_pdf;
			$insertRecord['fellowship_total']=$fetchRecord['existRecords'][0]->fellowship_total;
			$insertRecord['signed_form']=$fetchRecord['existRecords'][0]->signed_form;
			$insertRecord['certified_status']=$fetchRecord['existRecords'][0]->certified_status;
			$insertRecord['file_upload_signature']=$fetchRecord['existRecords'][0]->file_upload_signature;
			$insertRecord['final_submit']=$fetchRecord['existRecords'][0]->final_submit;
			$insertRecord['history_by']=1;
			$insertRecord['created_date']=$fetchRecord['existRecords'][0]->created_date;
			$insertRecord['created_by']=Auth::user()->id;
			$insertRecord['modified_date']=$date;
			
			/* Move Files to another history Folder */
			
			/* Annual Report Code */
			
			if($fetchRecord['existRecords'][0]->annual_report!=""){
			
			$source_file = public_path('/../public/uploads/nref/'.$fetchRecord['existRecords'][0]->annual_report);
			$destination_path = public_path('/../public/uploads/nref_history/'.$fetchRecord['existRecords'][0]->annual_report);
			
			$isExists = File::exists($source_file);
			//dd($isExists);
			if($isExists)
			{
				\File::copy($source_file , $destination_path);
			}
			}
			
			/* Faculty Members Code */
			
			if($fetchRecord['existRecords'][0]->faculty_details!=""){
			
			$source_file1 = public_path('/../public/uploads/nref/'.$fetchRecord['existRecords'][0]->faculty_details);
			$destination_path1 = public_path('/../public/uploads/nref_history/'.$fetchRecord['existRecords'][0]->faculty_details);
			
			$isExists1 = File::exists($source_file1);
			//dd($isExists);
			if($isExists1)
			{
				\File::copy($source_file1 , $destination_path1);
			}
			}
			
			/* placement of previous students Code */
			
			if($fetchRecord['existRecords'][0]->file_prevStudent_proof!=""){
			$source_file2 = public_path('/../public/uploads/nref/'.$fetchRecord['existRecords'][0]->file_prevStudent_proof);
			$destination_path2 = public_path('/../public/uploads/nref_history/'.$fetchRecord['existRecords'][0]->file_prevStudent_proof);
			
			$isExists2 = File::exists($source_file2);
			//dd($isExists);
			if($isExists2)
			{
				\File::copy($source_file2 , $destination_path2);
			}
			}
			
			
			/* Move Files TO another History Folder */
			
			$isertData = Admin_institute::insert_history($insertRecord);
		 
	
        $data = Admin_institute::update_university($postdata,$id);
		$registeration_id = DB::table('user_credential')->where('id',$fetchRecord['existRecords'][0]->user_id)->get()->first();
		// dd($registeration_id->registeration_id);
		DB::table('registration')->where('candidate_id',$registeration_id->registeration_id)->update(['institute_name' => $institute_name]);
		
		//$data = Admin_institute::update_university($postdata,$id);
		
		
		
		//DB::table('institute_details')->where('candidate_id',$id)->update($filedata);
		
		if($data==0)
		{
			 $deleteUniversity = Admin_institute::delete_univeristy($id);
			 //unlink($destination_path);
			 //unlink($destination_path1);
			//unlink($destination_path2);
			 
		}
		
		else
		{
			
			/* Annual Report Start Code */

			if($request->hasFile('annual_report')) {
			$image = $request->file('annual_report');
			$annual_report = $id.'_annual_report_'.$image->getClientOriginalName();
			$destinationPath = public_path('/../public/uploads/nref');
			$imagePath = $destinationPath. "/".  $annual_report;
			$image->move($destinationPath, $annual_report);

			$filedata1['annual_report'] = $annual_report;

			}
			
			else
			{
				$filedata1['annual_report']= $fetchRecord['existRecords'][0]->annual_report;
			}
				

			/* Annual Report Ended Code */
			
						/* Faculty Members Start Code */
						
						//$filedata1[]="";

			if($request->hasFile('file_course_proof')) {
			$image = $request->file('file_course_proof');
			$faculty_details = $id.'_file_course_'.$image->getClientOriginalName();
			$destinationPath = public_path('/../public/uploads/nref');
			$imagePath = $destinationPath. "/".  $faculty_details;
			$image->move($destinationPath, $faculty_details);

			$filedata1['faculty_details'] = $faculty_details;

			}
			else
			{
				$filedata1['faculty_details']= $fetchRecord['existRecords'][0]->faculty_details;
			}
	

			/* Faculty Members Ended Code */
			
			
			/* Details Of placement Start Code */

			if($request->hasFile('file_prevStudent_proof')) {
			$image = $request->file('file_prevStudent_proof');
			$file_prevStudent_proof = $id.'_file_prevStud_'.$image->getClientOriginalName();
			$destinationPath = public_path('/../public/uploads/nref');
			$imagePath = $destinationPath. "/".  $file_prevStudent_proof;
			$image->move($destinationPath, $file_prevStudent_proof);

			$filedata1['file_prevStudent_proof'] = $file_prevStudent_proof;

			}
			
			else
			{
				$filedata1['file_prevStudent_proof']= $fetchRecord['existRecords'][0]->file_prevStudent_proof;
			}

			/* Details Of placement Ended Code */
			
			/* if($request->hasFile('file_upload_signature')) {
			$image = $request->file('file_upload_signature');
			$file_upload_signature = $id.'_fileupload_sign_'.$image->getClientOriginalName();
			$destinationPath = public_path('/../public/uploads/nref');
			$imagePath = $destinationPath. "/".  $file_upload_signature;
			$image->move($destinationPath, $file_upload_signature);

			$filedata1['file_upload_signature'] = $file_upload_signature;
			} */
			
			DB::table('institute_details')->where('institute_id',$id)->update($filedata1);
			
		}
		
		////return redirect('university')->with('success','Institute Details are Updated successfully');
		///return redirect('final-university/'.$id);
		
		//return redirect()->route('final-university/', ['id' => $id]);
		
		return redirect()->to('final-university/'.$id);
		}
		
		else
		{
			
			//$insertData = Admin_institute::insert_newDetails($postdata);
			DB::table('institute_details')->insert($postdata);
			$last_id = DB::getPDO()->lastInsertId();
			
			if(!empty($last_id)){
				
							/* Annual Report Start Code */

			if($request->hasFile('annual_report')) {
			$image = $request->file('annual_report');
			$annual_report = $id.'_annual_report_'.$image->getClientOriginalName();
			$destinationPath = public_path('/../public/uploads/nref');
			$imagePath = $destinationPath. "/".  $annual_report;
			$image->move($destinationPath, $annual_report);

			$filedata['annual_report'] = $annual_report;

			}

			else
			{
			$filedata['annual_report'] = "";
			}
				

			/* Annual Report Ended Code */
			
						/* Faculty Members Start Code */

			if($request->hasFile('file_course_proof')) {
			$image = $request->file('file_course_proof');
			$faculty_details = $id.'_file_course_'.$image->getClientOriginalName();
			$destinationPath = public_path('/../public/uploads/nref');
			$imagePath = $destinationPath. "/".  $faculty_details;
			$image->move($destinationPath, $faculty_details);

			$filedata['faculty_details'] = $faculty_details;

			}

			else
			{
			$filedata['faculty_details'] = "";
			}
				

			/* Faculty Members Ended Code */
			
			
			/* Details Of placement Start Code */

			if($request->hasFile('file_prevStudent_proof')) {
			$image = $request->file('file_prevStudent_proof');
			$file_prevStudent_proof = $id.'_file_prevStud_'.$image->getClientOriginalName();
			$destinationPath = public_path('/../public/uploads/nref');
			$imagePath = $destinationPath. "/".  $file_prevStudent_proof;
			$image->move($destinationPath, $file_prevStudent_proof);

			$filedata['file_prevStudent_proof'] = $file_prevStudent_proof;

			}

			else
			{
			$filedata['file_prevStudent_proof'] = "";
			}
				

			/* Details Of placement Ended Code */
			
			if($request->hasFile('file_upload_signature')) {
			$image = $request->file('file_upload_signature');
			$file_upload_signature = $id.'_fileupload_sign_'.$image->getClientOriginalName();
			$destinationPath = public_path('/../public/uploads/nref');
			$imagePath = $destinationPath. "/".  $file_upload_signature;
			$image->move($destinationPath, $file_upload_signature);

			$filedata['file_upload_signature'] = $file_upload_signature;
			}
			else
			{
			$filedata['file_upload_signature'] = "";
			}
			
			DB::table('institute_details')->where('institute_id',$last_id)->update($filedata);
				
			}
			
			////return redirect('university')->with('success','Institute Details are Inserted successfully');
			return redirect()->to('final-university/'.$id);
			
			
		}
		
	   
    }
	
	
	/**
     * View Officer Form Data by id.
     *
     * @view
     */
	 
	/* public function view($id)
    { 
	  $permission_data = self::permission_data();$pri_explode = explode(',',$permission_data);
	  if(in_array(3, $pri_explode)){
		  $data = Admin_institute::edit($id);
	      return view('backend/admin_institute/university_view',compact('data'));
	  }else{
		  return redirect('access-denied');
	  }
	} */
	
	
	public function view($id)
    { 
	    $data = Admin_institute::edit($id);
		return view('backend/nref/Admin/admin_institute/university_view',compact('data'));
	}
	
	
	public function institute_status_considered(Request $request)
    { 
	    $postdata['status_application'] = $request->status_application;
	    date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s');
	
		$postdata['remarks'] = $request->remarks;
		$postdata['institute_id'] = $request->institute_id;
		$postdata['officer_id'] = $request->officer_id; 
		$postdata['officer_role_id'] = $request->role_id;
		$postdata['reason'] = $request->reason;
		$postdata['verified_date'] = $date;
		$postdata['scheme_code'] = "3";
		
		$a = DB::table('internship_verification')->insert($postdata);
		
		$status_application['status_id'] = $postdata['status_application'];
		$status_application['officer_role_id'] = $request->role_id;
		$status_application['officer_id'] = $request->officer_id;
		DB::table('institute_details')->where('institute_id',$request->institute_id)->update($status_application);
		echo $a;
   }
   
   
	
	/**
     * Delete Officer Data by id.
     *
     * @delete
     */
	 
	public function delete($id)
    { 
	   $data = Admin_institute::delete_data($id);
	   if($data['status'] == "1" ){
			return redirect('university')->with('success','Institute Details Deleted successfully');
	   }elseif($data['status'] == "0" ){
			return redirect('university')->with('error','Institute id does not exists');
	   }
	}

    public function final_selected_university($candidate_id)
    {   
	
	   $transactionResult = DB::transaction(function() use($candidate_id) {
		    date_default_timezone_set('Asia/Kolkata');
			$date = date('Y-m-d H:i:s');

			$internship_data = DB::table('institute_details')->where('institute_id', $candidate_id)->get()->first();
			$loginuseer  = Auth::user();
			$internship_data->selected_by = $loginuseer->id;
			$internship_data->status = "3"; 
			$internship_data->selected_by_role = $loginuseer->role;
			$internship_data->scheme_code = "3"; 
			$internship_data->modified_by = $loginuseer->id;
			$internship_data->modified_date = $date;
			$user = DB::table("selected_institute_application")->insert(get_object_vars($internship_data));
			
			$postdata['status_application'] = "3";
			$postdata['scheme_code'] = "3";
			$postdata['candidate_id'] = $candidate_id;
			$postdata['officer_id'] = $loginuseer->id;
			$postdata['officer_role_id'] = $loginuseer->role;
			$postdata['verified_date'] = $date;
			$a = DB::table('internship_verification')->insert($postdata);
			
			$status_application['status_id'] = $internship_data->status;
			$status_application['officer_role_id'] = $loginuseer->role;
			$status_application['officer_id'] = $loginuseer->id;
			DB::table('institute_details')->where('institute_id',$candidate_id)->update($status_application);
			return redirect('universitySelected')->with('success','Institute Selected successfully!!..');
       });
	   return $transactionResult;
    }
	
	
	

	
   
       
}
