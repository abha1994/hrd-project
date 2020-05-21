@extends('layouts.master')
@section('container')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Pending Application
     </li>
      </ol>
   
      <!-- Example DataTables Card-->
      <div class="card mb-3">
      <div class="card-header text-center"><h4 class="mt-2">Pending Application </h4></div>
         <div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app">   
      @include('includes/flashmessage')
      
     <!--  <div class="pull-right" style="float: right;">
        
        <a class="btn btn-success" href="{{ route('short-term-program.create') }}"><i class="nav-icon fas fa-plus"></i> New</a>
         
      </div> -->
      <br />      
      <br />
        <div class="table-responsive card-box">
          <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th style="width:30%;">Program Name</th>
                <th style="width:30%;">Coordinator Name</th>
                <th style="width:30%;">Coordinator Mobile</th>
                <th class="text-right">Action</th>
              </tr>
            </thead>
            <?php //dd($roles); ?>  
            <tbody> 
              @foreach ($records as $record)
                <tr>
                  <td>{{ $record->name_proposed_training_program }}</td>
                  <td>{{ $record->coordinator_name }}</td>
                  <td>{{ $record->coordinator_mobile }}</td>
                   <td><a class="btn btn-info" href="{{ route('short-term-application.show',$record->short_term_id) }}" style="color: white">Show</a>
                    @if(!empty($record->signature_doc))
                    <a class="btn btn-success" href="{{ route('short-term-application.edit',$record->short_term_id) }}">Edit</a>
                    @endif
                    {!! Form::open(['method' => 'DELETE','route' => ['short-term-application.destroy', $record->short_term_id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger confirmation','id'=>'delete']) !!}
                         
                        {!! Form::close() !!}  
                   </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div> 
    </div>
  </div>
</div>
<script type="text/javascript">
  $('.confirmation').on('click', function () {
    return confirm('Are you sure want to delete?');
  });
</script>
@endsection

 
	
	