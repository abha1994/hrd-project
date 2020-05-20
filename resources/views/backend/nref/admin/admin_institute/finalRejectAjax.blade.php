<?php
//echo "<pre>"; print_r($data); die;

$data1 = array();
$i=1;
foreach($data['institute_data'] as $inst)
{

$data1[] = array(

			"sid" =>$i,
	        "instituteName"=>$inst->institute_name,
    		"address"=>$inst->institute_addres,
			"cordinator"=>$inst->coordinate_prog,
			"email"=>$inst->email_id,
			"mobile"=>$inst->mobile_no,
			"fellowslot"=>$inst->fellowship_total,
			"fellowPeriod"=>$inst->fellowship_period,
			"regno"=>$inst->institute_reg_no,
			"pincode"=>$inst->pincode,
			"clickTocheck"=>'<a href="'.route('view-university',$inst->institute_id ).'"><i class="fa fa-eye"></i></a>'
			
    	);
					
		
		$i++;
}
		
		$response = array(
    "draw" => intval(1),
    "aaData" => $data1
);

echo json_encode($response);
?>