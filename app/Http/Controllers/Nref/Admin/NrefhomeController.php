<?php

namespace App\Http\Controllers\Nref\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Nref\studentRegistrationModel;
use Session;
use DB;
use Auth;
use PDF;
use Validator,Redirect;

class NrefhomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
		 $ins_data = DB::table('institute_details')->get();
        $data['ins_data'] = count($ins_data);
        
        $cons_ins_data =  DB::table('institute_details')->where('status_id',"1")->get();
        $data['cons_ins_data'] = count($cons_ins_data);
        
        $selected_ins_data =  DB::table('institute_details')->where('status_id',"3")->get();
        $data['selected_ins_data'] = count($selected_ins_data);
        
        $noncons_ins_data =  DB::table('institute_details')->where('status_id',"2")->get();
        $data['noncons_ins_data'] = count($noncons_ins_data);
		
		$ins_type_1 =  DB::table('institute_details')->where('institute_type_id',"1")->get();
        $data['ins_type_1'] = count($ins_type_1);
		
		$ins_type_2 =  DB::table('institute_details')->where('institute_type_id',"2")->get();
        $data['ins_type_2'] = count($ins_type_2);
		
		$ins_type_3 =  DB::table('institute_details')->where('institute_type_id',"3")->get();
        $data['ins_type_3'] = count($ins_type_3);
		
		$ins_type_4 =  DB::table('institute_details')->where('institute_type_id',"4")->get();
        $data['ins_type_4'] = count($ins_type_4);
		
		$ins_type_5 =  DB::table('institute_details')->where('institute_type_id',"5")->get();
        $data['ins_type_5'] = count($ins_type_5);
		
		$ins_type_6 =  DB::table('institute_details')->where('institute_type_id',"6")->get();
        $data['ins_type_6'] = count($ins_type_6);
		
		$ins_type_7 =  DB::table('institute_details')->where('institute_type_id',"7")->get();
        $data['ins_type_7'] = count($ins_type_7);
		
		$ins_type_8 =  DB::table('institute_details')->where('institute_type_id',"8")->get();
        $data['ins_type_8'] = count($ins_type_8);
		
		$ins_type_9 =  DB::table('institute_details')->where('institute_type_id',"9")->get();
        $data['ins_type_9'] = count($ins_type_9);
		 
		  return view('backend.nref.Admin.nref_home',compact('data'));
	}


}
