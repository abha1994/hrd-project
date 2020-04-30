<?php
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Spatie\Permission\Models\Role;
use DB;
use Hash;
class AdminUserController extends Controller
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
     * For Fetch permission  data from user creadentials table
     *
     * @permission_data
     */
	 
	public static function permission_data()
    { 
		$all_data =  Session::get('userdata');
		$privilage_id = DB::table('user_credential')->where('officer_id',$all_data['officer_id'])->get()->first()->privilage_id;
		if($privilage_id)
		{
			return $privilage_id;
		}else{
			return false;;
		}
	 }
	 
    /**
     *  Show the Officer Form List.
     *
     * @index
     */
   

	public function index(Request $request)
    { 
		 
    	$data = DB::table('admin_user')->get();
		return view('backend/admin_user/user_list',compact('data'));
		
	}
	
	/**
     * View Add Officer Page.
     *
     * @add
     */
	 
	public function add()
    { 
	  	$roles = Role::pluck('name','name')->all();
	     return view('backend/admin_user/user_add',compact('roles'));
	   
    }
	
	/**
     * Insert Add Officer Form Data.
     *
     * @create
     */
	
	public function create(Request $request){
	 

	   $this->validate($request,[
			'officer_name' => 'required',
			'designation' => 'required',
			'email' => 'required|email|unique:user_credential,email',
			'role_id' => 'required',
			'mobile_no' =>  'required|digits:10|numeric|regex:/^[6-9]\d{9}$/',
			'status' => 'required|not_in:-1',
			'dob' => 'required',
			'joining_date' => 'required',
			'transfer_date' => 'required',
			'roles' => 'required'
		]);
		
		$record = $request->all();
		dd($record);
		
		// date_default_timezone_set('Asia/Kolkata');
		// $date = date('Y-m-d H:i:s');
		// dd($date);
		
		// $postdata['officer_name'] = $request->officer_name;
		// $postdata['designation'] = $request->designation;
		// $postdata['email'] = $request->email;
		// $postdata['dob'] = date('Y-m-d', strtotime($request->dob)); 
		// $postdata['role_id'] = $request->role_id;
		// $postdata['mobile_no'] = $request->mobile_no;
		// $postdata['privilage_id'] = '0';
		// $postdata['status'] = $request->status;
		// $postdata['joining_date'] = date("Y-m-d",strtotime($request->joining_date));
		// $postdata['transfer_date'] = date("Y-m-d",strtotime($request->transfer_date));
		// $postdata['created_date'] = $date;
		
  //       $data = Admin_user::add($postdata);
		// if($data['status'] == "1" ){
		// 	  return redirect('user')->with('success','Officer Created successfully');
		// }
			
	}
	
	/**
     *View Edit Officer Page by id.
     *
     * @edit
     */
	
	public function edit($id)
    { 
	  $permission_data = self::permission_data(); $pri_explode = explode(',',$permission_data);
	  if(in_array(2, $pri_explode)){
		  $data = Admin_user::edit($id);
		  return view('backend/admin_user/user_edit',compact('data'));
	  }else{
		  return redirect('access-denied');
	  }
    }
	
	 /**
     * update Add Officer Form Data by id.
     *
     * @update
     */
	 
	public function update($id, Request $request)
    { 
	   $validatedData = $request->validate([
		//	'officer_name' => 'required',
			'designation' => 'required',
			'email' => 'required|email',
			'role_id' => 'required',
			'mobile_no' =>  'required|digits:10|numeric|regex:/^[6-9]\d{9}$/',
			'status' => 'required',
			'dob' => 'required',
			'joining_date' => 'required',
			'transfer_date' => 'required',
		]);
		//2020-01-16 24-Jan-2020'
		date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s');
		
		$postdata['officer_name'] = $request->officer_name;
		$postdata['designation'] = $request->designation;
		$postdata['email'] = $request->email;
		$postdata['dob'] = date('Y-m-d', strtotime($request->dob)); 
		$postdata['role_id'] = $request->role_id;
		$postdata['mobile_no'] = $request->mobile_no;
		$postdata['privilage_id'] = '0';
		$postdata['status'] = $request->status;
		$postdata['joining_date'] = date("Y-m-d",strtotime($request->joining_date));
		$postdata['transfer_date'] = date("Y-m-d",strtotime($request->transfer_date));
		$postdata['modified_date'] = $date;
		
        $data = Admin_user::update_user($postdata,$id);
		if($data['status'] == "1" ){
			  return redirect('user')->with('success','Officer Data Updated successfully');
		}
	   
    }
	
	
	/**
     * View Officer Form Data by id.
     *
     * @view
     */
	 
	public function view($id)
    { 
	  $permission_data = self::permission_data();$pri_explode = explode(',',$permission_data);
	  if(in_array(3, $pri_explode)){
		  $data = Admin_user::edit($id);
	      return view('backend/admin_user/user_view',compact('data'));
	  }else{
		  return redirect('access-denied');
	  }
	}
	
	/**
     * Delete Officer Data by id.
     *
     * @delete
     */
	 
	public function delete($id)
    { 
	  $permission_data = self::permission_data();$pri_explode = explode(',',$permission_data);
	  if(in_array(4, $pri_explode)){
		   $data = Admin_user::delete_data($id);
		   if($data['status'] == "1" ){
				return redirect('user')->with('success','Officer Deleted successfully');
		   }elseif($data['status'] == "0" ){
				return redirect('user')->with('error','Officer id does not exists');
		   }
	  }else{
		  return redirect('access-denied');
	  }
    }

      /**
     *Officer Account status change(Active / Inactive).
     *
     * @status_change
     */
	 
	public function status_change(Request $request)
    { 
        $status = $request->get('status');
	    $officer_id = $request->get('officer_id');
		$data = Admin_user::status_change($status,$officer_id);
		 if($data['status'] == "1" ){
	      echo "1";  // return redirect('user')->with('success','Officer Active successfully');
	    }elseif($data['status'] == "2" ){
		    echo "2";//return redirect('user')->with('error','Officer Inactive successfully');
	    }

	}
	
	
	  /**
	 *Fetch modules name data from privilage table
	 *
	 * @priviliage
	 */
	 
	public function priviliage($id)
    { 
	  $permission_data = self::permission_data();$pri_explode = explode(',',$permission_data);
	  if(in_array(5, $pri_explode)){
		  $fetch = DB::table('user_credential')->where('officer_id',$id)->get()->first();
		  $data = Admin_user::priviliage();
		  return view('backend/admin_user/pri_list',compact('data','id','fetch'));
	  }else{
		  return redirect('access-denied');
	  }
	}
	
	
	  /**
	 *update privilage accordigly user in to user credentials table
	 *
	 * @priviliage_creates
	 */
	
	public function priviliage_create($id,Request $request){
	     $postdata['privilage_id'] = implode(',',$request->privilage);
		 DB::table('user_credential')->where('officer_id',$id)->update($postdata);
		 return redirect('user')->with('success','Permission are updtaed successfully');
	}
   
       
}
