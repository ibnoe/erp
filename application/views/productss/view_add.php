<div id="response" class="alert hide"></div>
<div class="col-md-6" >
   <form role="form" id="myForm" name="myForm" class="form-horizontal" enctype="multipart/form-data" action="" method="post" autocomplete="off" >
      
      <div class="form-group">
         <label class="col-md-4 control-label">Category</label>
         <div class="col-md-5">
                <?php echo form_dropdown('category_id', $dropdown_category,'', 'id="category_id" class="form-control"' ); ?>
         </div>
      </div>
      
      <div class="form-group">
         <label class="col-md-4 control-label">Brand</label>
         <div class="col-md-5">
         <?php 
				$brand = array( ''  => 'Select');
                echo form_dropdown('brand_id', $dropdown_brands,'', 'id="brand_id" class="form-control"' );  
            ?>
            		
         </div>
      </div>
      
      
      <div class="form-group">
         <label class="col-md-4 control-label">Product Name</label>
         <div class="col-md-5">
          	<input type="text" class="form-control" name="product_item" id="product_item">
            		
         </div>
      </div>
      
      <div class="form-group">
         <label class="col-md-4 control-label">Selling Price</label>
         <div class="col-md-5">
          	<input type="text" class="form-control" name="selling_price" id="selling_price">
            		
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
                echo form_dropdown('warranty_product', $warr,'', 'id="warranty_product" class="form-control"' );  
            ?>
            		
         </div>
      </div>      
      
      
      <div class="form-group">
         <div class="col-sm-offset-4 col-sm-10">
            <button type="submit" class="btn btn-primary">Submit</button>
         </div>
      </div>
   </form>
</div>


<div class="col-md-6" >  	
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
<script type="text/javascript" src="<? echo base_url();?>support_admin/js/jquery.form.js"></script>
<script type="text/javascript"> 
   $(document).ready(function() { 
   var options = { 
   //target:        '#output1',   // target element(s) to be updated with server response 
   
   success:       showResponse  // post-submit callback 
   			
   
   // type:      type       
   //dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
   //clearForm: true        // clear all form fields after successful submit 
   //resetForm: true        // reset the form after successful submit 
   
   // $.ajax options can be used here too, for example: 
   //timeout:   3000 
   }; 
   
   // bind form using 'ajaxForm' 
   $('#myForm').ajaxForm(options); 
   }); 
   
   // post-submit callback 
   function showResponse(responseText, statusText, xhr, $form)  { 
   
   if(responseText==1){
   
    $('#myForm').resetForm();
    $("#response").removeClass("alert-danger") ;
     $("#response").html('Successfully Added').addClass('alert-success').removeClass("hide").hide().fadeIn("slow");
     setTimeout(function() {
         $('#response').addClass('hide').fadeIn("slow");
     }, 3000); 
   	
   		   	
   	
   } else{
    $("#response").removeClass("alert-success") ;
    $("#response").html('The information already exists').addClass('alert-danger').removeClass("hide").hide().fadeIn("slow");
     setTimeout(function() {
         $('#response').addClass('hide').fadeIn("slow");
     }, 3000); 
   	 
   }	
   
   
   } 
   
</script>