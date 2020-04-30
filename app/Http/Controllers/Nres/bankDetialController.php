<?php

namespace App\Http\Controllers\Nres;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use App\Nres\BankDetail;
use DB;
use Session;
use Auth;
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
        $banks = BankDetail::orderBy('id','desc')->where('scheme_code',$scheme_code)->get();
        return view('backend.nres.bankdetail.index',compact('banks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		
		$user_id = Auth::id();
        $student_name = DB::table('studentregistrations')->select('id','firstname','lastname')->where('institute_id',$user_id)->get(); 
        $bankdetils = DB::table('banklist')->distinct()->get('bank');
        return view('backend.nres.bankdetail.create',compact('bankdetils','student_name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $records = $request->all();
		// dd($records['student_id']);
		
     
	    $user_id = Auth::user()->id;
		$scheme_code =  Auth::user()->scheme_code;
		  if($scheme_code == "2"){
			   $records['student_id'] = $user_id; 
			   $records['scheme_code'] = '2';
		  }elseif($scheme_code == "3"){
			   $records['institute_id'] = $user_id;
			   $records['student_id'] = $records['student_id'];
			   $records['scheme_code'] = 3;
		}
	 
	 
        BankDetail::create($records);
         return redirect()->route('bank-details.index')
                        ->with('message','Bank Detail created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recorde = BankDetail::findOrFail($id);
        return view('backend.nres.bankdetail.show',compact('recorde'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$user_id = Auth::id();
        $student_name = DB::table('studentregistrations')->select('id','firstname','lastname')->where('institute_id',$user_id)->get(); 
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
        $records = BankDetail::find($id);
        $user_id = Auth::id();
      
	  
	  $scheme_code =  Auth::user()->scheme_code;
	  if($scheme_code == "2"){
		   $records->student_id = $user_id;
           $records->scheme_code = '2';
	  }else if($scheme_code == "3"){
		
		   $records->institute_id = $user_id;
		   $records->student_id = $request->student_id;
           $records->scheme_code = '3';
	  }
	 
        $records->bank_cname = $request->bank_cname;
       
        $records->branch_name = $request->branch_name;
        $records->account_number = $request->account_number;
        $records->rtgs = $request->rtgs;
        $records->neft = $request->neft;
        $records->ifsc_code = $request->ifsc_code;
        $records->micr_code = $request->micr_code;
        $records->pan = $request->pan;
        $records->aadhar_no = $request->aadhar_no;
        $records->account_type = $request->account_type;
        $records->bank_phone = $request->bank_phone;
        $records->bank_mobile = $request->bank_mobile;
        $records->bank_email = $request->bank_email;
        $records->save();
        return redirect()->route('bank-details.index')
                        ->with('message','Bank details updated successfully.'); 
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
