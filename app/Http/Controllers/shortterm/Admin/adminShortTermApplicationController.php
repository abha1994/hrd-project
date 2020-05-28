<?php

namespace App\Http\Controllers\shortterm\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use URL;
class adminShortTermApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $records = DB::table('short_term_program')->orderBy('short_term_id','DESC')->get();
        return view('backend.shortterm.admin.shortterm.index',compact('records'));
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
        
        return view('backend.shortterm.admin.shortterm.show',compact('record'));
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
        return view('backend.shortterm.admin.shortterm.edit',compact('record'));
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

         return redirect()->route('short-term-application.index')->with('message','Recorde Updated Successfully!');
        
        //return view('backend.shortterm.admin.shortterm.index',compact('record'));
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

         return view('backend.shortterm.admin.shortterm.considerBylevel1',compact('records'));
         
    }

    public function considerlvel1show($id){

         $record  = DB::table('short_term_program')->where([['officer_role_id',3],['status_id',1]])->get();

         return view('backend.shortterm.admin.shortterm.level1show',compact('record'));
    }

    public function nonconsiderlvel1(){

         //$officer_id = Auth::id();
        // $roleid = \App\User::with('roles')->find($officer_id);
         $records = DB::table('short_term_program')->where([['officer_role_id',3],['status_id',2]])->get();

         return view('backend.shortterm.admin.shortterm.nonConsiderBylevel1',compact('records'));
         
    }

    public function nonconsiderlvel1show(){
        $record = DB::table('short_term_program')->where([['officer_role_id',3],['status_id',2]])->get();

         return view('backend.shortterm.admin.shortterm.nonConsiderBylevel1show',compact('record'));
    }

    public function forwardtocommittee(){

        

        $records =  DB::table('short_term_program')->where('status_id' , 1)
     ->where(function($q) {
         $q->where('officer_role_id', '1')
           ->orWhere('officer_role_id', '2')
           ->orWhere('officer_role_id', '4');
          
     })
     ->get();
         return view('backend.shortterm.admin.shortterm.forwardToCommittee',compact('records'));
    }

public function recommendByCommitte(){

       $records = DB::table('short_term_program')
       // ->where('officer_role_id','=','1')      
        ->where([['officer_role_id','=','5'],['status_id','=','1']]) 
         ->get();

        
         
         return view('backend.shortterm.admin.shortterm.recommendCommittee',compact('records'));
    }
    


     public function consideradmin(){

         $officer_id = Auth::id();
         $roleid = \App\User::with('roles')->find($officer_id);
         $records = DB::table('short_term_program')->where('officer_role_id',2)->get();
         return view('backend.shortterm.admin.shortterm.index',compact('records'));
    }

    public function pendingApplication(){
 
        $records = DB::table('short_term_program')->where('status_id',0)->get();  
         
        return view('backend.shortterm.admin.shortterm.pendingApplication',compact('records'));
    }

    public function rejectedApplication(){

        $records = DB::table('short_term_program')->where('status_id',2)->get();        
        return view('backend.shortterm.admin.shortterm.rejectedAppliation',compact('records'));
    }


    public function finalselection(){
 
    $records =  DB::table('short_term_program')->where('status_id' , 3)
     ->where(function($q) {
         $q->where('officer_role_id', '5')
           ->orWhere('officer_role_id', '2')
           ->orWhere('officer_role_id', '4');
          
     })
     ->get();
    return view('backend.shortterm.admin.shortterm.finalselection',compact('records'));

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

    return view('backend.shortterm.admin.shortterm.finalrejected',compact('records'));
    }

public function finalselectionview($id){
    $record = DB::table('short_term_program')->where('short_term_id',$id)->get();
    return view('backend.shortterm.admin.shortterm.finalshow',compact('record'));
}


public function rejectedview($id){
    $record = DB::table('short_term_program')->where('short_term_id',$id)->get();
    return view('backend.shortterm.admin.shortterm.finalRejectedshow',compact('record'));
}



    public function considerNonconsider($id){
 
       $record = DB::table('short_term_program')->where('short_term_id',$id)->get();
       return view('backend.shortterm.admin.shortterm.committee',compact('record'));
    }

public function committeerecoment($id){
 
       $record = DB::table('short_term_program')->where('short_term_id',$id)->get();
       return view('backend.shortterm.admin.shortterm.committeerecoment',compact('record'));
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


}
