<?php


$data = array();
foreach($ins as $inst)
{
	
	                    if($inst->mou){ 
						
						$m = '<a href="'.url("public/uploads/nref/mou/").'/'.$inst->mou.'" target="_blank" download>Click Here to download</a>';
						 } else {
						$m = "MOU Not Uploaded";
						 } 
						
						if($inst->admin_mou_user_id){
                         $b = '<a href="'.url("public/uploads/nref/mou/admin").'/'.$inst->admin_mou.'" target="_blank" download>Click Here to download</a>';
				   } else {
				  if(!empty($inst->mou)){
						$b = '<button type="button"  userID="'.$inst->user_id.'" style="border: 1px solid red;padding: 4px 4px;background: red;color: white;" data-toggle="modal" data-target="#myModal" class="uploadValue1">Upload</button>';
				  }else{ $b = "---";}
					} 
				  
	    
	 
$i='1';
$data[] = array(
	        "srn"=>$i,
	        "institute_name"=>$inst->name,
			"mou"=>$m,
			"admin_mou"=>$b,
			
			
			
    	); 
		$i++;
}
		
		$response = array(
    "draw" => intval(1),
    "aaData" => $data
);

echo json_encode($response);
?>