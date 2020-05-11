<?php

namespace App\Http\Controllers\Nres\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Nref\studentRegistrationModel;
use Session;
use DB;
use Auth;
use PDF;
use Validator,Redirect;

class NreshomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
		 // return view('home',compact('dashboard_data'));
		  return view('backend.nres.admin.nres_home');
	}


}
