@extends('layouts.master')
@section('container')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Bank Detail</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('bank-details')}}">Home</a></li>
              <li class="breadcrumb-item active">Bank Detail</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid" id="app">        
                  
        @include('includes/flashmessage')
        <br />

<div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app">        
        <div  style="float: right; padding-bottom: 10px;">
        @can('bankdetail-view')
             <a class="btn btn-success" href="{{ route('bank-details.create') }}"> <i class="nav-icon fas fa-plus"></i> New</a>
            @endcan
        </div>                 
        @include('includes/flashmessage')
        <br />
            <table class="table table-bordered">
            
            <thead>
                <tr>
                    <th>S. No.</th>
                    <th>Candidate Name</th>
                    <th>Bank Name</th>
                    <th>Branch</th>
                    <th>A/C Number</th>
                    <th>Aadhar No</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
           @foreach($banks as $bank)
            <tr>
                <td>{{$loop->iteration}}</td>
                 <td>{{$bank->bank_cname}} </td>
                <td>{{$bank->bank_name}} </td>
                <td>{{$bank->branch_name}}</td>
                <td>{{$bank->account_number}}</td>
                <td>{{$bank->aadhar_no}}</td>
                <td>
                    

                
                 @can('bankdetail-list')
                   <a class="btn btn-info" href="{{url('bank-details/'.$bank->id)}}" style="color: white"> View </a>
                @endcan
                @can('bankdetail-edit')
                   <a  class="btn btn-primary" href="{{url('bank-details/'.$bank->id.'/edit')}}">Edit</a>
                @endcan
                         
                
                        <!-- <a class="btn btn-sm btn-outline-secondary btn-sml mr-2" href="{{url('bank-details-registers/'.$bank->id)}}">Register </a> -->
                         
                    
                
                   
                </td>
            </tr>
            @endforeach
         </tbody>
        </table>

        </div> 
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#table_id').DataTable();
    });
</script>
@endsection
	
	