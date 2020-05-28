<?php

namespace App\Http\Controllers\shortterm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Nref\studentRegistrationModel;
use Session;
use DB;
use Auth;
use PDF;
use Validator,Redirect;

class AcknowledgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$institute_id =  Auth::id(); // Institute login id
        $candidates = DB::table('candidate_attendence')->where(['user_id' =>$institute_id,'scheme_code'=>4])->orderBy('attendence_id','desc')->get();
		
		$short_term_program = DB::table('short_term_program')
		->select('short_term_id','scheme_code','name_proposed_training_program')
		->where('user_id',$institute_id)->first();
		
		// dd($candidates);
		$students = DB::table('studentregistrations')
            ->leftJoin('candidate_attendence', 'studentregistrations.id', '=', 'candidate_attendence.student_id')
			->where(['candidate_attendence.scheme_code' =>4])
			->where('candidate_attendence.user_id',$institute_id)
			->orderBy('attendence_id','asc')
            ->get();
			
			//echo "<pre>"; print_r($students); die;
		return view('backend.shortterm.shorttermAcknowledge.acknowledge',compact('students','candidates','short_term_program'));
    }

    public function acknowledge_short_post(Request $request)
    {
		
		///dd($request);
		$this->validate($request,[
     		'fileSign' => 'required|mimes:pdf',
		]); 
        $records = $request->all();
		    $transactionResult = DB::transaction(function() use ($request) {
			$user_id =  Auth::id();
			$existRecords = DB::table('candidate_attendence')
							->where(['student_id' => $request->student_id,'attendence_id' =>$request->candidate_attn_id,'scheme_code' =>4])
							->get();
			$RecordsCount = $existRecords->count();
			if($RecordsCount>0) {
				if($request->hasFile('fileSign')) {
						$image = $request->file('fileSign');
						$fileSign = $user_id.'_'.$request->student_id.'_file_shortTerm.'.$image->getClientOriginalExtension();
						$destinationPath = public_path('/../public/uploads/shortterm/acknowledge');
						$imagePath = $destinationPath. "/".  $fileSign;
						$image->move($destinationPath, $fileSign);
						
						$filedata['fileSign'] = $fileSign;
						$filedata['isfilesubmit'] = 1;
				}
					
				$updateQuery=DB::table('candidate_attendence')
					->where(['student_id' => $request->student_id,'attendence_id' =>$request->candidate_attn_id,'scheme_code' =>4])
					->update($filedata);
				if($updateQuery)
				{
					return back()->with('message','Short Term Slip Uploaded successfully !');
				}else{
					return back()->with('error','Short Term Slip Not uploaded');
				}
			}else{
			    return back()->with('error','Attandance Not Available');
		    }
	    });
		return $transactionResult;
	}
	
	public function shortTermpdf(Request $request)
    {
		// $all_data =  Session::get('userdata');
		// $user_id = $all_data['candidate_id'];
		$user_id =  Auth::id(); // Institute login id
		$registeration_id = DB::table('user_credential')->select('registeration_id')->where('id',$user_id)->get()->first();
		
		$loginuser = DB::table('registration')->where('candidate_id',$registeration_id->registeration_id)->get()->first();
		view()->share('logindetails',$loginuser);
		
		$type_institute = DB::table('institute_type')->orderBy('institute_type_id','asc')->get();
		view()->share('type_institute',$type_institute);
		
		$items = DB::table('institute_details')->where('user_id', $user_id)->get();
	    view()->share('items',$items);

        if($request->has('download')){
            $pdf = PDF::loadview('backend/shortterm/shorttermAcknowledge/shortTermpdf');
            return $pdf->download('ShortTermpdf.pdf');
        }
        return view('backend/shortterm/shorttermAcknowledge/shortTermpdf');
    }
	
	public function acknowledgeshortAjax(Request $request)
	{
		$val1=$request->input('v1');

		$institute_id =  Auth::id(); // Institute login id
        $students = DB::table('studentregistrations')->where('institute_id',$institute_id)->orderBy('id','desc')->get();
        $candidates = DB::table('candidate_attendence')->where('institute_id',$institute_id)->orderBy('attendence_id','desc')->get();

        $attendanceList = DB::table('studentregistrations')
            ->leftJoin('candidate_attendence', 'studentregistrations.id', '=', 'candidate_attendence.student_id')
			//->where(['month_atten' =>$val1,'year_atten'=>$val2])
			->where(['candidate_attendence.course_type' =>$val1,'candidate_attendence.scheme_code'=>4])
			->where('candidate_attendence.user_id',$institute_id)
			->orderBy('attendence_id','asc')
            ->get();
		return view('backend/shortterm/shorttermAcknowledge/acknowledgeShortAjax',compact('attendanceList','students','candidates','val1'));
	}


}
