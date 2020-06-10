<?php

namespace App\Http\Controllers\Nref;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use App\Nref\BankDetail;
use DB;
use Session;
use Auth;
use PDF;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class bankDetialController extends Controller
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
			
			$login_institute_id =  Auth::user()->id;
			$institute_id = DB::table('institute_details')->select('institute_id')->where('user_id', $login_institute_id)->get()->first()->institute_id;
			$student_name = DB::table('studentregistrations')->select('id','firstname','lastname')->where('institute_id',$institute_id)->get(); 
			$banks = BankDetail::orderBy('id','desc')->where('scheme_code',3)->where('institute_id',$institute_id)->get();
			//**********Save Data into audtitrail_tbl************//
			
			$audtitrail_tbl_post = array('status'=>'0','scheme_code'=>'3','action_type1'=>'5','desc'=>'Bank Details Form View');
			audtitrail_tbl_history($audtitrail_tbl_post);
			
			//**********Save Data into audtitrail_tbl************//
			return view('backend.nref.bankdetail.index',compact('banks','student_name'));
		}catch(\Exception $ex) {
	        //**********Save Data into audtitrail_tbl************//
			
			$audtitrail_tbl_post = array('status'=>'1','scheme_code'=>'3','action_type1'=>'5','desc'=>'Bank Details Form View');
            audtitrail_tbl_history($audtitrail_tbl_post);
			
			//**********Save Data into audtitrail_tbl************//    
			// dd('Message', $ex->getMessage());
			return redirect('error');
		}
    }

    public function index2(Request $request ,$id)
    { 
	   try{
		   //**********Save Data into audtitrail_tbl************//
			$audtitrail_tbl_post = array('status'=>'0','scheme_code'=>'3','action_type1'=>'2','desc'=>'Final Submit Form View');
			audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************//  
	        return view('backend.nref.bankdetail.final-submit',compact('id'));
	   }catch(\Exception $ex) {
	        //**********Save Data into audtitrail_tbl************//
			$audtitrail_tbl_post = array('status'=>'1','scheme_code'=>'3','action_type1'=>'2','desc'=>'Final Submit Form View');
			audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************//    
			// dd('Message', $ex->getMessage());
			return redirect('error');
	    }
	}
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		try {
			$login_institute_id = Auth::id();
			$institute_id = DB::table('institute_details')->select('institute_id')->where('user_id', $login_institute_id)->get()->first()->institute_id;
			$student_name = DB::table('studentregistrations')->select('id','firstname','lastname')->where('institute_id',$institute_id)->get(); 
			
			
			$exists_in_bankdetails = DB::table('bankdetails')
                        ->join('studentregistrations','bankdetails.student_id','=','studentregistrations.id')
            ->where('studentregistrations.institute_id',$institute_id)
            ->get();
			
			foreach($exists_in_bankdetails as $v){
				$arr[] = $v->id;
			}
			if(!empty($arr)){
			   $student_name = DB::table('studentregistrations')->select('id','firstname','lastname')->where('status_id','3')->where('scheme_code','3')->whereNotIn('id',$arr)->where('institute_id',$institute_id)->get(); 
			}else{
			   $student_name = DB::table('studentregistrations')->select('id','firstname','lastname')->where('status_id','3')->where('scheme_code','3')->where('institute_id',$institute_id)->get(); 
			}
			
			//**********Save Data into audtitrail_tbl************//
			$audtitrail_tbl_post['status'] = '0';
			$audtitrail_tbl_post['action_type1'] = '2';
			$audtitrail_tbl_post['desc'] = 'Add Bank Details Form View';
			audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************//  
			$bankdetils = DB::table('banklist')->distinct()->get('bank');
			return view('backend.nref.bankdetail.create',compact('bankdetils','student_name'));
	    }catch(\Exception $ex) {
	        //**********Save Data into audtitrail_tbl************//
			$audtitrail_tbl_post['status'] = '1';
			$audtitrail_tbl_post['action_type1'] = '2';
			$audtitrail_tbl_post['desc'] = 'Add Bank Details Form Not Working';
			audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************//    
			// dd('Message', $ex->getMessage());
			return redirect('error');
	    }
    }
	
	

   public function get_student_adhar(Request $request){
	    $getstudentData = $request->getstudentData;
	    $student_name = DB::table('studentregistrations')->where('scheme_code','3')->select('aadhar','mobile')->where('id',$getstudentData)->get()->first(); 
	    echo json_encode($student_name);
   }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	try {
        $records = $request->all();
		
		  $this->validate($request,[
            'pan'=> 'required|unique:bankdetails',
            'student_id' => 'required|unique:bankdetails',
            'account_number' => 'required|unique:bankdetails',
            'branch_name'  =>  'required',
            'rtgs' =>'required',
            'neft' => 'required',
            'micr_code' => 'required',
            'account_type' => 'required',
            'ifsc_code' =>'required',             
            // 'bank_mobile' => 'required',
            // 'bank_email' => 'required',
         ]);
		 
		$user_id = Auth::user()->id;
		$institute_id = DB::table('institute_details')->where('user_id',$user_id)->get()->first()->institute_id; 
		 
		$records['institute_id'] = $institute_id;
	    $records['user_id'] = $user_id;
	    $records['student_id'] = $records['student_id'];
	    $records['scheme_code'] = 3;
		 
		
		BankDetail::create($records);
		$last_id = DB::getPDO()->lastInsertId();
		//**********Save Data into audtitrail_tbl************//
			$audtitrail_tbl_post = array('status'=>'0','scheme_code'=>'3','action_type1'=>'2','desc'=>'Bank Details Form Submit Successfully');
			audtitrail_tbl_history($audtitrail_tbl_post);
		//**********Save Data into audtitrail_tbl************//    
		return redirect()->to('bankMandateForm/'.$last_id);
        
	}
	catch(\Illuminate\Database\QueryException $ex) {
	   // dd('Message', $ex->getMessage());
	    //**********Save Data into audtitrail_tbl************//
			$audtitrail_tbl_post = array('status'=>'1','scheme_code'=>'3','action_type1'=>'2','desc'=>'Bank Details Form Submit Successfully');
			audtitrail_tbl_history($audtitrail_tbl_post);
		//**********Save Data into audtitrail_tbl************//  
		return redirect('error');
	}

      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		try{
			$login_institute_id =  Auth::user()->id;
			$institute_id = DB::table('institute_details')->select('institute_id')->where('user_id', $login_institute_id)->get()->first()->institute_id;
			$student_name = DB::table('studentregistrations')->select('id','firstname','lastname')->where('scheme_code','3')->where('institute_id',$institute_id)->get();
			// dd($student_name);
			$recorde = BankDetail::findOrFail($id);
			
			//**********Save Data into audtitrail_tbl************//
			$audtitrail_tbl_post = array('status'=>'0','scheme_code'=>'3','action_type1'=>'2','desc'=>'Bank Details Form Submit Successfully');
			audtitrail_tbl_history($audtitrail_tbl_post);
		   //**********Save Data into audtitrail_tbl************//
		   
			return view('backend.nref.bankdetail.show',compact('recorde','student_name'));
		}catch(\Illuminate\Database\QueryException $ex) {
	    // dd('Message', $ex->getMessage());
	   
	   //**********Save Data into audtitrail_tbl************//
			$audtitrail_tbl_post = array('status'=>'1','scheme_code'=>'3','action_type1'=>'2','desc'=>'Bank Details Form Submit Successfully');
			audtitrail_tbl_history($audtitrail_tbl_post);
		//**********Save Data into audtitrail_tbl************//  
		
		return redirect('error');
	   }
    }

public function pdfview(Request $request)
    {
		
		$id=$request->input('id');
        $login_institute_id =  Auth::user()->id;
        $institute_id = DB::table('institute_details')->select('institute_id')->where('user_id', $login_institute_id)->get()->first()->institute_id;
		$student_name = DB::table('studentregistrations')->select('id','firstname','lastname')->where('institute_id',$institute_id)->get();
		view()->share('student_name',$student_name);
        $recorde = BankDetail::findOrFail($id);
		view()->share('recorde',$recorde);

        if($request->has('download')){
            $pdf = PDF::loadview('backend.nref.bankdetail.pdfview');
            return $pdf->download('pdfview.pdf');
        }
      return view('backend.nref.bankdetail.pdfview');
    }
	
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		try{
			$login_institute_id = Auth::id();
			$institute_id = DB::table('institute_details')->select('institute_id')->where('user_id', $login_institute_id)->get()->first()->institute_id;
			$student_name = DB::table('studentregistrations')->select('id','firstname','lastname')->where('status_id','3')->where('scheme_code','3')->where('institute_id',$institute_id)->get(); 
				
			$bankdetils = DB::table('banklist')->distinct()->get('bank');
			$record = BankDetail::findOrFail($id);
			//**********Save Data into audtitrail_tbl************//
				$audtitrail_tbl_post = array('status'=>'0','scheme_code'=>'3','action_type1'=>'3','desc'=>'Edit Bank Details Form View');
				audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************//
			return view('backend.nref.bankdetail.edit',compact('record','bankdetils','student_name'));
		
        }catch(\Illuminate\Database\QueryException $ex) {
	    // dd('Message', $ex->getMessage());
	   
		   //**********Save Data into audtitrail_tbl************//
				$audtitrail_tbl_post = array('status'=>'1','scheme_code'=>'3','action_type1'=>'3','desc'=>'Edit Bank Details Form View not working');
				audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************//  
			return redirect('error');
	   }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		try{
		    $this->validate($request,[
            'branch_name'  =>  'required',
            'pan'=> 'required|unique:bankdetails,pan,'.$id,
            'student_id' => 'required|unique:bankdetails,student_id,'.$id,
            'account_number' => 'required|unique:bankdetails,account_number,'.$id,
            'rtgs' =>'required',
            'neft' => 'required',
            'ifsc_code' => 'required',
            'micr_code' => 'required',
            'account_type' => 'required',           
            // 'bank_mobile' => 'required',
            // 'bank_email' => 'required',
          ]);
		  
		$records = BankDetail::find($id);
		$user_id = Auth::id(); 
		$institute_id = DB::table('institute_details')->where('user_id',$user_id)->get()->first()->institute_id; 
	  
		
		$records->institute_id = $institute_id;
		$records->user_id = $user_id;
		$records->student_id = $request->student_id;
		$records->scheme_code = '3';
		
	 
        $records->branch_name = $request->branch_name;
        $records->account_number = $request->account_number;
        $records->rtgs = $request->rtgs;
        $records->neft = $request->neft;
        $records->ifsc_code = $request->ifsc_code;
        $records->micr_code = $request->micr_code;
        $records->pan = $request->pan;
        $records->aadhar_no = $request->aadhar_no;
        $records->account_type = $request->account_type;
        $records->candidate_phone = $request->candidate_phone;
        $records->bank_mobile = $request->bank_mobile;
        $records->bank_email = $request->bank_email;
        $records->save();
		 //**********Save Data into audtitrail_tbl************//
			$audtitrail_tbl_post = array('status'=>'0','scheme_code'=>'3','action_type1'=>'3','desc'=>'Edit Bank Details Form Submitted Successfully');
			audtitrail_tbl_history($audtitrail_tbl_post);
		//**********Save Data into audtitrail_tbl************//  
		return redirect()->to('bankMandateForm/'.$id);
	}catch(\Illuminate\Database\QueryException $ex) {
	// dd('Message', $ex->getMessage());
   
	   //**********Save Data into audtitrail_tbl************//
			$audtitrail_tbl_post = array('status'=>'1','scheme_code'=>'3','action_type1'=>'3','desc'=>'Edit Bank Details Form Submitted Not Successfully');
			audtitrail_tbl_history($audtitrail_tbl_post);
		//**********Save Data into audtitrail_tbl************//  
		return redirect('error');
   }
  }
	
	
	
	public function bank_form_post_final(Request $request,$id) {
	try{
		$transactionrefult = DB::transaction(function() use ($request,$id) {
		date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s');
					   
		$login_institute_id = Auth::user()->id;
		$institute_id = DB::table('institute_details')->where('user_id', $login_institute_id)->get()->first()->institute_id;
		
		 if($request->hasFile('bank_mandate_form')) {
				$image = $request->file('bank_mandate_form');
				$bank_mandate_form = $id.'_fileupload_sign.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/../public/uploads/nref/BankMandateForm');
				$imagePath = $destinationPath. "/".  $bank_mandate_form;
				$image->move($destinationPath, $bank_mandate_form);
				
				$filedata['bank_mandate_form'] = $bank_mandate_form;
				$filedata['is_final_submit'] = 1;
			}
			$filedata['updated_at'] = $date;
			$a = DB::table('bankdetails')->where('id',$id)->where('institute_id',$institute_id)->update($filedata); 
			//**********Save Data into audtitrail_tbl************//
			$audtitrail_tbl_post = array('status'=>'0','scheme_code'=>'3','action_type1'=>'3','desc'=>'Final Bank Details Form Submitted Successfully');
			audtitrail_tbl_history($audtitrail_tbl_post);
		    //**********Save Data into audtitrail_tbl************//  
			return redirect()->to('bank-details/')->with('success',"Bank Mandatory Form Submitted successfully");
	    });
	   return $transactionrefult;
	}catch(\Illuminate\Database\QueryException $ex) {
	// dd('Message', $ex->getMessage());
   
	   //**********Save Data into audtitrail_tbl************//
			$audtitrail_tbl_post = array('status'=>'1','scheme_code'=>'3','action_type1'=>'3','desc'=>'Final Bank Details Form Submitted Not Successfully');
			audtitrail_tbl_history($audtitrail_tbl_post);
		//**********Save Data into audtitrail_tbl************//  
		return redirect('error');
   }
	 }
	 

    
    // public function register($id){
        // $bankdetils = DB::table('banklist')->distinct()->get('bank');
        // $record = BankDetail::findOrFail($id);
        // return view('backend.nref.bankregister.edit',compact('record','bankdetils'));
    // }
}
