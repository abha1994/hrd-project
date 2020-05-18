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
			"clickTocheck"=>'
			<a href="'.route('final-selected-university',$inst->institute_id ).'" onclick="return confirm("Are you sure you want to delete?")"><button type="button" class="btn btn-primary" style="border: #d81a11;font-size:10px;width:75%;background-color: #096c71;">Click For Selection</button></a>
			<a href="'.route('edit-university',$inst->institute_id ).'"><i class="fa fa-edit"></i></a>
			<a href="'.route('view-university',$inst->institute_id ).'"><i class="fa fa-eye"></i></a>
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