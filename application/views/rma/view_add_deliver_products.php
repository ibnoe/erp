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
        	category_id: "required",
        	brand_id: "required",
        	product_id: "required",
        	product_serial: "required",
        	delivery_serial:"required",
        	acc_rec: {
           		required:true,
           		number: true
         	 },
         	acc_pay: {
               		required:true,
               		number: true
            },	 
        },
        messages: {
        	
        	category_id: "Select Category",
        	brand_id: "Select Brand",      
        	product_id: "Select Product",
        	product_serial: "Enter Product Serial",
        	delivery_serial: "Enter Delivery Product's Serial",
        	acc_rec: {required: "Enter A/R",
        		number:"Incorrect A/R Price"
    		},
    		acc_pay: {required: "Enter A/P",
        		number:"Incorrect A/P Price"
    		},
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
        	delivery_date: "required",
        	
        	
        },
        messages: {
        	
        	
        	customer_name: "Enter Customer Name",
        	customer_contact: "Enter Customer Contact Number",
        	delivery_date: "Enter Date",
           	       
            
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
	 
   
  	<h2>Delivery Warranty Products</h2>
  	
 	 <hr>
 	 <div class="span-4 colborder" >
 	 
 	  <form autocomplete="off" class="product_entry" id="myForm" enctype="multipart/form-data" action="<?php echo base_url();?>rma/add_to_cart_delivery" method="post" name="myForm">
				
		<label>Product Serial</label>
		<input type="text" name="product_serial" id="product_serial" /> <br>
		
		<div><b>Replace With</b></div>
		<label>Category</label> 
		<?php echo form_dropdown('category_id', $dropdown_category,'', 'id="category_id"' ); ?> <br>
		<label>Brand</label> 
		<?php 
		$brand = array(
                  ''  => 'Select',
                  );
		echo form_dropdown('brand_id', $brand,'', 'id="brand_id"' ); ?> <br>
		<label>Product Item</label> 
		<?php 
		$product_id = array(
                  ''  => 'Select',
                  );
		
		echo form_dropdown('product_id', $product_id,'', 'id="product_id"' ); ?> <br>
		<label>Delivery Serial</label>
		<input type="text" name="delivery_serial" id="delivery_serial" /> <br>
		<label>A/R</label>
		<input type="text" name="acc_rec" id="acc_rec" /> <br>
		<label>A/P</label>
		<input type="text" name="acc_pay" id="acc_pay" /> <br>
				
		<br>
		
										
		<button class="button" style="margin-left:1	px;">Add New Item</button><br><br>
		
         <span class="errormsg2" style="font-size:14px;color:red;"></span>
         <span class="message" style="font-size:14px;color:red;"></span>
		
		
		</form>
	 
 	 </div>
 	 
 	 <div class="span-19">
		<form autocomplete="off" class="sales" id="voucherform" name="voucherform" action="<?php echo base_url();?>rma/confirm_product_delivery" method="post">

				
				<label style="margin-left:20px;">Date</label>
				<input readonly="readonly" id="datepicker1" name="delivery_date" value="" />
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

<script  type="text/javascript">
   $(function(){ // added
	   $('#category_id').change(function(){
    				var a_href = $(this).val(); 
    				

    	if(a_href==""){

    		$("#brand_id").html("<option value=''>Select</option>");
    		$("#product_id").html("<option value=''>Select</option>");
    		
        	
    	}
    	else {			
  //Do stuff
 		   	    	    				
  		 $.ajax({
   	        
     	 type: "POST",
     	 url: "<?php echo base_url(); ?>rma/get_serial_brands",
     	data: "category_id="+a_href,
     	 success: function(server_response){

     		$("#brand_id").html(server_response);

     		$("#product_id").html("<option value=''>Select</option>");
     					  
     	 	}
										   		
			});	//$.ajax ends here

    	}//if else		
    						return false
	});//.click function ends here


		
}); // function ends here														   
      	
 </script>
 
 <script  type="text/javascript">
   $(function(){ // added
	   $('#brand_id').change(function(){
    				var b_href = $(this).val();
    				var a_href = $('#category_id').val(); 

    	if(b_href==""){

    		
        	$("#product_id").html("<option value=''>Select</option>");


    	}
    	else {			
  //Do stuff
   	    	    				
  		 $.ajax({
   	        
     	 type: "POST",
     	 url: "<?php echo base_url(); ?>rma/get_serial_products",
     
     	data: {category_id: a_href, brand_id: b_href}, 
     	 success: function(server_response){

     		$("#product_id").html(server_response);
     		
     					  
     	 	}
										   		
			});	//$.ajax ends here

    	}//if else		
    						return false
	});//.click function ends here


		
}); // function ends here														   
      	
 </script> 


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
   						
 						if(responseText=="3") {
						
 							$(".message").html('Could not find the product in warrany list');
 							$(".message").show();
 							
 						}	else{
							$(".result").html(responseText);
							$(".message").hide();
							$('#myForm').resetForm();		

														
							}
 							
				} 
					
				</script> 													
				       
     
  </body> 
</html> 