 <?php if(count($records) > 0) { ?>
<div id="response" class="alert hide"></div>
<div class="col-md-6" >
  
   <form role="form" id="myForm" name="myForm" class="form-horizontal" enctype="multipart/form-data" action="" method="post" autocomplete="off" >
      
      <div class="form-group">
         <label class="col-md-4 control-label">Category</label>
         <div class="col-md-5">
                <?php echo form_dropdown('category_id', $dropdown_category, $records[0]['category_id'], 'id="category_id" class="form-control"' ); ?>
         </div>
      </div>
      
      <div class="form-group">
         <label class="col-md-4 control-label">Brand</label>
         <div class="col-md-5">
         <?php 
				$brand = array( ''  => 'Select');
                echo form_dropdown('brand_id', $dropdown_brands,$records[0]['brand_id'], 'id="brand_id" class="form-control"' );  
            ?>
            		
         </div>
      </div>
      
      
      <div class="form-group">
         <label class="col-md-4 control-label">Product Name</label>
         <div class="col-md-5">          	
            <input type="text" class="form-control" id="product_item" name="product_item" value='<?php echo $records[0]['product_item'];?>'>	
         </div>
      </div>
       
      <div class="form-group">
         <label class="col-md-4 control-label">Selling Price</label>
         <div class="col-md-5">
          	<input type="text" class="form-control" name="selling_price" id="selling_price" value="<?php echo $records[0]['selling_price'] ; ?>">
            		
         </div>
      </div>
      
      
      <div class="form-group">
         <label class="col-md-4 control-label">Warranty</label>
         <div class="col-md-5">
           <?php 
				$warr = array(
                  ''  => 'Select',
				 '1'  => 'Yes',
				 '2'  => 'No',
                  );
                echo form_dropdown('warranty_product', $warr, $records[0]['warranty_product'], 'id="warranty_product" class="form-control"' );  
            ?>
            		
         </div>
      </div>      
      
      <input type="hidden" name="product_id" value='<?php echo $records[0]['product_id'];?>'>
      
      <div class="form-group">
         <div class="col-sm-offset-4 col-sm-10">
         	<button type="submit" class="btn btn-default" onClick="location.href = document.referrer;">Back</button>
            <button type="submit" class="btn btn-primary">Submit</button>
         </div>
      </div>
   </form>
  
</div>
<div class="col-md-6" > 
   <span class="errormsg2" style="font-size:14px;color:red;"></span>
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
        	product_item: "required",
            category_id: "required",
            brand_id: "required",
            warranty_product: "required",
            selling_price: {          		
          		number: true
        		 },
                       
        },
        messages: {
        	product_item: "Enter product name",
            category_id: "Select a category",
            brand_id: "Select a brand",
            warranty_product: "Does the product have warranty?",
            selling_price: {
        		number:"The selling price has to be a number"
    		},
            
            
        }
    });
});

</script>

<script type="text/javascript" src="<? echo base_url();?>support_admin/js/jquery.form.js"></script> <!-- This jquery.form.js is for Submitting form data using jquery and Ajax  -->
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
   
   if(responseText==1){
   
   	$("#response").removeClass("alert-danger") ;
       $("#response").html('Successfully Updated, Redirecting...').addClass('alert-success').removeClass("hide").hide().fadeIn("slow");
   	
   	
   	window.setTimeout(function() {
   	    window.location.href = '<?php echo base_url();?>product/show';
   	}, 2000);
   	
   } else{
   	 $("#response").removeClass("alert-success") ;
   	   $("#response").html('The information already exists').addClass('alert-danger').removeClass("hide").hide().fadeIn("slow");
   	    setTimeout(function() {
   	        $('#response').addClass('hide').fadeIn("slow");
   	    }, 3000);
   }	
   
   
   } 
   
</script> 		

 <?php  } else {echo "Sorry, No Records Found";}?>