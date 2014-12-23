<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"  "http://www.w3.org/TR/html4/strict.dtd"> 
<html lang="en"> 
 <head> 
<?php $this->load->view('includes/head');?>
 
 
<!--Begining of Date Picker-->
	<link type="text/css" href="<?php echo base_url();?>support_admin/datepicker/css/jquery-ui-1.8.8.custom.css" rel="stylesheet" />
	<script type="text/javascript" src="<?php echo base_url();?>support_admin/datepicker/js/jquery-ui-1.8.20.custom.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>support_admin/js/jquery.validate.js"></script>
	
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
        	 quantity: {
         		required:true,
         		digits: true
       		 },
       		 price: {
          		required:true,
          		number: true
        		 },
        	unit_cost: {
            	required:true,
            	number: true
             },	 
        },
        messages: {
        	
        	category_id: "Select Category",
        	brand_id: "Select Brand",      
        	product_id: "Select Product",
        	quantity: {required: "Enter Quantity",
        		digits:"Incorrect Quantity"
    		},
    		price: {required: "Enter Unit Price",
        		number:"Incorrect Unit Price"
    		},

    		unit_cost: {required: "Enter Unit Cost",
        		number:"Incorrect Unit Cost"
    		},
        }
    });


 

    // validate signup form on keyup and submit
       var validator = $("#voucherform").validate({
           showErrors: function(errorMap, errorList) {
               $(".sales_errors").html($.map(errorList, function (el) {
                   return el.message;
               }).join(", "));
           },
           wrapper: "span",
           rules: {
           	
           	
           	purchase_date: "required",
           	"quantity[]": "required",
           	"rate[]": "required",
           	sales_invoice: {
                   required: true,
                   remote: {
                       url: '<?php echo base_url();?>sales/check_sales_voucher', async: false,
                       type: 'post'
                   }
               }
           	
           	
           },
           messages: {
           	
           	
           	purchase_date: "Enter Date",
           	"quantity[]": "Enter Quantity",
           	"rate[]": "Enter Price",
           	sales_invoice: {
                   required: "Enter Sales Invoice#",
                   remote: jQuery.format("Wrong Sales Invoice# Provided")
               },   
              	       
               
           }
       });
       
   
    
});

</script>

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
     	 url: "<?php echo base_url(); ?>purchase/get_brands_custom",
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
     	 url: "<?php echo base_url(); ?>purchase/get_products_custom",
     
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
	 
   
  	<h2>Sales Return</h2>
  	
  
  	
 	 <hr>
 	 <div class="span-3 colborder" >
 	   <form autocomplete="off" class="product_entry" id="myForm" enctype="multipart/form-data" action="<?php echo base_url();?>sales/sales_return_add_to_cart" method="post" name="myForm">
 	  
		
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
		
		<label>Quantity</label>
		<input type="text" name="quantity" id="quantity"  value="" size="10" /><br>
		<label>Sold Price</label>
		<input type="text" name="price" id="price"  value="" size="10" /><br>
		<label>Purchase Cost</label>
		<input type="text" name="unit_cost" id="unit_cost"  value="" size="10" /><br><br>				
		<button class="button" style="margin-left:1	px;">Add New Item</button><br><br>
		
         <span class="errormsg2" style="font-size:14px;color:red;"></span>
         <span class="message" style="font-size:14px;color:red;"></span>
		</form>
	 
 	 </div>
 	 
 	 <div class="span-20">
		<form autocomplete="off" class="sales" id="voucherform" name="voucherform" action="<?php echo base_url();?>sales/confirm_sales_return" method="post">

				
				<label style="margin-left:20px;">Date</label>
				<input readonly="readonly" id="datepicker1" name="return_date" value="" />
				<label  style="margin-left:20px;">Return Against Sales Invoice#</label>
				<input type="text" name="sales_invoice" id="sales_invoice"  value="" size="30" />
				
				 <span class="sales_errors" style="font-size:14px;color:red;"></span>
				
				 <br><br>
				<span class="result"></span>  
				
				<hr>
				<label>Product Serials To Return- Comma Seperated (Example:1001,1002,1003) </label><br>
				<textarea name="product_serials"></textarea>
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
							//target:        '#output1',   // target element(s) to be updated with server response 
						
							success:       showResponse  // post-submit callback 
					 				
						
						}; 
					 
						// bind form using 'ajaxForm' 
						$('#myForm').ajaxForm(options); 
					}); 
					
					// post-submit callback 
			function showResponse(responseText, statusText, xhr, $form)  { 
   
 						if(responseText=="2") {
						
 							$(".message").html('Product Not available in Stock');
 							$(".message").show();
 							
 						}	else if(responseText=="3"){
 							$(".message").html('Product already exists in the voucher');
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