@extends('layouts.app')

@section('content')
<br><br><br><br><br><br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
	  
     <div class="card card-login mx-auto mt-5" style="max-width: 65rem;">
  						   
      <div class="card-header text-center">Thank you</div>
      <div class="card-body">
 
 
                        
				Hello ,
				<p>congratulations !</p>
				<p>Your registration verification code send to this emailid : {{ session('EMAILID') }}       </p>
				<p>Please login to your email account and click the verification link. </p>

                                 
                            </div>
                        </div>
                         


                </div>
            </div>
    <?php

session()->forget('EMAILID');
session()->flush();
    ?>
  

@endsection