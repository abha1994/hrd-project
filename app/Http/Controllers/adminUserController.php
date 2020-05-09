<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use App\User;
use Mail;
use App\Mail\OfficerLoginCredential;

class adminUserController extends Controller
{
     function __construct()
    {
         $this->middleware('permission:officer-list|officer-create|officer-edit|officer-delete', ['only' => ['index','store']]);
         $this->middleware('permission:officer-create', ['only' => ['create','store']]);
         $this->middleware('permission:officer-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:officer-delete', ['only' => ['destroy']]);
    }
    
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$data = DB::table('admin_user')->get();

          $data = User::orderBy('id','DESC')->where('user_type','officer')->get();

        // return view('users.index',compact('data'))
            // ->with('i', ($request->input('page', 1) - 1) * 5);
        return view('backend/admin_user/user_list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $roles = Role::pluck('name','id')->all();
        return view('backend/admin_user/user_add',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'officer_name'  => 'required|min:4',
            'designation'   => 'required',
            'email'         => 'required|email|unique:user_credential,email',            
            'mobile_no'     =>  'required|digits:10|numeric|regex:/^[6-9]\d{9}$/|unique:user_credential,mobile_no',
            'status'        => 'required|not_in:-1',
            'dob'           => 'required',
            'joining_date'  => 'required',
            'transfer_date' => 'required',
            'roles'         => 'required'
        ]);

        $date = date('Y-m-d H:i:s');     
        $dob = date('Y-m-d', strtotime($request->dob));
        $joining_date = date('Y-m-d', strtotime($request->joining_date));
        $transfer_date = date('Y-m-d', strtotime($request->transfer_date));

        // $record = array('officer_name'=>$request->officer_name,'designation'=>$request->designation, 'email'=>$request->email,'mobile_no'=>$request->mobile_no,'role'=>$request->roles,'status'=> $request->status,'dob'=>$dob,'joining_date'=>$joining_date,'transfer_date'=>$transfer_date,'created_date'=>$date);       
        // DB::table('admin_user')->insert($record);

        $userrecord = User::orderBy('id','DESC')->first();
        $userlastrecord = $userrecord->id;
        $usernamelastid = $userlastrecord +1;
        // $username = $request->officer_name.$usernamelastid;
		$name = $request->officer_name;
		$substring = substr($name, 0, strpos($name, ' '));
		  if($substring != ""){
			
			$name_ex = str_replace('.','',$substring);
			$username = strtolower(mb_substr($name_ex, 0, 5).$usernamelastid);
		  }else{
			$username = strtolower(mb_substr($name, 0, 5).$usernamelastid);
		  }
			  
		
        // $password = 'password@321';
		//************Password***************8//
		$string1="abcdefghijklmnopqrstuvwxyz";
		$string2="1234567890";
		$string3="!@#$%^&*()_+";
		$string=$string1.$string2.$string3;
		$string= str_shuffle($string);
		$user_password  = substr($string,8,14); 
		$password1 = $user_password;
		//************Password***************8//
		
        $password = Hash::make($password1);


        $userData = array('name'=>$request->officer_name,'designation'=>$request->designation,'email'=>$request->email,'username'=>$username,'password'=>$password,'mobile'=>$request->mobile_no,'status'=> $request->status,'dob'=>$dob,'joining_date'=>$joining_date,'transfer_date'=>$transfer_date,'user_type'=>'officer','role'=>$request->roles);


        $user = User::create($userData);
        $user->assignRole($request->input('roles'));
        Mail::to($request->email)->send(new OfficerLoginCredential($userData));
        return redirect()->route('user.index')->with('message','Record created sucessfully');
         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::where('user_type','officer')->findOrFail($id);
       return view('backend/admin_user/user_view',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('user_type','officer')->findOrFail($id);
        $roles = Role::pluck('name','id')->all();
        $userRole = $user->roles->pluck('name','id')->all();
       return view('backend/admin_user/user_edit',compact('user','roles','userRole'));
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
        $this->validate($request, [
            'officer_name'  => 'required|min:4',
            'designation'   => 'required',
            'email'         => 'required|email|unique:user_credential,email,'.$id,  
            'mobile_no'     =>  'required|digits:10|numeric|regex:/^[6-9]\d{9}$/|unique:user_credential,mobile_no,'.$id,
            'status'        => 'required|not_in:-1',
            'dob'           => 'required',
            'joining_date'  => 'required',
            'transfer_date' => 'required',
            'roles'         => 'required'
        ]);

        

            $input = $request->all();
			$input['role'] = $request->roles;
            $input['dob'] = date('Y-m-d', strtotime($request->dob));
            $input['joining_date'] = date('Y-m-d', strtotime($request->joining_date));
            $input['transfer_date'] = date('Y-m-d', strtotime($request->transfer_date));

           
            $user = User::find($id);
            $user->update($input);
       
            DB::table('model_has_roles')->where('model_id',$id)->delete();
    
            $user->assignRole($request->input('roles'));
        
            return redirect()->route('user.index')
                        ->with('success','Record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('user.index')
                        ->with('success','Record Deleted successfully');

    }


    public function statuChange($id){

         $data = User::findOrFail($id);
         if($data->status == 1){
            $data->status =0;
            $data->save();

         }else{
            $data->status =1;
            $data->save();

         }
         return redirect()->back()->with('success','Status updated sucessfully');
    }
}
