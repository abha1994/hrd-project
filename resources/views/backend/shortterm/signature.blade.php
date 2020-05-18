@extends('layouts.master')
@section('container')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Short Term</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Short Term</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="container-fluid" id="app">   
    <form action="{{url('uploadsignature/'.$insertedID)}}" method="post" enctype="multipart/form-data">
      @csrf()
      
        <!-- <div  style="float: right; padding-bottom: 10px;">
        
            <a class="btn btn-success" href="{{route('short-term-program.create')}}"> New</a>
           
        </div>                 
        @include('includes/flashmessage') -->
        <input type="file" name="signature_doc" id="signature_doc" required="required">
        <br /><br />
  
        <a href="{{ url('pdfview/'.$insertedID) }}" class="btn btn-primary">Download PDF</a>
       
        <input type="submit" name="uploadsignature" value="Upload Signature">
</form>   
        </div> 
    </div>
@endsection

 
	
	