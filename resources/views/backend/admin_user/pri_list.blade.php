@extends('layouts.app1')

@section('content')
 <div class="content-wrapper" style="margin-left: 13px;">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Role & Permission</li>
      </ol>
	 
      <!-- Example DataTables Card-->
      <div class="card mb-3">
      
        <div class="card-body">
		 @if ($account = Session::get('success'))
		 <div class="alert alert-success alert-block">
		   <button type="button" class="close" data-dismiss="alert">×</button>	
		   <strong>{{ $account }}</strong>
		 </div>
	     @endif
		 
		  @if ($account = Session::get('error'))
		 <div class="alert alert-danger alert-block">
		   <button type="button" class="close" data-dismiss="alert">×</button>	
		   <strong>{{ $account }}</strong>
		 </div>
	     @endif
			   <div class="card card-login mx-auto mt-5 " style="max-width: 81rem;">
	
     <div class="card-header text-center"><h4 style="color: #2384c6;">Role & Permission</h4></div>
      <div class="card-body">	
          <div class="table-responsive">
		  	<form  enctype="multipart/form-data"  action="{{ route('create-pri',$id) }}" class=""  onsubmit="this.elements['submit'].disabled=true;" autocomplete="off" id="internship_form" method="POST" >
			<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
			
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th id="stud" scope="col">
						Module Name
					</th>
					<th id="villa" scope="col" colspan="5">
						Permission <input type="checkbox"  id="chk123" class="select_all" value="">
					</th>
				</tr>
			</thead>
			<tbody>
			<?php  $i=1;    foreach($data['privilages_data'] as $key=>$val){   ?>
				<tr>
					<th headers="par" id="pbed1">
					   <?php echo $key;?>
					</th>
					<?php foreach($val as $v){  ?>
					<td headers="par pbed1 stud" > 
					   <?php echo $v->name;?>
					   <input type="checkbox" name="privilage[]"  class="select_all" value="<?php echo $v->privilage_id?>" 
					 <?php if($fetch != null){
						 $permission = explode(',',$fetch->privilage_id); 
						 foreach($permission as $v1){
							 if($v1 == $v->privilage_id){
								 echo "checked";
							 }
						 }
						} ?>>
					</td>
					<?php } ?>
				</tr>
				<?php } ?>
			</tbody>
			</table>

            <center>
				<div class="form-group" >
				   <input class="btn btn-primary" type="submit"  name="submit" value="Submit">
				    <button class="btn btn-primary"style="background-color: #ffffff;" ><a href="{{ URL('user')}}">Cancel</a></button>
				</div> 
			</center>
							
			</form>
          </div>
        </div>
        <!--div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div-->
      </div>
    </div>   </div>
    </div>

@endsection

<!--<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			 <thead>
				<tr>
					<th id="" scope="col">
						Module Name
					</th>
					<th id="" scope="col">
						Permission <input type="checkbox"  id="chk123" class="select_all" value="">
					</th>
				</tr>
			</thead>
			
			<tbody>
			<?php //dd($data['privilages_data']); 
     			// $i=1; 
			    // foreach($data['privilages_data'] as $key=>$val){   ?>
				
				<tr>
					<th id="par" class="span" colspan="5" scope="colgroup">
						<?php //echo $key;?>
					</th>
				</tr>
				<?php //foreach($val as $v){  ?>
				<tr>
					<td headers="" id="">
						<?php //echo $v->name;?>
					</td>
					<td headers="par pbed1 stud">
						<input type="checkbox" name="privilage[]"  class="select_all" value="<?php //echo $v->privilage_id?>" 
						 <?php //if($fetch != null){
							 // $permission = explode(',',$fetch->privilage_id); 
							 // foreach($permission as $v1){
								 // if($v1 == $v->privilage_id){
									 // echo "checked";
								 // }
							 // }
						 // } ?>>
					</td>
				</tr>
				
				<?php //} } ?>
				
				
			</tbody>
			</table-->