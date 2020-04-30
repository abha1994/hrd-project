<?php

namespace App\Internship\Admin;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use DB,Session;
// use DataTables;
class AdminInternship extends Model
{
   
     /**
     *  Fetch all data of internship 
     *
     * @index
     */
	 

	public static function index($intern_duration=null,$pass_status=null,$datepicker_search_from=null,$dt21=null){
      if($intern_duration !=null){
				 $data['internship_data']  = DB::table('internship_tbl')->where('intern_duration',$intern_duration)->where('status_id',NULL)->get();
					
				 if($pass_status != null){
					$pass_status_data  = DB::table('intern_course_details')->where('pass_status',$pass_status)->get();
					foreach($pass_status_data as $v){
						$candidate_id[] = $v->candidate_id;
					}
					$data['internship_data']  = DB::table('internship_tbl')->where('intern_duration',$intern_duration)->whereIN('candidate_id',$candidate_id)->orderBy('candidate_id','desc')->where('status_id',NULL)->get();  
				 }
				 
				 if($dt21 != null){
					$a = date("Y-m-d",strtotime($datepicker_search_from));
					$b = date("Y-m-d",strtotime($dt21));
					$data['internship_data'] = DB::table('internship_tbl')->where('intern_duration',$intern_duration)->where('date_entry','>=',$a)->where('date_entry','<=',$b)->where('status_id',NULL)->get();
			    }
			}else if($pass_status != null){
					$pass_status_data  = DB::table('intern_course_details')->where('pass_status',$pass_status)->get();
					foreach($pass_status_data as $v){
						$candidate_id[] = $v->candidate_id;
					}
					$data['internship_data']  = DB::table('internship_tbl')->whereIN('candidate_id',$candidate_id)->orderBy('candidate_id','desc')->where('status_id',NULL)->get();
			}else if($dt21 != null){
					$a = date("Y-m-d",strtotime($datepicker_search_from));
					$b = date("Y-m-d",strtotime($dt21));
					$data['internship_data'] = DB::table('internship_tbl')->where('date_entry','>=',$a)->where('date_entry','<=',$b)->where('status_id',NULL)->get();
			}else{
					$data['selected_id'] = "0";
					$data['breadcum'] = "List Internship Data"; 
					$data['internship_data'] = DB::table('internship_tbl')->where('status_id',NULL)->get();
			}
	    return $data;
	 }
	 
	 
	/**
     * Fetch All Rejected internship data by level 2

     *
     * @rejected_internship
     */
	 
	public static function rejected_internship($intern_duration=null,$pass_status=null,$datepicker_search_from=null,$dt21=null){
		if($intern_duration != null){
				$data['internship_data']  = DB::table('internship_tbl')->where('intern_duration',$intern_duration)->where('status_id',"2")->get();
				
				if($pass_status != null){
					$pass_status_data  = DB::table('intern_course_details')->where('pass_status',$pass_status)->get();
					foreach($pass_status_data as $v){
						$candidate_id[] = $v->candidate_id;
					}
					$data['internship_data']  = DB::table('internship_tbl')->where('intern_duration',$intern_duration)->whereIN('candidate_id',$candidate_id)->where('status_id',"2")->get();
		        }
				if($dt21 != null){
					 $a = date("Y-m-d",strtotime($datepicker_search_from));
					 $b = date("Y-m-d",strtotime($dt21));
					 $data['internship_data'] = DB::table('internship_tbl')->where('intern_duration',$intern_duration)->where('date_entry','>=',$a)->where('date_entry','<=',$b)->where('status_id',"2")->get();
				}
		}else if($pass_status != null){
				$pass_status_data  = DB::table('intern_course_details')->where('pass_status',$pass_status)->get();
				foreach($pass_status_data as $v){
					$candidate_id[] = $v->candidate_id;
				}
				$data['internship_data']  = DB::table('internship_tbl')->whereIN('candidate_id',$candidate_id)->where('status_id',"2")->get();
		}else if($dt21 != null){
			 $a = date("Y-m-d",strtotime($datepicker_search_from));
			 $b = date("Y-m-d",strtotime($dt21));
			 $data['internship_data'] = DB::table('internship_tbl')->where('date_entry','>=',$a)->where('date_entry','<=',$b)->where('status_id',"2")->get();
		}else{
			  $data['selected_id'] = "0";
			  $data['breadcum'] = "List of Non Considered Application"; 
			  // 'status_id',[1,3]
			   $data['internship_data'] = DB::table('internship_tbl')->where('status_id',"2")->get();  
		}
	   return $data;
	}
	
	
	
	/**
     * Fetch All Considered internship data by level 2
     *
     * @considered_level_1
     */
	 
	 
	public static function considered_level_1($intern_duration=null,$pass_status=null,$datepicker_search_from=null,$dt21=null){
		if($intern_duration != null){
				$data['internship_data']  = DB::table('internship_tbl')->where('intern_duration',$intern_duration)->where('officer_role_id',3)->where('status_id',"1")->get();
				
				if($pass_status != null){
					$pass_status_data  = DB::table('intern_course_details')->where('pass_status',$pass_status)->get();
					foreach($pass_status_data as $v){
						$candidate_id[] = $v->candidate_id;
					}
					$data['internship_data']  = DB::table('internship_tbl')->where('intern_duration',$intern_duration)->whereIN('candidate_id',$candidate_id)->where('officer_role_id',3)->where('status_id',"1")->get();
		        }
				if($dt21 != null){
					 $a = date("Y-m-d",strtotime($datepicker_search_from));
					 $b = date("Y-m-d",strtotime($dt21));
					 $data['internship_data'] = DB::table('internship_tbl')->where('intern_duration',$intern_duration)->where('officer_role_id',2)->where('date_entry','>=',$a)->where('date_entry','<=',$b)->where('status_id',"1")->get();
				}
		}else if($pass_status != null){
				$pass_status_data  = DB::table('intern_course_details')->where('pass_status',$pass_status)->get();
				foreach($pass_status_data as $v){
					$candidate_id[] = $v->candidate_id;
				}
				$data['internship_data']  = DB::table('internship_tbl')->whereIN('candidate_id',$candidate_id)->where('officer_role_id',3)->where('status_id',"1")->get();
		}else if($dt21 != null){
			 $a = date("Y-m-d",strtotime($datepicker_search_from));
			 $b = date("Y-m-d",strtotime($dt21));
			 $data['internship_data'] = DB::table('internship_tbl')->where('date_entry','>=',$a)->where('officer_role_id',3)->where('date_entry','<=',$b)->where('status_id',"1")->get();
		}else{
			  $data['selected_id'] = "0";
			  $data['breadcum'] = "List of Internship Application Considered by Level 1 Officer"; 
			  $data['internship_data'] = DB::table('internship_tbl')->where('status_id',"1")->where('officer_role_id',3)->get(); 
		}
	   return $data;
	}
	
	public static function forword_to_committee ($intern_duration=null,$pass_status=null,$datepicker_search_from=null,$dt21=null){
		if($intern_duration != null){
				$data['internship_data']  = DB::table('internship_tbl')->where('intern_duration',$intern_duration)->where('officer_role_id','!=',3)->where('status_id',"1")->get();
				
				if($pass_status != null){
					$pass_status_data  = DB::table('intern_course_details')->where('pass_status',$pass_status)->get();
					foreach($pass_status_data as $v){
						$candidate_id[] = $v->candidate_id;
					}
					$data['internship_data']  = DB::table('internship_tbl')->where('intern_duration',$intern_duration)->whereIN('candidate_id',$candidate_id)->where('officer_role_id','!=',3)->where('status_id',"1")->get();
		        }
				if($dt21 != null){
					 $a = date("Y-m-d",strtotime($datepicker_search_from));
					 $b = date("Y-m-d",strtotime($dt21));
					 $data['internship_data'] = DB::table('internship_tbl')->where('intern_duration',$intern_duration)->where('officer_role_id','!=',3)->where('date_entry','>=',$a)->where('date_entry','<=',$b)->where('status_id',"1")->get();
				}
		}else if($pass_status != null){
				$pass_status_data  = DB::table('intern_course_details')->where('pass_status',$pass_status)->get();
				foreach($pass_status_data as $v){
					$candidate_id[] = $v->candidate_id;
				}
				$data['internship_data']  = DB::table('internship_tbl')->whereIN('candidate_id',$candidate_id)->where('officer_role_id','!=',3)->where('status_id',"1")->get();
		}else if($dt21 != null){
			 $a = date("Y-m-d",strtotime($datepicker_search_from));
			 $b = date("Y-m-d",strtotime($dt21));
			 $data['internship_data'] = DB::table('internship_tbl')->where('date_entry','>=',$a)->where('officer_role_id','!=',3)->where('date_entry','<=',$b)->where('status_id',"1")->get();
		}else{
			  $data['selected_id'] = "0";
			  $data['breadcum'] = "List of Application Forward To Committee"; 
			  $data['internship_data'] = DB::table('internship_tbl')->where('status_id',"1")->where('officer_role_id','!=',3)->get(); 
		}
	   return $data;
	}
	
	/**
     * Fetch All Final Selected internship data by level 2
     *
     * @selected_internship
     */
	
	public static function selected_internship($intern_duration=null,$pass_status=null,$datepicker_search_from=null,$dt21=null){
		if($intern_duration != null){
			$data['internship_data']  = DB::table('internship_tbl')->where('intern_duration',$intern_duration)->where('status_id',3)->get();
				if($pass_status != null){
					$pass_status_data  = DB::table('intern_course_details')->where('pass_status',$pass_status)->get();
					foreach($pass_status_data as $v){
						$candidate_id[] = $v->candidate_id;
					}
					$data['internship_data']  = DB::table('internship_tbl')->where('intern_duration',$intern_duration)->whereIN('candidate_id',$candidate_id)->where('status_id',3)->get();
		        }
				if($dt21 != null){
					 $a = date("Y-m-d",strtotime($datepicker_search_from));
					 $b = date("Y-m-d",strtotime($dt21));
					 $data['internship_data'] = DB::table('internship_tbl')->where('intern_duration',$intern_duration)->where('date_entry','>=',$a)->where('date_entry','<=',$b)->where('status_id',3)->get();
				}
		}else if($pass_status != null){
				$pass_status_data  = DB::table('intern_course_details')->where('pass_status',$pass_status)->get();
				foreach($pass_status_data as $v){
					$candidate_id[] = $v->candidate_id;
				}
				$data['internship_data']  = DB::table('internship_tbl')->whereIN('candidate_id',$candidate_id)->where('status_id',3)->get();
		}else if($dt21 != null){
			 $a = date("Y-m-d",strtotime($datepicker_search_from));
			 $b = date("Y-m-d",strtotime($dt21));
			 $data['internship_data'] = DB::table('internship_tbl')->where('date_entry','>=',$a)->where('date_entry','<=',$b)->where('status_id',3)->get();
		}else{
			   $data['selected_id'] = "3";
			   $data['breadcum'] = "List of Selected Candidate After Committee Recommendation"; 
			   $data['internship_data'] = DB::table('internship_tbl')->where('status_id',3)->get(); 
		}
	   return $data;
	}
	
	
   
   

	/**
     * Fetch data of internship by id
     *
     * @view
     */
	 
	public static function edit($id){
	   $data['internship_data'] = DB::table('internship_tbl')->where('candidate_id',$id)->get()->first();
	   $user_id = $data['internship_data']->user_id;
	   $data['candidate_type'] = DB::table('registration')->where('candidate_id',$user_id)->get()->first();
	   $data['category_data']  = DB::table('category')->orderBy('category_id','asc')->get();
	   $data['country_data'] = DB::table('country')->orderBy('name','asc')->get();
	   $data['state_data'] = DB::table('state_master')->orderBy('state_name','asc')->get();
	   $data['district_data'] = DB::table('district_master')->orderBy('district_name','asc')->get();
	   $data['courses_data'] = DB::table('courses')->orderBy('course_name','asc')->get();
	   
	   $data['intern_course_details'] = DB::table('intern_course_details')->where('candidate_id',$id)->get();
	   return $data;
	}
	
	 
     /**
     *Delete internship data from database using role id
     *
     * @delete_data
     */
	 // dd($internship_id);
	public static function delete_data($internship_id){
		$transactionResult = DB::transaction(function() use ($internship_id) {
		if(!empty($internship_id)){
			DB::table('intern_course_details')->where('candidate_id',$internship_id)->delete();
			DB::table('internship_tbl')->where('candidate_id',$internship_id)->delete();
			 $data['status'] = "1"; //data deleted successfully;
		}else{
			$data['status'] = "0"; //Id does not exists;
		}
	   return $data;
	   });
	   return $transactionResult;
	 }
	 
	

   // public static function export()
   // {
    // $data=array();
    // $internship_export= DB::table('internship_tbl')->orderBy('candidate_id','desc')->get();
	// if(isset($internship_export['internship_data']) && !empty($internship_export['internship_data']))
	// {   $header2=$newcomp=array();
		// $data['header']=array(
				   // '0' =>array(
					   // ''  =>"S. No.",
					   // 'Candidate id'  =>"Id",
					   // 'first_name' =>  "First Name",
					   // 'email'=>  "Email"
					   // ),
				   // );
				   // $i=1; 
				   // foreach($internship_export['internship_data'] as $value)
				   // { 
					   // $data['internship_export'][$i]['']=$i;
					   // $data['internship_export'][$i]['candidate_id']=$value->candidate_id;
					   // $data['internship_export'][$i]['first_name']= ucwords($value->first_name);
					   // $data['internship_export'][$i]['email'] = ucwords($value->email);
				   // $i++;
				   // }
    // }
    // return $data;   
	// }
	
	
	
	/**
     *Export All Data
     *
     * @export_all
     */
	 
    public static function export_all($intern_duration=null,$pass_status=null,$datepicker_search_from=null,$dt21=null,$interndatatype=null){
		 $data=array();

		 if($interndatatype == "1"){
			$internship_export = self::index($intern_duration,$pass_status,$datepicker_search_from,$dt21); 
		 }else if($interndatatype == "2"){
			$internship_export = self::considered_level_1($intern_duration,$pass_status,$datepicker_search_from,$dt21);
		 }else if($interndatatype == "3"){
			$internship_export = self::rejected_internship($intern_duration,$pass_status,$datepicker_search_from,$dt21);
		 }else if($interndatatype == "4"){
			$internship_export = self::forword_to_committee($intern_duration,$pass_status,$datepicker_search_from,$dt21);
		 }else if($interndatatype == "5"){
			$internship_export = self::selected_internship($intern_duration,$pass_status,$datepicker_search_from,$dt21);
		 }
		 	 
	 if(isset($internship_export['internship_data']) && !empty($internship_export['internship_data']))
	 {   $header2=$newcomp=array();
		$data['header']=array(
				   '0' =>array(
					   ''  =>"S. No.",
					    'Candidate id'  =>"Id",
					    'first_name' =>  "First Name",
					    'email'=>  "Email",
						'mob_number'=>  "Mobile Number",
						'gender'=>  "Gender",
						'date_birth'=>  "DOB",
						'father'=>  "Father Name",
						'phone'=>  "Landline No.",
						'address'=>  "Address",
						'pincode'=>  "Pincode",
						'countrycd'=>  "Country",
						'statecd'=>  "State",
						// 'districtcd'=>  "District",
						'area_interest'=>"Area of Interest",
						'intern_place'=>  "Desired Place of Internship",
						'intern_duration'=>  "Duration of Internship",
						'intern_start_month'=>  "Desired Month & Year of Internship",
						'writeup_interest'=>  "Write up interest",
						'remarks'=>  "Remarks",

					   ),
				   );
				   $i=1; 
				   foreach($internship_export['internship_data'] as $value)
				   { 
			            if(!empty($value->gender)){
                            if($value->gender =="1"){
								$gender = "Male";
							}else  if($value->gender =="2"){
								$gender = "Female";
							}else  if($value->gender =="0"){
								$gender = "Other";
							}
						}
						
						if(!empty($value->phone)){
                           $phone = $value->phone;
						}else{
							$phone = "";
						}
						
						$country_data = DB::table('country')->orderBy('name','asc')->get();
						$state_data = DB::table('state_master')->orderBy('state_name','asc')->get();
					    $district_data = DB::table('district_master')->orderBy('district_name','asc')->get();
						if(!empty($country_data)){
							foreach($country_data as $count){
								if($count->countrycd == $value->countrycd){
								   $country = $count->name;
							   }
						   }
						}
						if(!empty($state_data)){
						   foreach($state_data as $sta){
								if($sta->statecd == $value->statecd){
								   $statecd = $sta->state_name;
							   }
						   }
						}
	                    $area_interest1 = array( '1'=>'Solar PV' ,'2'=>'Solar Thermal','3'=>'Wind','4'=>'Small Hydro','5'=>'Biomass','6'=>'Biogas','7'=>'Waste to Energy','8'=>'Hydrogen','9'=>'Energy Storage','10'=>'Policy','11'=>'Environment Aspect','12'=>'Hydrogen &amp; Fuel Cell','13'=>'Finance');
						
							foreach($area_interest1 as $key=>$val){
								if($value->area_interest == $val){
									 $area_interest =  $val;
								}
							}
						
						
	                    $intern_place1 = array( '1'=>'MNRE' ,'2'=>'NISE-Gurugram','3'=>'NIWE-Chennai','4'=>'NIBE-Kapurthala','5'=>'SECI','6'=>'IREDA');
	 
						foreach($intern_place1 as $key1=>$val1){
							if($value->intern_place == $val1){
								 $intern_place =  $val1;
							}
						}
		
                        $intern_duration1 = array('2'=>'2 months','3'=>'3 months','4'=>'4 months','5'=>'5 months','6'=>'6 months');
						foreach($intern_duration1 as $k1=>$v1){
							if($value->intern_duration == $v1){
								 $intern_duration =  $v1;
							}
						}
					
					    $intern_start_mnth1 = array( '1'=>'Jan' ,'2'=>'Feb','3'=>'Mar','4'=>'Apr','5'=>'May','6'=>'June','7'=>'July','8'=>'Aug','9'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec');
					    foreach($intern_start_mnth1 as $k=>$v){
							if($value->intern_start_month == $k){
								$intern_start_month =  $v;
							}
						}
						
					    if($value->gender == "1"){
								$gender = "Male";
						}elseif($value->gender == "2"){
								$gender = "Female";
						}else if($value->gender == "0"){
								$gender = "Others";
						}
						
				   
						
					    $data['internship_export'][$i]['']=$i;
						$data['internship_export'][$i]['application_cd'] = $value->application_cd;
				         $data['internship_export'][$i]['first_name']= ucwords($value->first_name.' '.$value->last_name);
					    $data['internship_export'][$i]['email'] = $value->email;
						$data['internship_export'][$i]['mob_number'] = $value->mob_number;
						$data['internship_export'][$i]['gender'] =  $gender;
						$data['internship_export'][$i]['date_birth'] = $value->date_birth;
						$data['internship_export'][$i]['father'] = $value->father;
						$data['internship_export'][$i]['phone'] = $phone;
						$data['internship_export'][$i]['address'] = $value->address;
						$data['internship_export'][$i]['pincode'] = $value->pincode;
						$data['internship_export'][$i]['countrycd'] = $country;
						$data['internship_export'][$i]['statecd'] = $statecd;
						// if(!empty($district_data)){
						   // foreach($district_data as $dist){
					          // if($dist->districtcd == $value->districtcd){
							      // $data['internship_export'][$i]['districtcd'] = $dist->district_name;
							   // }
						   // }		
					     // }else{
							  // $data['internship_export'][$i]['districtcd'] = "N/A";
						 // }
					   
						
						$data['internship_export'][$i]['area_interest'] = $area_interest;
						$data['internship_export'][$i]['intern_place'] = $intern_place;
						$data['internship_export'][$i]['intern_duration'] = $intern_duration;
						$data['internship_export'][$i]['intern_start_month'] = $intern_start_month;
						$data['internship_export'][$i]['writeup_interest'] = $value->writeup_interest;
						$data['internship_export'][$i]['remarks'] = $value->remarks;
				   $i++;
				   }
    }
    return $data;   
	}
	
	/**
     *Export Data By Filter
     *
     * @all_export_data
     */
	 
	 public static function all_export_data($intern_duration=null,$pass_status=null,$datepicker_search_from=null,$dt21=null,$interndatatype=null){
		 if($interndatatype == "1"){
			$data = self::index($intern_duration,$pass_status,$datepicker_search_from,$dt21); 
		 }else if($interndatatype == "2"){
			$data = self::considered_level_1($intern_duration,$pass_status,$datepicker_search_from,$dt21);
		 }else if($interndatatype == "3"){
			$data = self::rejected_internship($intern_duration,$pass_status,$datepicker_search_from,$dt21);
		 }else if($interndatatype == "4"){
			$data = self::forword_to_committee($intern_duration,$pass_status,$datepicker_search_from,$dt21);
		 }else if($interndatatype == "5"){
			$data = self::selected_internship($intern_duration,$pass_status,$datepicker_search_from,$dt21);
		 }
		
	    $data['course_details']  = DB::table('intern_course_details')->get();
        $data['courses']  = DB::table('courses')->get();
        $data['district_data']  = DB::table('district_master')->get();
        $data['state_data']  = DB::table('state_master')->get();
        $data['country_data']  = DB::table('country')->get();
		$data['intern_duration']  = $intern_duration;//Old Code 24/02/2020
		$data['pass_status']  = $pass_status;//Old Code 24/02/2020
		$data['datepicker_search_from']  =  $datepicker_search_from;//Old Code 24/02/2020
		$data['dt21']  =  $dt21;//Old Code 24/02/2020
		$data['interndatatype'] = $interndatatype;
		 return $data;
    }
	
	
 
   
	  
	  
	  
	  
	  
	  
}

