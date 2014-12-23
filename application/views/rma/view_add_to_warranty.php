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
		
		var myDate = new Date();
		var prettyDate = myDate.getDate() + '-' +(myDate.getMonth()+1) + '-' +  myDate.getFullYear();
		$("#datepicker1").val(prettyDate);
	});
	</script>	

<script>
$(document).ready(function() {

	$('#product_serial').focus();
	
    // validate signup form on keyup and submit
    var validator = $("#myForm").validate({
        showErrors: function(errorMap, errorList) {
            $(".errormsg2").html($.map(errorList, function (el) {
                return el.message;
            }).join(", "));
        },
        wrapper: "span",
        rules: {
        	      	
        	
        	
        },
        messages: {
        	product_serial: "Enter Product Serial",
        	         	       
            
        }
    });


 // validate signup form on keyup and submit
    var validator = $("#voucherform").validate({
        showErrors: function(errorMap, errorList) {
            $(".errormsg2").html($.map(errorList, function (el) {
                return el.message;
            }).join(", "));
        },
        wrapper: "span",
        rules: {
        	
        	customer_name: "required",
        	customer_contact: "required",
        	sold_date: "required",
        	
        	
        },
        messages: {
        	
        	
        	customer_name: "Enter Customer Name",
        	customer_contact: "Enter Customer Contact Number",
        	sold_date: "Enter Date",
           	       
            
        }
    });

	
   
    
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
	 
   
  	<h2>Warranty Claim</h2>
  	
 	 <hr>
 	 <div class="span-4 colborder" >
 	 
 	  <form autocomplete="off" class="product_entry" id="myForm" enctype="multipart/form-data" action="<?php echo base_url();?>rma/add_to_cart_warranty" method="post" name="myForm">
				
		<label>Product Serial</label>
		<input type="text" name="product_serial" id="product_serial" /> <br><br><br>
		
										
		<button class="button" style="margin-left:1	px;">Add New Item</button><br><br>
		
         <span class="errormsg2" style="font-size:14px;color:red;"></span>
         <span class="message" style="font-size:14px;color:red;"></span>
		
		
		</form>
	 
 	 </div>
 	 
 	 <div class="span-19">
		<form autocomplete="off" class="sales" id="voucherform" name="voucherform" action="<?php echo base_url();?>rma/confirm_warranty" method="post">

				
				<label style="margin-left:20px;">Date</label>
				<input readonly="readonly" id="datepicker1" name="sold_date" value="" />
				<label  style="margin-left:20px;">Customer Name</label>
				<input type="text" name="customer_name" id="customer_name"  value="" size="30" />
				<label  style="margin-left:20px;">Contact Number</label>
				<input type="text" name="customer_contact" id="customer_contact"  value="" size="30" />
				  
			
				
				 <br><br>
				<span class="result"></span>  
				
				</form>
	 </div>	
 
        
</div>
 <!-- End of Main Area/Content  --> 
         
 <!-- Footer --> 
<div id="footer" class="span-24">
<?php $this->load->view('includes/footer');?>
</div>
<!-- Footer Ends -->  
      
      
 </div>      
 <!-- Container Ends -->  
 


<script type="text/javascript" src="<? echo base_url();?>support_admin/js/jquery.form.js"></script> 
				<script type="text/javascript"> 

				   $(document).ready(function() { 
						var options = { 
													
							success:       showResponse  // post-submit callback 
					 				
						
						}; 
					 
						// bind form using 'ajaxForm' 
						$('#myForm').ajaxForm(options); 
					}); 
					
					// post-submit callback 
			function showResponse(responseText, statusText, xhr, $form)  { 
   						
 						if(responseText=="2") {
						
 							$(".message").html('Serial Number Not Found');
 							$(".message").show();
 							
 						}	else if(responseText=="3"){
 							$(".message").html('The Product Is Already On Warranty');
 							$(".message").show();
						} else{
							$(".result").html(responseText);
							$(".message").hide();
							$('#myForm').resetForm();		

														
							}
 							
				} 
					
				</script> 													
				       
     
  </body> 
</html> 