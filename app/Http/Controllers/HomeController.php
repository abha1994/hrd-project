<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		$int_data = DB::table('internship_tbl')->get();
        $data['int_data'] = count($int_data);
        
        $cons_int_data =  DB::table('internship_tbl')->where('status_id',"1")->get();
        $data['cons_int_data'] = count($cons_int_data);
        
        $selected_int_data =  DB::table('internship_tbl')->where('status_id',"3")->get();
        $data['selected_int_data'] = count($selected_int_data);
        
        $noncons_int_data =  DB::table('internship_tbl')->where('status_id',"2")->get();
        $data['noncons_int_data'] = count($noncons_int_data);
		
		 $ins_data = DB::table('institute_details')->get();
        $data['ins_data'] = count($ins_data);
        
        $cons_ins_data =  DB::table('institute_details')->where('status_id',"1")->get();
        $data['cons_ins_data'] = count($cons_ins_data);
        
        $selected_ins_data =  DB::table('institute_details')->where('status_id',"3")->get();
        $data['selected_ins_data'] = count($selected_ins_data);
        
        $noncons_ins_data =  DB::table('institute_details')->where('status_id',"2")->get();
        $data['noncons_ins_data'] = count($noncons_ins_data);
		
		$st_data = DB::table('short_term_program')->get();
        $data['st_data'] = count($st_data);
        
        $cons_st_data =  DB::table('short_term_program')->where('status_id',"1")->get();
        $data['cons_st_data'] = count($cons_st_data);
        
        $selected_st_data =  DB::table('short_term_program')->where('status_id',"3")->get();
        $data['selected_st_data'] = count($selected_st_data);
        
        $noncons_st_data =  DB::table('short_term_program')->where('status_id',"2")->get();
        $data['noncons_st_data'] = count($noncons_st_data);
        
      
   
        return view('home',compact('data'));
    }
	public function session_menu(Request $request){
	    $menu_id = $request->input('scheme_menu');
	    Session::put('menu_id', $menu_id);
		echo $menu_id;
	}
	   
	public function error(Request $request){
	    return view('error');
	}
   
}
