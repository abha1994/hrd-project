<?php
namespace App\Http\Controllers\shortterm\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DateTime,Session;
use App\Upload\Attendance;
use App\User;
use Validator,Redirect;
use DB;
use Response;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;
use App\Http\Requests\Form_validation;
class ReportController extends Controller
{
    function __construct()
    {
         

    }
    /**
     * Display a listing of the reports.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		   /* $shortTerm = DB::table('short_term_program')
			->select('short_term_id','name_proposed_training_program','coordinator_name')
			->orderBy('coordinator_name','asc')
            ->get(); */
			
			$shortTerm = DB::table('short_term_program')
			->leftJoin('user_credential','short_term_program.user_id','=','user_credential.id')
			->leftJoin('registration','user_credential.registeration_id','=','registration.candidate_id')
			->select('short_term_program.user_id','name_proposed_training_program','registration.institute_name')
			->groupby('short_term_program.user_id')
             ->get();
			
	       return view('backend.shortterm.Admin.report.create',compact('shortTerm'));
    }
	
	public function getadminshorttermreport(Request $request)
	{
        $val2=$request->input('shortermname');
		
		if($val2!=""){
			$v = DB::table('short_term_program')->where('user_id',$val2)->get(array('utilization_cetificate_doc','audited_statement_doc','programme_completion_doc','impact_tranning'))->first();
			// dd($data);
		   return view('backend.shortterm.Admin.report.reporAjax',compact('v'));
		}
	}

	
 }
