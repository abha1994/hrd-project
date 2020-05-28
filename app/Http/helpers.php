<?php

/**
* change plain number to formatted currency
*
* @param $number
* @param $currency
*/
function institute_status_check()
{
	$login_user_id = Auth::id();
	// dd($login_user_id);
	$a = DB::table('institute_details')->where('status_id','3')->where('scheme_code','3')->where('user_id',$login_user_id)->get()->first();
    return $a;
}

function institute_notification()
{
	$login_user_id = Auth::id();
	// dd($login_user_id);
	$a = DB::table('institute_details')->select('status_id')->where('scheme_code','3')->where('user_id',$login_user_id)->whereIn('officer_role_id', [2, 4, 5,1])->get()->first();
    return $a;
}

function module_array()
{
	$arr = ['1'=>'Role','3'=>'Officer','4'=>'Fellow Amount','5'=>'Pending Internship Application','6'=>'Internship Application Considered By Level 1 Officer','7'=>'Internship Application Rejected By Level 1 Officer','8'=>'Internship Application Forward to Committee','9'=>'Internship Application Final Selected','10'=>'Pending Institute Application','11'=>'Institute Consider By level 1','12'=>'Institute Rejected by level 1','13'=>'Institute Forward to Committee','14'=>'Institute Recommanded by committee','15'=>'Final Rejected Institute','16'=>'Final Selected Institute','17'=>'Pending Student Application','18'=>'Student Application Consider by level 1','19'=>'Student Application Rejected by level 1','20'=>'Student Application forward to committee','21'=>'Student Application Recommanded by Committee','22'=>'Final Selected Student Application','23'=>'Final Rejected Student Application','24'=>'Student Bank Application','25'=>'Student Attandence Report','26'=>'Student Acknowledge Report','27'=>'Student Progress Report'];
	return $arr;
}