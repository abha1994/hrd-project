@extends('layouts.master')

@section('container')
 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active"><?php echo $data['breadcum'];?></li>
      </ol>
	 
      <!-- Example DataTables Card-->
      <div class="card mb-3">

	    <div class="card-header">
          <div class="card-header text-center"><h4 style="color: #2384c6;"><?php echo $data['breadcum'];?></h4></div>
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
            <table class="table table-bordered" id="dataTable12" width="100%">
              <thead>
                <tr>
				  <th id="sort">S. No.</th>
                  <th>Institute Name</th>
                  <th>Address</th>
                  <th>Institute Reg.No</th>
				  <th>Pincode</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              
				<?php $i=1; foreach($data['institute_data'] as $v){?>
				  <tr>
				  <td><?php echo $i; ?></td>
                  <td><?php echo $v->institute_name;?></td>
                  <td><?php echo $v->institute_addres;?></td>
                  <td>
				   <?php echo $v->institute_reg_no;?>
				  </td>
				  <td>
				   <?php echo $v->pincode;?>
				  </td>
                  <td>
				
				  <br>
			
					  @can('admin-nref-institute-edit')		
				      <a href="{{route('edit-university',$v->institute_id )}}"><i class="fa fa-edit"></i></a>
					  @endcan
				      @can('admin-nref-institute-list')
					  <a href="{{route('view-university',$v->institute_id )}}"><i class="fa fa-eye"></i></a>
				      @endcan
					  @can('admin-nref-institute-delete')
					  <a href="{{route('delete-university',$v->institute_id )}}" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash"></i></a>
					  @endcan
					  
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

