@extends('layouts.master')
@section('container')
	<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb" >
        <li class="breadcrumb-item">
          <a href="{{url('home')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Update Role Management</li>
      </ol>
  <div class="card card-login mx-auto mt-5 ">     
   <div class="card-header text-center"><h4 class="mt-2">Update Role Management</h4></div>
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif 
        <div class="card-body">

{!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Role Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
<style>
.head_design{
	background-color: #c1c1c1;
    color: white;
    padding: 6px;
    border-radius: 8px;
}  
</style>
  <div class="col-xs-10 col-sm-10 col-md-12">
    <div class="form-group">
            <div class="text-success mb-2"><input type="checkbox" id="selectall"/> Choose Permission:</div>
            <div class="row">
			<div class="col-12">
			
			<?php  $scheme_arr = ['0'=>'','1'=>'Internship','3'=>'National Renewable Energy Fellowship'];
			$mdarray = module_array();
			foreach($scheme_arr as $sk=>$sv){
			foreach($mdarray as $k=>$v){ 
			
				foreach($permission as $value) {
					if($value->module_id == $k){
						if($sk == $value->scheme_code){
					      $arr[$sk][$value->module_id][$value->id] = $value->name;
						}
				
					}
					
			 }
			 
			}
				
			}
		// echo "<pre>";print_r($arr);	
$mdarray = module_array();		
foreach($arr as $k1=>$v1){
	if($k1 == "0"){
	}else if($k1  == "1"){ ?>
	  <h3 class="head_design"><input type="checkbox" class="case select_1" dir="<?php echo $k1;?>">  NREI</h3>
	<?php }else if($k1  == "3"){ ?> 
	    <h3 class="head_design"><input type="checkbox" class="case select_3" dir="<?php echo $k1;?>" />  NREF</h3>
   <?php	}
	// echo "<pre>";print_r($v1);	
	?>
	
	 <?php 
	foreach($v1 as $k2=>$v2){
		
		foreach($mdarray as $k3=>$v3){ 
			if($k2 == $k3){?>
			  <h6 class=""><b><?php echo $v3.' :'; ?></b></h6>
			  <?php 
				 	foreach($v2 as $k4=>$v4){
						?>
						  <label style="font-size:16px;font-weight:400;display:inline-block;">{{ Form::checkbox('permission[]', $k4, in_array($k4, $rolePermissions) ? true : false, array('class' => "case select_code_$k1")) }}
                         {{ $v4 }}</label>&nbsp;&nbsp;
						<?php 
						
					}?>
                  <hr>					
			<?php
		   }
		}
	}
}			?>
		
			</div>	
        </div>  
      </div>
  </div>


    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
	
        <button type="submit" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i>&nbsp; Save</button>
        <a class="btn btn-secondary" href="{{ route('roles.index') }}"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Cancel</a>
    </div>
</div>
{!! Form::close() !!}
    </div>
    </div>
</div> 
</div>
 <script type="text/javascript">
 $(document).ready(function () {
	

$("#selectall").click(function () {
	var checkAll = $("#selectall").prop('checked');
	    if (checkAll) {
            $(".case").prop("checked", true);
        } else {
            $(".case").prop("checked", false);
        }
    }); 
   $(".select_1").click(function () {
	// var scheme_code = $(this).attr('dir');
	var checkAll = $(".select_1").prop('checked');
	    if (checkAll) {
            $(".select_code_1").prop("checked", true);
        } else {
            $(".select_code_1").prop("checked", false);
        }
    });
	
	$(".select_3").click(function () {
	// var scheme_code = $(this).attr('dir');
	var checkAll = $(".select_3").prop('checked');
	    if (checkAll) {
            $(".select_code_3").prop("checked", true);
        } else {
            $(".select_code_3").prop("checked", false);
        }
    });
	
	
	

    });
	

</script>
<!-- <script src="{{ asset('js/app.js') }}"></script> 
 -->@endsection

 
 