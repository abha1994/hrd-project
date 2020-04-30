
 <div class="content-wrapper" style="margin-left: 13px;">
    <div class="container-fluid">
	 
	
      <!-- Icon Cards-->
	   <div class="card card-login mx-auto mt-5 " style="max-width: 65rem; margin-bottom: 28px;">
							

     <div class="card-header text-center"><h4 style="    color: #2384c6;">Attendance Details</h4></div>
      <div class="card-body">
		
			
				            <div class="form-group">
								<div class="row">
									<div class="col-md-4">
									  <label for="name"  style="font-size: 13px;" class="control-label">Name of the Fellow : </label>
										<strong><?php if(!empty($logindetails->institute_name)){ ?>{{ $logindetails->institute_name }} <?php } ?></strong>
									</div>
									
									<div class="col-md-4">
									<label for="name"  style="font-size: 13px;" class="control-label">Stream : </label>
										<strong><?php if(count($items)>0){ ?>{{ $items[0]->department_name }} <?php } ?></strong>
									</div>
								</div> 
							</div>
							
							
								
								<div class="form-group">
								<div class="row">
								
								<div class="col-md-4">
								<label for="name"  style="font-size: 13px;color:#000" class="control-label">Name and Signature of Department with Seal</label>
										<p style="background-color: brown;color: white;text-align:center">Signature</p>
									
								</div>
								
								<div class="col-md-4">
								<label for="name"  style="font-size: 13px;color:#000" class="control-label">Name and Signature of Dean with Seal</label>
										<p style="background-color: brown;color: white;text-align:center">Signature</p>
									
								</div>
								
								<div class="col-md-4">
								
								
								<label for="name"  style="font-size: 13px;color:#000" class="control-label">Name and Signature of Registrar with Seal</label>
										<p style="background-color: brown;color: white;text-align:center">Signature</p>
									
								</div>
								</div>
								</div>
         </div>
     </div>
	
	