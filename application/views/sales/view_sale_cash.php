<div id="response" class="alert hide"></div>
<!-- Colmun 1 -->
<div class="col-md-3">
   <form role="form" id="myForm" name="myForm" class="" enctype="multipart/form-data" action="<?php echo base_url();?>sales/add_to_cart_cash" method="post" autocomplete="off" >
      <input type="text" name="product_serial" id="product_serial" class="form-control"  placeholder="Product Serial"/> <br>
      <div class="checkbox">
         <label>
         <input type="checkbox" name="without_serial" id="without_serial" value="1" > Without Serial
         </label>
      </div>
      <hr>
      <?php echo form_dropdown('category_id', $dropdown_category,'', 'id="category_id" class="form-control"' ); ?> <br>
      <?php 
         $brand = array(
                         ''  => 'Select',
                         );
         echo form_dropdown('brand_id', $brand,'', 'id="brand_id" class="form-control"' ); ?> <br>
      <label>Product Item</label> 
      <?php 
         $product_id = array(
                         ''  => 'Select',
                         );
         
         echo form_dropdown('product_id', $product_id,'', 'id="product_id" class="form-control"' ); ?> <br>
      <label>Quantity</label>
      <input type="text" name="quantity" id="quantity"  value="" size="10" class="form-control" /><br><br>
      <button type="submit" class="btn btn-primary">Add Item</button>
      <br> <br>
      <p>
         <span class="errormsg2"></span>
         <span class="message"></span>
      </p>
   </form>
</div>
<!-- End of Colmun 1 -->
<!-- Colmun 2 -->
<div class="col-md-9">
   <form class="form-inline" role="form" autocomplete="off" class="" id="voucherform" name="voucherform" action="<?php echo base_url();?>sales/confirm_cash_sales" method="post">
      <div class="form-group">
         <input type="text" size="10"  class="form-control" id="datepicker1"  name="sold_date" value="" />
      </div>
      <div class="form-group">			  
         <input type="text" name="customer_name" id="customer_name"  value="" class="form-control" placeholder="Customer Name"/>
      </div>
      <div class="form-group">			  
         <input type="text" name="customer_contact" id="customer_contact"  value="" class="form-control" placeholder="Contact"/>
      </div>
      <br><br>
      <span class="result"></span>  
   </form>
</div>
<!-- End of Column 2 --> 
<script>
   $(function(){
   
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
           	category_id: "Select Category",
           	brand_id: "Select Brand",      
           	product_id: "Select Product",
           	quantity: {required: "Enter Quantity",
           		digits:"Incorrect Quantity"
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
           	sold_date: "required",
           	
           	
           },
           messages: {
           	
           	
           	customer_name: "Enter Customer Name",
           	customer_contact: "Enter Customer Contact Number",
           	sold_date: "Enter Date",
              	       
               
           }
       });
   
   	// Product 
     $("#category_id").val("");
   	 $("#category_id").prop('disabled', true);
   	 $("#brand_id").val("");
   	 $("#brand_id").prop('disabled', true);
   	 $("#product_id").val("");
   	 $("#product_id").prop('disabled', true);
   	 $("#quantity").val("");
   	 $("#quantity").prop('disabled', true);
   
     $('#without_serial').change(function() {
   
       	 if ($(this).is(':checked')) {
   
       		 $("#product_serial").val("");
       		 $("#product_serial").prop('disabled', true);
     		 // Making it not required field
     		 $("#product_serial").removeClass("required");
     			
           	 $("#category_id").prop('disabled', false);
           	 $("#brand_id").prop('disabled', false);
           	 $("#product_id").prop('disabled', false);
           	 $("#quantity").prop('disabled', false);
   
    			// Making it required field
           	 $("#category_id").addClass("required");
           	 $("#brand_id").addClass("required");
           	 $("#product_id").addClass("required");
           	 $("#quantity").addClass("required digits");	
                
            } else {
   
    			$("#product_serial").prop('disabled', false);	
           	 // Making it required field
           	 	$("#product_serial").addClass("required");
           	 
       		 $("#category_id").val("");
       		 $("#category_id").prop('disabled', true);
       		 $("#brand_id").val("");
       		 $("#brand_id").prop('disabled', true);
       		 $("#product_id").val("");
       		 $("#product_id").prop('disabled', true);
       		 $("#quantity").val("");
       		 $("#quantity").prop('disabled', true);
       		 
       		// Making it not required field
     			 $("#category_id").removeClass("required");
     			 $("#brand_id").removeClass("required");
     			 $("#product_id").removeClass("required");
     			 $("#quantity").removeClass("required digits");
           	 
            } // end of else
               
   
           
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
     	 url: "<?php echo base_url(); ?>common/get_brands_custom",
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
 $(function(){ 
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
     	 url: "<?php echo base_url(); ?>common/get_products_custom",
     
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
<script type="text/javascript"> 
$(function(){
   var options = { 
   //target:        '#output1',   // target element(s) to be updated with server response 
   
   success:       showResponse  // post-submit callback 
   			
   
   }; 
   
   // bind form using 'ajaxForm' 
   $('#myForm').ajaxForm(options); 
   }); 
   
   // post-submit callback 
   function showResponse(responseText, statusText, xhr, $form)  { 
   		
   if(responseText=="2") 
   {

	   $("#response").removeClass("alert-success") ;
	   $("#response").html('The product is not available in stock').addClass('alert-danger').removeClass("hide").hide().fadeIn("slow");
	     setTimeout(function() {
	         $('#response').addClass('hide').fadeIn("slow");
	     }, 3000);
   
   
   	
   }	
   else if(responseText=="3")
   {
   	
      $("#response").removeClass("alert-success") ;
	   $("#response").html('The product is already in the cart').addClass('alert-danger').removeClass("hide").hide().fadeIn("slow");
	     setTimeout(function() {
	         $('#response').addClass('hide').fadeIn("slow");
	     }, 3000);
   } 
   else
   {
   $(".result").html(responseText);
   $(".message").hide();
   $('#myForm').resetForm();		
   
   $("#product_serial").prop('disabled', false);	
        	 // Making it required field
        	 	$("#product_serial").addClass("required");
        	 
    		 $("#category_id").val("");
    		 $("#category_id").prop('disabled', true);
    		 $("#brand_id").val("");
    		 $("#brand_id").prop('disabled', true);
    		 $("#product_id").val("");
    		 $("#product_id").prop('disabled', true);
    		 $("#quantity").val("");
    		 $("#quantity").prop('disabled', true);
    		 
    		// Making it not required field
   		 $("#category_id").removeClass("required");
   		 $("#brand_id").removeClass("required");
   		 $("#product_id").removeClass("required");
   		 $("#quantity").removeClass("required digits");
   
   
   }
   	
   } 
   
</script>