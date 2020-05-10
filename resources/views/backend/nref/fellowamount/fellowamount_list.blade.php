@extends('layouts.master')

@section('container')
 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">List Fellow Amount</li>
      </ol>
	 
      <!-- Example DataTables Card-->
       <div class="card mb-3">
	    <div class="card-header text-center"><h4 class="mt-2">List Fellow Amount</h4></div>
	       <div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app"> 
		   
		    @if ($success = Session::get('success'))
		 <div class="alert alert-success alert-block">
		   <button type="button" class="close" data-dismiss="alert">×</button>	
		   <strong>{{ $success }}</strong>
		 </div>
	     @endif
		 
		  @if ($error = Session::get('error'))
		 <div class="alert alert-danger  alert-block">
		   <button type="button" class="close" data-dismiss="alert">×</button>	
		   <strong>{{ $error }}</strong>
		 </div>
	     @endif
		 
		   <div class="pull-right" style="float: right;">
				@can('role-create')
				<a class="btn btn-success" href="{{ URL('add-fellowamount') }}"><i class="nav-icon fas fa-plus"></i> Add Fellow Amount</a>
				@endcan
			</div>
			<br><br>
	
             <div class="table-responsive card-box">
                <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                               
              <thead>
                <tr>
				  <th id="sort">S. No.</th>
                  <th>Financial Year</th>
				  <th>Course Name</th>
				  <th>Amount</th>
				  <th>Validity Period</th>
                  <!--th>Status</th-->
                  <th>Action</th>
                </tr>
              </thead>
              <!--tfoot>
                <tr>
                  <th>Name</th>
                  <th>Position</th>
                  <th>Office</th>
                  <th>Age</th>
                  <th>Start date</th>
                  <th>Salary</th>
                </tr>
				onclick="status_change('1','<?php //echo $v->officer_id?>')"
              </tfoot-->
              <tbody>
              
				<?php $i=1; foreach($data['fellowamount_data'] as $v){?>
				  <tr>
				  <td><?php echo $i; ?></td>
                  <td><?php echo $v->financial_year;?></td>
				  <td><?php echo $v->course_name;?></td>
				  <td><?php echo $v->amount;?></td>
				  <td><?php echo $v->validity_period;?></td>
                  <!--td>
				    <?php //if($v->status == "1"){ ?>
							<a href="javascript:void(0)"   class="btn btn-success">Active</a>
					<?php //}else if($v->status == "2"){ ?>
							<a href="javascript:void(0)"  class="btn btn-danger">Inactive</a>
					<?php //} ?>
				  </td-->
                  <td>
				      
				        <a href="{{route('edit-fellowamount',$v->fellow_amount_id )}}"><i class="fa fa-edit"></i></a>
					
					    <a href="{{route('view-fellowamount',$v->fellow_amount_id )}}"><i class="fa fa-eye"></i></a>
					  
					    <a href="{{route('delete-fellowamount',$v->fellow_amount_id )}}" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash"></i></a>
			 
				  </td>
				  </tr>
				<?php $i++; } ?>
                
             
             
              </tbody>
            </table>
          </div>
        </div>
        <!--div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div-->
      </div>
    </div>  </div>

@endsection
