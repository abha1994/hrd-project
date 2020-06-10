<?php

namespace App\Http\Controllers\shortterm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use App\shortterm\BankDetail;
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
		  
			//**********Save Data into audtitrail_tbl************//
			 $audtitrail_tbl_post['status'] = '0';
			 $audtitrail_tbl_post['action_type1'] = '5';
			 $audtitrail_tbl_post['scheme_code'] = '4';
			 $audtitrail_tbl_post['desc'] = 'List Bank Details';
			 audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************// 
			  $login_user_id =  Auth::user()->id;
		
		$short_term_id = DB::table('short_term_program')->where('user_id',$login_user_id)->where('status_id','3')->get()->first()->short_term_id;
		
		$shortterm_exist = DB::table('bankdetails')->where('scheme_code','4')->where('institute_id',$short_term_id)->get(); 
        $banks = BankDetail::orderBy('id','desc')->where('scheme_code','4')->where('institute_id',$short_term_id)->get();
        return view('backend.shortterm.bankdetail.index',compact('banks','shortterm_exist'));
		}catch(\Exception $ex) {
			//**********Save Data into audtitrail_tbl************//
			$audtitrail_tbl_post['status'] = '1';
			$audtitrail_tbl_post['action_type1'] = '5';
			$audtitrail_tbl_post['scheme_code'] = '4';
			$audtitrail_tbl_post['desc'] = 'List Bank Details';
			audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************//    
			// dd('Message', $ex->getMessage());
			return redirect('error');
	    }
	  
    }

    public function index2(Request $request	,$id)
    { 
	
	    try{
		  
			//**********Save Data into audtitrail_tbl************//
			 $audtitrail_tbl_post['status'] = '0';
			 $audtitrail_tbl_post['action_type1'] = '5';
			 $audtitrail_tbl_post['scheme_code'] = '4';
			 $audtitrail_tbl_post['desc'] = 'List Bank Details';
			 audtitrail_tbl_history($audtitrail_tbl_post);
	         return view('backend.shortterm.bankdetail.final-submit',compact('id'));
	   }catch(\Exception $ex) {
			//**********Save Data into audtitrail_tbl************//
			$audtitrail_tbl_post['status'] = '1';
			$audtitrail_tbl_post['action_type1'] = '5';
			$audtitrail_tbl_post['scheme_code'] = '4';
			$audtitrail_tbl_post['desc'] = 'List Bank Details';
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
			
			 
			//**********Save Data into audtitrail_tbl************//
			 $audtitrail_tbl_post['status'] = '0';
			 $audtitrail_tbl_post['action_type1'] = '2';
			 $audtitrail_tbl_post['scheme_code'] = '4';
			 $audtitrail_tbl_post['desc'] = 'Create Bank Details';
			 audtitrail_tbl_history($audtitrail_tbl_post);
			 
			$login_user_id = Auth::id();
			$short_term_id = DB::table('short_term_program')->where('user_id',$login_user_id)->where('status_id','3')->get()->first()->short_term_id;
			
		
			$exists_in_bankdetails = DB::table('bankdetails')
            ->select('studentregistrations.id')
            ->join('studentregistrations','bankdetails.student_id','=','studentregistrations.id')
            ->where('studentregistrations.institute_id',$short_term_id)
			->where('studentregistrations.user_id',$login_user_id)
			->where('studentregistrations.scheme_code',4)
            ->get();
			// dd($exists_in_bankdetails);
		    foreach($exists_in_bankdetails as $v){
				$arr[] = $v->id;
			}
	
			
			
			 if(!empty($arr)){
			     $student_name = DB::table('studentregistrations')->select('id','firstname','lastname')->where('scheme_code','4')->whereNotIn('id',$arr)->where('institute_id',$short_term_id)->get(); 
			}else{
			   $student_name = DB::table('studentregistrations')->select('id','firstname','lastname')->where('scheme_code','4')->where('institute_id',$short_term_id)->get(); 
			}
			
			$bankdetils = DB::table('banklist')->distinct()->get('bank');
			return view('backend.shortterm.bankdetail.create',compact('bankdetils','student_name'));
	    }catch(\Exception $ex) {
			
			//**********Save Data into audtitrail_tbl************//
			$audtitrail_tbl_post['status'] = '1';
			$audtitrail_tbl_post['action_type1'] = '2';
			$audtitrail_tbl_post['scheme_code'] = '4';
			$audtitrail_tbl_post['desc'] = 'Create Bank Details';
			audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************//    
			// dd('Message', $ex->getMessage());
			return redirect('error');
	        //dd('Message', $ex->getMessage());
	    }
    }
	
	

   public function get_student_adhar(Request $request){
	   // dd("Hello");
	    $getstudentData = $request->getstudentData;
	    $student_name = DB::table('studentregistrations')->select('aadhar','mobile','address')->where('scheme_code','4')->where('id',$getstudentData)->get()->first(); 
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
		
		//**********Save Data into audtitrail_tbl************//
			 $audtitrail_tbl_post['status'] = '0';
			 $audtitrail_tbl_post['action_type1'] = '2';
			 $audtitrail_tbl_post['scheme_code'] = '4';
			 $audtitrail_tbl_post['desc'] = 'Save Bank Details';
			 audtitrail_tbl_history($audtitrail_tbl_post);
			 
        $records = $request->all();
		
		  $this->validate($request,[
             
           
            'account_number' => 'required|unique:bankdetails',
            'branch_name'  =>  'required',
            'rtgs' =>'required',
            'neft' => 'required',
            'micr_code' => 'required',
            'account_type' => 'required',
            'ifsc_code' =>'required',             
            // 'bank_mobile' => 'required',
            // 'bank_email' => 'required',
			
			'bank_address' => 'required',
			
		
         ]);
		 
		$user_id = Auth::user()->id;
		$short_term_id = DB::table('short_term_program')->where('user_id',$user_id)->where('status_id','3')->get()->first()->short_term_id;
		 
			   $records['institute_id'] = $short_term_id;
			   $records['user_id'] = $user_id;
			   // $records['student_id'] = $short_term_id;
			   $records['scheme_code'] = 4;
		
        BankDetail::create($records);
		$last_id = DB::getPDO()->lastInsertId();
		return redirect()->to('st-bankMandateForm/'.$last_id);
        
	}
	catch(\Illuminate\Database\QueryException $ex) {
		
		//**********Save Data into audtitrail_tbl************//
			$audtitrail_tbl_post['status'] = '1';
			$audtitrail_tbl_post['action_type1'] = '2';
			$audtitrail_tbl_post['scheme_code'] = '4';
			$audtitrail_tbl_post['desc'] = 'Save Bank Details';
			audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************//    
			// dd('Message', $ex->getMessage());
			return redirect('error');
	   //dd('Message', $ex->getMessage());
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
		  
			//**********Save Data into audtitrail_tbl************//
			 $audtitrail_tbl_post['status'] = '0';
			 $audtitrail_tbl_post['action_type1'] = '1';
			 $audtitrail_tbl_post['scheme_code'] = '4';
			 $audtitrail_tbl_post['desc'] = 'show Bank Details';
			 audtitrail_tbl_history($audtitrail_tbl_post);
		 $login_user_id =  Auth::user()->id;
		
		$short_term_id = DB::table('short_term_program')->where('user_id',$login_user_id)->where('status_id','3')->get()->first()->short_term_id;
		$student_name = DB::table('studentregistrations')->select('id','firstname','lastname')->where('institute_id',$short_term_id)->get();
		// dd($student_name);
        $recorde = BankDetail::findOrFail($id);
        return view('backend.shortterm.bankdetail.show',compact('recorde','student_name'));
		
		 }catch(\Exception $ex) {
			//**********Save Data into audtitrail_tbl************//
			$audtitrail_tbl_post['status'] = '1';
			$audtitrail_tbl_post['action_type1'] = '1';
			$audtitrail_tbl_post['scheme_code'] = '4';
			$audtitrail_tbl_post['desc'] = 'Show Bank Details';
			audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************//    
			// dd('Message', $ex->getMessage());
			return redirect('error');
	    }
    }

public function pdfview_bank(Request $request)
    {
		 try{
		  
			//**********Save Data into audtitrail_tbl************//
			 $audtitrail_tbl_post['status'] = '0';
			 $audtitrail_tbl_post['action_type1'] = '1';
			 $audtitrail_tbl_post['scheme_code'] = '4';
			 $audtitrail_tbl_post['desc'] = 'PDF Download';
		     audtitrail_tbl_history($audtitrail_tbl_post);
		
		$id=$request->input('id');
        $login_user_id =  Auth::user()->id;
        $short_term_id = DB::table('short_term_program')->where('user_id',$login_user_id)->where('status_id','3')->get()->first()->short_term_id;
		$student_name = DB::table('studentregistrations')->select('id','firstname','lastname')->where('institute_id',$short_term_id)->get();
		view()->share('student_name',$student_name);
        $recorde = BankDetail::findOrFail($id);
		view()->share('recorde',$recorde);

        if($request->has('download')){
            $pdf = PDF::loadview('backend.shortterm.bankdetail.pdfview');
            return $pdf->download('pdfview.pdf');
        }
      return view('backend.shortterm.bankdetail.pdfview');
	   }catch(\Exception $ex) {
			//**********Save Data into audtitrail_tbl************//
			$audtitrail_tbl_post['status'] = '1';
			$audtitrail_tbl_post['action_type1'] = '1';
			$audtitrail_tbl_post['scheme_code'] = '4';
			$audtitrail_tbl_post['desc'] = 'PDF Download';
			audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************//    
			// dd('Message', $ex->getMessage());
			return redirect('error');
	    }
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
		  
			//**********Save Data into audtitrail_tbl************//
			 $audtitrail_tbl_post['status'] = '0';
			 $audtitrail_tbl_post['action_type1'] = '3';
			 $audtitrail_tbl_post['scheme_code'] = '4';
			 $audtitrail_tbl_post['desc'] = 'Edit Bank Details';
			  audtitrail_tbl_history($audtitrail_tbl_post);
		 $login_user_id =  Auth::user()->id;
		
		$short_term_id = DB::table('short_term_program')->where('user_id',$login_user_id)->where('status_id','3')->get()->first()->short_term_id;
        $student_name = DB::table('studentregistrations')->select('id','firstname','lastname')->where('institute_id',$short_term_id)->get(); 
			
        $bankdetils = DB::table('banklist')->distinct()->get('bank');
        $record = BankDetail::findOrFail($id);
        return view('backend.shortterm.bankdetail.edit',compact('record','bankdetils','student_name'));
		 }catch(\Exception $ex) {
			//**********Save Data into audtitrail_tbl************//
			$audtitrail_tbl_post['status'] = '1';
			$audtitrail_tbl_post['action_type1'] = '3';
			$audtitrail_tbl_post['scheme_code'] = '4';
			$audtitrail_tbl_post['desc'] = 'Edit Bank Details';
			audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************//    
			// dd('Message', $ex->getMessage());
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
		  
			//**********Save Data into audtitrail_tbl************//
			 $audtitrail_tbl_post['status'] = '0';
			 $audtitrail_tbl_post['action_type1'] = '3';
			 $audtitrail_tbl_post['scheme_code'] = '4';
			 $audtitrail_tbl_post['desc'] = 'Update Bank Details';
			 audtitrail_tbl_history($audtitrail_tbl_post);
		
		    $this->validate($request,[
            'branch_name'  =>  'required',
            'account_number' => 'required|unique:bankdetails,account_number,'.$id,
            'rtgs' =>'required',
            'neft' => 'required',
            'ifsc_code' => 'required',
            'micr_code' => 'required',
            'account_type' => 'required',           
            // 'bank_mobile' => 'required',
            // 'bank_email' => 'required',
			
			'bank_address' => 'required',
          ]);
		  
      $records = BankDetail::find($id);
      $user_id = Auth::id(); 
      $short_term_id = DB::table('short_term_program')->where('user_id',$user_id)->where('status_id','3')->get()->first()->short_term_id; 
	  // dd($institute_id);
	 
	 
		   $records->institute_id = $short_term_id;
		   $records->user_id = $user_id;
		   // $records->student_id = $short_term_id;
           $records->scheme_code = '4';
	  
	 
	   
       
        $records->branch_name = $request->branch_name;
        $records->account_number = $request->account_number;
        $records->rtgs = $request->rtgs;
        $records->neft = $request->neft;
        $records->ifsc_code = $request->ifsc_code;
        $records->micr_code = $request->micr_code;
        $records->account_type = $request->account_type;
        $records->bank_mobile = $request->bank_mobile;
        $records->bank_email = $request->bank_email;
		$records->bank_address = $request->bank_address;
		$records->pfms_code = $request->pfms_code;
        $records->save();
		
		return redirect()->to('st-bankMandateForm/'.$id);
         //return redirect()->route('st-bank-details.index')
                        // ->with('message','Bank details updated successfully.'); 
						
			 }catch(\Exception $ex) {
			//**********Save Data into audtitrail_tbl************//
			$audtitrail_tbl_post['status'] = '1';
			$audtitrail_tbl_post['action_type1'] = '3';
			$audtitrail_tbl_post['scheme_code'] = '4';
			$audtitrail_tbl_post['desc'] = 'Update Bank Details';
			audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************//    
			// dd('Message', $ex->getMessage());
			return redirect('error');
	    }
    }
	
	
	
	public function bank_form_post_final(Request $request,$id) {
		
		 try{
		  
			//**********Save Data into audtitrail_tbl************//
			 $audtitrail_tbl_post['status'] = '0';
			 $audtitrail_tbl_post['action_type1'] = '2';
			 $audtitrail_tbl_post['scheme_code'] = '4';
			 $audtitrail_tbl_post['desc'] = 'Create Bank Mandate Form';
			 audtitrail_tbl_history($audtitrail_tbl_post);
		$transactionResult = DB::transaction(function() use ($request,$id) {
				date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s');
							   
				$login_user_id = Auth::user()->id;
				$short_term_id = DB::table('short_term_program')->where('user_id',$login_user_id)->where('status_id','3')->get()->first()->short_term_id;
				
				 if($request->hasFile('bank_mandate_form')) {
						$image = $request->file('bank_mandate_form');
						$bank_mandate_form = $id.'_fileupload_sign.'.$image->getClientOriginalExtension();
						$destinationPath = public_path('/../public/uploads/shortterm/BankMandateForm');
						$imagePath = $destinationPath. "/".  $bank_mandate_form;
						$image->move($destinationPath, $bank_mandate_form);
						
						$filedata['bank_mandate_form'] = $bank_mandate_form;
						$filedata['is_final_submit'] = 1;
					}
				    $filedata['updated_at'] = $date;
				    $a = DB::table('bankdetails')->where('id',$id)->where('institute_id',$short_term_id)->update($filedata); 
			        return redirect()->to('st-bank-details/')->with('success',"Bank Mandatory Form Submitted successfully");
		      });
	   return $transactionResult;
	   
	   	  }catch(\Exception $ex) {
			//**********Save Data into audtitrail_tbl************//
			$audtitrail_tbl_post['status'] = '1';
			$audtitrail_tbl_post['action_type1'] = '2';
			$audtitrail_tbl_post['scheme_code'] = '4';
			$audtitrail_tbl_post['desc'] = 'Create Bank Mandate Form';
			audtitrail_tbl_history($audtitrail_tbl_post);
			//**********Save Data into audtitrail_tbl************//    
			// dd('Message', $ex->getMessage());
			return redirect('error');
	    }
	 }
	 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

   
}
