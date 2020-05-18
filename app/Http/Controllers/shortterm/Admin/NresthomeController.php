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
		 // return view('home',compact('dashboard_data'));
		  return view('backend.shortterm.Admin.nrest_home');
	}


}
