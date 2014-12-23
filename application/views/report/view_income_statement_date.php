<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"  "http://www.w3.org/TR/html4/strict.dtd"> 
<html lang="en"> 
 <head> 
<?php $this->load->view('includes/head');?>

<!--Begining of Date Picker-->
	<link type="text/css" href="<?php echo base_url();?>support_admin/datepicker/css/jquery-ui-1.8.8.custom.css" rel="stylesheet" />
		<script type="text/javascript" src="<?php echo base_url();?>support_admin/datepicker/js/jquery-ui-1.8.20.custom.min.js"></script>
	
	<script>
	$(function() {
		$( "#datepicker1" ).datepicker({ changeMonth: true, changeYear: true,dateFormat: 'dd-mm-yy'});
		$( "#datepicker2" ).datepicker({ changeMonth: true, changeYear: true,dateFormat: 'dd-mm-yy'});
		
		var myDate = new Date();
		var prettyDate = myDate.getDate() + '-' +(myDate.getMonth()+1) + '-' +  myDate.getFullYear();
		$("#datepicker2").val(prettyDate);
	});
	</script>	
</head> 



  <body> 
  
      
<div class="container"> 
  
<!-- Headers Starts -->
	<div  id="header" class="column span-24">  
	<?php $this->load->view('includes/header');?>
 	</div>
 <!-- Headers Ends -->
	  
<!-- Navigation Start -->
	<div id="nav" class="span-24 last"> 
		<?php $this->load->view('includes/menu');?>
	</div>
 <!-- Navigation End -->
	 
 <!-- Main Area/Content Starts -->
    <div id="content" class="span-24"> 
	 
    <div class="prepend-1 append-1">
  	<h2 >Select Date Range</h2>
  	
 	 <hr>
 	 <div class="span-15">
 	 
 	 <form autocomplete="off" class="myform" id="myForm" enctype="multipart/form-data" action="<?php echo base_url();?>report/income_statement" method="post" name="myForm">
	
	<label>From</label>
		<input type="text" name="daterange1" value="" id="datepicker1" />  <br>
		<label>To</label>
		<input type="text" name="daterange2" value="" id="datepicker2" />  <br>
			
		
		<button class="button" style="margin-left: 400px;">Submit</button>			
				
	</form>

	 
 	 </div>
	 	
	 <div class="span-8">
		  <span class="result" style="font-size:14px;color:green;"></span>
         <span class="errormsg2" style="font-size:14px;color:red;"></span>
	 
	 </div>	
	 	
         
         
	</div>	
         
</div>
 <!-- End of Main Area/Content  --> 
         
 <!-- Footer --> 
<div id="footer" class="span-24">
<?php $this->load->view('includes/footer');?>
</div>
<!-- Footer Ends -->  
 
<script>
$(document).ready(function() {
    // validate signup form on keyup and submit
    var validator = $("#myForm").validate({
        showErrors: function(errorMap, errorList) {
            $(".errormsg2").html($.map(errorList, function (el) {
                return el.message;
            }).join(", "));
        },
        wrapper: "span",
        rules: {
        
        	daterange2: "required",
        	
            
        },
        messages: {
        	
        	daterange2: "Select End date",
        	
            
            
        }
    });
});

</script>		     
      
 </div>      


  </body> 
</html> 