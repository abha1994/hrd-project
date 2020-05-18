<?php

namespace App\Http\Controllers\shortterm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use PDF;
class shortTermProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //echo 'short term program';
        $records = DB::table('short_term_program')->orderBy('short_term_id','DESC')->get();
          
        return view('backend.shortterm.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.shortterm.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request,[
           
            'name_proposed_training_program' =>'required',
             'coordinator_name' =>'required',
             'coordinator_mobile' => 'required',
             'coordinator_address' => 'required',
             'history_organization_doc_' =>'required',
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
             'course_material_doc' =>'required',
             'methodology_imparting_training' => 'required|not_in:0',
             'guest_faculty_doc' => 'required',
             'content_letter_doc' => 'required',
             'core_guest_percentage_time' => 'required',
             'tieup_campus_programmer' =>'required',
             'engaging_trained_programmer' => 'required',
             'fee_charged_traniees' => 'required',
             'anticipated_impact' => 'required',
             'financial_proposal_doc' => 'required',


         ]);

         $record = $request->all();
         $lastid = DB::table('short_term_program')->latest('short_term_id')->first();
            if(!empty($lastid)){
               $lastid = $lastid->short_term_id +1;
			}else{
				 $lastid =1;
			}

         if ($request->hasFile('history_organization_doc_')) {
            if ($request->file('history_organization_doc_')->isValid()) {             
                $fileName=$request->file('history_organization_doc_')->getClientOriginalName();
                $fileName =$lastid."_history_organization_doc_".$fileName;
                $request->file('history_organization_doc_')->move('public/uploads/short_term', $fileName);
                $records['history_organization_doc_']=$fileName;                
            }
        } 
         if ($request->hasFile('course_material_doc')) {
            if ($request->file('course_material_doc')->isValid()) {             
                $fileName=$request->file('course_material_doc')->getClientOriginalName();
                $fileName =$lastid."_course_material_doc".$fileName;
                $request->file('course_material_doc')->move('public/uploads/short_term', $fileName);
                $records['course_material_doc']=$fileName;                
            }
        }  
        if ($request->hasFile('guest_faculty_doc')) {
            if ($request->file('guest_faculty_doc')->isValid()) {             
                $fileName=$request->file('guest_faculty_doc')->getClientOriginalName();
                $fileName =$lastid."_guest_faculty_doc".$fileName;
                $request->file('guest_faculty_doc')->move('public/uploads/short_term', $fileName);
                $records['guest_faculty_doc']=$fileName;                
            }
        }  
        if ($request->hasFile('content_letter_doc')) {
            if ($request->file('content_letter_doc')->isValid()) {             
                $fileName=$request->file('content_letter_doc')->getClientOriginalName();
                $fileName =$lastid."_content_letter_doc".$fileName;
                $request->file('content_letter_doc')->move('public/uploads/short_term', $fileName);
                $records['content_letter_doc']=$fileName;                
            }
        }  
        if ($request->hasFile('financial_proposal_doc')) {
            if ($request->file('financial_proposal_doc')->isValid()) {             
                $fileName=$request->file('financial_proposal_doc')->getClientOriginalName();
                $fileName =$lastid."_financial_proposal_doc".$fileName;
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
            'history_organization_doc' => $records['history_organization_doc_'],
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
            'course_material_doc' =>  $records['course_material_doc'],
            'guest_faculty_doc' => $records['guest_faculty_doc'],
            'content_letter_doc' => $records['content_letter_doc'],
            'core_guest_percentage_time' => $request->core_guest_percentage_time,
            'tieup_campus_programmer' => $request->tieup_campus_programmer,
            'engaging_trained_programmer' => $request->engaging_trained_programmer,
            'fee_charged_traniees' => $request->fee_charged_traniees,
            'anticipated_impact' => $request->anticipated_impact,
            'financial_proposal_doc' =>  $records['financial_proposal_doc'],
            'created_by' => Auth::id(),
            'created_date' =>date('y-m-d'),
            'other_re_area'=>$request->other_re_area
        );
        $insertedID =DB::table('short_term_program')->insertGetId($data);
         
        //return view('short-term-program-signature',compact('insertedID'));

         return view('backend.shortterm.signature',compact('insertedID'));
      // return redirect()->route('short-term-program-signature')->with('message','Sort term program created successfully!!');
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
         return view('backend.shortterm.show',compact('record'));
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
        return view('backend.shortterm.edit',compact('record'));

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
            'created_by' => Auth::id(),
            'created_date' =>date('y-m-d'),
            'other_re_area'=>$request->other_re_area
        );
         
       DB::table('short_term_program')
        ->where('short_term_id',$id)
        ->update($data);

        //return view('short-term-program-signature',compact('insertedID'));
        $insertedID = $id;
         return view('backend.shortterm.signature',compact('insertedID'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function pdfview(Request $request,$id){
        //dd($request->all());

        $record = DB::table('short_term_program')->where('short_term_id',$id)->get();
         view()->share('record',$record);
        $pdf = PDF::loadview('backend/shortterm/pdfview');
        return $pdf->download('pdfview.pdf');

    }

    public function uploadSignature(Request $request, $id){
         $record = $request->all();
         if ($request->hasFile('signature_doc')) {
            if ($request->file('signature_doc')->isValid()) {             
                $fileName=$request->file('signature_doc')->getClientOriginalName();
                $fileName =time()."signature_doc".$fileName;
                $request->file('signature_doc')->move('uploads/nref/short_term_sig', $fileName);
                $records['signature_doc']=$fileName;                
            }
        }  

         DB::table('short_term_program')
        ->where('short_term_id', $id)
        
        ->update(array('signature_doc' => $records['signature_doc']));
        return redirect()->route('short-term-program.index')->with('message','Singature udated successfully');
         
    }
}
