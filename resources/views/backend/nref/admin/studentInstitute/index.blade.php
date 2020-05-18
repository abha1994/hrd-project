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
                    <td><form name="find" action="{{route('get-institute')}}" method="post">
                        @csrf
                         <select name="findStudentInst" id="findStudentInst"  class="form-control" >
                            <option value="">Select Institute</option>
                            @foreach($inst as $val)
                            <option value="{{ $val->institute_id }}">{{$val->institute_name}}</option>
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
                       
						<a href="{{ url('registerd-student/'.$student->id.'/'.$student->institute_id) }}"><i class="fa fa-eye"></i></a>
                        @can('studentregistration-edit')
                        <a href="{{ url('registerd-student/'.$student->id.'/edit/'.$student->institute_id) }}"><i class="fa fa-edit"></i></a>
                        @endcan
                        @can('studentregistration-delete')
                        <a href="{{ url('registerd-student/'.$student->id.'/delete/'.$student->institute_id) }}"><i class="fa fa-trash"></i></a>
                        @endcan
						
                        
                    </td>
                </tr>
                @endforeach
            </table>
        </div> 
    
    
    </div>

@endsection

 
	
	