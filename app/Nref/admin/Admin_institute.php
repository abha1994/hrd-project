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
           ->select('registration.institute_name','registration.institute_addres','registration.institute_reg_no','registration.pincode','institute_details.user_id','institute_details.institute_id','institute_details.department_name','institute_details.application_cd','institute_details.coordinate_prog','institute_details.institute_type_id','institute_details.university_rank','institute_details.year_establishment','institute_details.no_student','institute_details.any_collaboration','institute_details.research_phd','institute_details.energy_experience','institute_details.course_start_date','institute_details.no_of_seat','institute_details.specialization_offered','institute_details.industry_collaboration','institute_details.placement_details','institute_details.other_details','institute_details.spon_project','institute_details.fellowship_mtech','institute_details.fellowship_jrf','institute_details.fellowship_srf','institute_details.fellowship_msc','institute_details.certified_status','institute_details.annual_report','institute_details.final_submit','institute_details.faculty_details','institute_details.placement_details','institute_details.file_prevStudent_proof','institute_details.file_upload_signature','institute_details.status_id','institute_details.officer_role_id')
			->where('institute_details.status_id',NULL)
            ->get();
			
		 $data['breadcum'] = 'List of Institute';
		 return $data;
	}
	
	public static function considered_by_level1(){
		 $data['institute_data'] =DB::table('institute_details')
		    ->leftJoin('user_credential', 'user_credential.id', '=', 'institute_details.user_id')
		    ->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
		    ->select('registration.candidate_id','registration.category_id','registration.institute_name','registration.institute_addres','registration.institute_reg_no','registration.pincode','institute_details.institute_id','institute_details.application_cd','institute_details.department_name','institute_details.coordinate_prog','institute_details.institute_type_id','institute_details.university_rank','institute_details.year_establishment','institute_details.no_student','institute_details.any_collaboration','institute_details.research_phd','institute_details.energy_experience','institute_details.course_start_date','institute_details.no_of_seat','institute_details.specialization_offered','institute_details.industry_collaboration','institute_details.placement_details','institute_details.other_details','institute_details.spon_project','institute_details.fellowship_mtech','institute_details.fellowship_jrf','institute_details.fellowship_srf','institute_details.fellowship_msc','institute_details.certified_status','institute_details.annual_report','institute_details.final_submit','institute_details.faculty_details','institute_details.placement_details','institute_details.file_prevStudent_proof','institute_details.file_upload_signature','institute_details.status_id','institute_details.officer_role_id')
			->where('registration.category_id', 3)
			->where('institute_details.status_id', 1)
			->where('institute_details.officer_role_id',3)
			->get();
			
		 $data['breadcum'] = 'List of Application Considered by Level 1 Officer';
		 return $data;
	}
	
	
	public static function forward_to_committee(){
		
		 $data['institute_data'] =DB::table('institute_details')
		    ->leftJoin('user_credential', 'user_credential.id', '=', 'institute_details.user_id')
		    ->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
            ->select('registration.candidate_id','registration.category_id','registration.institute_name','registration.institute_addres','registration.institute_reg_no','registration.pincode','institute_details.institute_id','institute_details.application_cd','institute_details.department_name','institute_details.coordinate_prog','institute_details.institute_type_id','institute_details.university_rank','institute_details.year_establishment','institute_details.no_student','institute_details.any_collaboration','institute_details.research_phd','institute_details.energy_experience','institute_details.course_start_date','institute_details.no_of_seat','institute_details.specialization_offered','institute_details.industry_collaboration','institute_details.placement_details','institute_details.other_details','institute_details.spon_project','institute_details.fellowship_mtech','institute_details.fellowship_jrf','institute_details.fellowship_srf','institute_details.fellowship_msc','institute_details.certified_status','institute_details.annual_report','institute_details.final_submit','institute_details.faculty_details','institute_details.placement_details','institute_details.file_prevStudent_proof','institute_details.file_upload_signature','institute_details.status_id','institute_details.officer_role_id')
			->where('registration.category_id', 3)
			->where('institute_details.status_id', 1)
			->whereNotIn('institute_details.officer_role_id',[3])
            ->get();
		 
		 $data['breadcum'] = 'List of Application Forward To Committee';
		 return $data;
	}
	
	public static function rejected(){
		
		 $data['institute_data'] =DB::table('institute_details')
		    ->leftJoin('user_credential', 'user_credential.id', '=', 'institute_details.user_id')
		    ->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
            ->select('registration.candidate_id','registration.category_id','registration.institute_name','registration.institute_addres','registration.institute_reg_no','registration.pincode','institute_details.institute_id','institute_details.application_cd','institute_details.department_name','institute_details.coordinate_prog','institute_details.institute_type_id','institute_details.university_rank','institute_details.year_establishment','institute_details.no_student','institute_details.any_collaboration','institute_details.research_phd','institute_details.energy_experience','institute_details.course_start_date','institute_details.no_of_seat','institute_details.specialization_offered','institute_details.industry_collaboration','institute_details.placement_details','institute_details.other_details','institute_details.spon_project','institute_details.fellowship_mtech','institute_details.fellowship_jrf','institute_details.fellowship_srf','institute_details.fellowship_msc','institute_details.certified_status','institute_details.annual_report','institute_details.final_submit','institute_details.faculty_details','institute_details.placement_details','institute_details.file_prevStudent_proof','institute_details.file_upload_signature','institute_details.status_id','institute_details.officer_role_id')
			->where('registration.category_id', 3)
			->where('institute_details.status_id', 2)
			->get();
		 
		 $data['breadcum'] = 'List of Non Considered Application';
		 return $data;
	}
	
	public static function selected(){
		
		 $data['institute_data'] =DB::table('institute_details')
		    ->leftJoin('user_credential', 'user_credential.id', '=', 'institute_details.user_id')
		    ->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
            ->select('registration.candidate_id','registration.category_id','registration.institute_name','registration.institute_addres','registration.institute_reg_no','registration.pincode','institute_details.institute_id','institute_details.application_cd','institute_details.department_name','institute_details.coordinate_prog','institute_details.institute_type_id','institute_details.university_rank','institute_details.year_establishment','institute_details.no_student','institute_details.any_collaboration','institute_details.research_phd','institute_details.energy_experience','institute_details.course_start_date','institute_details.no_of_seat','institute_details.specialization_offered','institute_details.industry_collaboration','institute_details.placement_details','institute_details.other_details','institute_details.spon_project','institute_details.fellowship_mtech','institute_details.fellowship_jrf','institute_details.fellowship_srf','institute_details.fellowship_msc','institute_details.certified_status','institute_details.annual_report','institute_details.final_submit','institute_details.faculty_details','institute_details.placement_details','institute_details.file_prevStudent_proof','institute_details.file_upload_signature','institute_details.status_id','institute_details.officer_role_id')
			->where('registration.category_id', 3)
			->where('institute_details.status_id', 3)
			->get();
			$data['breadcum'] = 'List of Selected Application After Committee Recommendation';
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
	   ->select('registration.candidate_id','registration.category_id','registration.institute_name','registration.institute_addres','registration.institute_reg_no','registration.pincode','institute_details.institute_id','institute_details.application_cd','institute_details.department_name','institute_details.coordinate_prog','institute_details.institute_type_id','institute_details.university_rank','institute_details.year_establishment','institute_details.no_student','institute_details.any_collaboration','institute_details.research_phd','institute_details.energy_experience','institute_details.course_start_date','institute_details.no_of_seat','institute_details.specialization_offered','institute_details.industry_collaboration','institute_details.placement_details','institute_details.other_details','institute_details.spon_project','institute_details.fellowship_mtech','institute_details.fellowship_jrf','institute_details.fellowship_srf','institute_details.fellowship_msc','institute_details.certified_status','institute_details.annual_report','institute_details.final_submit','institute_details.faculty_details','institute_details.placement_details','institute_details.file_prevStudent_proof','institute_details.file_upload_signature')
	   ->where('institute_details.institute_id',$id)->get()->first();
	   //$data['role_data'] = DB::table('role')->orderBy('role_id','asc')->get();
	   $data['type_inst'] = DB::table('institute_type')->orderBy('institute_type_id','asc')->get();
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
			$insertRecord['signed_form']=$fetchRecord[0]->signed_form;
			$insertRecord['certified_status']=$fetchRecord[0]->certified_status;
			$insertRecord['file_upload_signature']=$fetchRecord[0]->file_upload_signature;
			$insertRecord['final_submit']=$fetchRecord[0]->final_submit;
			$insertRecord['history_by']=2;
			$insertRecord['created_date']=$fetchRecord[0]->created_date;
			$insertRecord['created_by']=$fetchRecord[0]->created_by;
			$insertRecord['modified_date']=$fetchRecord[0]->modified_date;
			
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
	 
	
	  
	
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
}

