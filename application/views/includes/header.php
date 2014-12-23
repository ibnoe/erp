<?php     
   header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
   header("Cache-Control: no-store, no-cache, must-revalidate");
   ?> 
<!DOCTYPE html>
<html>
   <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>POS:: Software</title>
      <link rel="shortcut icon" href="<?php echo base_url();?>support_admin/images/fav.ico" />
      
      <link rel="stylesheet" href="<?php echo base_url();?>support_admin/bootstrap/style.css" type="text/css" media="screen, projection">
      <link rel="stylesheet" href="<?php echo base_url();?>support_admin/dataTable/dataTables.bootstrap.css" type="text/css" media="screen, projection">      
      
      <script type="text/javascript" src="<?php echo base_url();?>support_admin/js/jquery-1.7.1.min.js"></script>
      <script type="text/javascript" language="javascript" src="<?php echo base_url();?>support_admin/dataTable/jquery.dataTables.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url();?>support_admin/dataTable/dataTables.bootstrap.js"></script>
      <script type="text/javascript" src="<?php echo base_url();?>support_admin/js/jquery.slidingmessage.min.js"></script>
      
      <script type="text/javascript" src="<?php echo base_url();?>support_admin/js/jquery.validate.js"></script>	 
      <script type="text/javascript" src="<?php echo base_url();?>support_admin/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url();?>support_admin/js/bootstrap3-typeahead.js"></script>
      <script type="text/javascript" src="<?php echo base_url();?>support_admin/js/jquery.form.min.js"></script>
      
      <link type="text/css" href="<?php echo base_url();?>support_admin/datepicker/jquery-ui-1.8.8.custom.css" rel="stylesheet" />
	  <script type="text/javascript" src="<?php echo base_url();?>support_admin/datepicker/jquery-ui-1.8.20.custom.min.js"></script>
	  <script type="text/javascript" src="<?php echo base_url();?>support_admin/js/jquery.validate.js"></script>
      
      
      <script>
	$(function() {
		$('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
			// Avoid following the href location when clicking
			event.preventDefault(); 
			// Avoid having the menu to close when clicking
			event.stopPropagation(); 
			// If a menu is already open we close it
			//$('ul.dropdown-menu [data-toggle=dropdown]').parent().removeClass('open');
			// opening the one you clicked on
			$(this).parent().addClass('open');
		
			var menu = $(this).parent().find("ul");
			var menupos = menu.offset();
		  
			if ((menupos.left + menu.width()) + 30 > $(window).width()) {
				var newpos = - menu.width();      
			} else {
				var newpos = $(this).parent().width();
			}
			menu.css({ left:newpos });
		
		});
	});


	$(function() {

		
		$('#gtable').dataTable( {
			//"sScrollY": "350px",
			"bScrollCollapse": true,
			"bPaginate": true,
			"bJQueryUI": false,
			"aoColumnDefs": [
				{ "sWidth": "10%", "aTargets": [ -1 ] }
			],
			"bInfo": false
		} );

		
	});

	
</script>
      
      
    <!--Begining of Date Picker-->
	
	
	<script>
	$(function() {
		$( "#datepicker1" ).datepicker({ changeMonth: true, changeYear: true,dateFormat: 'dd-mm-yy'});
		$( "#datepicker2" ).datepicker({ changeMonth: true, changeYear: true,dateFormat: 'dd-mm-yy'});

		var myDate = new Date();
		var prettyDate = myDate.getDate() + '-' +(myDate.getMonth()+1) + '-' +  myDate.getFullYear();
		$("#datepicker1").val(prettyDate);
		
	});
	</script>
   	
      							  
      
   </head>
   <body>
      <div id="wrap">
      <div style="padding:0 15px;">
      
      
      <!-- Header -->
      <div class="row" style="background-color:#614789; height:65px;">
      <div class="container">
         <!-- School Name -->
         <div class="col-md-6">
            <h3 style="color:#FFF;"> PC Carnival</h3>
         </div>
         <!-- End of School Name -->
         
         <!-- Begining of User Information -->
         <div class="col-md-3 pull-right">            
            <div style="text-align:right; margin-top:20px; color:white;">
               Welcome, <?php echo $this->authex->get_user_name() ;?>
               <a style="color:white; text-decoration:none;" href="<?php echo base_url();?>auth/logout" title="logout">Logout</a>
            </div>
         </div>   
         <!-- End of User Information -->	
         
      </div>
      </div>
      <!-- Header -->