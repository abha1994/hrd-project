<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;
use Illuminate\Support\Facades\Hash;
use Illuminate\Mail\Message;
use Validator,Redirect;
use Illuminate\Contracts\Encryption\DecryptException;
use Session;
use App\Admin_link;

class AdminLinkController extends Controller
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
     *  Show the Link Officer Form List.
     *
     * @index
     */
    
	public function index(Request $request)
    { 
	     $data = Admin_link::index();
		 return view('admin_link/link_list',compact('data'));
	}
	
	/**
     * View Add Link Officer Page.
     *
     * @add
     */
	 
	  public function create()
	  { 
	      $data = Admin_link::index();
		  return view('admin_link/link_add',compact('data'));
	  }
	
	/**
     * Insert Link Officer Form Data.
     *
     * @create
     */
	
	public function store(Request $request){
	 
	   $validatedData = $request->validate([
			'officer_id' => 'required',
			'link_officer_id' => 'required',
			'valid_from' => 'required',
			'valid_to' => 'required',
		]);
		
		date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s');
		
		$postdata['officer_id'] = $request->officer_id;
		$postdata['link_officer_id'] = $request->link_officer_id;
		$postdata['valid_from'] = date("Y-m-d",strtotime($request->valid_from));
		$postdata['valid_to'] = date("Y-m-d",strtotime($request->valid_to));
		
		$postdata['created_date'] = $date;
		
        $data = Admin_link::add($postdata);
		if($data['status'] == "1" ){
			  return redirect('link-officer')->with('success','Link Officer Created successfully')->with('all_data',$postdata);
		}
	}
	
	/**
     *View Edit link Officer Page by id.
     *
     * @edit
     */
	
	 public function edit($id)
     { 
	       $data = Admin_link::edit($id);
	       return view('admin_link/link_edit',compact('data'));
	 }
	
	 /**
     * update Link Officer Form Data by id.
     *
     * @update
     */
	 
	public function update($id, Request $request)
    { 
	    $validatedData = $request->validate([
			'officer_id' => 'required',
			'link_officer_id' => 'required',
			'valid_from' => 'required',
			'valid_to' => 'required',
		]);
		date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s');
		
		$postdata['officer_id'] = $request->officer_id;
		$postdata['link_officer_id'] = $request->link_officer_id;
		$postdata['valid_from'] = date("Y-m-d",strtotime($request->valid_from));
		$postdata['valid_to'] = date("Y-m-d",strtotime($request->valid_to));
		$postdata['modified_date'] = $date;
		
        $data = Admin_link::update_link($postdata,$id);
		if($data['status'] == "1" ){
			  return redirect('link-officer')->with('success','Link Officer Updated successfully')->with('all_data',$postdata);;
		}
	 }
	
	
	/**
     * Check officer id unique.
     *
     * @get_officer_id
     */
	public function get_officer_id(Request $request){
		$officer_id = $request->officer_id;
		date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d');
		
		$data1 = DB::table('assign_link_officer')->where('officer_id',$officer_id)->where('valid_to','>=',$date)->get()->first();
	    if($data1 == null){
			echo "2";// Not exists
		}else{
			$current_date = strtotime($date);
			$valid_to_date = strtotime($data1->valid_to);
			
			if($valid_to_date >=  $current_date){
				echo "1";//echo "Working Now";
			}else{
				echo "2"; //echo "Expired link officer"; 
			}
		}
	}
	/**
     * Check Link officer id unique.
     *
     * @view
     */
	public function get_link_officer_id(Request $request){
		date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d');
		$link_officer_id = $request->link_officer_id;
		$data1 = DB::table('assign_link_officer')->where('link_officer_id',$link_officer_id)->where('valid_to','>=',$date)->get()->first();
		if($data1 == null){
			echo "2";// Not exists
		}else{
			$current_date = strtotime($date);
			$valid_to_date = strtotime($data1->valid_to);
			
			if($valid_to_date >=  $current_date){
				echo "1";//echo "Working Now";
			}else{
				echo "2"; //echo "Expired";
			}
		}
	}
	
	
	
	/**
     * View Link Officer Form Data by id.
     *
     * @view
     */
	 
	public function view($id)
    { 
	       $data = Admin_link::edit($id);
	       return view('admin_link/link_view',compact('data'));
	}
	


   
       
}
