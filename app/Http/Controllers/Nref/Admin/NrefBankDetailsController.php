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
		$student_name = DB::table('studentregistrations')->select('id','firstname','lastname')->where('scheme_code','3')->get(); 
        $banks = nrefBankDetails::orderBy('id','desc')->where('scheme_code','3')->get(); 
		  return view('backend.nref.Admin.bankdetails.nref_bankdetails',compact('banks','student_name'));
	}

    public function show($id)
    {
		$student_name = DB::table('studentregistrations')->select('id','firstname','lastname')->get();
		
		 $recorde = nrefBankDetails::findOrFail($id);
        
          
		  return view('backend.nref.Admin.bankdetails.nref_bankdetails_show',compact('recorde','student_name'));
	}

}
