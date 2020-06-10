<?php

namespace App\Http\Controllers\Nref;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Nref\studentRegistrationModel;
use Session;
use DB;
use Auth;
use PDF;
use Validator,Redirect;

class MouController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$user_id =  Auth::id();
		$ins = DB::table('institute_details')->where('user_id',$user_id)->get()->first();
		
		return view('backend.nref.mou.mou',compact('ins'));
    }

    public function mou_form_post(Request $request)
    {
		
		$this->validate($request,[
     		'filemou' => 'required',
		]); 
        $records = $request->all();
		    $transactionResult = DB::transaction(function() use ($request) {
			$user_id =  Auth::id();
			
				if($request->hasFile('filemou')) {
						$image = $request->file('filemou');
						$fileSign = $user_id.'_'.'3'.'_mou.'.$image->getClientOriginalExtension();
						$destinationPath = public_path('/../public/uploads/nref/mou');
						$imagePath = $destinationPath. "/".  $fileSign;
						$image->move($destinationPath, $fileSign);
						
						$filedata['mou'] = $fileSign;
						
				}
					
				$updateQuery=DB::table('institute_details')
					->where('user_id',$user_id)
					->update($filedata);
				if($updateQuery)
				{
					return back()->with('message','MOU Uploaded successfully !');
				}else{
					return back()->with('error','MOU Not uploaded');
				}
			
	    });
		return $transactionResult;
	}
	
	
	


}
