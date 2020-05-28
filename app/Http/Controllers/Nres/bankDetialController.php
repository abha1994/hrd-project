<?php

namespace App\Http\Controllers\Nres;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use App\Nres\BankDetail;
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
         // $this->middleware('permission:bankdetail-list|bankdetail-create|bankdetail-edit|bankdetail-delete', ['only' => ['index','show']]);
         // $this->middleware('permission:bankdetail-create', ['only' => ['create','store']]);
         // $this->middleware('permission:bankdetail-edit', ['only' => ['edit','update']]);
         // $this->middleware('permission:bankdetail-delete', ['only' => ['destroy']]);


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $scheme_code =  Auth::user()->scheme_code;
        $login_institute_id =  Auth::user()->id;
        $institute_id = DB::table('institute_details')->select('institute_id')->where('user_id', $login_institute_id)->get()->first()->institute_id;
		$student_name = DB::table('studentregistrations')->select('id','firstname','lastname')->where('institute_id',$institute_id)->get(); 
        $banks = BankDetail::orderBy('id','desc')->where('scheme_code',$scheme_code)->where('institute_id',$institute_id)->get();
        return view('backend.nres.bankdetail.index',compact('banks','student_name'));
    }

    public function index2(Request $request	,$id)
    { 
	   return view('backend.nres.bankdetail.final-submit',compact('id'));
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
			$student_name = DB::table('studentregistrations')->select('id','firstname','lastname')->where('institute_id',$institute_id)->where('scheme_code','3')->get(); 
			
			
			$exists_in_bankdetails = DB::table('bankdetails')
            ->join('studentregistrations','bankdetails.student_id','=','studentregistrations.id')
            ->where('studentregistrations.institute_id',$institute_id)
			// ->where('bankdetails.scheme_code','3')
            ->get();
			
			// $arr = "";
		    foreach($exists_in_bankdetails as $v){
				$arr[] = $v->id;
			}
			// dd($arr);
	        if(!empty($arr)){
			   $student_name = DB::table('studentregistrations')->select('id','firstname','lastname')->where('status_id','3')->where('scheme_code','3')->whereNotIn('id',$arr)->where('institute_id',$institute_id)->get(); 
			}else{
			   $student_name = DB::table('studentregistrations')->select('id','firstname','lastname')->where('status_id','3')->where('scheme_code','3')->where('institute_id',$institute_id)->get(); 
			}
			// dd($student_name);
			$bankdetils = DB::table('banklist')->distinct()->get('bank');
			return view('backend.nres.bankdetail.create',compact('bankdetils','student_name'));
	    }catch(\Exception $ex) {
	        dd('Message', $ex->getMessage());
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
            'bank_mobile' => 'required',
            'bank_email' => 'required',
         ]);
		 
		$user_id = Auth::user()->id;
		$institute_id = DB::table('institute_details')->where('user_id',$user_id)->get()->first()->institute_id; 
		 
		$scheme_code =  Auth::user()->scheme_code;
		  if($scheme_code == "2"){
			   $records['student_id'] = $user_id;		   
			   $records['scheme_code'] = '2';
		  }elseif($scheme_code == "3"){
			   $records['institute_id'] = $institute_id;
			   $records['user_id'] = $user_id;
			   $records['student_id'] = $records['student_id'];
			   $records['scheme_code'] = 3;
		}
		
		// $bank_mandate_uploaded['is_bank_details_fill'] = "1";
			// $updateQuery=DB::table('studentregistrations')
			// ->where(['id' => $request->student_id,'institute_id' =>$institute_id,'user_id' =>$user_id])
			// ->update($bank_mandate_uploaded);
	 
        BankDetail::create($records);
		$last_id = DB::getPDO()->lastInsertId();
		return redirect()->to('bankMandateForm/'.$last_id);
         // return redirect()->route('bank-details.index')
                        // ->with('message','Bank Detail created successfully.');
	}
	catch(\Illuminate\Database\QueryException $ex) {
	   dd('Message', $ex->getMessage());
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
		$login_institute_id =  Auth::user()->id;
        $institute_id = DB::table('institute_details')->select('institute_id')->where('user_id', $login_institute_id)->get()->first()->institute_id;
		$student_name = DB::table('studentregistrations')->select('id','firstname','lastname')->where('scheme_code','3')->where('institute_id',$institute_id)->get();
		// dd($student_name);
        $recorde = BankDetail::findOrFail($id);
        return view('backend.nres.bankdetail.show',compact('recorde','student_name'));
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
            $pdf = PDF::loadview('backend.nres.bankdetail.pdfview');
            return $pdf->download('pdfview.pdf');
        }
      return view('backend.nres.bankdetail.pdfview');
    }
	
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$login_institute_id = Auth::id();
		$institute_id = DB::table('institute_details')->select('institute_id')->where('user_id', $login_institute_id)->get()->first()->institute_id;
        $student_name = DB::table('studentregistrations')->select('id','firstname','lastname')->where('status_id','3')->where('scheme_code','3')->where('institute_id',$institute_id)->get(); 
			
        $bankdetils = DB::table('banklist')->distinct()->get('bank');
        $record = BankDetail::findOrFail($id);
        return view('backend.nres.bankdetail.edit',compact('record','bankdetils','student_name'));
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
            'bank_mobile' => 'required',
            'bank_email' => 'required',
          ]);
		  
      $records = BankDetail::find($id);
      $user_id = Auth::id(); 
      $institute_id = DB::table('institute_details')->where('user_id',$user_id)->get()->first()->institute_id; 
	  // dd($institute_id);
	  $scheme_code =  Auth::user()->scheme_code;
	  if($scheme_code == "2"){
		   $records->student_id = $user_id;
           $records->scheme_code = '2';
	  }else if($scheme_code == "3"){
		   $records->institute_id = $institute_id;
		   $records->user_id = $user_id;
		   $records->student_id = $request->student_id;
           $records->scheme_code = '3';
	  }
	 
	    // $bank_mandate_uploaded['is_bank_details_fill'] = "1";
		// $updateQuery=DB::table('studentregistrations')
					// ->where(['id' => $request->student_id,'institute_id' =>$institute_id,'user_id' =>$user_id])
					// ->update($bank_mandate_uploaded);
		
					
        // $records->bank_cname = $request->bank_cname;
       
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
		
		return redirect()->to('bankMandateForm/'.$id);
        // return redirect()->route('bank-details.index')
                        // ->with('message','Bank details updated successfully.'); 
    }
	
	
	
	public function bank_form_post_final(Request $request,$id) {
		$transactionResult = DB::transaction(function() use ($request,$id) {
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
			        return redirect()->to('bank-details/')->with('success',"Bank Mandatory Form Submitted successfully");
		      });
	   return $transactionResult;
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

    public function register($id){
         
          $bankdetils = DB::table('banklist')->distinct()->get('bank');
         $record = BankDetail::findOrFail($id);
        return view('backend.nref.bankregister.edit',compact('record','bankdetils'));
    }
}
