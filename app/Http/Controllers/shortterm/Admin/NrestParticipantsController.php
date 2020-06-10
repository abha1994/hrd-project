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
		$shortTerm = DB::table('short_term_program')
			->leftJoin('user_credential','short_term_program.user_id','=','user_credential.id')
			->leftJoin('registration','user_credential.registeration_id','=','registration.candidate_id')
			->select('short_term_program.user_id','name_proposed_training_program','registration.institute_name')
			->groupby('short_term_program.user_id')
             ->get();
			
			
			
		$students = DB::table('studentregistrations')->where('scheme_code','4')->orderBy('id','desc')->get();
		$state_data = DB::table('state_master')->distinct('statae_name')->get();
		
        $district_data = DB::table('district_master')->distinct('district_name')->get();   
		return view('backend.shortterm.Admin.nrest_participants',compact('shortTerm','students','state_data','district_data'));
			
	}
	
	public function getadminparticipantdata(Request $request)
	{
	
        $val2=$request->input('v1');
		
		if($val2!=""){
			$state_data = DB::table('state_master')->distinct('statae_name')->get();
            $district_data = DB::table('district_master')->distinct('district_name')->get(); 
			$students = DB::table('studentregistrations')->where('scheme_code','4')->where('user_id',$val2)->orderBy('id','desc')->get();
			// dd($data);
		   return view('backend.shortterm.Admin.nrest_participants_filter',compact('students','state_data','district_data'));
		}
	}

    public function show($id)
    {
	    $recorde = DB::table('studentregistrations')->where('scheme_code','4')->where('id',$id)->orderBy('id','desc')->get()->first();
        $stateName = DB::table('state_master')->where('statecd',$recorde->statecd)->distinct('statecd')->get();
        $disticName = DB::table('district_master')->where('districtcd',$recorde->districtcd)->distinct('statecd')->get();    
	    return view('backend.shortterm.Admin.nrest_participants_show',compact('recorde','stateName','disticName'));
	}

}
