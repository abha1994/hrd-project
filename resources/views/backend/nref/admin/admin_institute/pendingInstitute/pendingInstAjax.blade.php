<?php
//echo "<pre>"; print_r($data); die;

$data1 = array();
$i=1;
foreach($data['institute_data'] as $inst)
{

$data1[] = array(

			"sid" =>$i,
	        "instituteName"=>$inst->institute_name,
			"email"=>$inst->email_id,
    		"address"=>$inst->institute_addres,
			"pincode"=>$inst->pincode,
			"cordinator"=>$inst->coordinate_prog,
			"fellowslot"=>$inst->fellowship_total,
			"fellowPeriod"=>$inst->fellowship_period,
			"regno"=>$inst->institute_reg_no,
			
			"clickTocheck"=>'<a href="'.route('edit-university',$inst->institute_id ).'#university"><i class="fa fa-edit"></i></a>
			<a href="'.route('view-Pendinguniversity',$inst->institute_id ).'"><i class="fa fa-eye"></i></a>
			<a href="'.route('delete-university',$inst->institute_id ).'" onclick="return confirm("Are you sure you want to delete?")"><i class="fa fa-trash"></i></a>'
			
    	);
					
		
		$i++;
}
		
		$response = array(
    "draw" => intval(1),
    "aaData" => $data1
);

echo json_encode($response);
?>