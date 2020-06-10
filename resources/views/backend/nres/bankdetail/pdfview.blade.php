<?php //echo "<pre>"; print_r($courses); echo count($courses); die; ?>
 <div class="content-wrapper" style="margin-left: 13px;">
    <div class="container-fluid">
	 
	
      <!-- Icon Cards-->
	   <div class="card card-login mx-auto mt-5 " style="max-width: 65rem; margin-bottom: 28px;">
							

     <div class="card-header text-center"><h4 style="color: #2384c6;"><center>Bank Mandate Form</center></h4></div>
      <div class="card-body">
		
			
				           <table id="example1" class="table table-bordered " role="grid" aria-describedby="example1_info">
        <tbody>
           
          <tr>
            <td>Candidate Name : </td>
			
            <td>  <?php echo $name;?> 
		    </td>
          </tr>
		   <tr>
            <td>Bank Phone : </td>
            <td>{{$recorde->candidate_phone}}</td>
          </tr>
		   <tr>
            <td>Pan Number : </td>
            <td>{{$recorde->pan}}</td>
          </tr>
           <tr>
            <td>Aadhar Number : </td>
            <td>{{$recorde->aadhar_no}}</td>
          </tr>
           <tr>
            <td>Bank Name : </td>
            <td>{{$recorde->bank_name}}</td>
          </tr>
           <tr>
            <td>Branch Name : </td>
            <td>{{$recorde->branch_name}}</td>
          </tr>
           <tr>
            <td>Acount Number : </td>
            <td>{{$recorde->account_number}}</td>
          </tr>
           <tr>
            <td>RTGS Enable : </td>
            <td>
			    @if($recorde->rtgs == "Y" )
			       YES 
					@else 
				   NO 
				@endif
			</td>
          </tr>
           <tr>
            <td>NEFT Enable : </td>
            <td>
			    @if($recorde->neft == "Y" )
			       YES 
					@else 
				   NO 
				@endif
			</td>
          </tr>
          
           <tr>
            <td>Account Type : </td>
            <td>{{$recorde->account_type}}</td>
          </tr>
           
           <tr>
            <td>Bank  Mobile : </td>
            <td>{{$recorde->bank_mobile}}</td>
          </tr>
          <tr>
            <td>Bank Email Id : </td>
            <td>{{$recorde->bank_email}}</td>
          </tr>  
           
        
        </tbody>
      </table>
							
								
								<br><br><br>
								
								<div class="form-group">
								<div class="row">
								
								<div class="col-md-6" style="width: 20%;">
								<label for="name"  style="font-size: 12px;color:#000" class="control-label">Candidate Signature</label>
										<!--<p style="background-color: brown;color: white;text-align:center">Signature</p>-->
										<hr>
									
								</div>
								
								<div class="col-md-6" style="width: 20%;position: relative;left: 10em;margin-top: -4em;">
								<label for="name"  style="font-size: 12px;color:#000" class="control-label">Bnak Manager Signature</label>
								<hr>
									
								</div>
								
								</div>
								</div>
								
								
         </div>
		 
		 
     </div>
	 
	 <div style="position: relative;top: 7em;">
	 <p><strong>Ministry of New and Renewable Energy</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Designed & Developed by National Informatics Centre</strong></p>
	 </div>
	
	