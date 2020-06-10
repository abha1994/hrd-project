<?php


$data = array();
foreach($banks as $bank)
{
	
	foreach($student_name as $v){
		if($v->id == $bank->student_id){
	 $stu= ucwords($v->firstname.' '.$v->lastname);
	}
	}
	    
	 
$i='1';
$data[] = array(
	        "srn"=>$i,
	        
			"bank_name"=>$bank->bank_name,
			"accno"=>$bank->account_number,
			
			"view"=>'<a href="'.url("nrest-bankdetails-show/").'/'.$bank->id.'"><i class="fa fa-eye"></i></a>',
			
			
    	); 
		$i++;
}
		
		$response = array(
    "draw" => intval(1),
    "aaData" => $data
);

echo json_encode($response);
?>