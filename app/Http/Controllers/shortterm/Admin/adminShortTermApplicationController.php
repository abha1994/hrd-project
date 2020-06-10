<?php

namespace App\Http\Controllers\shortterm\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use URL;
use File;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
class adminShortTermApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         
        $leftPageActivelink = $request->leftPageActive;
        //$records = DB::table('short_term_program')->orderBy('short_term_id','DESC')->get();
         $records = DB::table('short_term_program')->where('status_id',0)->get();  
        return view('backend.shortterm.Admin.shortterm.index',compact('records','leftPageActivelink'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $record = DB::table('short_term_program')->where('short_term_id',$id)->get();     
        
        return view('backend.shortterm.Admin.shortterm.show',compact('record'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
       $record = DB::table('short_term_program')->where('short_term_id', $id)->first();
       // dd($record);
        return view('backend.shortterm.Admin.shortterm.edit',compact('record'));
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
         
        
         $this->validate($request,[           
            'name_proposed_training_program' =>'required',
             'coordinator_name' =>'required',
             'coordinator_mobile' => 'required',
             'coordinator_address' => 'required',
             //'history_organization_doc_' =>'required',
             'technology_area' => 'required|not_in:0',
             'objective_program' => 'required',
             'target_group' => 'required',
             'geographical_area' => 'required',
             'assessment_skilled' => 'required',
             'no_student_trained_a_year' => 'required',
             'proposed_programme_a_year' => 'required',
             'no_trainee_proposed_batch' => 'required',
             'duration_proposed_course' => 'required',
             'selection_criteria' => 'required',
             'duration_proposed_course' => 'required',
             'faculty_name' => 'required',
             'faculty_designation' => 'required',
             'faculty_level' => 'required',
             'infrastructure' =>'required',
             //'course_material_doc' =>'required',
             'methodology_imparting_training' => 'required|not_in:0',
             //'guest_faculty_doc' => 'required',
             //'content_letter_doc' => 'required',
             'core_guest_percentage_time' => 'required',
             'tieup_campus_programmer' =>'required',
             'engaging_trained_programmer' => 'required',
             'fee_charged_traniees' => 'required',
             'anticipated_impact' => 'required',
            // 'financial_proposal_doc' => 'required',
         ]);

         $leftPageActive = $request->page_name;

         $records = DB::table('short_term_program')->where('short_term_id',$id)->first();
         
         
         if ($request->hasFile('history_organization_doc')) {

            if ($request->file('history_organization_doc')->isValid()) {             
                $fileName=$request->file('history_organization_doc')->getClientOriginalName();

                $fileName =$id."_history_organization_doc".$fileName;
                $request->file('history_organization_doc')->move('public/uploads/short_term', $fileName);
                $records['history_organization_doc']=$fileName;   

                    
                 
            }
        } 

         if ($request->hasFile('course_material_doc')) {

            if ($request->file('course_material_doc')->isValid()) {             
                $fileName=$request->file('course_material_doc')->getClientOriginalName();
                $fileName =$id."_course_material_doc".$fileName;
                $request->file('course_material_doc')->move('public/uploads/short_term', $fileName);
                $records['course_material_doc']=$fileName;                
            }
        }  
        if ($request->hasFile('guest_faculty_doc')) {
            if ($request->file('guest_faculty_doc')->isValid()) {             
                $fileName=$request->file('guest_faculty_doc')->getClientOriginalName();
                $fileName =$id."_guest_faculty_doc".$fileName;
                $request->file('guest_faculty_doc')->move('public/uploads/short_term', $fileName);
                $records['guest_faculty_doc']=$fileName;                
            }
        }  
        if ($request->hasFile('content_letter_doc')) {
            if ($request->file('content_letter_doc')->isValid()) {             
                $fileName=$request->file('content_letter_doc')->getClientOriginalName();
                $fileName =$id."_content_letter_doc".$fileName;
                $request->file('content_letter_doc')->move('public/uploads/short_term', $fileName);
                $records['content_letter_doc']=$fileName;                
            }
        }  
        if ($request->hasFile('financial_proposal_doc')) {
            if ($request->file('financial_proposal_doc')->isValid()) {             
                $fileName=$request->file('financial_proposal_doc')->getClientOriginalName();
                $fileName =$id."_financial_proposal_doc".$fileName;
                $request->file('financial_proposal_doc')->move('public/uploads/short_term', $fileName);
                $records['financial_proposal_doc']=$fileName;                
            }
        }  

        $data = array(
            'name_proposed_training_program' => $request->name_proposed_training_program,
            'coordinator_name' => $request->coordinator_name,
            'scheme_code'=>'4',
            'coordinator_mobile' => $request->coordinator_mobile,
            'coordinator_address' => $request->coordinator_address,
            'history_organization_doc' =>  $records->history_organization_doc,
            'technology_area' => $request->technology_area,
            'objective_program' => $request->objective_program,
            'technology_area' => $request->technology_area,
            'objective_program' => $request->objective_program,
            'target_group' => $request->target_group,
            'geographical_area' => $request->geographical_area,
            'assessment_skilled' => $request->assessment_skilled,
            'no_student_trained_a_year' => $request->no_student_trained_a_year,
            'duration_proposed_course' => $request->duration_proposed_course,
            'selection_criteria' => $request->selection_criteria,
            'duration_proposed_course' => $request->duration_proposed_course,
            'faculty_name' => $request->faculty_name,
            'faculty_designation' => $request->faculty_designation,
            'faculty_level' => $request->faculty_level,
            'infrastructure' => $request->infrastructure,
            'methodology_imparting_training' =>$request->methodology_imparting_training, 
            'no_trainee_proposed_batch' => $request->no_trainee_proposed_batch,
            'proposed_programme_a_year'=>$request->proposed_programme_a_year,            
            'course_material_doc' =>  $records->course_material_doc,
            'guest_faculty_doc' => $records->guest_faculty_doc,
            'content_letter_doc' => $records->content_letter_doc,
            'core_guest_percentage_time' => $request->core_guest_percentage_time,
            'tieup_campus_programmer' => $request->tieup_campus_programmer,
            'engaging_trained_programmer' => $request->engaging_trained_programmer,
            'fee_charged_traniees' => $request->fee_charged_traniees,
            'anticipated_impact' => $request->anticipated_impact,
            'financial_proposal_doc' =>  $records->financial_proposal_doc,
            'created_by'=>$records->created_by,
            'created_date'=>$records->created_date,
            'modified_by' => Auth::id(),
            'user_id'=> $records->user_id,
            'modified_date' =>date('Y-m-d H-i-s'),
            'other_re_area'=>$request->other_re_area
            
        );
         
        DB::table('short_term_program')
        ->where('short_term_id',$id)
        ->update($data);
        $officer_id = Auth::id();
        $roleid = \App\User::with('roles')->find($officer_id);
        $data["short_term_id"] = $id;
        $data["signature_doc"] =  $records->content_letter_doc;
        $data["officer_id"] = $officer_id;
        $data["officer_role_id"] = $roleid->role;
        $data["status_id"] = 1;
        $data['history_status'] =1;


        DB::table('short_term_history')
        //->where('short_term_id',$id)
        ->insert($data);
    $request->session()->forget('redirect');

return redirect()->route($leftPageActive)->with('message','Recorde Updated Successfully!');

        // return redirect()->route('short-term-application.index',compact('leftPageActive'))->with('message','Recorde Updated Successfully!');

        
        //return view('backend.shortterm.Admin.shortterm.index',compact('record'));

        //return redirect()->back()->with('message','Recorde Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $records = DB::table('short_term_program')->where('short_term_id',$id)->first();
         $officer_id = Auth::id();
         $roleid = \App\User::with('roles')->find($officer_id);
         $data = array(
            'name_proposed_training_program' => $records->name_proposed_training_program,
            'coordinator_name' => $records->coordinator_name,
            'scheme_code'=>'4',
            'coordinator_mobile' => $records->coordinator_mobile,
            'coordinator_address' => $records->coordinator_address,
            'history_organization_doc' =>  $records->history_organization_doc,
            'technology_area' => $records->technology_area,
            'objective_program' => $records->objective_program,
            'technology_area' => $records->technology_area,
             
            'target_group' => $records->target_group,
            'geographical_area' => $records->geographical_area,
            'assessment_skilled' => $records->assessment_skilled,
            'no_student_trained_a_year' => $records->no_student_trained_a_year,
            'duration_proposed_course' => $records->duration_proposed_course,
            'selection_criteria' => $records->selection_criteria,
            'duration_proposed_course' => $records->duration_proposed_course,
            'faculty_name' => $records->faculty_name,
            'faculty_designation' => $records->faculty_designation,
            'faculty_level' => $records->faculty_level,
            'infrastructure' => $records->infrastructure,
            'methodology_imparting_training' =>$records->methodology_imparting_training, 
            'no_trainee_proposed_batch' => $records->no_trainee_proposed_batch,
            'proposed_programme_a_year'=>$records->proposed_programme_a_year,            
            'course_material_doc' =>  $records->course_material_doc,
            'guest_faculty_doc' => $records->guest_faculty_doc,
            'content_letter_doc' => $records->content_letter_doc,
            'core_guest_percentage_time' => $records->core_guest_percentage_time,
            'tieup_campus_programmer' => $records->tieup_campus_programmer,
            'engaging_trained_programmer' => $records->engaging_trained_programmer,
            'fee_charged_traniees' => $records->fee_charged_traniees,
            'anticipated_impact' => $records->anticipated_impact,
            'financial_proposal_doc' =>  $records->financial_proposal_doc,
            'created_by'=>$records->created_by,
            'created_date'=>$records->created_date,
            'modified_by' => Auth::id(),
            'user_id'=>Auth::id(),
            'modified_date' =>date('Y-m-d H-i-s'),
            'other_re_area'=>$records->other_re_area,
            'short_term_id' => $id,
            'status_id' => 2,
            'signature_doc' =>  $records->content_letter_doc,
            'officer_id' => $officer_id,
            'officer_role_id' => $roleid->role,
            
            'history_status' =>2
        );

        DB::table('short_term_history')
        //->where('short_term_id',$id)
        ->insert($data);

         
        DB::table('short_term_program')->where('short_term_id', $id)->delete();
        return redirect()->route('short-term-application.index')->with('message','Recorde deleted successfully!');
    }

    public function  student_consider(Request $request ){

         $officer_id = Auth::id();

        $roleid = \App\User::with('roles')->find($officer_id);
        $postdata['status_application'] = $request->status_application;    
        date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d H:i:s');
        $postdata['remarks'] = $request->remarks;
        //$postdata['candidate_id'] = $request->student_id; 
        $postdata['institute_id'] = $request->student_id;        
        $postdata['officer_id'] = $officer_id; 
        $postdata['officer_role_id'] = $roleid->role;
        $postdata['reason'] = $request->reason;
        $postdata['verified_date'] = $date;
        $postdata['scheme_code'] = "4";
            // dd($postdata);
        $a = DB::table('internship_verification')->insert($postdata);
        $postdata['status_application'] = $request->status_application;
        $status_application['status_id'] = $postdata['status_application'];
        $status_application['officer_role_id'] = $request->role_id;
        $status_application['officer_id'] = $request->officer_id;
        DB::table('short_term_program')->where('short_term_id',$request->student_id)->update($status_application);
        echo $a;
    }

    public function considerlvel1(){

         //$officer_id = Auth::id();
        // $roleid = \App\User::with('roles')->find($officer_id);
         $records = DB::table('short_term_program')->where([['officer_role_id',3],['status_id',1]])->get();
		 
		 $shortTerm = DB::table('short_term_program')
			->leftJoin('user_credential','short_term_program.user_id','=','user_credential.id')
			->leftJoin('registration','user_credential.registeration_id','=','registration.candidate_id')
			->select('short_term_program.user_id','name_proposed_training_program','registration.institute_name')
			->groupby('short_term_program.user_id')
             ->get();

			$stateList = 	$this->getState();

         return view('backend.shortterm.Admin.shortterm.considerBylevel1',compact('records','shortTerm','stateList'));
         
    }

    public function considerlvel1show($id){

         $record  = DB::table('short_term_program')->where([['officer_role_id',3],['status_id',1]])->get();

         return view('backend.shortterm.Admin.shortterm.level1show',compact('record'));
    }

    public function nonconsiderlvel1(){

         //$officer_id = Auth::id();
        // $roleid = \App\User::with('roles')->find($officer_id);
         $records = DB::table('short_term_program')->where([['officer_role_id',3],['status_id',2]])->get();
		 
		 $shortTerm = DB::table('short_term_program')
			->leftJoin('user_credential','short_term_program.user_id','=','user_credential.id')
			->leftJoin('registration','user_credential.registeration_id','=','registration.candidate_id')
			->select('short_term_program.user_id','name_proposed_training_program','registration.institute_name')
			->groupby('short_term_program.user_id')
             ->get();

			$stateList = 	$this->getState();

         return view('backend.shortterm.Admin.shortterm.nonConsiderBylevel1',compact('records','shortTerm','stateList'));
         
    }

    public function nonconsiderlvel1show(){
        $record = DB::table('short_term_program')->where([['officer_role_id',3],['status_id',2]])->get();

         return view('backend.shortterm.Admin.shortterm.nonConsiderBylevel1show',compact('record'));
    }

    public function forwardtocommittee(){

        

        $records =  DB::table('short_term_program')->where('status_id' , 1)
     ->where(function($q) {
         $q->where('officer_role_id', '1')
           ->orWhere('officer_role_id', '2')
           ->orWhere('officer_role_id', '4');
          
     })
     ->get();
	 
	 $shortTerm = DB::table('short_term_program')
			->leftJoin('user_credential','short_term_program.user_id','=','user_credential.id')
			->leftJoin('registration','user_credential.registeration_id','=','registration.candidate_id')
			->select('short_term_program.user_id','name_proposed_training_program','registration.institute_name')
			->groupby('short_term_program.user_id')
             ->get();

			$stateList = 	$this->getState();
			
         return view('backend.shortterm.Admin.shortterm.forwardToCommittee',compact('records','shortTerm','stateList'));
    }

public function recommendByCommitte(){

       $records = DB::table('short_term_program')
       // ->where('officer_role_id','=','1')      
        ->where([['officer_role_id','=','5'],['status_id','=','1']]) 
         ->get();
		 
		  $shortTerm = DB::table('short_term_program')
			->leftJoin('user_credential','short_term_program.user_id','=','user_credential.id')
			->leftJoin('registration','user_credential.registeration_id','=','registration.candidate_id')
			->select('short_term_program.user_id','name_proposed_training_program','registration.institute_name')
			->groupby('short_term_program.user_id')
             ->get();

			$stateList = 	$this->getState();

        
         
         return view('backend.shortterm.Admin.shortterm.recommendCommittee',compact('records','shortTerm','stateList'));
    }
    


     public function consideradmin(){

         $officer_id = Auth::id();
         $roleid = \App\User::with('roles')->find($officer_id);
         $records = DB::table('short_term_program')->where('officer_role_id',2)->get();
         return view('backend.shortterm.Admin.shortterm.index',compact('records'));
    }

    public function pendingApplication(){
 
        $records = DB::table('short_term_program')->where('status_id',0)->get();

        $shortTerm = DB::table('short_term_program')
			->leftJoin('user_credential','short_term_program.user_id','=','user_credential.id')
			->leftJoin('registration','user_credential.registeration_id','=','registration.candidate_id')
			->select('short_term_program.user_id','name_proposed_training_program','registration.institute_name')
			->groupby('short_term_program.user_id')
             ->get();

          $stateList = 	$this->getState();			 
         
        return view('backend.shortterm.Admin.shortterm.pendingApplication',compact('records','shortTerm','stateList'));
    }
	
	public static function getState(){
		 
		  $state =DB::table('state_master')->distinct()->orderBy('state_name','asc')->get();
		
		 return $state;
	}
	
	public function getPendingApp(Request $request)
	{

		$val1=$request->input('shortermname');
		$frmDate=$request->input('frmDate');
	    $toDate = $request->input('toDate');
	    $stateId=  $request->input('stateId');
		$institutetype = $request->input('institutetype');
		
		  $a = date("Y-m-d",strtotime($frmDate));
	      $b = date("Y-m-d",strtotime($toDate));
		
		   $query = DB::table('short_term_program')
		        ->leftJoin('user_credential', 'user_credential.id', '=', 'short_term_program.user_id')
		        ->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id');
			
			if($val1!=""){
			$query = $query->where('user_id',$val1);
			}
			
			if($stateId!="") {
			$query = $query->where('registration.statecd',$stateId);
			}

			if($frmDate !="")
			{
			$query= $query->where('short_term_program.created_date','>=',$a);
			}

			if($toDate !="")
			{
			$query= $query->where('short_term_program.created_date','<=',$b);
			}
			
		if($institutetype==1) {
			$query = $query->where('short_term_program.status_id',0);
		}
		
		if($institutetype==2) {
			$query = $query->where('short_term_program.officer_role_id',3);
			$query = $query->where('short_term_program.status_id',1);
		}
		
		if($institutetype==3) {
			$query = $query->where('short_term_program.officer_role_id',3);
			$query = $query->where('short_term_program.status_id',2);
		}
		
		if($institutetype==4) {
	
			$query = $query->whereNotIn('short_term_program.officer_role_id',[3,5]);
			$query = $query->where('short_term_program.status_id',1);
		}
		
		if($institutetype==5) {
	 
			$query = $query->where('short_term_program.officer_role_id',5);
			$query = $query->where('short_term_program.status_id',1);
		}
		
		if($institutetype==6) {
	 
			$query = $query->whereNotIn('short_term_program.officer_role_id',[1,3]);
			$query = $query->where('short_term_program.status_id',3);
		}
		
		if($institutetype == 7){
			$query= $query->where('short_term_program.status_id',2);
			$query= $query->whereNotIn('short_term_program.officer_role_id',[3]);
			}
		
			$shortTermList = $query->orderBy('short_term_id','desc')->get();
		   return view('backend/shortterm/Admin/shortterm/ajaxApplication',compact('shortTermList'));
	}

    public function rejectedApplication(){

        $records = DB::table('short_term_program')->where('status_id',2)->get();        
        return view('backend.shortterm.Admin.shortterm.rejectedAppliation',compact('records'));
    }


    public function finalselection(){
 
    $records =  DB::table('short_term_program')->where('status_id' , 3)
     ->where(function($q) {
         $q->where('officer_role_id', '5')
           ->orWhere('officer_role_id', '2')
           ->orWhere('officer_role_id', '4');
          
     })
     ->get();
	 
	 $shortTerm = DB::table('short_term_program')
			->leftJoin('user_credential','short_term_program.user_id','=','user_credential.id')
			->leftJoin('registration','user_credential.registeration_id','=','registration.candidate_id')
			->select('short_term_program.user_id','name_proposed_training_program','registration.institute_name')
			->groupby('short_term_program.user_id')
             ->get();

$stateList = 	$this->getState();

    return view('backend.shortterm.Admin.shortterm.finalselection',compact('records','shortTerm','stateList'));

    }

    public function rejected(){
        $records =  DB::table('short_term_program')->where('status_id' , 2)
     ->where(function($q) {
         $q->where('officer_role_id', '5')
           ->orWhere('officer_role_id', '2')
            ->orWhere('officer_role_id', '1')
           ->orWhere('officer_role_id', '4');
          
     })
     ->get();
	 
	 $shortTerm = DB::table('short_term_program')
			->leftJoin('user_credential','short_term_program.user_id','=','user_credential.id')
			->leftJoin('registration','user_credential.registeration_id','=','registration.candidate_id')
			->select('short_term_program.user_id','name_proposed_training_program','registration.institute_name')
			->groupby('short_term_program.user_id')
             ->get();

$stateList = 	$this->getState();

    return view('backend.shortterm.Admin.shortterm.finalrejected',compact('records','shortTerm','stateList'));
    }

public function finalselectionview($id){
    $record = DB::table('short_term_program')->where('short_term_id',$id)->get();
    return view('backend.shortterm.Admin.shortterm.finalshow',compact('record'));
}


public function rejectedview($id){
    $record = DB::table('short_term_program')->where('short_term_id',$id)->get();
    return view('backend.shortterm.Admin.shortterm.finalRejectedshow',compact('record'));
}



    public function considerNonconsider($id){
 
       $record = DB::table('short_term_program')->where('short_term_id',$id)->get();
       return view('backend.shortterm.Admin.shortterm.committee',compact('record'));
    }

public function committeerecoment($id){
 
       $record = DB::table('short_term_program')->where('short_term_id',$id)->get();
       return view('backend.shortterm.Admin.shortterm.committeerecoment',compact('record'));
    }




    public function  student_selection(Request $request ){

         $officer_id = Auth::id();

        $roleid = \App\User::with('roles')->find($officer_id);
        $postdata['status_application'] = $request->status_application;    
        date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d H:i:s');
        $postdata['remarks'] = $request->remarks;
        //$postdata['candidate_id'] = $request->student_id; 
        $postdata['institute_id'] = $request->student_id;        
        $postdata['officer_id'] = $officer_id; 
        $postdata['officer_role_id'] = $roleid->role;
        $postdata['reason'] = $request->reason;
        $postdata['verified_date'] = $date;
        $postdata['scheme_code'] = "4";
         
        $a = DB::table('internship_verification')->insert($postdata);
        $postdata['status_application'] = $request->status_application;
        $status_application['status_id'] = $postdata['status_application'];
        $status_application['officer_role_id'] = $request->role_id;
        $status_application['officer_id'] = $request->officer_id;
        DB::table('short_term_program')->where('short_term_id',$request->student_id)->update($status_application);
        echo $a;
    }
	
	/* Export COde Start */
	
  public static function all_export_data($instpdf=null,$statepdf=null,$frmDate=null,$toDate=null,$institutetype=null)
	 
	 {
		 
		$a = date("Y-m-d",strtotime($frmDate));
		$b = date("Y-m-d",strtotime($toDate));
		
			$query =DB::table('short_term_program')
			->leftJoin('user_credential', 'user_credential.id', '=', 'short_term_program.user_id')
			->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
			->select('registration.institute_name','registration.institute_addres','registration.institute_reg_no','registration.pincode','registration.statecd','registration.category_id','registration.email_id','registration.mobile_no','short_term_program.*');

			if($instpdf!="") {
			$query = $query->where('short_term_program.user_id',$instpdf);
			}

			if($statepdf!="") {
			$query = $query->where('registration.statecd',$statepdf);
			}

			if($frmDate !="")
			{
			$query= $query->where('short_term_program.created_date','>=',$a);
			}

			if($toDate !="")
			{
			$query= $query->where('short_term_program.created_date','<=',$b);
			}
			if($institutetype == "7"){
			$query= $query->where('short_term_program.status_id',2);
			$query= $query->whereNotIn('short_term_program.officer_role_id',[3]);
			}
			
			if($institutetype == "6"){
			$query = $query->whereNotIn('short_term_program.officer_role_id',[1,3]);
			$query = $query->where('short_term_program.status_id',3);
			}
			
			if($institutetype == "5"){
			$query= $query->where('short_term_program.status_id',1);
			$query= $query->where('short_term_program.officer_role_id',5);
			}
			else if($institutetype == "4"){
			$query= $query->where('short_term_program.status_id',1);
			$query= $query->whereNotIn('short_term_program.officer_role_id',[3,5]);
			}
			
			else if($institutetype == "3"){
			$query= $query->where('short_term_program.status_id',2);
			$query= $query->where('short_term_program.officer_role_id', 3);
			}
			
			else if($institutetype == "2"){
			$query= $query->where('short_term_program.status_id',1);
		    $query= $query->where('short_term_program.officer_role_id',3);
			}
			
			else if($institutetype == "1"){
			$query= $query->where('short_term_program.status_id',0);
			}

			$data['shortTerm_details']  = $query->get();
			return $data;
    }
	
	
	public static function export_all($instpdf=null,$statepdf=null,$frmDate=null,$toDate=null,$institutetype=null){
			
			//echo $statepdf; die;
			
			
		$a = date("Y-m-d",strtotime($frmDate));
		$b = date("Y-m-d",strtotime($toDate));
		
		$data=array();
		
		
		$query =DB::table('short_term_program')
			->leftJoin('user_credential', 'user_credential.id', '=', 'short_term_program.user_id')
			->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
			->select('registration.institute_name','registration.institute_addres','registration.institute_reg_no','registration.pincode','registration.statecd','registration.category_id','registration.email_id','registration.mobile_no','short_term_program.*');
			
			if($instpdf!="") {
			$query = $query->where('short_term_program.user_id',$instpdf);
			}

			if($statepdf!="") {
			$query = $query->where('registration.statecd',$statepdf);
			}

			if($frmDate !="")
			{
			$query= $query->where('short_term_program.created_date','>=',$a);
			}

			if($toDate !="")
			{
			$query= $query->where('short_term_program.created_date','<=',$b);
			}
			
			if($institutetype == "7"){
			$query= $query->where('short_term_program.status_id',2);
			$query= $query->whereNotIn('short_term_program.officer_role_id',[3]);
			}
			
			if($institutetype == "6"){
			$query = $query->whereNotIn('short_term_program.officer_role_id',[1,3]);
			$query = $query->where('short_term_program.status_id',3);
			}

			if($institutetype == "5"){
			$query= $query->where('short_term_program.status_id',1);
			$query= $query->where('short_term_program.officer_role_id',5);
			}
			
			else if($institutetype == "4"){
			$query= $query->where('short_term_program.status_id',1);
			$query= $query->whereNotIn('short_term_program.officer_role_id',[3,5]);
			}
			
			else if($institutetype == "3"){
			$query= $query->where('short_term_program.status_id',2);
			$query= $query->where('short_term_program.officer_role_id',3);
			}
			
			else if($institutetype == "2"){
			$query= $query->where('short_term_program.status_id',1);
		    $query= $query->where('short_term_program.officer_role_id',3);
			}
			
			else if($institutetype == "1"){
			$query= $query->where('short_term_program.status_id',0);
			}
				
			$data['short_details']  = $query->get();
		 if(isset($data['short_details']) && !empty($data['short_details']))
		{  
	
	    $header2=$newcomp=array();
		$data['header']=array(
		'0' =>array(
		''  =>"S. No.",
		'short_name'  =>"ShortTerm Name",
		'prog_name' =>  "Program Name",
		'cordinate_name'=>  "Coordinator Name",
		'cordinate_mobile'=>  "Coordinator Mobile",

		),
		);
		 $i=1; 
		foreach($data['short_details'] as $value)
		{ 

		$data['internship_export'][$i]['']=$i;
		$data['internship_export'][$i]['short_name'] = $value->institute_name;
		$data['internship_export'][$i]['prog_name']=  $value->name_proposed_training_program;
		$data['internship_export'][$i]['cordinate_name'] = $value->coordinator_name;
		$data['internship_export'][$i]['cordinate_mobile'] = $value->coordinator_mobile;
		$i++;
		} 
		 }
		
		return $data;   
		}
		
		
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
	
	
	public function exportPdf(Request $request){
		
		//echo "<pre>"; dd($request);
		 $type = $request->input('type');
	     $instpdf = $request->input('instpdf');
		 $statepdf = $request->input('statepdf');
		 $frmDate=$request->input('frmdatepdf');
	     $toDate = $request->input('todatepdf');
		 $institutetype = $request->input('institutetype');
	
	if($type == "2"){
            $shortterm_data= $this->all_export_data($instpdf,$statepdf,$frmDate,$toDate,$institutetype); 
			 //dd($internship_data);
			$Mpdf = PDF::loadview('backend/shortterm/Admin/shortterm/pdf_report', compact('shortterm_data'))->setPaper('a4', 'landscape');
			return $Mpdf->download('Application.pdf'); 
	}
	else
	{
		$response = $this->export_all($instpdf,$statepdf,$frmDate,$toDate,$institutetype);
		
		if($institutetype=="1")
		{
			$redirectURL= 'pending-application';
		}
		
		else if($institutetype=="2")
		{
			$redirectURL= 'consider-by-level1';
		}
		
		else if($institutetype=="3")
		{
			$redirectURL= 'nonconsider-by-level1';
		}
		
		else if($institutetype=="4")
		{
			$redirectURL= 'forward-to-committee-short-term';
		}
		
		else if($institutetype=="5")
		{
			$redirectURL= 'recommend-by-committe-short-term';
		}
		
		else if($institutetype=="6")
		{
			$redirectURL= 'final-selecction';
		}
		
		else if($institutetype=="7")
		{
			$redirectURL= 'final-rejected';
		}
		
		if(isset($response['internship_export']) && !empty($response['internship_export'])){
		$datamrg = array_merge( $response['header'] , $response['internship_export'] );
		self::array_to_csv($datamrg,'ShortTerm List-'.date('Y-m-d H:i:s').'.csv');
		}
		
		else{
		return redirect($redirectURL)->with('error','Data not found for export Some error, try again ');
		} 
	}
		
	}
	
	/* Export Code Ended */


}
