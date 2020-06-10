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
		
		try{
			
		  //**********Save Data into audtitrail_tbl************//
			$audtitrail_tbl_post = array('status'=>'0','scheme_code'=>'4','action_type1'=>'5','desc'=>'List Short Term Bank Details');
			//audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************//
		$shortTerm = DB::table('short_term_program')
			->leftJoin('user_credential','short_term_program.user_id','=','user_credential.id')
			->leftJoin('registration','user_credential.registeration_id','=','registration.candidate_id')
			->select('short_term_program.user_id','name_proposed_training_program','registration.institute_name')
			->groupby('short_term_program.user_id')
             ->get();		
		$student_name = DB::table('studentregistrations')->select('id','firstname','lastname')->where('scheme_code','4')->get(); 
        $banks = nrestBankDetails::orderBy('id','desc')->where('scheme_code','4')->get(); 
		  return view('backend.shortterm.Admin.nrest_bankdetails',compact('shortTerm','banks','student_name'));
		   }catch(\Exception $ex) {
			//**********Save Data into audtitrail_tbl************//
			$audtitrail_tbl_post = array('status'=>'1','scheme_code'=>'4','action_type1'=>'5','desc'=>'List Short Term Bank Details');
			//audtitrail_tbl_history($audtitrail_tbl_post);
			
			
			return redirect('error');
	    }
	}
	
	public function getadminbankdata(Request $request)
	{
		try{
		  
			//**********Save Data into audtitrail_tbl************//
			$audtitrail_tbl_post = array('status'=>'0','scheme_code'=>'4','action_type1'=>'5','desc'=>'Show Short Term Bank Details');
			//audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************//
	  
        $val2=$request->input('v1');
		if($val2!=""){
			$student_name = DB::table('studentregistrations')->select('id','firstname','lastname')->where('scheme_code','4')->get(); 
        $banks = nrestBankDetails::orderBy('id','desc')->where('scheme_code','4')->where('user_id',$val2)->get(); 
		  return view('backend.shortterm.Admin.nrest_bankdetails_filter',compact('banks','student_name'));
		}
		 }catch(\Exception $ex) {
			//**********Save Data into audtitrail_tbl************//
			$audtitrail_tbl_post = array('status'=>'1','scheme_code'=>'4','action_type1'=>'5','desc'=>'Show Short Term Bank Details not working');
			//audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************//
			return redirect('error');
	    }
	}


    public function show($id)
    {
		try{
		  
			//**********Save Data into audtitrail_tbl************//
			$audtitrail_tbl_post = array('status'=>'0','scheme_code'=>'4','action_type1'=>'1','desc'=>'View Short Term Bank Details');
			//audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************//
		$student_name = DB::table('studentregistrations')->select('id','firstname','lastname')->get();
		
		 $recorde = nrestBankDetails::findOrFail($id);
        
          
		  return view('backend.shortterm.Admin.nrest_bankdetails_show',compact('recorde','student_name'));
		   }catch(\Exception $ex) {
			//**********Save Data into audtitrail_tbl************//
			$audtitrail_tbl_post = array('status'=>'1','scheme_code'=>'4','action_type1'=>'1','desc'=>'View Short Term Bank Details not working');
			//audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************//
			return redirect('error');
	    }
	}

}
