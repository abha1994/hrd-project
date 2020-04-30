@extends('layouts.master')

@section('container')
 <div class="content-wrapper" >
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">List Link Officer</li>
      </ol>
	 
      <!-- Example DataTables Card-->
      <div class="card mb-3">
	 
        <div class="card-header">
          <a href="{{ route('link-officer.create')  }}"><i class="fa fa-plus"></i> Add Link Officer</a>
		</div>
		
		
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
				
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
				  <th id="sort">S. No.</th>
                  <th>Officer Name</th>
				  <th>Link Officer Name</th>
                  <th>Valid From</th>
                  <th>Valid To</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              
				<?php $i=1; foreach($data['link_tbl_data'] as $v){ ?>
				  <tr>
				  <td><?php echo $i; ?></td>
                  <td>
				  <?php foreach($data['officer_data'] as $val){
					    if($val->officer_id == $v->officer_id){
							echo $val->officer_name;
						}
				  }?>
				  </td>
                  <td>
				  <?php foreach($data['link_officer_data'] as $val){
					    if($val->officer_id == $v->link_officer_id){
							echo $val->officer_name;
						}
				  }?>
				  </td>
				  <td><?php echo $v->valid_from; ?></td>
				  <td><?php echo $v->valid_to; ?></td>
				  <td>
				  <?php
						date_default_timezone_set('Asia/Kolkata');
						$date = date('Y-m-d');
						$current_date = strtotime($date);
						$valid_to_date = strtotime($v->valid_to);
						// dd($current_date,$valid_to_date,$date,$v->valid_to);	

						if($valid_to_date >=  $current_date){
							echo "Working Now";
						}else{
							echo "Expired";
						}
                  ?>
				  </td>
                  <td>
				      
				      <a href="{{ url('link-officer/'.$v->assign_link_officer_id.'/edit') }}"><i class="fa fa-edit"></i></a>
					  
					  <a href="{{ url('link-officer/'.$v->assign_link_officer_id.'/view')  }}"><i class="fa fa-eye"></i></a>
					 
					
				 </td>
				 </tr>
				<?php $i++; } ?>
                
             
             
              </tbody>
            </table>
          </div>
        </div>
        <!--div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div-->
      </div>
    </div>    
</div>

@endsection
