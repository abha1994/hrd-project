<?php

namespace App\Http\Controllers\Nres\Fellowship;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Nres\fellowship\fellowship;
use App\Internship;
use App\Nres\fellowship\condidatereference;
use App\Nres\fellowship\fellowsolarreferences;
use App\Nres\fellowship\education;
use DB;

class fellowshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.nres.fellowship.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		
		$all_data =  Session::get('userdata');
		$dataExist = DB::table('internship_tbl')->where('user_id',$all_data['candidate_id'])->get();
	
		
		//echo "<pre>";print_r($all_data); echo $all_data['candidate_id'];

//print_r($dataExist); echo count($dataExist); echo $dataExist[0]->candidate_id;	die;
        $data = Internship::index();
        $loginuser_data = $data['loginuser_data'];
		
		if(count($dataExist)>0)
		{
			return redirect('fellowship-solar-form/'.$dataExist[0]->candidate_id);
		}
		else
		{
        return view('backend.nres.fellowship.create',compact('data','loginuser_data'));
		}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		//if ($request->has('submit_bt')) {
		
		
		//dd($request);
        $records = $request->all();

        $all_data =  Session::get('userdata');
        $user_id = $all_data['candidate_id'];
		
		//echo "<pre>"; print_r($all_data); die;

        
         $MaxIdvalue = DB::table('internship_tbl')->max('candidate_id');
         $MaxIdvalue = $MaxIdvalue+1;
         $application_cd  = 'NREI/'.date('Y').'/'.$MaxIdvalue;
		
		
        $sql = array(
            'application_cd'        =>  $application_cd,
            'scheme_code'           =>  '02',
            'user_id'               =>  $user_id,
            'first_name'            =>  $records['first_name'],
            'middle_name'           =>  $records['middle_name'],
            'last_name'             =>  $records['last_name'],
            'father'                =>  $records['father_name'],
            'address'               =>  $records['address'],
            'countrycd'             =>  $records['country'], 
            'statecd'               =>  $records['state'],
            'districtcd'            =>  $records['distric'],
            'pincode'               =>  $records['pincode'],
            'email'                 => $records['email_id'],
            'date_birth'            =>  $records['dob'],
            'gender'                =>  $records['gender'],
            'categories'            =>  $records['categories'],
            'phone'                 =>  $records['landline'],
            'mob_number'            =>  $records['mobile_no'],
            'organization'          =>  $records['organization'],
            'organization_address'  =>  $records['organization_address'],
            'id_proof_type'         =>  $records['id_proof'], // select conrol value
            //'file_id_proof'         =>  $records['file_id_proof'] ,// browse id proof type
            //'file_photo'            =>  $records['candidate_photo'], // condidate image
            );
           DB::table('internship_tbl')->insert($sql);
           $last_id = DB::getPDO()->lastInsertId();

			if(!empty($last_id)){
				
				
				if ($request->hasFile('file_id_proof')) {
            if ($request->file('file_id_proof')->isValid()) {
             
                $fileName=$request->file('file_id_proof')->getClientOriginalName();
                $fileName =time()."_".$fileName;
				$destinationPath = public_path('/../public/uploads/nres/fellowship');
                $request->file('file_id_proof')->move($destinationPath, $fileName);
                    //column name 
                $filedata['file_id_proof']=$fileName;
                
            }
        } //ID Proof image

        if ($request->hasFile('candidate_photo')) {
            if ($request->file('candidate_photo')->isValid()) {
             
                $fileName=$request->file('candidate_photo')->getClientOriginalName();
                $fileName =time()."_".$fileName;
                  $destinationPath = public_path('/../public/uploads/nres/fellowship');
                $request->file('candidate_photo')->move($destinationPath, $fileName);
                    //column name 
                $filedata['file_photo']=$fileName;
                
            }
        } //candidate photo
		
		DB::table('internship_tbl')->where('candidate_id',$last_id)->update($filedata);


        if ($request->hasFile('research_work')) {
            if ($request->file('research_work')->isValid()) {
             
                $fileName=$request->file('research_work')->getClientOriginalName();
                $fileName =time()."_".$fileName;
                $destinationPath = public_path('/../public/uploads/nres/fellowship');
                $request->file('research_work')->move($destinationPath, $fileName);
                    //column name 
                $records['research_work']=$fileName;
                
            }
        } //Research book image		
			

           $sqlFellow = array( 
               'internship_candidate_id'        => $last_id,	   
                'scheme_code'       =>  '02', 
            'salary'                =>  $records['salary'],
			'special_achievement'   =>  $records['special_achievement'],
            'ar_spc'                =>  $records['area_spc'],
            'paper_published'       =>  $records['paper_published'],
			'book_published'        =>  $records['book_published'],
			'audio_video'           => $records['audio_video'],
			'research_work'         =>  $records['research_work'],
			'details_scholar'       => $records['details_scholar'],
            'details_awards'        =>  $records['details_awards'],
			'why_selected'          => $records['why_selected'],
            'commitment'            =>  $records['commitment'],
            'submit_bond'           =>  $records['submit_bond']
            
            
             
            );

           DB::table('fellowship_details')->insert($sqlFellow);
	}
           //fellowship::create($records);// insert recorde in fellowhips tables
               
        //Insert Reference Data in DataBase */
		
		if(count($request->refname)>0) {
		
		for($i=0;$i<count($request->refname);$i++)
		{
		
		        $reference['fellowship_id'] = $last_id;
                $reference['name_ref'] = $request->refname[$i];
                $reference['email_ref'] = $request->refemail[$i];
                $reference['mobile_ref'] = $request->refphone[$i];
            fellowsolarreferences::create($reference); // insert recored in condidate reference table
		}
		
		}
		
		// Insert Reference Data In Database */
		
		/* Insert Data for Education in Database */
		
		if(count($request->courseid)>0) {
		
		for($i=0;$i<count($request->courseid);$i++)
		{
		
		        $education['fellowship_id'] = $last_id;
                $education['courseid'] = $request->courseid[$i];
                $education['institute'] = $request->institute[$i];
                $education['stream'] = $request->stream[$i];
				$education['passstatus'] = $request->passstatus[$i];
				$education['yearcompletion'] = $request->yearcompletion[$i];
				$education['markspercentage'] = $request->markspercentage[$i];
            education::create($education); // insert record in education table
		}
		
		}
		
		/* Insert Data for Education in Database */
         
         return redirect('fellowship-solar-form/'.$last_id);
		//}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		
       // $data = fellowship::with('educations','condidatereferences')->findOrFail($id);       
         $data = DB::table('internship_tbl')->where('candidate_id',$id)->first();    
         $educations = DB::table('educations')->where('fellowship_id',$id)->get();  
         $country = DB::table('country')->where('countrycd',$data->countrycd)->first();
         $state = DB::table('state_master')->where('statecd',$data->statecd)->first();
         $distric = DB::table('district_master')->where('districtcd',$data->districtcd)->first();
          
         
         $fellowshipDetails = DB::table('fellowship_details')->where('internship_candidate_id',$id)->first(); 
		 
		 //echo "<pre>"; print_r($fellowshipDetails); die;
         $condidatereferences = DB::table('fellowsolarreferences')->where('fellowship_id',$id)->get(); 
        return view('backend.nres.fellowship.view',compact('data','educations','fellowshipDetails','condidatereferences','country','state','distric'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        echo 'edit';
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
        echo 'update';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        echo 'destroy';
    }
}


//intership_tbl
//felloship_detail
//intern_course_details