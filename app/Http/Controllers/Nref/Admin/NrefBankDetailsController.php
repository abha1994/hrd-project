<?php

namespace App\Http\Controllers\Nref\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Nref\admin\nrefBankDetails;
use Session;
use DB;
use Auth;
use PDF;
use Validator,Redirect;

class NrefBankDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
		$institute_data =DB::table('institute_details')
		     ->leftJoin('user_credential', 'institute_details.user_id', '=', 'user_credential.id')
             ->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
			 ->select('registration.institute_name','institute_details.institute_id')
			->where('institute_details.status_id',3)
            ->get();
		$student_name = DB::table('studentregistrations')->select('id','firstname','lastname')->where('scheme_code','3')->get(); 
        $banks = nrefBankDetails::orderBy('id','desc')->where('scheme_code','3')->get(); 
		return view('backend.nref.Admin.bankdetails.nref_bankdetails',compact('banks','student_name','institute_data'));
	}

public function getinbanknref(Request $request)
	{
	   
        $val2=$request->input('v1');
		 if($val2!=""){
			$student_name = DB::table('studentregistrations')->select('id','firstname','lastname')->where('scheme_code','3')->get(); 
            $banks = nrefBankDetails::orderBy('id','desc')->where('scheme_code','3')->where('institute_id',$val2)->get(); 
			// dd($banks);
		   return view('backend.nref.Admin.bankdetails.nref_bankdetails_filter',compact('student_name','banks'));
		}

	}
    public function show($id)
    {
		$student_name = DB::table('studentregistrations')->select('id','firstname','lastname')->get();
		$recorde = nrefBankDetails::findOrFail($id);
        return view('backend.nref.Admin.bankdetails.nref_bankdetails_show',compact('recorde','student_name'));
	}

}
