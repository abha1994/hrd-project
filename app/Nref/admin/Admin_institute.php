<?php

namespace App\Nref\Admin;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use DB;
use File;
use Session;

class Admin_institute extends Model
{
   
   
    /**
     * Fetch all data of officer from database
     *application_cd
     * @index
     */
	 
	public static function index(){
		  $data['breadcum'] = "List University Data"; 
		  $data['institute_data'] =DB::table('institute_details')
           ->leftJoin('user_credential', 'user_credential.id', '=', 'institute_details.user_id')
		   ->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
           ->select('registration.institute_name','registration.institute_addres','registration.institute_reg_no','registration.pincode','registration.email_id','registration.mobile_no','institute_details.user_id','institute_details.institute_id','institute_details.department_name','institute_details.application_cd','institute_details.coordinate_prog','institute_details.institute_type_id','institute_details.university_rank','institute_details.year_establishment','institute_details.no_student','institute_details.any_collaboration','institute_details.research_phd','institute_details.energy_experience','institute_details.course_start_date','institute_details.no_of_seat','institute_details.specialization_offered','institute_details.industry_collaboration','institute_details.placement_details','institute_details.other_details','institute_details.spon_project','institute_details.fellowship_mtech','institute_details.fellowship_jrf','institute_details.fellowship_srf','institute_details.fellowship_msc','institute_details.fellowship_total','institute_details.fellowship_period','institute_details.certified_status','institute_details.annual_report','institute_details.final_submit','institute_details.faculty_details','institute_details.placement_details','institute_details.file_prevStudent_proof','institute_details.file_upload_signature','institute_details.status_id','institute_details.officer_role_id','institute_details.course_offered_dept')
			->where('institute_details.status_id',NULL)
			->where('institute_details.final_submit',1)
            ->get();
			
		 $data['breadcum'] = 'List of Institute';
		 return $data;
	}
	
	public static function considered_by_level1(){
		 $data['institute_data'] =DB::table('institute_details')
		    ->leftJoin('user_credential', 'user_credential.id', '=', 'institute_details.user_id')
		    ->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
		    ->select('registration.candidate_id','registration.category_id','registration.institute_name','registration.institute_addres','registration.institute_reg_no','registration.pincode','registration.email_id','registration.mobile_no','institute_details.institute_id','institute_details.application_cd','institute_details.department_name','institute_details.coordinate_prog','institute_details.institute_type_id','institute_details.university_rank','institute_details.year_establishment','institute_details.no_student','institute_details.any_collaboration','institute_details.research_phd','institute_details.energy_experience','institute_details.course_start_date','institute_details.no_of_seat','institute_details.specialization_offered','institute_details.industry_collaboration','institute_details.placement_details','institute_details.other_details','institute_details.spon_project','institute_details.fellowship_mtech','institute_details.fellowship_jrf','institute_details.fellowship_srf','institute_details.fellowship_msc','institute_details.fellowship_total','institute_details.fellowship_period','institute_details.certified_status','institute_details.annual_report','institute_details.final_submit','institute_details.faculty_details','institute_details.placement_details','institute_details.file_prevStudent_proof','institute_details.file_upload_signature','institute_details.status_id','institute_details.officer_role_id')
			->where('registration.category_id', 3)
			->where('institute_details.status_id', 1)
			->where('institute_details.officer_role_id',3)->where('institute_details.final_submit',1)
			->get();
			
		 $data['breadcum'] = 'List of Application Considered by Level 1 Officer';
		 return $data;
	}
	
	
	public static function forward_to_committee(){
		
		 $data['institute_data'] =DB::table('institute_details')
		    ->leftJoin('user_credential', 'user_credential.id', '=', 'institute_details.user_id')
		    ->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
            ->select('registration.candidate_id','registration.category_id','registration.institute_name','registration.institute_addres','registration.institute_reg_no','registration.pincode','registration.email_id','registration.mobile_no','institute_details.institute_id','institute_details.application_cd','institute_details.department_name','institute_details.coordinate_prog','institute_details.institute_type_id','institute_details.university_rank','institute_details.year_establishment','institute_details.no_student','institute_details.any_collaboration','institute_details.research_phd','institute_details.energy_experience','institute_details.course_start_date','institute_details.no_of_seat','institute_details.specialization_offered','institute_details.industry_collaboration','institute_details.placement_details','institute_details.other_details','institute_details.spon_project','institute_details.fellowship_mtech','institute_details.fellowship_jrf','institute_details.fellowship_srf','institute_details.fellowship_msc','institute_details.fellowship_total','institute_details.fellowship_period','institute_details.certified_status','institute_details.annual_report','institute_details.final_submit','institute_details.faculty_details','institute_details.placement_details','institute_details.file_prevStudent_proof','institute_details.file_upload_signature','institute_details.status_id','institute_details.officer_role_id')
			->where('registration.category_id', 3)
			->where('institute_details.status_id', 1)
			->whereNotIn('institute_details.officer_role_id',[3,5])->where('institute_details.final_submit',1)
            ->get();
		 
		 $data['breadcum'] = 'List of Application Forward To Committee';
		 return $data;
	}
	
	public static function rejected(){
		
		 $data['institute_data'] =DB::table('institute_details')
		    ->leftJoin('user_credential', 'user_credential.id', '=', 'institute_details.user_id')
		    ->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
            ->select('registration.candidate_id','registration.category_id','registration.institute_name','registration.institute_addres','registration.institute_reg_no','registration.pincode','registration.email_id','registration.mobile_no','institute_details.institute_id','institute_details.application_cd','institute_details.department_name','institute_details.coordinate_prog','institute_details.institute_type_id','institute_details.university_rank','institute_details.year_establishment','institute_details.no_student','institute_details.any_collaboration','institute_details.research_phd','institute_details.energy_experience','institute_details.course_start_date','institute_details.no_of_seat','institute_details.specialization_offered','institute_details.industry_collaboration','institute_details.placement_details','institute_details.other_details','institute_details.spon_project','institute_details.fellowship_mtech','institute_details.fellowship_jrf','institute_details.fellowship_srf','institute_details.fellowship_msc','institute_details.fellowship_total','institute_details.fellowship_period','institute_details.certified_status','institute_details.annual_report','institute_details.final_submit','institute_details.faculty_details','institute_details.placement_details','institute_details.file_prevStudent_proof','institute_details.file_upload_signature','institute_details.status_id','institute_details.officer_role_id')
			->where('registration.category_id', 3)
			->where('institute_details.status_id', 2)
			->where('institute_details.officer_role_id', 3)
			//->whereNotIn('institute_details.officer_role_id', [5])
			->where('institute_details.final_submit',1)
			->get();
		 
		 $data['breadcum'] = 'List of Non Considered Application';
		 return $data;
	}
	
	/* public static function selected(){
		
		 $data['institute_data'] =DB::table('institute_details')
		    ->leftJoin('user_credential', 'user_credential.id', '=', 'institute_details.user_id')
		    ->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
            ->select('registration.candidate_id','registration.category_id','registration.institute_name','registration.institute_addres','registration.institute_reg_no','registration.pincode','registration.email_id','registration.mobile_no','institute_details.institute_id','institute_details.application_cd','institute_details.department_name','institute_details.coordinate_prog','institute_details.institute_type_id','institute_details.university_rank','institute_details.year_establishment','institute_details.no_student','institute_details.any_collaboration','institute_details.research_phd','institute_details.energy_experience','institute_details.course_start_date','institute_details.no_of_seat','institute_details.specialization_offered','institute_details.industry_collaboration','institute_details.placement_details','institute_details.other_details','institute_details.spon_project','institute_details.fellowship_mtech','institute_details.fellowship_jrf','institute_details.fellowship_srf','institute_details.fellowship_msc','institute_details.fellowship_total','institute_details.fellowship_period','institute_details.certified_status','institute_details.annual_report','institute_details.final_submit','institute_details.faculty_details','institute_details.placement_details','institute_details.file_prevStudent_proof','institute_details.file_upload_signature','institute_details.status_id','institute_details.officer_role_id')
			->where('registration.category_id', 3)
			->where('institute_details.status_id', 3)->where('institute_details.final_submit',1)
			->get();
			$data['breadcum'] = 'List of Selected Application After Committee Recommendation';
		 return $data;
	} */
	
	
	public static function recommendByCommitee(){
		
		 $data['institute_data'] =DB::table('institute_details')
		    ->leftJoin('user_credential', 'user_credential.id', '=', 'institute_details.user_id')
		    ->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
			->leftJoin('internship_verification', 'institute_details.institute_id', '=', 'internship_verification.institute_id')
            ->select('registration.candidate_id','registration.category_id','registration.institute_name','registration.institute_addres','registration.institute_reg_no','registration.pincode','registration.email_id','registration.mobile_no','institute_details.institute_id','institute_details.application_cd','institute_details.department_name','institute_details.coordinate_prog','institute_details.institute_type_id','institute_details.university_rank','institute_details.year_establishment','institute_details.no_student','institute_details.any_collaboration','institute_details.research_phd','institute_details.energy_experience','institute_details.course_start_date','institute_details.no_of_seat','institute_details.specialization_offered','institute_details.industry_collaboration','institute_details.placement_details','institute_details.other_details','institute_details.spon_project','institute_details.fellowship_mtech','institute_details.fellowship_jrf','institute_details.fellowship_srf','institute_details.fellowship_msc','institute_details.fellowship_total','institute_details.fellowship_period','institute_details.certified_status','institute_details.annual_report','institute_details.final_submit','institute_details.faculty_details','institute_details.placement_details','institute_details.file_prevStudent_proof','institute_details.file_upload_signature','institute_details.status_id','institute_details.officer_role_id','internship_verification.remarks')
			->where('registration.category_id', 3)
			->where('institute_details.status_id', 1)
			->where('institute_details.officer_role_id', 5)
			->where('institute_details.final_submit',1)
			->where('internship_verification.officer_role_id',5)
			->get();
			$data['breadcum'] = 'List of Application After Committee Recommendation';
		 return $data;
	}
	
	
	public static function finalSelect(){
		
		 $data['institute_data'] =DB::table('institute_details')
		    ->leftJoin('user_credential', 'user_credential.id', '=', 'institute_details.user_id')
		    ->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
            ->select('registration.candidate_id','registration.category_id','registration.institute_name','registration.institute_addres','registration.institute_reg_no','registration.pincode','registration.email_id','registration.mobile_no','institute_details.institute_id','institute_details.application_cd','institute_details.department_name','institute_details.coordinate_prog','institute_details.institute_type_id','institute_details.university_rank','institute_details.year_establishment','institute_details.no_student','institute_details.any_collaboration','institute_details.research_phd','institute_details.energy_experience','institute_details.course_start_date','institute_details.no_of_seat','institute_details.specialization_offered','institute_details.industry_collaboration','institute_details.placement_details','institute_details.other_details','institute_details.spon_project','institute_details.fellowship_mtech','institute_details.fellowship_jrf','institute_details.fellowship_srf','institute_details.fellowship_msc','institute_details.fellowship_total','institute_details.fellowship_period','institute_details.certified_status','institute_details.annual_report','institute_details.final_submit','institute_details.faculty_details','institute_details.placement_details','institute_details.file_prevStudent_proof','institute_details.file_upload_signature','institute_details.status_id','institute_details.officer_role_id','institute_details.sancation_forms')
			->where('registration.category_id', 3)
			->where('institute_details.status_id', 3)
			->where('institute_details.final_submit',1)
			->get();
			$data['breadcum'] = 'List of Selected Application';
		 return $data;
	}
	
	public static function rejectByCommitee(){
		
		 $data['institute_data'] =DB::table('institute_details')
		    ->leftJoin('user_credential', 'user_credential.id', '=', 'institute_details.user_id')
		    ->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
            ->select('registration.candidate_id','registration.category_id','registration.institute_name','registration.institute_addres','registration.institute_reg_no','registration.pincode','registration.email_id','registration.mobile_no','institute_details.institute_id','institute_details.application_cd','institute_details.department_name','institute_details.coordinate_prog','institute_details.institute_type_id','institute_details.university_rank','institute_details.year_establishment','institute_details.no_student','institute_details.any_collaboration','institute_details.research_phd','institute_details.energy_experience','institute_details.course_start_date','institute_details.no_of_seat','institute_details.specialization_offered','institute_details.industry_collaboration','institute_details.placement_details','institute_details.other_details','institute_details.spon_project','institute_details.fellowship_mtech','institute_details.fellowship_jrf','institute_details.fellowship_srf','institute_details.fellowship_msc','institute_details.fellowship_total','institute_details.fellowship_period','institute_details.certified_status','institute_details.annual_report','institute_details.final_submit','institute_details.faculty_details','institute_details.placement_details','institute_details.file_prevStudent_proof','institute_details.file_upload_signature','institute_details.status_id','institute_details.officer_role_id')
			->where('registration.category_id', 3)
			->where('institute_details.status_id', 2)
			//->where('institute_details.officer_role_id', 5)
			->whereNotIn('institute_details.officer_role_id', [3])
			->where('institute_details.final_submit',1)
			->get();
			$data['breadcum'] = 'List of Rejected Application By Committee';
		 return $data;
	}
	
	
	
	 
	
	public static function fetch_details($id){
		
		  $data['existRecords']= DB::table('institute_details')->where('institute_id',$id)->get();
		 // $RecordsCount = $existRecords->count();
		 return $data;
	}
	 
	 
      /**
     * Post add form officer into database
     *
     * @add
     */
	 
	 public static function insert_history($postdata)
	 {
		 
		 $transactionResult = DB::transaction(function() use ($postdata) {
			 
			 $insrtQuery=DB::table('institute_details_history')->insert($postdata);
			 
			 });
		return $transactionResult;
		
	 }
	 
	 public static function insert_newDetails($postdata)
	 {
		 
		 $transactionResult = DB::transaction(function() use ($postdata) {
			 
			 $insrtQuery=DB::table('institute_details')->insert($postdata);
			 
			 });
		return $transactionResult;
		
	 }
   
    public static function add($postdata){
	    $transactionResult = DB::transaction(function() use ($postdata) {
			
			date_default_timezone_set('Asia/Kolkata');
		    $date = date('Y-m-d H:i:s');
		
			DB::table('admin_user')->insert($postdata); // Officer data insert into table
			$officer_id = DB::getPDO()->lastInsertId(); 
			
			$sql = DB::table('admin_user')->where('officer_id',$officer_id)->get()->first();
			// dd($sql->officer_name);
			$name = strtolower($sql->officer_name);
							
							
			   /**************** Genrate Password *********************/
			
				$string1="abcdefghijklmnopqrstuvwxyz";
				$string2="1234567890";
				$string3="!@#$%^&*()_+";
				$string=$string1.$string2.$string3;
				$string= str_shuffle($string);
				$user_password  = substr($string,8,14); 
	 
			  /**************** Genrate Password *********************/
		   
			  /**************** Genrate Username *********************/
			  $substring = substr($name, 0, strpos($name, ' '));
			  if($substring != ""){
				
				$name_ex = str_replace('.','',$substring);
				$user_name = strtolower(mb_substr($name_ex, 0, 5).$officer_id);
			  }else{
				$user_name = strtolower(mb_substr($name, 0, 5).$officer_id);
			  }
			   /**************** Genrate Username *********************/
		   
				/**************** Insert data into login table *********************/
				$credential_data['registeration_id'] = "0";
				$credential_data['officer_id'] = $officer_id;
				$credential_data['username'] = $user_name;
				$credential_data['password'] = md5($user_password);
				$credential_data['status'] = $sql->status;
				$credential_data['force_password'] = 1;
				$credential_data['role'] = $sql->role_id;
				$credential_data['created_date'] = $date;
				
				$data = DB::table('user_credential')->insert($credential_data); 
                $credential_last_id = DB::getPDO()->lastInsertId(); 

              
				
				/**************** Insert data into login table *********************/
			
			    if(!empty($credential_last_id)){
				DB::table('admin_user')->where('officer_id',$officer_id)->update(array('user_id'=>$credential_last_id));//dd($update_user_id);
					  
				$to = 'email1@localhost';

				$subject = 'Login Credentials';

				$html = "";	
				$html  .= "Dear ".$name.','. "<br />";	
				$html .= '<br/><br/>Please find your login credentials are given below: '. "<br/>";
				$html .= '<br/>Username : '.$user_name."<br/>" ;
				$html .= '<br/>Password : '.$user_password."<br/>" ;
				$html .= '<br><br><br>Regards,';
				$html .= '<br>HRD portal';
				
				$message = $html;

				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: Server <email2@localhost>' . "\r\n";
				$headers .= 'X-Mailer: PHP/' . phpversion();

				mail($to, $subject, $message, $headers);
				}			
			$result['status'] = '1';
			return $result;
		});
		return $transactionResult;
	}
	
	
	/**
     * Fetch officer data by officer id.
     *
     * @edit
     */
	 
	 public static function edit($id){
		 
		 // >leftJoin('user_credential', 'user_credential.id', '=', 'institute_details.user_id')
		   // ->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
		   
		   
	   $data['institute_data'] =  DB::table('institute_details')
	   ->leftJoin('user_credential', 'user_credential.id', '=', 'institute_details.user_id')
	   ->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
	   ->select('registration.candidate_id','registration.category_id','registration.institute_name','registration.institute_addres','registration.institute_reg_no','registration.pincode','registration.email_id','registration.mobile_no','institute_details.institute_id','institute_details.application_cd','institute_details.department_name','institute_details.coordinate_prog','institute_details.institute_type_id','institute_details.university_rank','institute_details.year_establishment','institute_details.no_student','institute_details.any_collaboration','institute_details.research_phd','institute_details.lstCourse','institute_details.energy_experience','institute_details.course_start_date','institute_details.no_of_seat','institute_details.specialization_offered','institute_details.industry_collaboration','institute_details.placement_details','institute_details.collab_institute','institute_details.other_details','institute_details.spon_project','institute_details.fellowship_period','institute_details.fellowship_mtech','institute_details.fellowship_jrf','institute_details.fellowship_srf','institute_details.fellowship_msc','institute_details.fellowship_ra','institute_details.fellowship_pdf','institute_details.fellowship_total','institute_details.certified_status','institute_details.annual_report','institute_details.final_submit','institute_details.faculty_details','institute_details.placement_details','institute_details.file_prevStudent_proof','institute_details.file_upload_signature','institute_details.course_offered_dept','institute_details.officer_role_id','institute_details.status_id')
	   ->where('institute_details.institute_id',$id)->get()->first();
	   //$data['role_data'] = DB::table('role')->orderBy('role_id','asc')->get();
	   $data['type_inst'] = DB::table('institute_type')->orderBy('institute_type_id','asc')->get();
	   $data['courses_list'] = DB::table('courses')->where('display',1)->orderBy('course_name','asc')->get();
	   $data['courses_offered'] = DB::table('courses')->where('course_offered',1)->orderBy('course_name','asc')->get();
	   return $data;
	 }
	 
	 
	/**
     * Update officer Data into database  by id
     *
     * @update_user
     */
	 
	 public static function update_university($postdata,$id){
		 
		
	 $transactionResult = DB::transaction(function() use ($postdata,$id) {
			
			date_default_timezone_set('Asia/Kolkata');
		    $date = date('Y-m-d H:i:s');
		
		    if(!empty($id)){
				
				$update = DB::table('institute_details')->where('institute_id',$id)->update($postdata);
				
			}
			
			if($update)
			{
				return '1';
			}
			else
			{
				return '0';
				
			}
			
				
		});
		return $transactionResult;
	 }
	 
	 
	 public static function delete_univeristy($id){
		$transactionResult = DB::transaction(function() use ($id) {
		if(!empty($id)){
			
	$data=DB::table("institute_details_history")
    ->where("institute_id", $id)
    ->orderBy("history_id", "DESC")
    ->take(1)
    ->delete();
	
		}
	   return $data;
	   });
	   return $transactionResult;
	 }
	 
	 /**
     *Delete officer data from database using officer id
     *
     * @delete_data
     */
	 
	public static function delete_data($id){
		$transactionResult = DB::transaction(function() use ($id) {
			date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s');
		if(!empty($id)){
			// $candidate_id = DB::table('institute_details')->where('institute_id',$id)->get()->first()->candidate_id;
			// if(!empty($candidate_id)){
				
				$fetchRecord=DB::table('institute_details')->where('institute_id',$id)->get();
				
				// echo "<pre>"; print_r($fetchRecord); die;
				
				/* Insert History code start */
				
			$insertRecord['institute_id']=$fetchRecord[0]->institute_id;
			$insertRecord['user_id']=$fetchRecord[0]->user_id;
			$insertRecord['application_cd']=$fetchRecord[0]->application_cd;
			$insertRecord['scheme_code']=$fetchRecord[0]->scheme_code;
			$insertRecord['officer_id']=$fetchRecord[0]->officer_id;
			$insertRecord['officer_role_id']=$fetchRecord[0]->officer_role_id;
			$insertRecord['status_id']=$fetchRecord[0]->status_id;
			$insertRecord['department_name']=$fetchRecord[0]->department_name;
			$insertRecord['coordinate_prog']=$fetchRecord[0]->coordinate_prog;
			$insertRecord['institute_type_id']=$fetchRecord[0]->institute_type_id;
			$insertRecord['university_rank']=$fetchRecord[0]->university_rank;
			
			$insertRecord['annual_report']=$fetchRecord[0]->annual_report;
			
			$insertRecord['year_establishment']=$fetchRecord[0]->year_establishment;
			$insertRecord['no_student']=$fetchRecord[0]->no_student;
			$insertRecord['faculty_details']=$fetchRecord[0]->faculty_details;
			$insertRecord['any_collaboration']=$fetchRecord[0]->any_collaboration;
			$insertRecord['research_phd']=$fetchRecord[0]->research_phd;
			$insertRecord['energy_experience']=$fetchRecord[0]->energy_experience;
			$insertRecord['course_start_date']=$fetchRecord[0]->course_start_date;
			$insertRecord['no_of_seat']=$fetchRecord[0]->no_of_seat;
			$insertRecord['specialization_offered']=$fetchRecord[0]->specialization_offered;
			$insertRecord['industry_collaboration']=$fetchRecord[0]->industry_collaboration;
			$insertRecord['placement_details']=$fetchRecord[0]->placement_details;
			$insertRecord['file_prevStudent_proof']=$fetchRecord[0]->file_prevStudent_proof;
			$insertRecord['other_details']=$fetchRecord[0]->other_details;
			$insertRecord['spon_project']=$fetchRecord[0]->spon_project;
			$insertRecord['fellowship_mtech']=$fetchRecord[0]->fellowship_mtech;
			$insertRecord['fellowship_jrf']=$fetchRecord[0]->fellowship_jrf;
			$insertRecord['fellowship_srf']=$fetchRecord[0]->fellowship_srf;
			$insertRecord['fellowship_msc']=$fetchRecord[0]->fellowship_msc;
			$insertRecord['fellowship_period']=$fetchRecord[0]->fellowship_period;
			$insertRecord['fellowship_total']=$fetchRecord[0]->fellowship_total;
			$insertRecord['signed_form']=$fetchRecord[0]->signed_form;
			$insertRecord['certified_status']=$fetchRecord[0]->certified_status;
			$insertRecord['file_upload_signature']=$fetchRecord[0]->file_upload_signature;
			$insertRecord['final_submit']=$fetchRecord[0]->final_submit;
			$insertRecord['history_by']=2;
			$insertRecord['created_date']=$fetchRecord[0]->created_date;
			$insertRecord['modified_by']= Auth::user()->id;
			$insertRecord['modified_date']=$date;
			
			$isertData = DB::table('institute_details_history')->insert($insertRecord);
				
				/* Insert History Code Ended */
				
				/* Annual Report Code */
			
			if($fetchRecord[0]->annual_report!=""){
			
			$source_file = public_path('/../public/uploads/nref/'.$fetchRecord[0]->annual_report);
			$destination_path = public_path('/../public/uploads/nref_history/'.$fetchRecord[0]->annual_report);
			
			$isExists = File::exists($source_file);
			//dd($isExists);
			if($isExists)
			{
				\File::copy($source_file , $destination_path);
			}
			}
			
			/* Faculty Members Code */
			
			if($fetchRecord[0]->faculty_details!=""){
			
			$source_file1 = public_path('/../public/uploads/nref/'.$fetchRecord[0]->faculty_details);
			$destination_path1 = public_path('/../public/uploads/nref_history/'.$fetchRecord[0]->faculty_details);
			
			$isExists1 = File::exists($source_file1);
			//dd($isExists);
			if($isExists1)
			{
				\File::copy($source_file1 , $destination_path1);
			}
			}
			
			/* placement of previous students Code */
			
			if($fetchRecord[0]->file_prevStudent_proof!=""){
			$source_file2 = public_path('/../public/uploads/nref/'.$fetchRecord[0]->file_prevStudent_proof);
			$destination_path2 = public_path('/../public/uploads/nref_history/'.$fetchRecord[0]->file_prevStudent_proof);
			
			$isExists2 = File::exists($source_file2);
			//dd($isExists);
			if($isExists2)
			{
				\File::copy($source_file2 , $destination_path2);
			}
			}
			
			
			/* Move Files TO another History Folder */
				
	            DB::table('institute_details')->where('institute_id',$id)->delete();
				$data['status'] = "1";
			// }
		}else{
			$data['status'] = "0"; //Id does not exists;
		}
	   return $data; 
	   });
	   return $transactionResult;
	 }
	 
	 
	 /* Filter Code Start */
	 
	 public static function getState(){
		 
		  $state =DB::table('state_master')->distinct()->orderBy('state_name','asc')->get();
		
		 return $state;
	}
	 
	 public static function pendingInst($frmDate=null,$toDate=null,$stateId=null,$courseId=null){
		 
		  $data['breadcum'] = "List University Data";
		  
		  
		  $a = date("Y-m-d",strtotime($frmDate));
	      $b = date("Y-m-d",strtotime($toDate));

			   
		if($courseId=="mtech")
		{
		$fellow="fellowship_mtech";
		}

		if($courseId=="jrf")
		{
		$fellow="fellowship_jrf";
		}
		
		if($courseId=="srf")
		{
		$fellow="fellowship_srf";
		}
		
		if($courseId=="msc")
		{
		$fellow="fellowship_msc";
		}
		
		if($courseId=="ra")
		{
		$fellow="fellowship_ra";
		}
		
		if($courseId=="pdf")
		{
		$fellow="fellowship_pdf";
		}
		
		  
		  
		  $query =DB::table('institute_details')
		->leftJoin('user_credential', 'user_credential.id', '=', 'institute_details.user_id')
		->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
		->select('registration.institute_name','registration.institute_addres','registration.institute_reg_no','registration.pincode','registration.statecd','registration.category_id','registration.email_id','registration.mobile_no','institute_details.user_id','institute_details.institute_id','institute_details.department_name','institute_details.application_cd','institute_details.coordinate_prog','institute_details.institute_type_id','institute_details.university_rank','institute_details.year_establishment','institute_details.no_student','institute_details.any_collaboration','institute_details.research_phd','institute_details.energy_experience','institute_details.course_start_date','institute_details.no_of_seat','institute_details.specialization_offered','institute_details.industry_collaboration','institute_details.placement_details','institute_details.other_details','institute_details.spon_project','institute_details.fellowship_mtech','institute_details.fellowship_jrf','institute_details.fellowship_srf','institute_details.fellowship_msc','institute_details.fellowship_total','institute_details.fellowship_period','institute_details.certified_status','institute_details.annual_report','institute_details.final_submit','institute_details.faculty_details','institute_details.placement_details','institute_details.file_prevStudent_proof','institute_details.file_upload_signature','institute_details.status_id','institute_details.officer_role_id');
		
		if($courseId!="") {
		$query = $query->whereNotNull($fellow);
		}
		
		if($stateId!="") {
		$query = $query->where('registration.statecd',$stateId);
		}
		
		if($frmDate !="")
		{
			$query= $query->where('institute_details.created_date','>=',$a);
		}
		
		if($toDate !="")
		{
			$query= $query->where('institute_details.created_date','<=',$b);
		}
		
		$query= $query->where('institute_details.status_id',null);
		$query= $query->where('institute_details.final_submit',1);
		
		
		$data['institute_data'] = $query->get();
		
			
		 $data['breadcum'] = 'List of Institute';
		 return $data;
	}
	
	
	//// Consider Level 1 code 
	
	public static function considerInst($frmDate=null,$toDate=null,$stateId=null,$courseId=null){
		 
		  $data['breadcum'] = "List University Data";
		  
		  $a = date("Y-m-d",strtotime($frmDate));
	      $b = date("Y-m-d",strtotime($toDate));

			   
		if($courseId=="mtech")
		{
		$fellow="fellowship_mtech";
		}

		if($courseId=="jrf")
		{
		$fellow="fellowship_jrf";
		}
		
		if($courseId=="srf")
		{
		$fellow="fellowship_srf";
		}
		
		if($courseId=="msc")
		{
		$fellow="fellowship_msc";
		}
		
		if($courseId=="ra")
		{
		$fellow="fellowship_ra";
		}
		
		if($courseId=="pdf")
		{
		$fellow="fellowship_pdf";
		}
		
		  
		  
		  $query =DB::table('institute_details')
		->leftJoin('user_credential', 'user_credential.id', '=', 'institute_details.user_id')
		->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
		->select('registration.institute_name','registration.institute_addres','registration.institute_reg_no','registration.pincode','registration.statecd','registration.category_id','registration.email_id','registration.mobile_no','institute_details.user_id','institute_details.institute_id','institute_details.department_name','institute_details.application_cd','institute_details.coordinate_prog','institute_details.institute_type_id','institute_details.university_rank','institute_details.year_establishment','institute_details.no_student','institute_details.any_collaboration','institute_details.research_phd','institute_details.energy_experience','institute_details.course_start_date','institute_details.no_of_seat','institute_details.specialization_offered','institute_details.industry_collaboration','institute_details.placement_details','institute_details.other_details','institute_details.spon_project','institute_details.fellowship_mtech','institute_details.fellowship_jrf','institute_details.fellowship_srf','institute_details.fellowship_msc','institute_details.fellowship_total','institute_details.fellowship_period','institute_details.certified_status','institute_details.annual_report','institute_details.final_submit','institute_details.faculty_details','institute_details.placement_details','institute_details.file_prevStudent_proof','institute_details.file_upload_signature','institute_details.status_id','institute_details.officer_role_id');
		
		if($courseId!="") {
		$query = $query->whereNotNull($fellow);
		}
		
		if($stateId!="") {
		$query = $query->where('registration.statecd',$stateId);
		}
		
		if($frmDate !="")
		{
			$query= $query->where('institute_details.created_date','>=',$a);
		}
		
		if($toDate !="")
		{
			$query= $query->where('institute_details.created_date','<=',$b);
		}
		
		$query= $query->where('institute_details.status_id',1);
		$query= $query->where('institute_details.officer_role_id',3);
		$query= $query->where('registration.category_id',3);
		$query= $query->where('institute_details.final_submit',1);
		
		
		$data['institute_data'] = $query->get();
			
		 $data['breadcum'] = 'List of Institute';
		 return $data;
	}
	
	
	// Non Consider 
	
		public static function nonconsiderInst($frmDate=null,$toDate=null,$stateId=null,$courseId=null){
		 
		  $data['breadcum'] = "List University Data";
		  
		  $a = date("Y-m-d",strtotime($frmDate));
	      $b = date("Y-m-d",strtotime($toDate));

			   
		if($courseId=="mtech")
		{
		$fellow="fellowship_mtech";
		}

		if($courseId=="jrf")
		{
		$fellow="fellowship_jrf";
		}
		
		if($courseId=="srf")
		{
		$fellow="fellowship_srf";
		}
		
		if($courseId=="msc")
		{
		$fellow="fellowship_msc";
		}
		
		if($courseId=="ra")
		{
		$fellow="fellowship_ra";
		}
		
		if($courseId=="pdf")
		{
		$fellow="fellowship_pdf";
		}
		
		  
		  
		  $query =DB::table('institute_details')
		->leftJoin('user_credential', 'user_credential.id', '=', 'institute_details.user_id')
		->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
		->select('registration.institute_name','registration.institute_addres','registration.institute_reg_no','registration.pincode','registration.statecd','registration.category_id','registration.email_id','registration.mobile_no','institute_details.user_id','institute_details.institute_id','institute_details.department_name','institute_details.application_cd','institute_details.coordinate_prog','institute_details.institute_type_id','institute_details.university_rank','institute_details.year_establishment','institute_details.no_student','institute_details.any_collaboration','institute_details.research_phd','institute_details.energy_experience','institute_details.course_start_date','institute_details.no_of_seat','institute_details.specialization_offered','institute_details.industry_collaboration','institute_details.placement_details','institute_details.other_details','institute_details.spon_project','institute_details.fellowship_mtech','institute_details.fellowship_jrf','institute_details.fellowship_srf','institute_details.fellowship_msc','institute_details.fellowship_total','institute_details.fellowship_period','institute_details.certified_status','institute_details.annual_report','institute_details.final_submit','institute_details.faculty_details','institute_details.placement_details','institute_details.file_prevStudent_proof','institute_details.file_upload_signature','institute_details.status_id','institute_details.officer_role_id');
		
		if($courseId!="") {
		$query = $query->whereNotNull($fellow);
		}
		
		if($stateId!="") {
		$query = $query->where('registration.statecd',$stateId);
		}
		
		if($frmDate !="")
		{
			$query= $query->where('institute_details.created_date','>=',$a);
		}
		
		if($toDate !="")
		{
			$query= $query->where('institute_details.created_date','<=',$b);
		}
		
		$query= $query->where('institute_details.status_id',2);
		$query= $query->where('institute_details.officer_role_id',3);
		//$query= $query->whereNotIn('institute_details.officer_role_id', [5]);
		$query= $query->where('registration.category_id',3);
		$query= $query->where('institute_details.final_submit',1);
		
		
		$data['institute_data'] = $query->get();
		  
		
			
		 $data['breadcum'] = 'List of Institute';
		 return $data;
	}
	
	
	
	//  Forward to Commitie
	
	
		public static function fwdcommitInst($frmDate=null,$toDate=null,$stateId=null,$courseId=null){
		 
		$data['breadcum'] = "List University Data";
	
		  $a = date("Y-m-d",strtotime($frmDate));
	      $b = date("Y-m-d",strtotime($toDate));

			   
		if($courseId=="mtech")
		{
		$fellow="fellowship_mtech";
		}

		if($courseId=="jrf")
		{
		$fellow="fellowship_jrf";
		}
		
		if($courseId=="srf")
		{
		$fellow="fellowship_srf";
		}
		
		if($courseId=="msc")
		{
		$fellow="fellowship_msc";
		}
		
		if($courseId=="ra")
		{
		$fellow="fellowship_ra";
		}
		
		if($courseId=="pdf")
		{
		$fellow="fellowship_pdf";
		}
		
		  
		  
		  $query =DB::table('institute_details')
		->leftJoin('user_credential', 'user_credential.id', '=', 'institute_details.user_id')
		->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
		->select('registration.institute_name','registration.institute_addres','registration.institute_reg_no','registration.pincode','registration.statecd','registration.category_id','registration.email_id','registration.mobile_no','institute_details.user_id','institute_details.institute_id','institute_details.department_name','institute_details.application_cd','institute_details.coordinate_prog','institute_details.institute_type_id','institute_details.university_rank','institute_details.year_establishment','institute_details.no_student','institute_details.any_collaboration','institute_details.research_phd','institute_details.energy_experience','institute_details.course_start_date','institute_details.no_of_seat','institute_details.specialization_offered','institute_details.industry_collaboration','institute_details.placement_details','institute_details.other_details','institute_details.spon_project','institute_details.fellowship_mtech','institute_details.fellowship_jrf','institute_details.fellowship_srf','institute_details.fellowship_msc','institute_details.fellowship_total','institute_details.fellowship_period','institute_details.certified_status','institute_details.annual_report','institute_details.final_submit','institute_details.faculty_details','institute_details.placement_details','institute_details.file_prevStudent_proof','institute_details.file_upload_signature','institute_details.status_id','institute_details.officer_role_id');
		
		if($courseId!="") {
		$query = $query->whereNotNull($fellow);
		}
		
		if($stateId!="") {
		$query = $query->where('registration.statecd',$stateId);
		}
		
		if($frmDate !="")
		{
			$query= $query->where('institute_details.created_date','>=',$a);
		}
		
		if($toDate !="")
		{
			$query= $query->where('institute_details.created_date','<=',$b);
		}
		
		$query= $query->where('institute_details.status_id',1);
		$query= $query->where('registration.category_id',3);
		$query= $query->whereNotIn('institute_details.officer_role_id',[3,5]);
		$query= $query->where('institute_details.final_submit',1);
		
		
		$data['institute_data'] = $query->get();
		  
		 $data['breadcum'] = 'List of Institute';
		 return $data;
	}
	
	
	// Recommmed code
	
	public static function recommendInst($frmDate=null,$toDate=null,$stateId=null,$courseId=null){
		 
		  $data['breadcum'] = "List University Data";
		  
		  $a = date("Y-m-d",strtotime($frmDate));
	      $b = date("Y-m-d",strtotime($toDate));

			   
		if($courseId=="mtech")
		{
		$fellow="fellowship_mtech";
		}

		if($courseId=="jrf")
		{
		$fellow="fellowship_jrf";
		}
		
		if($courseId=="srf")
		{
		$fellow="fellowship_srf";
		}
		
		if($courseId=="msc")
		{
		$fellow="fellowship_msc";
		}
		
		if($courseId=="ra")
		{
		$fellow="fellowship_ra";
		}
		
		if($courseId=="pdf")
		{
		$fellow="fellowship_pdf";
		}
		
		  
		  
		  $query =DB::table('institute_details')
		->leftJoin('user_credential', 'user_credential.id', '=', 'institute_details.user_id')
		->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
		->select('registration.institute_name','registration.institute_addres','registration.institute_reg_no','registration.pincode','registration.statecd','registration.category_id','registration.email_id','registration.mobile_no','institute_details.user_id','institute_details.institute_id','institute_details.department_name','institute_details.application_cd','institute_details.coordinate_prog','institute_details.institute_type_id','institute_details.university_rank','institute_details.year_establishment','institute_details.no_student','institute_details.any_collaboration','institute_details.research_phd','institute_details.energy_experience','institute_details.course_start_date','institute_details.no_of_seat','institute_details.specialization_offered','institute_details.industry_collaboration','institute_details.placement_details','institute_details.other_details','institute_details.spon_project','institute_details.fellowship_mtech','institute_details.fellowship_jrf','institute_details.fellowship_srf','institute_details.fellowship_msc','institute_details.fellowship_total','institute_details.fellowship_period','institute_details.certified_status','institute_details.annual_report','institute_details.final_submit','institute_details.faculty_details','institute_details.placement_details','institute_details.file_prevStudent_proof','institute_details.file_upload_signature','institute_details.status_id','institute_details.officer_role_id');
		
		if($courseId!="") {
		$query = $query->whereNotNull($fellow);
		}
		
		if($stateId!="") {
		$query = $query->where('registration.statecd',$stateId);
		}
		
		if($frmDate !="")
		{
			$query= $query->where('institute_details.created_date','>=',$a);
		}
		
		if($toDate !="")
		{
			$query= $query->where('institute_details.created_date','<=',$b);
		}
		
		$query= $query->where('institute_details.status_id',1);
		$query= $query->where('institute_details.officer_role_id', 5);
		$query= $query->where('registration.category_id',3);
		$query= $query->where('institute_details.final_submit',1);
		
		
		$data['institute_data'] = $query->get();
		  
		
			
		 $data['breadcum'] = 'List of Institute';
		 return $data;
	}
	
	
	// Final Rejection 
	
	public static function finalrejctInst($frmDate=null,$toDate=null,$stateId=null,$courseId=null){
		 
		  $data['breadcum'] = "List University Data";
		  
		  $a = date("Y-m-d",strtotime($frmDate));
	      $b = date("Y-m-d",strtotime($toDate));

			   
		if($courseId=="mtech")
		{
		$fellow="fellowship_mtech";
		}

		if($courseId=="jrf")
		{
		$fellow="fellowship_jrf";
		}
		
		if($courseId=="srf")
		{
		$fellow="fellowship_srf";
		}
		
		if($courseId=="msc")
		{
		$fellow="fellowship_msc";
		}
		
		if($courseId=="ra")
		{
		$fellow="fellowship_ra";
		}
		
		if($courseId=="pdf")
		{
		$fellow="fellowship_pdf";
		}
		
		  
		  
		  $query =DB::table('institute_details')
		->leftJoin('user_credential', 'user_credential.id', '=', 'institute_details.user_id')
		->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
		->select('registration.institute_name','registration.institute_addres','registration.institute_reg_no','registration.pincode','registration.statecd','registration.category_id','registration.email_id','registration.mobile_no','institute_details.user_id','institute_details.institute_id','institute_details.department_name','institute_details.application_cd','institute_details.coordinate_prog','institute_details.institute_type_id','institute_details.university_rank','institute_details.year_establishment','institute_details.no_student','institute_details.any_collaboration','institute_details.research_phd','institute_details.energy_experience','institute_details.course_start_date','institute_details.no_of_seat','institute_details.specialization_offered','institute_details.industry_collaboration','institute_details.placement_details','institute_details.other_details','institute_details.spon_project','institute_details.fellowship_mtech','institute_details.fellowship_jrf','institute_details.fellowship_srf','institute_details.fellowship_msc','institute_details.fellowship_total','institute_details.fellowship_period','institute_details.certified_status','institute_details.annual_report','institute_details.final_submit','institute_details.faculty_details','institute_details.placement_details','institute_details.file_prevStudent_proof','institute_details.file_upload_signature','institute_details.status_id','institute_details.officer_role_id');
		
		if($courseId!="") {
		$query = $query->whereNotNull($fellow);
		}
		
		if($stateId!="") {
		$query = $query->where('registration.statecd',$stateId);
		}
		
		if($frmDate !="")
		{
			$query= $query->where('institute_details.created_date','>=',$a);
		}
		
		if($toDate !="")
		{
			$query= $query->where('institute_details.created_date','<=',$b);
		}
		
		$query= $query->where('institute_details.status_id',2);
		//$query= $query->where('institute_details.officer_role_id', 5);
		$query= $query->whereNotIn('institute_details.officer_role_id', [3]);
		$query= $query->where('registration.category_id',3);
		$query= $query->where('institute_details.final_submit',1);
		
		
		$data['institute_data'] = $query->get();
		  
		
			
		 $data['breadcum'] = 'List of Institute';
		 return $data;
	}
	
	
	// Selected Code 
	
	
		public static function selectedInst($frmDate=null,$toDate=null,$stateId=null,$courseId=null){
		 
		  $data['breadcum'] = "List University Data";
		  
		  $a = date("Y-m-d",strtotime($frmDate));
	      $b = date("Y-m-d",strtotime($toDate));

			   
		if($courseId=="mtech")
		{
		$fellow="fellowship_mtech";
		}

		if($courseId=="jrf")
		{
		$fellow="fellowship_jrf";
		}
		
		if($courseId=="srf")
		{
		$fellow="fellowship_srf";
		}
		
		if($courseId=="msc")
		{
		$fellow="fellowship_msc";
		}
		
		if($courseId=="ra")
		{
		$fellow="fellowship_ra";
		}
		
		if($courseId=="pdf")
		{
		$fellow="fellowship_pdf";
		}
		
		  
		  
		  $query =DB::table('institute_details')
		->leftJoin('user_credential', 'user_credential.id', '=', 'institute_details.user_id')
		->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
		->select('registration.institute_name','registration.institute_addres','registration.institute_reg_no','registration.pincode','registration.statecd','registration.category_id','registration.email_id','registration.mobile_no','institute_details.user_id','institute_details.institute_id','institute_details.department_name','institute_details.application_cd','institute_details.coordinate_prog','institute_details.institute_type_id','institute_details.university_rank','institute_details.year_establishment','institute_details.no_student','institute_details.any_collaboration','institute_details.research_phd','institute_details.energy_experience','institute_details.course_start_date','institute_details.no_of_seat','institute_details.specialization_offered','institute_details.industry_collaboration','institute_details.placement_details','institute_details.other_details','institute_details.spon_project','institute_details.fellowship_mtech','institute_details.fellowship_jrf','institute_details.fellowship_srf','institute_details.fellowship_msc','institute_details.fellowship_total','institute_details.fellowship_period','institute_details.certified_status','institute_details.annual_report','institute_details.final_submit','institute_details.faculty_details','institute_details.placement_details','institute_details.file_prevStudent_proof','institute_details.file_upload_signature','institute_details.status_id','institute_details.officer_role_id','institute_details.sancation_forms');
		
		if($courseId!="") {
		$query = $query->whereNotNull($fellow);
		}
		
		if($stateId!="") {
		$query = $query->where('registration.statecd',$stateId);
		}
		
		if($frmDate !="")
		{
			$query= $query->where('institute_details.created_date','>=',$a);
		}
		
		if($toDate !="")
		{
			$query= $query->where('institute_details.created_date','<=',$b);
		}
		
		$query= $query->where('institute_details.status_id',3);
		$query= $query->where('registration.category_id',3);
		$query= $query->where('institute_details.final_submit',1);
		
		
		$data['institute_data'] = $query->get();
		  
		
			
		 $data['breadcum'] = 'List of Institute';
		 return $data;
	}
	
	
	 public static function all_export_data($coursepdf=null,$statepdf=null,$frmDate=null,$toDate=null,$institutetype=null)
	 
	 {
		$a = date("Y-m-d",strtotime($frmDate));
		$b = date("Y-m-d",strtotime($toDate));

		if($coursepdf=="mtech")
		{
		$fellow="fellowship_mtech";
		}

		if($coursepdf=="jrf")
		{
		$fellow="fellowship_jrf";
		}

		if($coursepdf=="srf")
		{
		$fellow="fellowship_srf";
		}

		if($coursepdf=="msc")
		{
		$fellow="fellowship_msc";
		}

		if($coursepdf=="ra")
		{
		$fellow="fellowship_ra";
		}

		if($coursepdf=="pdf")
		{
		$fellow="fellowship_pdf";
		}
		
			$query =DB::table('institute_details')
			->leftJoin('user_credential', 'user_credential.id', '=', 'institute_details.user_id')
			->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
			->select('registration.institute_name','registration.institute_addres','registration.institute_reg_no','registration.pincode','registration.statecd','registration.category_id','registration.email_id','registration.mobile_no','institute_details.user_id','institute_details.institute_id','institute_details.department_name','institute_details.application_cd','institute_details.coordinate_prog','institute_details.institute_type_id','institute_details.university_rank','institute_details.year_establishment','institute_details.no_student','institute_details.any_collaboration','institute_details.research_phd','institute_details.energy_experience','institute_details.course_start_date','institute_details.no_of_seat','institute_details.specialization_offered','institute_details.industry_collaboration','institute_details.placement_details','institute_details.other_details','institute_details.spon_project','institute_details.fellowship_mtech','institute_details.fellowship_jrf','institute_details.fellowship_srf','institute_details.fellowship_msc','institute_details.fellowship_ra','institute_details.fellowship_pdf','institute_details.fellowship_total','institute_details.fellowship_period','institute_details.certified_status','institute_details.annual_report','institute_details.lstCourse','institute_details.final_submit','institute_details.faculty_details','institute_details.placement_details','institute_details.file_prevStudent_proof','institute_details.file_upload_signature','institute_details.status_id','institute_details.officer_role_id');

			if($coursepdf!="") {
			$query = $query->whereNotNull($fellow);
			}

			if($statepdf!="") {
			$query = $query->where('registration.statecd',$statepdf);
			}

			if($frmDate !="")
			{
			$query= $query->where('institute_details.created_date','>=',$a);
			}

			if($toDate !="")
			{
			$query= $query->where('institute_details.created_date','<=',$b);
			}
			
			
			if($institutetype == "7"){
			$query= $query->where('institute_details.status_id',2);
			//$query= $query->where('institute_details.officer_role_id', 5);
			$query= $query->whereNotIn('institute_details.officer_role_id',[3]);
			}
			
			if($institutetype == "6"){
			$query= $query->where('institute_details.status_id',3);
			}
			
			if($institutetype == "5"){
			$query= $query->where('institute_details.status_id',1);
			$query= $query->where('institute_details.officer_role_id',5);
			}
			else if($institutetype == "4"){
			$query= $query->where('institute_details.status_id',1);
			$query= $query->whereNotIn('institute_details.officer_role_id',[3,5]);
			}
			
			else if($institutetype == "3"){
			$query= $query->where('institute_details.status_id',2);
			//$query= $query->whereNotIn('institute_details.officer_role_id', [5]);
			$query= $query->where('institute_details.officer_role_id', 3);
			}
			
			else if($institutetype == "2"){
			$query= $query->where('institute_details.status_id',1);
		    $query= $query->where('institute_details.officer_role_id',3);
			}
			
			else if($institutetype == "1"){
			$query= $query->where('institute_details.status_id',null);
			}
			
			
			
			$query= $query->where('registration.category_id',3);
			$query= $query->where('institute_details.final_submit',1);

			$data['institute_details']  = $query->get();

			$data['type_inst'] = DB::table('institute_type')->orderBy('institute_type_id','asc')->get();
			$data['courses_list'] = DB::table('courses')->where('display',1)->orderBy('course_name','asc')->get();
			return $data;
    }
	
	/* Export Code In Excel Format */
	
		public static function export_all($coursepdf=null,$statepdf=null,$frmDate=null,$toDate=null,$institutetype=null){
			
			
		$a = date("Y-m-d",strtotime($frmDate));
		$b = date("Y-m-d",strtotime($toDate));

		if($coursepdf=="mtech")
		{
		$fellow="fellowship_mtech";
		}

		if($coursepdf=="jrf")
		{
		$fellow="fellowship_jrf";
		}

		if($coursepdf=="srf")
		{
		$fellow="fellowship_srf";
		}

		if($coursepdf=="msc")
		{
		$fellow="fellowship_msc";
		}

		if($coursepdf=="ra")
		{
		$fellow="fellowship_ra";
		}

		if($coursepdf=="pdf")
		{
		$fellow="fellowship_pdf";
		}
		
		
		$data=array();
		
		
		$query =DB::table('institute_details')
			->leftJoin('user_credential', 'user_credential.id', '=', 'institute_details.user_id')
			->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
			->select('registration.institute_name','registration.institute_addres','registration.institute_reg_no','registration.pincode','registration.statecd','registration.category_id','registration.email_id','registration.mobile_no','institute_details.user_id','institute_details.institute_id','institute_details.department_name','institute_details.application_cd','institute_details.coordinate_prog','institute_details.institute_type_id','institute_details.university_rank','institute_details.year_establishment','institute_details.no_student','institute_details.any_collaboration','institute_details.research_phd','institute_details.energy_experience','institute_details.course_start_date','institute_details.no_of_seat','institute_details.specialization_offered','institute_details.industry_collaboration','institute_details.placement_details','institute_details.other_details','institute_details.spon_project','institute_details.fellowship_mtech','institute_details.fellowship_jrf','institute_details.fellowship_srf','institute_details.fellowship_msc','institute_details.fellowship_ra','institute_details.fellowship_pdf','institute_details.fellowship_total','institute_details.fellowship_period','institute_details.certified_status','institute_details.annual_report','institute_details.lstCourse','institute_details.final_submit','institute_details.faculty_details','institute_details.placement_details','institute_details.file_prevStudent_proof','institute_details.file_upload_signature','institute_details.status_id','institute_details.officer_role_id');
			
			if($coursepdf!="") {
			$query = $query->whereNotNull($fellow);
			}

			if($statepdf!="") {
			$query = $query->where('registration.statecd',$statepdf);
			}

			if($frmDate !="")
			{
			$query= $query->where('institute_details.created_date','>=',$a);
			}

			if($toDate !="")
			{
			$query= $query->where('institute_details.created_date','<=',$b);
			}
			
			if($institutetype == "7"){
			$query= $query->where('institute_details.status_id',2);
			//$query= $query->where('institute_details.officer_role_id', 5);
			$query= $query->whereNotIn('institute_details.officer_role_id',[3]);
			}
			
			if($institutetype == "6"){
			$query= $query->where('institute_details.status_id',3);
			}

			if($institutetype == "5"){
			$query= $query->where('institute_details.status_id',1);
			$query= $query->where('institute_details.officer_role_id',5);
			}
			
			else if($institutetype == "4"){
			$query= $query->where('institute_details.status_id',1);
			$query= $query->whereNotIn('institute_details.officer_role_id',[3,5]);
			}
			
			else if($institutetype == "3"){
			$query= $query->where('institute_details.status_id',2);
			//$query= $query->whereNotIn('institute_details.officer_role_id',[5]);
			$query= $query->where('institute_details.officer_role_id',3);
			}
			
			else if($institutetype == "2"){
			$query= $query->where('institute_details.status_id',1);
		    $query= $query->where('institute_details.officer_role_id',3);
			}
			
			else if($institutetype == "1"){
			$query= $query->where('institute_details.status_id',null);
			}
			
			$query= $query->where('registration.category_id',3);
			$query= $query->where('institute_details.final_submit',1);
			
			$data['institute_details']  = $query->get();
			
			$data['type_inst'] = DB::table('institute_type')->orderBy('institute_type_id','asc')->get();
			$data['courses_list'] = DB::table('courses')->where('display',1)->orderBy('course_name','asc')->get();
	
	
	//echo "<pre>"; print_r($data['institute_details']); die;
		 if(isset($data['institute_details']) && !empty($data['institute_details']))
		{  
	
	    $header2=$newcomp=array();
		$data['header']=array(
		'0' =>array(
		''  =>"S. No.",
		'application_cd'  =>"Application Id",
		'dept_name' =>  "Name of the Department",
		'cordinate_prog'=>  "Coordinator of the Proposed Program",
		'type_institute'=>  "Type of Institution",
		'uni_rank'=>  "University/Institute Ranking as per UGC/NIRF",
		'course_list'=>  "Course Listing",
		'year_est'=>  "Years of Establishment",
		'approx_student'=>  "Approx. Number of Students in Proposed Program",
		'any_collabInst'=>  "Any Collaborative Institute",
		'exp_energyCourse'=>  "Experience in Energy related courses",
		'date_start'=>  "A) Date of approximate course Start",
		'no_seats'=>  "B) Number of Seats in each of the course",
		'special_offer'=>  "C) Specialization offered",
		'indus_collab'=>"D) If any industry collaboration is there, if so details thereof",
		'placement_prov'=>  "E) If placement service is being provided",
		'any_details'=>  "F ) Any other details",
		'spon_project'=>  "Sponsored Projects in the area of Energy, Environment and Renewable Energy",
		'fellow_period'=>  "Fellowship slot requirement Period",
		'mtech'=>  "M.Tech.",
		'jrf'=>  "JRF",
		'srf'=>  "SRF",
		'msc'=>  "M.SC. Renewable Energy",
		'ra'=>  "RA",
		'pdf'=>  "PDF",
		'fellow_total'=>  "Total",

		),
		);
		 $i=1; 
		foreach($data['institute_details'] as $value)
		{ 
		
		
		if(isset($data['type_inst'])){
		foreach($data['type_inst'] as $instit){
		if($instit->institute_type_id == $value->institute_type_id){
		$instType = $instit->institute_desc;
		}
		}
		}
		
		$curse=explode(',',$value->lstCourse);
		
		if(isset($data['courses_list'])) {
		foreach($data['courses_list'] as $val)

		if(count($curse)>0) { 
		for($k=0;$k<count($curse);$k++) {
		if($curse[$k]==$val->course_id) {
	    $courseList[]=$val->course_name;
		} } }
		}

		$data['internship_export'][$i]['']=$i;
		$data['internship_export'][$i]['application_cd'] = $value->application_cd;
		$data['internship_export'][$i]['dept_name']=  $value->department_name;
		$data['internship_export'][$i]['cordinate_prog'] = $value->coordinate_prog;
		$data['internship_export'][$i]['type_institute'] = $instType;
		$data['internship_export'][$i]['uni_rank'] = $value->university_rank;
		$data['internship_export'][$i]['course_list'] =  implode(',',$courseList);
		$data['internship_export'][$i]['year_est'] = $value->year_establishment;
		$data['internship_export'][$i]['approx_student'] = $value->no_student;
		$data['internship_export'][$i]['any_collabInst'] = ucfirst($value->any_collaboration);
		$data['internship_export'][$i]['exp_energyCourse'] = $value->energy_experience;
		$data['internship_export'][$i]['date_start'] = $value->course_start_date;
		$data['internship_export'][$i]['no_seats'] = $value->no_of_seat;
		$data['internship_export'][$i]['special_offer'] = $value->specialization_offered;
		$data['internship_export'][$i]['indus_collab'] = $value->industry_collaboration;
		$data['internship_export'][$i]['placement_prov'] = ucfirst($value->placement_details);
		$data['internship_export'][$i]['any_details'] = $value->other_details;
		$data['internship_export'][$i]['spon_project'] = $value->spon_project;
		$data['internship_export'][$i]['fellow_period'] = $value->fellowship_period;
		$data['internship_export'][$i]['mtech'] = $value->fellowship_mtech;
		$data['internship_export'][$i]['jrf'] = $value->fellowship_jrf;
		$data['internship_export'][$i]['srf'] = $value->fellowship_srf;
		$data['internship_export'][$i]['msc'] = $value->fellowship_msc;
		$data['internship_export'][$i]['ra'] = $value->fellowship_ra;
		$data['internship_export'][$i]['pdf'] = $value->fellowship_pdf;
		$data['internship_export'][$i]['fellow_total'] = $value->fellowship_total;
		$i++;
		} 
		 }
		
		
		//echo "<pre>"; print_r($data); die;
		return $data;   
		}
	 
	
	  
	
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
}

