<?php

// namespace App\Http\Controllers;
namespace App\Http\Controllers\Internship\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use DateTime;
use Illuminate\Support\Facades\Hash;
use Validator,Redirect;
use App\Internship\Admin\AdminInternship;
use Session;
use App\Http\Requests\Form_validation;
use DataTables;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Role;

class AdminInternshipController extends Controller
{  
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		$current_url =  \Request::segment(1);
		if($current_url == 'admin-internship'){
			
			$this->middleware('permission:admin-internship-list|admin-internship-edit|admin-internship-delete', ['only' => ['index','view']]);
			$this->middleware('permission:admin-internship-edit', ['only' => ['edit','update']]);
			$this->middleware('permission:admin-internship-delete', ['only' => ['destroy']]);
			
		}else if($current_url == 'considered-internship'){
			
			$this->middleware('permission:considered-internship-by-level1-list|considered-internship-by-level1-edit|considered-internship-by-level1-delete', ['only' => ['considered_level_1','view']]);
			$this->middleware('permission:considered-internship-by-level1-edit', ['only' => ['edit','update']]);
			$this->middleware('permission:considered-internship-by-level1-delete', ['only' => ['destroy']]);

		}else if($current_url == 'rejected-internship'){
			
			$this->middleware('permission:rejected-internship-list|rejected-internship-edit|rejected-internship-delete', ['only' => ['rejected_internship','view']]);
			$this->middleware('permission:rejected-internship-edit', ['only' => ['edit','update']]);
			$this->middleware('permission:rejected-internship-delete', ['only' => ['destroy']]);
			
		}else if($current_url == 'forward-to-committee'){
			
			$this->middleware('permission:forward-to-committee-internship-list|forward-to-committee-internship-edit|forward-to-committee-internship-delete', ['only' => ['forword_to_committee','view']]);
			$this->middleware('permission:forward-to-committee-internship-edit', ['only' => ['edit','update']]);
			$this->middleware('permission:forward-to-committee-internship-delete', ['only' => ['destroy']]);
			
		}else if($current_url == 'selected-internship'){
			
			$this->middleware('permission:Selected-internship-list|Selected-internship-edit|Selected-internship-delete', ['only' => ['selected_internship','view']]);
			$this->middleware('permission:Selected-internship-edit', ['only' => ['edit','update']]);
			$this->middleware('permission:Selected-internship-delete', ['only' => ['destroy']]);
		}
		
	  }
	
	
	/**
     * For Fetch permission  data from user creadentials table
     *
     * @permission_data
     */
	 
	
 
	
	
 
    public function index(Request $request)
    { 
	
	
		  
	   if ($request->ajax()) {  
					$intern_duration = $request->intern_duration;
					$pass_status = $request->pass_status;
					$datepicker_search_from = $request->datepicker_search_from;
					$dt21 = $request->dt21;
				  
					$data = AdminInternship::index($intern_duration,$pass_status,$datepicker_search_from,$dt21);
					// dd($data);
					return Datatables::of($data['internship_data'])
						->addIndexColumn()
						->addColumn('first_name', function($row){
							$first_name = $row->first_name.' '.$row->last_name;
							return $first_name;
						})
						->addColumn('intern_duration', function($row){
							$intern_duration = $row->intern_duration.' Month';
							return $intern_duration;
						})
						->addColumn('date_entry', function($row){
							$date_entry = date("d-m-Y",strtotime($row->date_entry));
							return $date_entry;
						})
						->addColumn('action', function($row){

							$candidate_id = 	self::ID_encode($row->candidate_id);
							$editUrl = url('/admin-internship-edit/'.$candidate_id);
							$viewUrl = url('/admin-internship-view/'.$candidate_id);
							$deleteUrl = url('/admin-internship-delete/'.$candidate_id);
							
							if (Auth::user()->can('admin-internship-edit', App\Model::class)){
								$edit = '<a href="'.$editUrl.'"><i class="fa fa-edit"  data-toggle="tooltip" title="Edit"></i></a>';
							}else{
								$edit = "";
							}
							if (Auth::user()->can('admin-internship-list', App\Model::class)){
							   $view = '<a href="'.$viewUrl.'"><i class="fa fa-eye" data-toggle="tooltip" title="View"></i></a>';
							}else{
								$view = "";
							}
							if (Auth::user()->can('admin-internship-delete', App\Model::class)){
							   $delete =  "<a href='".$deleteUrl."' data-toggle='tooltip' title='Delete'  onclick=\"return confirm('Are you sure you want to delete?')\"><i class='fa fa-trash'></i></a>";
							}else{
								$delete = "";
							}
							   $action = $edit.$view.$delete ;
							 return $action;
						 })
					 ->rawColumns(['action','first_name','intern_duration','date_entry'])
					 ->make(true);
					}
					$data = AdminInternship::index();
					return view('backend/internship/admin_internship/list',compact('data'));
				
	}
	
	
	 /**
     *Fetch All Considered internship data by level 1
     *
     * @considered_level_1
     */
	public function considered_level_1(Request $request)
    { 
	  if ($request->ajax()) {  
					$intern_duration = $request->intern_duration;
					$pass_status = $request->pass_status;
					$datepicker_search_from = $request->datepicker_search_from;
					$dt21 = $request->dt21;
				 
					$data = AdminInternship::considered_level_1($intern_duration,$pass_status,$datepicker_search_from,$dt21);
					return Datatables::of($data['internship_data'])
							->addIndexColumn()
							->addColumn('first_name', function($row){
								$first_name = $row->first_name.' '.$row->last_name;
								return $first_name;
							})
							->addColumn('intern_duration', function($row){
								$intern_duration = $row->intern_duration.' Month';
								return $intern_duration;
							})
							->addColumn('date_entry', function($row){
								$date_entry = date("d-m-Y",strtotime($row->date_entry));
								return $date_entry;
							})
							->addColumn('action', function($row){
								$candidate_id = 	self::ID_encode($row->candidate_id);
								$editUrl = url('/admin-internship-edit/'.$candidate_id);
								$viewUrl = url('/admin-internship-view/'.$candidate_id);
								$deleteUrl = url('/admin-internship-delete/'.$candidate_id);
								   $edit = '<a href="'.$editUrl.'"><i class="fa fa-edit"  data-toggle="tooltip" title="Edit"></i></a>';
								   $view = '<a href="'.$viewUrl.'"><i class="fa fa-eye" data-toggle="tooltip" title="View"></i></a>';
								   $delete =  "<a href='".$deleteUrl."' data-toggle='tooltip' title='Delete'   onclick=\"return confirm('Are you sure you want to delete?')\"><i class='fa fa-trash'></i></a>";
  								   return $edit.' '.$view.' '.$delete;
						   })
					 ->rawColumns(['action','first_name','intern_duration','date_entry'])
					 ->make(true);
				}
				$data = AdminInternship::considered_level_1();
				return view('backend/internship/admin_internship/list_level_1',compact('data'));
	}
	
	 
	 	 /**
     *Fetch All Considered internship data by level 2
     *
     * @forword_to_committee
     */
	public function forword_to_committee(Request $request)
    { 
	 if ($request->ajax()) {  
					$intern_duration = $request->intern_duration;
					$pass_status = $request->pass_status;
					$datepicker_search_from = $request->datepicker_search_from;
					$dt21 = $request->dt21;
				 
					$data = AdminInternship::forword_to_committee($intern_duration,$pass_status,$datepicker_search_from,$dt21);
					
					return Datatables::of($data['internship_data'])
							->addIndexColumn()
							->addColumn('first_name', function($row){
								$first_name = $row->first_name.' '.$row->last_name;
								return $first_name;
							})
							->addColumn('intern_duration', function($row){
								$intern_duration = $row->intern_duration.' Month';
								return $intern_duration;
							})
							->addColumn('date_entry', function($row){
								$date_entry = date("d-m-Y",strtotime($row->date_entry));
								return $date_entry;
							})
							->addColumn('action', function($row){
								$candidate_id = 	self::ID_encode($row->candidate_id);
								$selected_url = url('/selected-candidate/'.$row->candidate_id);
								$editUrl = url('/admin-internship-edit/'.$candidate_id);
								$viewUrl = url('/admin-internship-view/'.$candidate_id);
								$deleteUrl = url('/admin-internship-delete/'.$candidate_id);
								
								
							if (Auth::user()->can('forward-to-committee-edit', App\Model::class)){	
							   $edit = '<a href="'.$editUrl.'"><i class="fa fa-edit"  data-toggle="tooltip" title="Edit"></i></a>';
							}
							if (Auth::user()->can('forward-to-committee-list', App\Model::class)){
							   $view = '<a href="'.$viewUrl.'"><i class="fa fa-eye" data-toggle="tooltip" title="View"></i></a>';
							}
							if (Auth::user()->can('forward-to-committee-delete', App\Model::class)){
							   $delete =  "<a href='".$deleteUrl."' data-toggle='tooltip' title='Delete'  onclick=\"return confirm('Are you sure you want to delete?')\"><i class='fa fa-trash'></i></a>";
							}
								
						     
							  
							  if (Auth::user()->can('forward-to-committee-internship-status-selected', App\Model::class)){
                                $action = "<a href=".$selected_url." onclick=\"return confirm('Are you sure you want to Select this candidate?')\"><button type='button' class='btn btn-primary' style='border: #d81a11;font-size:10px;width:75%;background-color: #096c71;'>Click For Selection</button></a>";
								}else{
									$action ="";
								}
							
								
								return $action.' '.$edit.' '.$view.' '.$delete;
						   })
					 ->rawColumns(['action','first_name','intern_duration','date_entry'])
					 ->make(true);
				}
				$data = AdminInternship::forword_to_committee();
				return view('backend/internship/admin_internship/list_forward_committee',compact('data'));
	 }
	
	 /**
     *Fetch All Rejected internship data by level 2
     *
     * @rejected_internship
     */
	 
    public function rejected_internship(Request $request)
    { 
	   if ($request->ajax()) {  
					$intern_duration = $request->intern_duration;
					$pass_status = $request->pass_status;
					$datepicker_search_from = $request->datepicker_search_from;
					$dt21 = $request->dt21;
				 
					$data = AdminInternship::rejected_internship($intern_duration,$pass_status,$datepicker_search_from,$dt21);
					return Datatables::of($data['internship_data'])
							->addIndexColumn()
							->addColumn('first_name', function($row){
								$first_name = $row->first_name.' '.$row->last_name;
								return $first_name;
							})
							->addColumn('intern_duration', function($row){
								$intern_duration = $row->intern_duration.' Month';
								return $intern_duration;
							})
							->addColumn('date_entry', function($row){
								$date_entry = date("d-m-Y",strtotime($row->date_entry));
								return $date_entry;
							})
							->addColumn('action', function($row){
								$candidate_id = 	self::ID_encode($row->candidate_id);
								$editUrl = url('/admin-internship-edit/'.$candidate_id);
								$viewUrl = url('/admin-internship-view/'.$candidate_id);
								$deleteUrl = url('/admin-internship-delete/'.$candidate_id);
								
								   $edit = '<a href="'.$editUrl.'"><i class="fa fa-edit"  data-toggle="tooltip" title="Edit"></i></a>';
								   $view = '<a href="'.$viewUrl.'"><i class="fa fa-eye" data-toggle="tooltip" title="View"></i></a>';
								   $delete =  "<a href='".$deleteUrl."' data-toggle='tooltip' title='Delete'  onclick=\"return confirm('Are you sure you want to delete?')\"><i class='fa fa-trash'></i></a>";
								
								
								// if($row->officer_role_id == "1"){ 
									// $action = "<button type='button' class='btn btn-primary' style='border: #d81a11;font-size:10px;width:70%;background-color: #bd4c46;'>Non Considered By by Admin</button>";
								// }if($row->officer_role_id == "3"){
									// $action = "<button type='button' class='btn btn-primary' style='border: #d81a11;font-size:10px;width:70%;background-color: #bd4c46;'>Non Considered By by Level2 Officer</button>";
								// }if($row->officer_role_id == "2"){
									// $action = "<button type='button' class='btn btn-primary' style='border: #d81a11;font-size:10px;width:70%;background-color: #bd4c46;'>Non Considered By by level1 Officer</button>";
								// }
								$action = "";
								
								
								// $action = '<button type="button" class="btn btn-primary" style="border: #d81a11;font-size:10px;width:87%;background-color: #d81a11;">Non Considered By Level2</button>';
								
								return $action.' '.$edit.' '.$view.' '.$delete;
						   })
					 ->rawColumns(['action','first_name','intern_duration','date_entry'])
					 ->make(true);
				}
				$data = AdminInternship::rejected_internship();
				return view('backend/internship/admin_internship/list_reject',compact('data'));
	 }
	
     /**
     *Access denied view pagae
     *
     * @access_denied
     */
	 
	public function access_denied()
    { 
	 return view('backend/access_denied');
	}
	
	 /**
     *Fetch All Final Selected internship data by level 2
     *
     * @selected_internship
     */
			
	public function selected_internship(Request $request)
    { 
	 if ($request->ajax()) {  
			$intern_duration = $request->intern_duration;
			$pass_status = $request->pass_status;
			$datepicker_search_from = $request->datepicker_search_from;
			$dt21 = $request->dt21;
			$data = AdminInternship::selected_internship($intern_duration,$pass_status,$datepicker_search_from,$dt21);
			    return Datatables::of($data['internship_data'])
							->addIndexColumn()
							->addColumn('first_name', function($row){
								$first_name = $row->first_name.' '.$row->last_name;
								return $first_name;
							})
							->addColumn('intern_duration', function($row){
								$intern_duration = $row->intern_duration.' Month';
								return $intern_duration;
							})
							->addColumn('date_entry', function($row){
								$date_entry = date("d-m-Y",strtotime($row->date_entry));
								return $date_entry;
							})
							->addColumn('action', function($row){
								$selected = '<button type="button" class="btn btn-primary" style="background-color: #28a745;">Selected</button>';
								$candidate_id = 	self::ID_encode($row->candidate_id);
								$editUrl = url('/admin-internship-edit/'.$candidate_id);
								$viewUrl = url('/admin-internship-view/'.$candidate_id);
								$deleteUrl = url('/admin-internship-delete/'.$candidate_id);
								
								 $edit = '<a href="'.$editUrl.'"><i class="fa fa-edit"  data-toggle="tooltip" title="Edit"></i></a>';
								 $view = '<a href="'.$viewUrl.'"><i class="fa fa-eye" data-toggle="tooltip" title="View"></i></a>';
								 $delete =  "<a href='".$deleteUrl."' data-toggle='tooltip' title='Delete'  onclick=\"return confirm('Are you sure you want to delete?')\"><i class='fa fa-trash'></i></a>";
								 return $selected.' '.$edit.' '.$view.' '.$delete;
						   })
				 ->rawColumns(['action','first_name','intern_duration','date_entry'])
				 ->make(true);
			}
		$data = AdminInternship::selected_internship();
        return view('backend/internship/admin_internship/list_selected',compact('data'));
	}
	
	/**
     *Using for encode id
     *
     * @ID_encode
     */
	public function ID_encode($id){
        $encode_id  =   '';
        if($id){
            $encode_id  =   rand(1111,9999).(($id+19)).rand(1111,9999);
        }else{
            $encode_id  =   '';
        }
        return $encode_id;
    }

     /**
     *Using for decode id
     *
     * @ID_decode
     */
	function ID_decode($encoded_id){
		$id  =   '';
		if($encoded_id){
			$id =   substr($encoded_id,4,strlen($encoded_id)-8);
			$id =   $id-19;
		}else{
			$id  =   '';
		}
		return $id;
	}
	
	/**
     * Show the User Internship Form View.
     *
     * @view
     */
	public function view($id)
    { 
	
	  $decrypted = self::ID_decode($id);
	  $all_data =  Session::get('userdata');
	  $login_userdata = DB::table('user_credential')->where('officer_id',$all_data['officer_id'])->get()->first();
	  $data = AdminInternship::edit($decrypted);
	  return view('backend/internship/admin_internship/view',compact('data','login_userdata'));
	}
	
	/**
     * Show the User Internship Form Edit.
     *
     * @view
     */
	 
	public function edit($id)
    { 
	      $decrypted = self::ID_decode($id);
		  $data = AdminInternship::edit($decrypted);
		  return view('backend/internship/admin_internship/edit',compact('data','id'));
	}
	
	
	/**
     * Show the User Internship Form Update.
     *
     * @view
     */
	 
	 
	public function update($decode_id,Request $request)
    { 
	  $id = self::ID_decode($decode_id); 
      $transactionResult = DB::transaction(function() use ($id,$request) {
		 DB::enableQueryLog(); 
      	    date_default_timezone_set('Asia/Kolkata');
			$date = date('Y-m-d H:i:s');
			
			$device = $_SERVER['HTTP_USER_AGENT'];
		    $ip_address = $_SERVER['REMOTE_ADDR']; 
		    $login_officer_id = Auth::user()->id;
			// $all_data =  Session::get('userdata');
			$curr_year = date('Y');
		    $data = AdminInternship::edit($id);
			
			$registeration_id = DB::table('user_credential')->select('registeration_id')->where('id',$request->user_id)->get()->first();
			// dd($registeration_id);
			
			$login_data['name'] = $request->first_name.' '.$request->middle_name.' '.$request->last_name;
			$login_data['email'] = $request->email;
			$login_data['mobile'] = $request->mob_number;
			DB::table('user_credential')->where('id',$request->user_id)->update($login_data);
			
			$reg_postdata['first_name'] = $request->first_name;
			$reg_postdata['middle_name'] = $request->middle_name;
			$reg_postdata['last_name'] = $request->last_name;
			$reg_postdata['dob'] = $request->date_birth;
			$reg_postdata['mobile_no'] = $request->mob_number;
			$reg_postdata['email_id'] = $request->email;
			$reg_postdata['countrycd'] = $request->countrycd;
			$reg_postdata['statecd'] = $request->statecd;
			$reg_postdata['districtcd'] = $request->districtcd;
			$reg_postdata['gender'] = $request->gender;
			$reg_postdata['update_date'] = $date;
			$reg_postdata['update_by'] = $login_officer_id;
			$a = DB::table('registration')->where('candidate_id',$registeration_id->registeration_id)->update($reg_postdata);
			
			
			$postdata['user_id'] = $request->user_id;
			$postdata['first_name'] = $request->first_name;
			$postdata['middle_name'] = $request->middle_name;
			$postdata['last_name'] = $request->last_name;
			$postdata['date_birth'] = $request->date_birth;
			$postdata['gender'] = $request->gender;
			$postdata['mob_number'] = $request->mob_number;
			$postdata['email'] = $request->email;
			$postdata['countrycd'] = $request->countrycd;
			$postdata['statecd'] = $request->statecd;
			$postdata['districtcd'] = $request->districtcd;
			
			$postdata['father'] = $request->father;
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
			// dd($postdata);
			
			
	        // $postdata['institute'] = "0";
			// $postdata['institute_address'] = "0";
			if($request->hasFile('file_photo') == "true"){
				if($request->hasFile('file_photo')) {
					$image = $request->file('file_photo');
					$file_photo = $id.'_file_photo.'.$image->getClientOriginalExtension();
					$destinationPath = public_path('/../public/uploads/internship/photo/');
					$imagePath = $destinationPath. "/".  $file_photo;
					$image->move($destinationPath, $file_photo);
				}
			    $postdata['file_photo'] = $file_photo;
			}else{
				$postdata['file_photo'] = $request->file_photo;
			}
			
			if($request->hasFile('file_id_proof') == "true"){
				if($request->hasFile('file_id_proof')) {
					$image = $request->file('file_id_proof');
					$file_id_proof = $id.'_file_id_proof.'.$image->getClientOriginalExtension();
					$destinationPath = public_path('/../public/uploads/internship/id_proof/');
					$imagePath = $destinationPath. "/".  $file_id_proof;
					$image->move($destinationPath, $file_id_proof);
				}
				$postdata['file_id_proof'] = $file_id_proof;
			}else{
				$postdata['file_id_proof'] = $request->file_id_proof;
			}
			
			if($request->hasFile('file_experience') == "true"){
				if($request->hasFile('file_experience')) {
					$image = $request->file('file_experience');
					$file_experience = $id.'_file_experience.'.$image->getClientOriginalExtension();
					$destinationPath = public_path('/../public/uploads/internship/experience/');
					$imagePath = $destinationPath. "/".  $file_experience;
					$image->move($destinationPath, $file_experience);
				}
				$postdata['file_experience'] = $file_experience;
			}else{
				$postdata['file_experience'] = $request->file_experience;
			}
			$filedata['scheme_code'] = 1;
			$postdata['application_cd'] =  'NREI/'.$curr_year.'/'.$id;
			$postdata['modified_date'] = $date;
			$postdata['modified_by'] = $login_officer_id;
			
			
			DB::table('internship_tbl')->where('candidate_id',$id)->update($postdata); 	
		    DB::table('intern_course_details')->where('candidate_id',$id)->delete(); 
				// dd(DB::getQueryLog()); 
			
				foreach($request->year_completion as $v){if($v == null){$d = "0";}else{$d  = $v;}	 $year_completion[] = $d;}
				$ques_count = count($request->course_id);
				for ($i = 0; $i < $ques_count; $i++) {
					$array = array(
					 'candidate_id'=>$id,
					 'course_id' => $request->course_id[$i],
					 'institute' => $request->institute[$i],
					 'stream' => $request->stream[$i],
					 'pass_status' => $request->pass_status[$i],
					 'year_completion' => $year_completion[$i],
					 'marks_percentage' => $request->marks_percentage[$i]
					 );
					
				 DB::table('intern_course_details')->insert($array); 
				}
		     return redirect('admin-internship')->with('success','Internship Form data updated successfully');
		    });
	   return $transactionResult;
	  }
	
	/**
     * Delete the User Internship Form data by id.
     *
     * @delete
     */
	public function delete($id)
    { 
	   $decrypted = self::ID_decode($id);
	   $data = AdminInternship::delete_data($decrypted);
	   if($data['status'] == "1" ){
			return redirect('admin-internship')->with('success','Internship Data Deleted successfully');
	   }elseif($data['status'] == "0" ){
			return redirect('admin-internship')->with('error','Internship id does not exists');
	   }
	}

	
	/**
     * For Status Considered
     *
     * @status_considered
     */
	 
	public function status_considered($internship_status,$candidate_id)
    { 
		 $data = AdminInternship::edit($candidate_id);
		  return view('backend/admin_internship/considered',compact('data','internship_status'));
	}
	
	/**
     * For Internship Status Considered
     *
     * @internship_status_considered
     */
	 
	
    public function internship_status_considered(Request $request)
    { 
	    $postdata['status_application'] = $request->status_application;
	
	    date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s');
		
		$postdata['remarks'] = $request->remarks;
		$postdata['candidate_id'] = $request->internship_candidate_id;
		$postdata['officer_id'] = $request->officer_id; 
		$postdata['officer_role_id'] = $request->role_id;
		$postdata['reason'] = $request->reason;
		$postdata['verified_date'] = $date;
		$postdata['scheme_code'] = "1";
			// dd($postdata);
		$a = DB::table('internship_verification')->insert($postdata);
		
		$status_application['status_id'] = $postdata['status_application'];
		$status_application['officer_role_id'] = $request->role_id;
		$status_application['officer_id'] = $request->officer_id;
		DB::table('internship_tbl')->where('candidate_id',$postdata['candidate_id'])->update($status_application);
		echo $a;
   }
	
	/**
     * For Selected candidate
     *
     * @selected_candidate
     */
	 
	public function selected_candidate($candidate_id)
    {   
	   $transactionResult = DB::transaction(function() use($candidate_id) {
		    date_default_timezone_set('Asia/Kolkata');
			$date = date('Y-m-d H:i:s');

			$internship_data = DB::table('internship_tbl')->where('candidate_id', $candidate_id)->get()->first();
			$loginuseer  = Auth::user();
			$internship_data->selected_by = $loginuseer->id;
			$internship_data->status = "3"; 
			$internship_data->selected_by_role = $loginuseer->role;
			$internship_data->scheme_code = "1"; 
			$internship_data->modified_by = $loginuseer->id;
			$internship_data->modified_date = $date;
			$user = DB::table("selected_internship_application")->insert(get_object_vars($internship_data));
			
			$postdata['status_application'] = "3";
			$postdata['scheme_code'] = "1";
			$postdata['candidate_id'] = $candidate_id;
			$postdata['officer_id'] = $loginuseer->id;
			$postdata['officer_role_id'] = $loginuseer->role;
			$postdata['verified_date'] = $date;
			$a = DB::table('internship_verification')->insert($postdata);
			
			$status_application['status_id'] = $internship_data->status;
			$status_application['officer_role_id'] = $loginuseer->role;
			$status_application['officer_id'] = $loginuseer->id;
			DB::table('internship_tbl')->where('candidate_id',$candidate_id)->update($status_application);
			return redirect('selected-internship')->with('success','Candidate Selected successfully!!..');
       });
	   return $transactionResult;
    }
	
	
	/**********************Export Data***********************/
	/**
     * Download csv file
     *
     * @array_to_csv
     */
	public function array_to_csv($array, $download = "") {
		if ($download != "") {	
			header("Content-Description: File Transfer");
			header("Content-Type: application/csv;");
			header("Content-Disposition: attachment; filename=$download");
		}		
		ob_start();
		$f = fopen('php://output', 'w') or show_error("Can't open php://output");
		$n = 0;		
		foreach ($array as $line) {
			$n++;
			if ( ! fputcsv($f, $line)) {
				show_error("Can't write line $n: $line");
			}
		}
		fclose($f) or show_error("Can't close php://output");
		$str = ob_get_contents();
		ob_end_clean();
		if ($download == "") {
			return $str;	
		} else {	
			echo $str;
		}		
	}


     /**
     * Export all data and by filter in csv .
     *
     * @export
     */
	 
	function export(Request $request){
	    $type = $request->input('type');
		$interndatatype = $request->input('interndatatype');
	    $checkbox = $request->input('item');
		$duration = $request->input('duration');
		$pass_status = $request->input('pass_status');
		$datepicker_search_from = $request->input('datepicker_search_from');
		$dt21 = $request->input('dt21');
		if($type == "1"){
			 if($checkbox == null){
				 $response = AdminInternship::export_all($duration,$pass_status,$datepicker_search_from,$dt21,$interndatatype); 
			}else{
				 $ids = explode(',', $checkbox);
				 $response = AdminInternship::export_all($ids,$duration,$pass_status,$datepicker_search_from,$dt21,$interndatatype);
			}
			
			if(isset($response['internship_export']) && !empty($response['internship_export'])){
				$datamrg = array_merge( $response['header'] , $response['internship_export'] );
				self::array_to_csv($datamrg,'Internship List-'.date('Y-m-d H:i:s').'.csv');
			}else{
				 return redirect('admin-internship')->with('error','Internship data not found for export Some error, try again ');
			} 
			
			
				
		}else{
            $internship_data= AdminInternship::all_export_data($duration,$pass_status,$datepicker_search_from,$dt21,$interndatatype); 
			// dd($internship_data);
			$Mpdf = PDF::loadview('backend/internship/admin_internship/pdf_report', compact('internship_data'))->setPaper('a4', 'landscape');
			return $Mpdf->download('internship.pdf');
			   // return view('backend/admin_internship/pdf_report',compact('internship_data'));
		}
	}


 
	
	
       
}
