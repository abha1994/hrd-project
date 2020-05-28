<?php

namespace App\Http\Controllers\shortterm\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DateTime,Session;
use App\User;
use Validator,Redirect;
use DB;
use Response;
use Auth;
use App\Http\Requests\Form_validation;
class courseUploadController extends Controller
{
    function __construct()
    {
         

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
		$short_term_data= DB::table('short_term_program')->select('short_term_id','course_content_doc','padaggogy_doc','practical_content_doc')->first();
		// dd($short_term_data);
		 return view('backend.shortterm.Admin.course_content.create',compact('short_term_data'));
	}



  


	
}
