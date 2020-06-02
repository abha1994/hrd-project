<?php

namespace App\Http\Controllers\shortterm\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\shortterm\Admin\nrestBankDetails;
use Session;
use DB;
use Auth;
use PDF;
use Validator,Redirect;

class NrestBankDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
		$shortTerm = DB::table('short_term_program')
			->select('short_term_id','name_proposed_training_program','coordinator_name')
			->orderBy('coordinator_name','asc')
            ->get();
		
		$student_name = DB::table('studentregistrations')->select('id','firstname','lastname')->where('scheme_code','4')->get(); 
        $banks = nrestBankDetails::orderBy('id','desc')->where('scheme_code','4')->get(); 
		  return view('backend.shortterm.Admin.nrest_bankdetails',compact('shortTerm','banks','student_name'));
	}
	
	public function getadminbankdata(Request $request)
	{
	  
        $val2=$request->input('v1');
		
		if($val2!=""){
			$student_name = DB::table('studentregistrations')->select('id','firstname','lastname')->where('scheme_code','4')->get(); 
        $banks = nrestBankDetails::orderBy('id','desc')->where('scheme_code','4')->where('institute_id',$val2)->get(); 
		  return view('backend.shortterm.Admin.nrest_bankdetails_filter',compact('banks','student_name'));
		}
	}


    public function show($id)
    {
		$student_name = DB::table('studentregistrations')->select('id','firstname','lastname')->get();
		
		 $recorde = nrestBankDetails::findOrFail($id);
        
          
		  return view('backend.shortterm.Admin.nrest_bankdetails_show',compact('recorde','student_name'));
	}

}
