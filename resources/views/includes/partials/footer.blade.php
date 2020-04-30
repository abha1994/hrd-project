
<!-- Bootstrap 4 -->
<script src="{{ asset('public/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('public/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('public/dist/js/demo.js') }}"></script>
<script src="{{ asset('public/jquery-validation/dist/jquery.validate.js') }}"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<footer class="main-footer">
	  <div class="container">
		<div class="">
		   <img src="{{ URL::asset('public/assets/img/iconic_logo_v2.png')}}" style="height: 58px;width: 314px; margin-left: 33px;">
		   <small style="margin-left: 9%;">Designed & Developed by National Informatics Centre.</small>
		</div>
	  </div>
</footer>

<script>


 $(document).ready(function(){
	 <!----- Left Menu ------------>
 	 $('.has-treeview').each(function(e){
		if($(this).find("a").hasClass("active")){
			$(this).addClass("menu-open");
		}
	});
	<!--------------Left Menu----------->


 $('#datepicker_search_from').datepicker({
       autoclose: true,
  }).on("changeDate", function (e) {
	   $('#dt21').val('');
       $('#dt21').datepicker('setStartDate', e.date);
  });

  $('#dt21').datepicker({
	 autoclose: true,
  });
  
  
 <!------------Admin Panale select scheme_menu----------> 
 var value = $(".scheme_menu option:selected").val();
	$(".scheme_menu").change(function(){
		var changeValue = $(".scheme_menu option:selected").val();
		$.ajax({
				type: 'POST',
				url:"{{ route('session-menu') }}",
				data: {
					"_token": "{{ csrf_token() }}",
					"scheme_menu": changeValue
                },
			   success: function(data) {
				   
				   if(data == "3"){
					   window.location.replace('http://localhost/hrd/nref-home');
				   }else if(data == "1"){
					    window.location.href = "http://localhost/hrd/internship-home";
				   }else if(data == "2"){
					    window.location.href = "http://localhost/hrd/nres-home";
				   }
				   // location.reload();
			   }
            // }
		})
		
		sessionStorage.removeItem("scheme_menu");
	    sessionStorage.setItem('scheme_menu', changeValue);
		// location.reload();
	})	
	
 <!------------Admin Panale select scheme_menu----------> 
})
</script>