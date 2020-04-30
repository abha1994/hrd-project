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
		$internship_data = DB::table('internship_tbl')->get();
        $dashboard_data['internship_data'] = count($internship_data);
        
        $considered_data =  DB::table('internship_tbl')->where('status_id',"1")->get();
        $dashboard_data['considered_data'] = count($considered_data);
        
        $selected_data =  DB::table('internship_tbl')->where('status_id',"2")->get();
        $dashboard_data['selected_data'] = count($selected_data);
        
        $nonconsidered_data =  DB::table('internship_tbl')->where('status_id',"3")->get();
        $dashboard_data['nonconsidered_data'] = count($nonconsidered_data);
        
        $onemonth_data =  DB::table('internship_tbl')->where('intern_duration',"1")->get();
        $dashboard_data['onemonth_data'] = count($onemonth_data);
        
        $twomonth_data =  DB::table('internship_tbl')->where('intern_duration',"2")->get();
        $dashboard_data['twomonth_data'] = count($twomonth_data);
        
        $threemonth_data =  DB::table('internship_tbl')->where('intern_duration',"3")->get();
        $dashboard_data['threemonth_data'] = count($threemonth_data);
        
        $fourmonth_data =  DB::table('internship_tbl')->where('intern_duration',"4")->get();
        $dashboard_data['fourmonth_data'] = count($fourmonth_data);
        
        $fivemonth_data =  DB::table('internship_tbl')->where('intern_duration',"5")->get();
        $dashboard_data['fivemonth_data'] = count($fivemonth_data);
        
        $sixmonth_data =  DB::table('internship_tbl')->where('intern_duration',"6")->get();
        $dashboard_data['sixmonth_data'] = count($sixmonth_data);
        
        $gra_be_btech_pass =  DB::table('intern_course_details')->where('course_id',"4")->where('pass_status',"2")->get();
        $dashboard_data['gra_be_btech_pass'] = count($gra_be_btech_pass);
        
        $gra_ba_bsc_pass =  DB::table('intern_course_details')->where('course_id',"5")->where('pass_status',"2")->get();
        $dashboard_data['gra_ba_bsc_pass'] = count($gra_ba_bsc_pass);
        
        $pg_mtech_pass =  DB::table('intern_course_details')->where('course_id',"6")->where('pass_status',"2")->get();
        $dashboard_data['pg_mtech_pass'] = count($pg_mtech_pass);
        
        $pg_ma_msc_pass =  DB::table('intern_course_details')->where('course_id',"7")->where('pass_status',"2")->get();
        $dashboard_data['pg_ma_msc_pass'] = count($pg_ma_msc_pass);
        
        $pg_mscre_pass =  DB::table('intern_course_details')->where('course_id',"8")->where('pass_status',"2")->get();
        $dashboard_data['pg_mscre_pass'] = count($pg_mscre_pass);
        
        $pg_diploma_pass =  DB::table('intern_course_details')->where('course_id',"9")->where('pass_status',"2")->get();
        $dashboard_data['pg_diploma_pass'] = count($pg_diploma_pass);
        
        $mphil_pass =  DB::table('intern_course_details')->where('course_id',"10")->where('pass_status',"2")->get();
        $dashboard_data['mphil_pass'] = count($mphil_pass);
        
        $phd_pass =  DB::table('intern_course_details')->where('course_id',"11")->where('pass_status',"2")->get();
        $dashboard_data['phd_pass'] = count($phd_pass);
        
        $gra_be_btech_pur =  DB::table('intern_course_details')->where('course_id',"4")->where('pass_status',"1")->get();
        $dashboard_data['gra_be_btech_pur'] = count($gra_be_btech_pur);
        
        $gra_ba_bsc_pur =  DB::table('intern_course_details')->where('course_id',"5")->where('pass_status',"1")->get();
        $dashboard_data['gra_ba_bsc_pur'] = count($gra_ba_bsc_pur);
        
        $pg_mtech_pur =  DB::table('intern_course_details')->where('course_id',"6")->where('pass_status',"1")->get();
        $dashboard_data['pg_mtech_pur'] = count($pg_mtech_pur);
        
        $pg_ma_msc_pur =  DB::table('intern_course_details')->where('course_id',"7")->where('pass_status',"1")->get();
        $dashboard_data['pg_ma_msc_pur'] = count($pg_ma_msc_pur);
        
        $pg_mscre_pur =  DB::table('intern_course_details')->where('course_id',"8")->where('pass_status',"1")->get();
        $dashboard_data['pg_mscre_pur'] = count($pg_mscre_pur);
        
        $pg_diploma_pur =  DB::table('intern_course_details')->where('course_id',"9")->where('pass_status',"1")->get();
        $dashboard_data['pg_diploma_pur'] = count($pg_diploma_pur);
        
        $mphil_pur =  DB::table('intern_course_details')->where('course_id',"10")->where('pass_status',"1")->get();
        $dashboard_data['mphil_pur'] = count($mphil_pur);
        
        $phd_pur =  DB::table('intern_course_details')->where('course_id',"11")->where('pass_status',"1")->get();
        $dashboard_data['phd_pur'] = count($phd_pur);
   
        return view('home',compact('dashboard_data'));
    }
	
	  public function session_menu(Request $request){
	     $menu_id = $request->input('scheme_menu');
	      Session::put('menu_id', $menu_id);
		  echo $menu_id;
	   }
   
}
