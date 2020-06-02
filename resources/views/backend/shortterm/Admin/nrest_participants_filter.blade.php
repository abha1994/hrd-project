<?php

$data = array();
foreach($students as $student)
{
	     if($student->upload_aadhar!="")
	     {
		  $imgURL='<a href="'.URL::asset("public/uploads/shortterm/student_registration/upload_aadhar").'/'.$student->upload_aadhar.'" target="_blank">Download</a>';
	     }
	     else
	    {
		 $imgURL='-';
	    }
		if($student->gender == "1"){$g= "Male";}else if($student->gender == "2"){$g= "Female";}else if($student->gender == "3"){$g= "Others";} 
		
		
		if($student->category == "1")
		{$c= "General";}else if($student->category == "2"){$c= "OBC";}else if($student->category == "3"){$c= "SC";} else if($student->category == "4"){$c= "ST";}
	
	 foreach($district_data as $dist)
	 {
		if($student->districtcd == $dist->districtcd){
		$d= strtolower($dist->district_name);}
	 }
	 foreach($state_data as $stat)
	 {
		if($student->statecd == $stat->statecd){
		$s= strtolower($stat->state_name);}
	 }
	 
	 $dat= date('d-m-Y',strtotime($student->dob));
	

	
	
	$i='1';
$data[] = array(
	        "srn"=>$i,
	        "firstname"=>$student->firstname.' '.$student->middlename.' '.$student->lastname,
			"gender"=>$g,
			"address"=>$student->address,
			"dob"=>$dat,
			"aadhar"=>$student->aadhar,
			"districtcd"=>$d,
			"statecd"=>$s,
			"countrycd"=>"INDIA",
			"pincode"=>$student->pincode,
			"mobile"=>$student->mobile,
			"category"=>$c,
			"upload_aadhar"=>$imgURL,
			"view"=>'<a href="'.url("nrest-participants-show/").'/'.$student->id.'"><i class="fa fa-eye"></i></a>',
			
			
    	); 
		$i++;
}
		
		$response = array(
    "draw" => intval(1),
    "aaData" => $data
);

echo json_encode($response);
?>