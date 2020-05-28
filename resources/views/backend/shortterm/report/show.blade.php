@extends('layouts.master')
@section('container')
<style type="text/css">

.txt {

    background-color: #17a2b8!important;
    color: white;

}

.lnk {
text-align:center !important;
}
  </style>

<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb" >
        <li class="breadcrumb-item">
           <a href="{{ url('home')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Upload Course And Practical Content</li>
      </ol>

  <div class="card card-login mx-auto mt-5 " style="">     
      
        <div class="container-fluid border-top bg-white card-footer text-muted text-left " id="app">        
    <table id="example1" class="table table-bordered " role="grid" aria-describedby="example1_info">
        <tbody>

          <tr>
           <td class="txt lnk">Item</td>
           <td class="txt lnk">Content View</td>
           <td class="txt lnk">Download</td>

          </tr>
          
		   <tr>
            <td class="lnk">Course Content</td>
            <td class="lnk"><a href="<?php echo URL::asset('public/uploads/upload/course/'.$data->course_content_doc);?>"  target="__blank" ><i class="fa fa-eye"></i></a></td>
             <td class="lnk"><a href="{{ URL::route('download-package',[1]) }}" >Click to Download</a></td>
          </tr>
		   <tr>
            <td class="lnk">Padaggogy</td>
            <td class="lnk"><a href="<?php echo URL::asset('public/uploads/upload/padaggogy/'.$data->padaggogy_doc);?>" target="__blank" ><i class="fa fa-eye"></i></a></td>
             <td class="lnk"><a href="{{ URL::route('download-package',[2]) }}"  >Click to Download</a></td>
          </tr>
           <tr>
            <td class="lnk">Practical Content</td>
            <td class="lnk"><a href="<?php echo URL::asset('public/uploads/upload/practical/'.$data->practical_content_doc);?>" target="__blank" ><i class="fa fa-eye"></i></a></td>
             <td class="lnk"><a href="{{ URL::route('download-package',[3]) }}" >Click to Download</a></td>
          </tr>
         
        </tbody>
      </table>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
			<a class="btn btn-secondary" href=""><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Cancel</a>
			</div>
        </div>
        </div> 
    </div></div>
<!--     <script src="{{ asset('js/app.js') }}"></script>  -->

@endsection

