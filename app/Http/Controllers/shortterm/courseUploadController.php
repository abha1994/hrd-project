<?php

namespace App\Http\Controllers\shortterm;
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
		$logID=Auth::id();
		$short_term_data= DB::table('short_term_program')->select('short_term_id','course_content_doc','padaggogy_doc','practical_content_doc')->where('user_id', $logID)->first();
		 return view('backend.shortterm.course_content.create',compact('short_term_data'));
	}



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	    $transactionResult = DB::transaction(function() use ($request) {
			$doc_id = $request->doc_id;
			
			$course_content_doc = $request->course_content_doc;
			$padaggogy_doc = $request->padaggogy_doc;
			$practical_content_doc = $request->practical_content_doc;
			
			$logID=Auth::id();
			date_default_timezone_set('Asia/Kolkata');
			$date = date('Y-m-d H:i:s');
		
			if($doc_id == "1"){
				$this->validate($request,[
                    'course_content_doc' => 'max:1024|mimes:pdf', // padaggogy
                ]);
				 if($request->hasFile('course_content_doc')) {
						$image = $request->file('course_content_doc');
						$imagename = $image->getClientOriginalName();
						$course_content = $logID.'_'.'_course__4_'.'_'.$imagename;
						$coursePath = public_path('/../public/uploads/shortterm/course');
						$imagePath = $coursePath. "/".  $course_content;
						$image->move($coursePath, $course_content);
					    $records1['course_content_doc'] = $course_content;
						$records1['scheme_code']= "4";
		                DB::table('short_term_program')->where('user_id',$logID)->update($records1);
						
	        	}
			}
			if($doc_id == "2"){
				$this->validate($request,[
                    'padaggogy_doc' => 'max:1024|mimes:pdf',     //practical_content
                ]);
				if($request->hasFile('padaggogy_doc')) {
                        $image = $request->file('padaggogy_doc');
						$imagename = $image->getClientOriginalName();
						$padaggogy_content = $logID.'_'.'_padaggogy__4_'.'_'.$imagename;
						$padaggogyPath = public_path('/../public/uploads/shortterm/padaggogy');
						$imagePath = $padaggogyPath. "/".$padaggogy_content;
						$image->move($padaggogyPath, $padaggogy_content);
						$records1['padaggogy_doc'] = $padaggogy_content;
						$records1['scheme_code']= "4";
		                DB::table('short_term_program')->where('user_id',$logID)->update($records1);
					
				}
			}
			if($doc_id = "3"){
				$this->validate($request,[
                    'practical_content_doc' => 'max:1024|mimes:pdf',
                ]);
				if($request->hasFile('practical_content_doc')) {
						$image = $request->file('practical_content_doc');
						$imagename = $image->getClientOriginalName();
						$practical_content =  $logID.'_'.'_practical__4_'.'_'.$imagename;
						$practicalPath = public_path('/../public/uploads/shortterm/practical');
						$imagePath = $practicalPath. "/".  $practical_content;
						$image->move($practicalPath , $practical_content);
						$records1['practical_content_doc'] = $practical_content;
						$records1['scheme_code']= "4";
		                DB::table('short_term_program')->where('user_id',$logID)->update($records1);
						
				}
		
			}
			
			if($course_content_doc == null && $padaggogy_doc == null && $practical_content_doc ==null)
			{  
		        return redirect('course-content');
		    }else{
				return redirect('course-content')->with('message','Course and Content Uploaded successfully.');
			}
		  });
	   return $transactionResult;
          
    
 }
  


  
  


	
}
