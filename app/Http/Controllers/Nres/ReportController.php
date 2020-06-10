<?php

namespace App\Http\Controllers\Nres;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use DateTime,Session;
use Illuminate\Support\Facades\Hash;
use PDF;
use Illuminate\Mail\Message;
use Validator,Redirect;

class ReportController extends Controller
{  
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		
    }

    /**
     *  Show the Upload Form List.
     *
     * @index
     */
    
	public function index(Request $request)  { 
      try{
		  //**********Save Data into audtitrail_tbl************//
			$audtitrail_tbl_post = array('status'=>'0','scheme_code'=>'2','action_type1'=>'1','desc'=>'Listing of Upload Report');
			audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************//   
		  $logID=Auth::id();
		  $usrid= DB::table('internship_tbl')->where('user_id',$logID)->get()->first();
		  if(!empty($usrid)) {
			$data = DB::table('fellowship_details')->where('internship_candidate_id',$usrid->candidate_id)->get()->first();
			return view('backend/nres/report/create',compact('data'));
		  }
	  }catch(\Exception $ex) {
			//**********Save Data into audtitrail_tbl************//
				$audtitrail_tbl_post = array('status'=>'1','scheme_code'=>'2','action_type1'=>'1','desc'=>'Listing of Upload Report Not working');
				audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************//    
	        // dd('Message', $ex->getMessage());
            return redirect('error');
	    }
    }
	
	/**
     * Upload form post.
     *
     * @report_form_post
	 Form_validation
     */
	 
	 /* Final Submit */
	 
	public function report_form_post(Request $request) {
		try{
		$transactionResult = DB::transaction(function() use ($request) {
		$logID=Auth::id();
		$records = $request->all();
        date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s');
			
        if($request->hasFile('expenditure_rprt')) {
            $this->validate($request,[
               'expenditure_rprt' => 'required|max:1024|mimes:pdf', 
        ]);

			$image = $request->file('expenditure_rprt');
			$imagename = $image->getClientOriginalName();
			$exp_content = $logID.'_'.'_expenditure__4_'.'_'.$imagename;
			$expPath = public_path('/../public/uploads/nres/expenditure');
			$imagePath = $expPath. "/".  $exp_content;
			$image->move($expPath, $exp_content);
			$records1['expenditure_rprt'] = $exp_content;
		}
				
        if($request->hasFile('publication_rprt')) {
            $this->validate($request,[
                'publication_rprt' => 'required|max:1024|mimes:pdf', 
        ]);
			$image = $request->file('publication_rprt');
			$imagename = $image->getClientOriginalName();
			$publ_content =  $logID.'_'.'_publication__4_'.'_'.$imagename;
			$publPath = public_path('/../public/uploads/nres/publication');
			$imagePath = $publPath. "/".  $publ_content;
			$image->move($publPath , $publ_content);
			$records1['publication_rprt'] = $publ_content;
		}
		
        if($request->hasFile('continuance_rprt')) {
            $this->validate($request,[
               'continuance_rprt' => 'required|max:1024|mimes:pdf', 
        ]);

			$image = $request->file('continuance_rprt');
			$imagename = $image->getClientOriginalName();
			$continuance_content = $logID.'_'.'_continuance__4_'.'_'.$imagename;
			$continuancePath = public_path('/../public/uploads/nres/continuance');
			$imagePath = $continuancePath. "/".$continuance_content;
			$image->move($continuancePath, $continuance_content);
			$records1['continuance_rprt'] = $continuance_content;
		}

        if($request->hasFile('contingency_rprt')) {
            $this->validate($request,[
               'contingency_rprt' => 'required|max:1024|mimes:pdf', 
        ]);

			$image = $request->file('contingency_rprt');
			$imagename = $image->getClientOriginalName();
			$contingency_content = $logID.'_'.'_contingency__4_'.'_'.$imagename;
			$contingencyPath = public_path('/../public/uploads/nres/contingency');
			$imagePath = $contingencyPath. "/".$contingency_content;
			$image->move($contingencyPath, $contingency_content);
			$records1['contingency_rprt'] = $contingency_content;
		}

        if($request->hasFile('scientific_rprt')) {
            $this->validate($request,[
                'scientific_rprt' => 'required|max:1024|mimes:pdf', 
        ]);

			$image = $request->file('scientific_rprt');
			$imagename = $image->getClientOriginalName();
			$scientific_content = $logID.'_'.'_scientific__4_'.'_'.$imagename;
			$scientificPath = public_path('/../public/uploads/nres/scientific');
			$imagePath = $scientificPath. "/".$scientific_content;
			$image->move($scientificPath, $scientific_content);
			$records1['scientific_rprt'] = $scientific_content;
		}
        
		if($request->hasFile('periodic_rprt')) {
            $this->validate($request,[
                'periodic_rprt' => 'required|max:1024|mimes:pdf', 
		]);

			$image = $request->file('periodic_rprt');
			$imagename = $image->getClientOriginalName();
			$periodic_content = $logID.'_'.'_periodic__4_'.'_'.$imagename;
			$periodicPath = public_path('/../public/uploads/nres/periodic');
			$imagePath = $periodicPath. "/".$periodic_content;
			$image->move($periodicPath, $periodic_content);
			$records1['periodic_rprt'] = $periodic_content;
		}

        if($request->hasFile('final_rprt')) {
  		    $this->validate($request,[
                'final_rprt' => 'required|max:1024|mimes:pdf', 
        ]);

			$image = $request->file('final_rprt');
			$imagename = $image->getClientOriginalName();
			$final_content = $logID.'_'.'_final__4_'.'_'.$imagename;
			$finalPath = public_path('/../public/uploads/nres/finalreport');
			$imagePath = $finalPath. "/".$final_content;
			$image->move($finalPath, $final_content);
			$records1['final_rprt'] = $final_content;
		}	
		
		if($request->hasFile('patent_rprt')) {
            $this->validate($request,[
                'patent_rprt' => 'required|max:1024|mimes:pdf',
        ]);

			$image = $request->file('patent_rprt');
			$imagename = $image->getClientOriginalName();
			$patent_content = $logID.'_'.'_patent__4_'.'_'.$imagename;
			$patentPath = public_path('/../public/uploads/nres/patent');
			$imagePath = $patentPath. "/".$patent_content;
			$image->move($patentPath, $patent_content);
			$records1['patent_rprt'] = $patent_content;
		}		

		$records1['created_date']= $date;
		$records1['scheme_code']= "4";
		//**********Save Data into audtitrail_tbl************//
			$audtitrail_tbl_post = array('status'=>'0','scheme_code'=>'2','action_type1'=>'2','desc'=>' Upload Report successfully');
			audtitrail_tbl_history($audtitrail_tbl_post);
		//**********Save Data into audtitrail_tbl************//  
		$data= DB::table('internship_tbl')->where('user_id',$logID)->get()->first();
		
		if(!empty($data)) {
		   DB::table('fellowship_details')->where('internship_candidate_id',$data->candidate_id)->update( $records1);  
		}else{
		   return redirect()->route('nres-report')->with('success','Please check internship candidate id.');
	    } 		
        return redirect()->route('nres-report.index')->with('success','Your Files Are Uploaded  successfully.');
	  });
	  return $transactionResult;
   }catch(\Exception $ex) {
		//**********Save Data into audtitrail_tbl************//
			$audtitrail_tbl_post = array('status'=>'1','scheme_code'=>'2','action_type1'=>'2','desc'=>' Upload Report Not working');
			audtitrail_tbl_history($audtitrail_tbl_post);
		//**********Save Data into audtitrail_tbl************//    
		// dd('Message', $ex->getMessage());
		return redirect('error');
	}
}
	 
	 /* Final Submit */


    public function download($content) {
        $candidate_id = Auth::user()->id;
		$data = DB::table('fellowship_details')->where('internship_candidate_id',"458")->get()->first();    	 

         if($content==1) {

         	$filename=$data->expenditure_rprt;
         	$download_link = public_path('uploads/nres/expenditure/'.$filename);
         	//echo $download_link; die;
         }

         else if($content==2) {

            $filename=$data->publication_rprt;
            $download_link = public_path('uploads/nres/publication/'.$filename);
         }

         else if($content==3) {

            $filename=$data->continuance_rprt;
            $download_link = public_path('uploads/nres/continuance/'.$filename);
         }

         else if($content==6) {

            $filename=$data->scientific_rprt;
            $download_link = public_path('uploads/nres/scientific/'.$filename);
         }

         else if($content==4) {

            $filename=$data->contingency_rprt;
            $download_link = public_path('uploads/nres/contingency/'.$filename);
         }

         else if($content==5) {

            $filename=$data->periodic_rprt;
            $download_link = public_path('uploads/nres/periodic/'.$filename);
         }

         else if($content==7) {

            $filename=$data->final_rprt;
            $download_link = public_path('uploads/nres/finalreport/'.$filename);
         }

           else if($content==8) {

            $filename=$data->patent_rprt;
            $download_link = public_path('uploads/nres/patent/'.$filename);
         }
        return response()->download($download_link);
    } 


	
}
