@extends('layouts.master')

@section('container')

<?php //echo "<pre>"; print_r($evalution); die; ?>

 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Training Program Evaluation</li>
      </ol>
<div class="card card-login mx-auto mt-5 " style="max-width: 100rem;">
	
	
					<div class="card-body">
					<h4><strong><center>Training Program Evaluation</center></strong></h4>
					
					<div class="card-header">Fellow Information</div>
					<br>
					<div class="form-group">
								<div class="row">
									<div class="col-md-9">
									  <label for="name"  style="font-size: 13px;" class="control-label">Name Of Fellow</label>
										<input  disabled type="text" value="<?php echo $evalution[0]->firstname.' '.$evalution[0]->middlename.' '.$evalution[0]->lastname; ?>" >
									</div>
									
									
								</div> 
							</div>
							
							<div class="form-group">
								<div class="row">
									<div class="col-md-9">
									  <label for="name"  style="font-size: 13px;" class="control-label">Email</label>
										<input disabled type="text" value="<?php echo $evalution[0]->email_id; ?>" >
									</div>
									
									
								</div> 
							</div>
							<hr>
					
					       <div class="form-group">
								<div class="row">
									<div class="col-md-9">
									  <label for="name"  style="font-size: 13px;" class="control-label">The information I received about the training program prior to enrolment was accurate and useful</label>
										<input type="checkbox" name="tpe1" value="The information I received about the training program prior to enrolment was accurate and useful" <?php if($evalution[0]->tbl_tpe1=="The information I received about the training program prior to enrolment was accurate and useful") { echo "checked"; } ?>>
									</div>
									
									
								</div> 
							</div>
							
							<div class="form-group">
								<div class="row">
									<div class="col-md-9">
									  <label for="name"  style="font-size: 13px;" class="control-label">The training facilities and equipment's were accurate</label>
										<input type="checkbox" name="tpe2" value="The training facilities and equipment's were accurate" <?php if($evalution[0]->tbl_tpe2=="The training facilities and equipment's were accurate") { echo "checked"; } ?>>
									</div>
									
									
								</div> 
							</div>
							
							
							<div class="form-group">
								<div class="row">
									<div class="col-md-9">
									  <label for="name"  style="font-size: 13px;" class="control-label">The content of training program was easy to understand</label>
										<input type="checkbox" name="tpe3" value="The content of training program was easy to understand" <?php if($evalution[0]->tbl_tpe3=="The content of training program was easy to understand") { echo "checked"; } ?>>
									</div>
									
									
								</div> 
							</div>
							
							<div class="form-group">
								<div class="row">
									<div class="col-md-9">
									  <label for="name"  style="font-size: 13px;" class="control-label">All written material was easy to follow and understand</label>
										<input type="checkbox" name="tpe4" value="All written material was easy to follow and understand" <?php if($evalution[0]->tbl_tpe4=="All written material was easy to follow and understand") { echo "checked"; } ?>>
									</div>
									
									
								</div> 
							</div>
							
							<div class="form-group">
								<div class="row">
									<div class="col-md-9">
									  <label for="name"  style="font-size: 13px;" class="control-label">I felt I achieved the learning outcome of the course</label>
										<input type="checkbox" name="tpe5" value="I felt I achieved the learning outcome of the course" <?php if($evalution[0]->tbl_tpe5=="I felt I achieved the learning outcome of the course") { echo "checked"; } ?>>
									</div>
									
									
								</div> 
							</div>
							
							<div class="form-group">
								<div class="row">
									<div class="col-md-9">
									  <label for="name"  style="font-size: 13px;" class="control-label">The trainer assigned to me was made my learning experience good
</label>
										<input type="checkbox" name="tpe6" value="The trainer assigned to me was made my learning experience good" <?php if($evalution[0]->tbl_tpe6=="The trainer assigned to me was made my learning experience good") { echo "checked"; } ?>>
									</div>
									
									
								</div> 
							</div>
							
							<div class="form-group">
								<div class="row">
									<div class="col-md-9">
									  <label for="name"  style="font-size: 13px;" class="control-label">I found activities were relevant to my need</label>
										<input type="checkbox" name="tpe7" value="I found activities were relevant to my need" <?php if($evalution[0]->tbl_tpe7=="I found activities were relevant to my need") { echo "checked"; } ?>>
									</div>
									
									
								</div> 
							</div>
							
							<hr>
							
							<div class="card-header">Trainer Evaluation</div>
							<br>
							<div class="form-group">
								<div class="row">
									<div class="col-md-9">
									  <label for="name"  style="font-size: 13px;" class="control-label">The trainer gave an overview of the training program at the onset of each session and explained 
the assessment process adequately</label>
										<input type="checkbox" name="tpe8" value="The trainer gave an overview of the training program at the onset of each session and explained 
the assessment process adequately" <?php if($evalution[0]->tbl_tpe8=="The trainer gave an overview of the training program at the onset of each session and explained 
the assessment process adequately") { echo "checked"; } ?>>
									</div>
									
									
								</div> 
							</div>
							
							<div class="form-group">
								<div class="row">
								<div class="col-md-9">

                      <label for="name"  style="font-size: 13px;" class="control-label">Star Ratings</label>								
							<input type="text"  value="<?php echo $evalution[0]->star_rating; ?>" disabled /> 
									</div>
								</div> 
							</div>
							
							<div class="form-group">
								<div class="row">
									<div class="col-md-9">
									  <label for="name"  style="font-size: 13px;" class="control-label">Your suggestions</label>
										<textarea type="checkbox" name="suggestion" disabled> <?php echo $evalution[0]->suggestions; ?></textarea>
									</div>
									
									
								</div> 
							</div>
							
							
							<center>
								<div class="form-group" >	
								<a href="{{url('/trainingEvalution')}}" class="btn btn-primary buttonEvent"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp; Back</a>
								</div> 
							</center>
							

					</div>
            </div>
         </div>
     </div>
	 
	 
	 <script>
$(document).ready(function() { 

   var getUrl = window.location;
	var folderName1= getUrl.pathname.split('/')[1];
	var baseurl= getUrl.origin;

	
	if(folderName1=="view-evaluation")
	{
		$("#trainingEvalution").addClass("active");
	}
	
	

});
</script>

@endsection
	
	