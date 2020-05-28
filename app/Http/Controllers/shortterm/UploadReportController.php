<?php

namespace App\Http\Controllers\shortterm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DateTime,Session;
use App\Upload\Attendance;
use App\User;
use Validator,Redirect;
use DB;
use Response;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;
use App\Http\Requests\Form_validation;
class UploadReportController extends Controller
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
		$login_institute_id = Auth::id();//dd($login_institute_id);
         $candidate_id = Auth::user()->id;
        //$registeration_id = DB::table('user_credential')->where('id',$candidate_id)->get()->first();
           $data = DB::table('short_term_program')->where('user_id',$candidate_id)->get(array('utilization_cetificate_doc','audited_statement_doc','programme_completion_doc','impact_tranning'))->first();
    
    
        return view('backend.shortterm.report.create',compact('data'));

    }

	

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

         	       $data = Course::index();

    	         // $ndata = get_object_vars($data) ? TRUE : FALSE;

         
               if($data->course_content_doc == null){
             
                  return view('backend.shortterm.upload.create');
		   
		     }else{         
        
               return view('backend.shortterm.report.show',compact('data'));
           }
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function utilization_form_post(Request $request)


    {


          
     
 
		 $transactionResult = DB::transaction(function() use ($request) {
		$logID=Auth::id();

         
       // dd($request->all());
         $this->validate($request,[
           
            'utilization_cetificate_doc' => 'required|max:1024|mimes:pdf', // padaggogy
            
            // 'bankMandate' => 'required|max:1024|mimes:doc,docx,pdf',
            //'publication' => 'required|max:1024|mimes:doc,docx,pdf',

         ]);


         
        $records = $request->all();
        date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s');
			
        //$records['institute_id'] = $institiuteID;
		$records['user_id'] = $logID;
        	
// dd($records);
        //studentRegistration::create($records);
		//$last_id = DB::getPDO()->lastInsertId();
		//if(!empty($last_id)){
		 if($request->hasFile('utilization_cetificate_doc')) {
				$image = $request->file('utilization_cetificate_doc');
				$imagename = $image->getClientOriginalName();
				$util_content = $logID.'_'.'_utlization__4_'.'_'.$imagename;
				$utilPath = public_path('/../public/uploads/shortterm/report/utilize');
				$utilizationPath = $utilPath. "/".  $util_content;
				$image->move($utilPath , $util_content );
			
				$records1['utilization_cetificate_doc'] = $util_content;
		}
				
        
        
		$records1['created_date']= $date;
		$records1['scheme_code']= "4";
		     DB::table('short_term_program')->where('user_id',$logID)->update($records1);  
            		
		//}
		return redirect()->route('report-content.index')->with('success','Your File Are Uploaded  successfully.');
		  });
	   return $transactionResult;
          
    
 }





  /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function audited_form_post(Request $request)


    {


          
     
 
         $transactionResult = DB::transaction(function() use ($request) {
        $logID=Auth::id();
     
       // dd($request->all());
         $this->validate($request,[
           
            'practical_content_doc' => 'required|max:1024|mimes:pdf', // padaggogy
            
            // 'bankMandate' => 'required|max:1024|mimes:doc,docx,pdf',
            //'publication' => 'required|max:1024|mimes:doc,docx,pdf',

         ]);


         
        $records = $request->all();
        date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d H:i:s');
            
        //$records['institute_id'] = $institiuteID;
        $records['user_id'] = $logID;
 

         if($request->hasFile('practical_content_doc')) {
                $image = $request->file('practical_content_doc');
                $imagename = $image->getClientOriginalName();
                $audited_content = $logID.'_'.'_audited__4_'.'_'.$imagename;
                $auditedPath = public_path('/../public/uploads/shortterm/report/practical');
                $aditedPath = $auditedPath. "/". $audited_content;
                $image->move($auditedPath, $audited_content);
                $records1['audited_statement_doc'] = $audited_content;
        }
                
        
        
        $records1['created_date']= $date;
        $records1['scheme_code']= "4";
             DB::table('short_term_program')->where('user_id',$logID)->update($records1);  
                    
        //}
        return redirect()->route('report-content.index')->with('success','Your File Are Uploaded  successfully.');
          });
       return $transactionResult;
          
    
 }
  



    public function program_form_post(Request $request)


    {


          
     
 
         $transactionResult = DB::transaction(function() use ($request) {
        $logID=Auth::id();
        
         
       // dd($request->all());
         $this->validate($request,[
           
            'programme_completion_doc' => 'required|max:1024|mimes:pdf', // padaggogy
            
            // 'bankMandate' => 'required|max:1024|mimes:doc,docx,pdf',
            //'publication' => 'required|max:1024|mimes:doc,docx,pdf',

         ]);


         
        $records = $request->all();
        date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d H:i:s');
            
        //$records['institute_id'] = $institiuteID;
        $records['user_id'] = $logID;
            
// dd($records);
        //studentRegistration::create($records);
        //$last_id = DB::getPDO()->lastInsertId();
        //if(!empty($last_id)){
         if($request->hasFile('programme_completion_doc')) {
                $image = $request->file('programme_completion_doc');
                $imagename = $image->getClientOriginalName();
                $program_content = $logID.'_'.'_program__4_'.'_'.$imagename;
                $programPath = public_path('/../public/uploads/shortterm/report/program');
                $prgramPath = $programPath. "/". $program_content;
                $image->move($programPath, $program_content);
                $records1['programme_completion_doc'] = $program_content;
        }
                
                
        $records1['created_date']= $date;
       
        $records1['scheme_code']= "4";
             DB::table('short_term_program')->where('user_id',$logID)->update($records1);  
                    
        //}
        return redirect()->route('report-content.index')->with('success','Your File Are Uploaded  successfully.');
          });
       return $transactionResult;
          
    
 }
  


    public function training_form_post(Request $request)


    {


          
     
 
         $transactionResult = DB::transaction(function() use ($request) {
        $logID=Auth::id();

       // dd($request->all());
         $this->validate($request,[
           
            'impact_tranning' => 'required|max:1024|mimes:pdf', // padaggogy
            
            // 'bankMandate' => 'required|max:1024|mimes:doc,docx,pdf',
            //'publication' => 'required|max:1024|mimes:doc,docx,pdf',

         ]);


         
        $records = $request->all();
        date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d H:i:s');
            
        //$records['institute_id'] = $institiuteID;
        $records['user_id'] = $logID;
            
// dd($records);
        //studentRegistration::create($records);
        //$last_id = DB::getPDO()->lastInsertId();
        //if(!empty($last_id)){
         if($request->hasFile('impact_tranning')) {
                $image = $request->file('impact_tranning');
                $imagename = $image->getClientOriginalName();
                $training_content = $logID.'_'.'_trainig__4_'.'_'.$imagename;
                $trainingPath = public_path('/../public/uploads/shortterm/report/training');
                $imagePath = $trainingPath. "/". $training_content;
                $image->move($trainingPath, $training_content);
                $records1['impact_tranning'] = $training_content;
        }
                
        
        
        $records1['created_date']= $date;
        $records1['scheme_code']= "4";
             DB::table('short_term_program')->where('user_id',$logID)->update($records1);  
                    
        //}
        return redirect()->route('report-content.index')->with('success','Your File Are Uploaded  successfully.');
          });
       return $transactionResult;
          
    
 }








     public function download($content) {


     	 $candidate_id = Auth::user()->id;
		//$registeration_id = DB::table('user_credential')->where('id',$candidate_id)->get()->first();
        $data = DB::table('short_term_program')->where('user_id',$candidate_id)->get(array('utilization_cetificate_doc','audited_statement_doc','programme_completion_doc','impact_tranning'))->first();

         if($content==1) {

         	$filename=$data->utilization_cetificate_doc;
         	$download_link = public_path('uploads/shortterm/report/utilize/'.$filename);
         	//echo $download_link; die;
         }

         else if($content==2) {

            $filename=$data->audited_statement_doc;
            $download_link = public_path('uploads/shortterm/report/practical/'.$filename);
         }

         else if($content==3) {

            $filename=$data->programme_completion_doc;
            $download_link = public_path('uploads/shortterm/report/program/'.$filename);
         }

         else if($content==4) {

            $filename=$data->impact_tranning;
            $download_link = public_path('uploads/shortterm/report/training/'.$filename);
         }

         //$headers = ['Content-Type: application/pdf'];
         return response()->download($download_link);


       } 

  


	
}
