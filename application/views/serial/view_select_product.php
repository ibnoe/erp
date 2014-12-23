<div class="col-md-6" >
   <form role="form" id="myForm" name="myForm" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url();?>serial/show" method="post" autocomplete="off" >
      <div class="form-group">
         <label class="col-md-3 control-label">Category</label>
         <div class="col-md-6">
            <?php echo form_dropdown('category_id', $dropdown_category,'', 'id="category_id" class="form-control"' ); ?>
         </div>
      </div>
      <div class="form-group">
         <label class="col-md-3 control-label">Brand</label>
         <div class="col-md-6">
            <?php $brand = array(
               ''  => 'Select',
               );
               echo form_dropdown('brand_id', $brand,'', 'id="brand_id" class="form-control"' ); ?>
         </div>
      </div>
      <div class="form-group">
         <label class="col-md-3 control-label">Product</label>
         <div class="col-md-6">
            <?php 
               $product_id = array(
                             ''  => 'Select',
                             );
                echo form_dropdown('product_id', $product_id,'', 'id="product_id" class="form-control"' ); ?>
         </div>
      </div>
      <div class="form-group">
         <div class="col-sm-offset-3 col-sm-10">
            <button type="submit" class="btn btn-primary">Submit</button>
         </div>
      </div>
   </form>
</div>
<div class="span-6">
   <span class="result"></span>
   <span class="errormsg2"></span>
</div>
<script>
   $(function() {
       // validate signup form on keyup and submit
       var validator = $("#myForm").validate({
           showErrors: function(errorMap, errorList) {
               $(".errormsg2").html($.map(errorList, function (el) {
                   return el.message;
               }).join(", "));
           },
           wrapper: "span",
           rules: {
           	daterange1: "required",
           	daterange2: "required",
           	party_id: "required",
               
           },
           messages: {
           	daterange1: "Select from date",
           	daterange2: "Select to date",
           	party_id: "Select A Party",
               
               
           }
       });
   });
   
</script>			 
<script>
   $(function(){
   	
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
           	 
           },
           messages: {
           	
           	category_id: "Select Category",
           	brand_id: "Select Brand",      
           	product_id: "Select Product",
           	
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