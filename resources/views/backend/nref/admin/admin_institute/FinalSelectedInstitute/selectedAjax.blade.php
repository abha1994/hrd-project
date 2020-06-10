<?php
//echo "<pre>"; print_r($data['institute_data']); die;

$data1 = array();
$i=1;
foreach($data['institute_data'] as $inst)
{
	
	
	if($inst->sancation_forms!="")
	{
		$imgURL='<a href="'.URL::asset("public/uploads/sancation").'/'.$inst->sancation_forms.'" download>Click Here</a>';
	}
	else
	{
		$imgURL='-';
	}
	
	foreach($data['remarksByCommitee'] as $val)
			{
				if($val->institute_id==$inst->institute_id)
				{
					$ss=$val->remarks;
				}
				else
				{
					$ss="";
				}
			}
			
			foreach($data['remarksByAdmin'] as $val)
			{
				if($val->institute_id==$inst->institute_id)
				{
					$remrkadm=$val->remarks;
				}
				else
				{
					$remrkadm="";
				}
			}

$data1[] = array(

			"sid" =>$i,
	        "instituteName"=>$inst->institute_name,
    		"address"=>$inst->institute_addres,
			"cordinator"=>$inst->coordinate_prog,
			"email"=>$inst->email_id,
			"fellowslot"=>$inst->fellowship_total,
			"fellowPeriod"=>$inst->fellowship_period,
			"regno"=>$inst->institute_reg_no,
			"pincode"=>$inst->pincode,
			"remarksbyCommittee"=>$ss,
			"sancation"=>$imgURL,
			"remarksbyAdmin"=>$remrkadm,
			"clickTocheck"=>'
			<a href="'.route('view-university',$inst->institute_id ).'"><i class="fa fa-eye"></i></a>'
			
    	);

		$i++;
}
		
		$response = array(
    "draw" => intval(1),
    "aaData" => $data1
);

echo json_encode($response);
?>