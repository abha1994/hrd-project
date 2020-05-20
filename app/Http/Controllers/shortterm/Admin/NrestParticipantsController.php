<?php

namespace App\Http\Controllers\shortterm\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\shortterm\Admin\nrestParticipants;
use Session;
use DB;
use Auth;
use PDF;
use Validator,Redirect;

class NrestParticipantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
		$students = DB::table('studentregistrations')->where('scheme_code','4')->orderBy('id','desc')->get();
		$state_data = DB::table('state_master')->distinct('statae_name')->get();
		
        $district_data = DB::table('district_master')->distinct('district_name')->get();   
		  return view('backend.shortterm.Admin.nrest_participants',compact('students','state_data','district_data'));
	}

    public function show($id)
    {
		
		 $recorde = nrestParticipants::findOrFail($id);
        
        $stateName = DB::table('state_master')->where('statecd',$recorde->statecd)->distinct('statecd')->get();
        $disticName = DB::table('district_master')->where('districtcd',$recorde->districtcd)->distinct('statecd')->get();    
		  return view('backend.shortterm.Admin.nrest_participants_show',compact('recorde','stateName','disticName'));
	}

}
