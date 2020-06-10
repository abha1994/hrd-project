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
		try{
			$login_institute_id = Auth::id();//dd($login_institute_id);
			$candidate_id = Auth::user()->id;
			$data = DB::table('short_term_program')->where('user_id',$candidate_id)->get(array('utilization_cetificate_doc','audited_statement_doc','programme_completion_doc','impact_tranning'))->first();
			//**********Save Data into audtitrail_tbl************//
				$audtitrail_tbl_post = array('status'=>'0','scheme_code'=>'4','action_type1'=>'5','desc'=>'List Of Upload Reports');
				audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************// 
			return view('backend.shortterm.report.create',compact('data'));
		}catch(\Exception $ex) {
			//**********Save Data into audtitrail_tbl************//
				$audtitrail_tbl_post = array('status'=>'1','scheme_code'=>'4','action_type1'=>'5','desc'=>'List Of Upload Reports Not Working');
				audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************// 

	        return redirect('error');// dd('Message', $ex->getMessage());
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
		try{
        $transactionResult = DB::transaction(function() use ($request) {
		$logID=Auth::id();
        $this->validate($request,[
            'utilization_cetificate_doc' => 'required|max:1024|mimes:pdf', // padaggogy
        ]);
        $records = $request->all();
        date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s');
		$records['user_id'] = $logID;
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
		//**********Save Data into audtitrail_tbl************//
			$audtitrail_tbl_post = array('status'=>'0','scheme_code'=>'4','action_type1'=>'2','desc'=>'Upload Utiltization Certificate report uploaded successfully');
			audtitrail_tbl_history($audtitrail_tbl_post);
		//**********Save Data into audtitrail_tbl************// 
		DB::table('short_term_program')->where('user_id',$logID)->update($records1);  
        return redirect()->route('report-content.index')->with('success','Your File Are Uploaded  successfully.');
	    });
	    return $transactionResult;
		}catch(\Exception $ex) {
			//**********Save Data into audtitrail_tbl************//
				$audtitrail_tbl_post = array('status'=>'1','scheme_code'=>'4','action_type1'=>'2','desc'=>'Upload Utiltization Certificate report Not Working');
				audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************// 

	        return redirect('error');// dd('Message', $ex->getMessage());
	    }
          
    
 }





  /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function audited_form_post(Request $request)
    {
		try{
        $transactionResult = DB::transaction(function() use ($request) {
        $logID=Auth::id();
        $this->validate($request,[
           'practical_content_doc' => 'required|max:1024|mimes:pdf', // padaggogy
        ]);

        $records = $request->all();
        date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d H:i:s');
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
		//**********Save Data into audtitrail_tbl************//
			$audtitrail_tbl_post = array('status'=>'0','scheme_code'=>'4','action_type1'=>'2','desc'=>'Upload Audited Statement Of Expenditure report uploaded successfully');
			audtitrail_tbl_history($audtitrail_tbl_post);
		//**********Save Data into audtitrail_tbl************// 
        DB::table('short_term_program')->where('user_id',$logID)->update($records1);  
        return redirect()->route('report-content.index')->with('success','Your File Are Uploaded  successfully.');
        });
        return $transactionResult;
        }catch(\Exception $ex) {
			//**********Save Data into audtitrail_tbl************//
				$audtitrail_tbl_post = array('status'=>'1','scheme_code'=>'4','action_type1'=>'2','desc'=>'Upload Audited Statement Of Expenditure report Not Working');
				audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************// 

	        return redirect('error');// dd('Message', $ex->getMessage());
	    }      
   }
  



    public function program_form_post(Request $request)
   {
	   try{
        $transactionResult = DB::transaction(function() use ($request) {
        $logID=Auth::id();
        $this->validate($request,[
            'programme_completion_doc' => 'required|max:1024|mimes:pdf', // padaggogy
        ]);
        $records = $request->all();
        date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d H:i:s');
        $records['user_id'] = $logID;
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
			//**********Save Data into audtitrail_tbl************//
				$audtitrail_tbl_post = array('status'=>'0','scheme_code'=>'4','action_type1'=>'2','desc'=>'Upload the Programme Completion Report report uploaded successfully');
				audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************// 
        DB::table('short_term_program')->where('user_id',$logID)->update($records1);  
        return redirect()->route('report-content.index')->with('success','Your File Are Uploaded  successfully.');
        });
        return $transactionResult;
        }catch(\Exception $ex) {
			//**********Save Data into audtitrail_tbl************//
				$audtitrail_tbl_post = array('status'=>'1','scheme_code'=>'4','action_type1'=>'2','desc'=>'Upload the Programme Completion Report report Not Working');
				audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************// 

	        return redirect('error');// dd('Message', $ex->getMessage());
	    }   
    }
  


   public function training_form_post(Request $request)
   {
        try{
        $transactionResult = DB::transaction(function() use ($request) {
        $logID=Auth::id();
        $this->validate($request,[
           'impact_tranning' => 'required|max:1024|mimes:pdf', // padaggogy
        ]);
        $records = $request->all();
        date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d H:i:s');
        $records['user_id'] = $logID;
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
		//**********Save Data into audtitrail_tbl************//
			$audtitrail_tbl_post = array('status'=>'0','scheme_code'=>'4','action_type1'=>'2','desc'=>'Impact of training report uploaded successfully');
			audtitrail_tbl_history($audtitrail_tbl_post);
		//**********Save Data into audtitrail_tbl************// 
        DB::table('short_term_program')->where('user_id',$logID)->update($records1);  
        return redirect()->route('report-content.index')->with('success','Your File Are Uploaded  successfully.');
        });
        return $transactionResult;
        }catch(\Exception $ex) {
			//**********Save Data into audtitrail_tbl************//
				$audtitrail_tbl_post = array('status'=>'1','scheme_code'=>'4','action_type1'=>'2','desc'=>'Impact of training report Not Working');
				audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************// 

	        return redirect('error');// dd('Message', $ex->getMessage());
	    }     
    }


    public function download($content) {
		try{
        $candidate_id = Auth::user()->id;
		$data = DB::table('short_term_program')->where('user_id',$candidate_id)->get(array('utilization_cetificate_doc','audited_statement_doc','programme_completion_doc','impact_tranning'))->first();

        if($content==1) {
         	$filename=$data->utilization_cetificate_doc;
         	$download_link = public_path('uploads/shortterm/report/utilize/'.$filename);
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
           //**********Save Data into audtitrail_tbl************//
				$audtitrail_tbl_post = array('status'=>'0','scheme_code'=>'4','action_type1'=>'1','desc'=>'Download reports');
				audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************// 
         return response()->download($download_link);
        }catch(\Exception $ex) {
			//**********Save Data into audtitrail_tbl************//
				$audtitrail_tbl_post = array('status'=>'1','scheme_code'=>'4','action_type1'=>'1','desc'=>'Download report Not Working');
				audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************// 

	        return redirect('error');// dd('Message', $ex->getMessage());
	    }  

    } 

  


	
}
