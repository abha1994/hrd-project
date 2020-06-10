<?php

namespace App\Http\Controllers\shortterm\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;
use Auth;
use PDF;
use Validator,Redirect;

class NresthomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
		$st_data = DB::table('short_term_program')->get();
        $data['st_data'] = count($st_data);
        
        $cons_st_data =  DB::table('short_term_program')->where('status_id',"1")->get();
        $data['cons_st_data'] = count($cons_st_data);
        
        $selected_st_data =  DB::table('short_term_program')->where('status_id',"3")->get();
        $data['selected_st_data'] = count($selected_st_data);
        
        $noncons_st_data =  DB::table('short_term_program')->where('status_id',"2")->get();
        $data['noncons_st_data'] = count($noncons_st_data);
		
		  return view('backend.shortterm.Admin.nrest_home',compact('data'));
	}


}
