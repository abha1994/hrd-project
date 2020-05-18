@extends('layouts.master')
@section('container')

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Registered Student</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('registerd-student')}}">Home</a></li>
              <li class="breadcrumb-item active">Registered Student</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
       @include('includes/flashmessage')
     
    
       <div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app">        
        <div>
            <table>
                <tr>
                    <td><form name="find" id="find" action="{{route('get-institute')}}" method="post">
                        @csrf

                        <select name="findStudentInst" id="findStudentInst"  class="form-control" required>
                            <option value="">Select Institute</option>
                            @foreach($inst as $val)
                            <option value="{{ $val->institute_id }}" @if($val->institute_id == $id) ? selected : '' @endif>{{$val->department_name}}</option>
                             @endforeach
                        </select>

                         
                
                    </td>
                    <td>
                        <button class="btn btn-primary">Go</button>
                    </td>
                    </form>
                </tr>
            </table>
            
            
        </div>                 
        
        <br />
           <table class="table table-bordered">
                <tr>
                    <th>S. No.</th>
                    <th>Student Name</th>
                    <th>Gender</th>
                    <th>Email ID</th>
                    <th>Mobile</th>
                    <th width="100px">Action</th>
                </tr>
                @foreach($students as $student)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$student->firstname}} {{ $student->middlename}} {{$student->lastname}}</td>
                    <td>{{$student->gender}}</td>
                    <td>{{$student->email_id}}</td>
                    <td>{{$student->mobile}}</td>
                    <td style="width: 250px">
                    <a class="btn btn-info" href="{{ url('registerd-student/'.$student->id.'/'.$id) }}" style="color: white">Show</a>
                        @can('studentregistration-edit')
                            <a class="btn btn-primary" href="{{ url('registerd-student/'.$student->id.'/edit/'.$id) }}">Edit</a>
                        @endcan
                        @can('studentregistration-delete')
                            {!! Form::open(['method' => 'DELETE','route' => ['registerd-student.destroy', $student->id],'style'=>'display:inline']) !!}
                            <input type="hidden" name="redirecturl" value="{{$id}}">
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger confirmation','id'=>'delete']) !!}
                             
                            {!! Form::close() !!}   
                        @endcan
                    </td>
                </tr>
                @endforeach
            </table>

        </div> 
    
    
    </div>
 <script type="text/javascript">
    $('#delete').on('click', function () {
        
        return confirm('Are you sure want to delete?');
    });
</script>
<!-- <script src="{{ asset('js/app.js') }}"></script>  -->
<script type="text/javascript">
 $(document).ready(function () {
      $(".nav-link").removeClass('active');
      $("#listudent").addClass('active');
    });



 
</script>
@endsection

 
	
	