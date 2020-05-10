<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use DateTime;
use Illuminate\Support\Facades\Hash;
use Illuminate\Mail\Message;
use Validator,Redirect;
use App\FellowAmount;
use Session;

class FellowAmountController extends Controller
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
     * Show the FellowAmount Form List.
     *
     * @index
     */

    
	public function index(Request $request)
    { 
		 $data = FellowAmount::index();
	     return view('backend/nref/fellowamount/fellowamount_list',compact('data'));
	}
	
	
	 /**
     * View Add Fellow Amount Page.
     *
     * @add
     */
	 
	public function add()
    { 
	      $data = FellowAmount::index();
		  return view('backend/nref/fellowamount/fellowamount_add',compact('data'));
    }
	
     /**
     * Insert Add Role Form Data.
     *
     * @create
     */
	 
	
	public function create(Request $request){
	
	   $validatedData = $request->validate([
			'financial_year' => 'required',
			'course_id' => 'required',
			'amount' => 'required',
			'validity_period' => 'required',
			
		]);
		
		date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s');
		
		$postdata['financial_year'] = $request->financial_year;
		$postdata['course_id'] = $request->course_id;
		$postdata['amount'] = $request->amount;
		$postdata['validity_period'] = $request->validity_period;
		
		$postdata['created_date'] = $date;
		
		
		$fellow_amount = DB::table('fellow_amount')->where('financial_year',$postdata['financial_year'])->where('course_id',$postdata['course_id'])->get();
	// dd(count($fellow_amount));   
	if(count($fellow_amount) == 0)	{
        $data = FellowAmount::add($postdata);	
		if($data['status'] == "1" ){
			  return redirect('fellowamount-list')->with('success','Fellow Amount inserted successfully');
		}
			
	}else{
		return redirect('fellowamount-list')->with('error','Record Already Inserted for Selected Financial Year and Course');
	}
	
	}
	
	
	 /**
     *View Edit Fellow Amount Page by id.
     *
     * @edit
     */
	 
	public function edit($id)
    { 
	     $data = FellowAmount::edit($id);
	     return view('backend/nref/fellowamount/fellowamount_edit',compact('data'));
	}
	
	
	 /**
     * update Add Fellow Amount Form Data by id.
     *
     * @update
     */
	 
	public function update($id, Request $request)
    { 
	   $validatedData = $request->validate([
		    'amount' => 'required',
			'validity_period' => 'required',
		]);
		
		date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s');
		
		$postdata['amount'] = $request->amount;
		$postdata['validity_period'] = $request->validity_period;
		$postdata['modified_date'] = $date;
		
        $data = FellowAmount::update_fellowamount($postdata,$id);
		if($data['status'] == "1" ){
			  return redirect('fellowamount')->with('success','Fellow Amount Data Updated successfully');
		}
	   
    }
	
	
	/**
     * View Fellow Amount Form Data by id.
     *
     * @view
     */
	 
	public function view($id)
    { 
	      $data = FellowAmount::edit($id);
		  return view('backend/nref/fellowamount/fellowamount_view',compact('data'));
	}
     
	 
	 /**
     * Delete Fellow Amount Data by id.
     *
     * @delete
     */

   public function delete($id)
    { 
	  
		   $data = FellowAmount::delete_data($id);
		   if($data['status'] == "2" ){
				return redirect('fellowamount-list')->with('error','Fellow Amount is in used. Can not be deleted!!..');
		   }else if($data['status'] == "1" ){
				return redirect('fellowamount-list')->with('success','Record Deleted successfully');
		   }elseif($data['status'] == "0" ){
				return redirect('fellowamount-list')->with('error','Record id does not exists');
		   }
	  
    }
	
	
	
	
    
	
}
