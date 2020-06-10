<?php

namespace App\Http\Controllers\shortterm\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;
use Auth;
use PDF;
use Validator,Redirect;

class TrainingEvalutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$students = DB::table('traininng_program_evaluation')
            ->leftJoin('studentregistrations', 'traininng_program_evaluation.student_id', '=', 'studentregistrations.id')
			->orderBy('traininng_program_evaluation.id','desc')
            ->get();
			
			$studentData = DB::table('studentregistrations')
			->select('id','email_id')
			->where('email_id','!=',NULL)
			->orderBy('email_id','asc')
            ->get();
			
		return view('backend/shortterm/Admin.training_evaluation.trainingEvaluation',compact('students','studentData'));
    }
	
	public function viewEvaluation($id)
    { 

		$evalution = DB::table('traininng_program_evaluation')
            ->leftJoin('studentregistrations', 'traininng_program_evaluation.student_id', '=', 'studentregistrations.id')
			->select('traininng_program_evaluation.*','studentregistrations.firstname','studentregistrations.middlename','studentregistrations.lastname','studentregistrations.email_id')
			->where('traininng_program_evaluation.id',$id)
            ->get();
			
		return view('backend/shortterm/Admin/training_evaluation/view_evaluation',compact('evalution'));
	}

	
	public function evaluationAjax(Request $request)
	{
		
		$fellowid=$request->input('fellowname');

      $feedbackList = DB::table('traininng_program_evaluation')
            ->leftJoin('studentregistrations', 'traininng_program_evaluation.student_id', '=', 'studentregistrations.id')
			->where('traininng_program_evaluation.student_id',$fellowid)
			->orderBy('traininng_program_evaluation.id','desc')
            ->get();
			

		return view('backend/shortterm/Admin.training_evaluation.evaluationAjax',compact('feedbackList'));
	}


}
