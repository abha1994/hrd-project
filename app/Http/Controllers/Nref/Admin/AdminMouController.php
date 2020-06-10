<?php

namespace App\Http\Controllers\Nref\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Nref\studentRegistrationModel;
use Session;
use DB;
use Auth;
use PDF;
use Validator,Redirect;
use App\Nref\admin\Admin_institute;

class AdminMouController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	 
	   public function index()
    {
		 $data['institute_data'] =
                       DB::table('institute_details')
		     ->leftJoin('user_credential', 'institute_details.user_id', '=', 'user_credential.id')
                      ->leftJoin('registration', 'user_credential.registeration_id', '=', 'registration.candidate_id')
			 ->select('registration.*','user_credential.*','institute_details.*')
			->where('institute_details.status_id',3)
            ->get();	

		
		return view('backend.nref.Admin.mou.adminmou',compact('data'));
    }
   
    public function admin_mou_form_post(Request $request)
    {
		
		$this->validate($request,[
     		'fileadminmou' => 'required',
		]); 
		
		

        $records = $request->all();
		    $transactionResult = DB::transaction(function() use ($request) {
			
				if($request->hasFile('fileadminmou')) {
					    $login_user_id =  Auth::id();
					
						$image = $request->file('fileadminmou');
						$user_id = $request->user_id;
                        
						$fileSign = $login_user_id.'_'.$user_id.'_'.'3'.'_adminmou.'.$image->getClientOriginalExtension();
						$destinationPath = public_path('/../public/uploads/nref/mou/admin');
						$imagePath = $destinationPath. "/".  $fileSign;
						$image->move($destinationPath, $fileSign);
						
						$filedata['admin_mou'] = $fileSign;
						$filedata['admin_mou_user_id'] = $login_user_id;
						
				}
					
				$updateQuery=DB::table('institute_details')
					->where('user_id',$user_id)
					->update($filedata);
					
				if($updateQuery)
				{
					return back()->with('message','Admin MOU Uploaded successfully !');
				}else{
					return back()->with('error','Admin MOU Not uploaded');
				}
			
	    });
		return $transactionResult;
	}
	
	
	public function getinsmou(Request $request)
	{
	   
        $val2=$request->input('v1');
		
		if($val2!=""){
			
			 $ins =DB::table('institute_details')
		    ->leftJoin('user_credential', 'user_credential.id', '=', 'institute_details.user_id')
		    ->select('user_credential.name','institute_details.institute_id','institute_details.mou','institute_details.admin_mou_user_id','institute_details.user_id','institute_details.admin_mou')
			->where('institute_details.status_id', 3)
			->where('institute_details.scheme_code', 3)
			->where('institute_details.final_submit',1)
			->where('user_id',$val2)
			->get();
       
		  return view('backend.nref.Admin.mou.adminmou_filter',compact('ins'));
		}
	}


}
