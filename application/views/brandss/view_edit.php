 <?php if(count($records) > 0) { ?>
<div id="response" class="alert hide"></div>
<div class="col-md-6" >
  
   <form role="form" id="myForm" name="myForm" class="form-horizontal" enctype="multipart/form-data" action="" method="post" autocomplete="off" >
      <div class="form-group">
         <label class="col-md-4 control-label">Brand</label>
         <div class="col-md-5">
            <input type="text" class="form-control" name="brand_name" id="brand_name" value="<?php echo $records[0]['brand_name'];?>">
            <input type="hidden" name="brand_id" value="<?php echo $records[0]['brand_id'];?>" /> 
         </div>
      </div>
      <div class="form-group">
         <div class="col-sm-offset-4 col-sm-10">
            <button type="submit" class="btn btn-default" onClick="location.href = document.referrer;">Back</button>
            <button type="submit" class="btn btn-primary">Update</button>
         </div>
      </div>
   </form>
  
</div>
<div class="col-md-6" > 
   <span class="errormsg2" style="font-size:14px;color:red;"></span>
</div>
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
               
           	category_name: {required:true,
           	
               }
               
           },
           messages: {
            
           	category_name: {required: "Please Enter A Product Cateogry Name.",
           	
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
   	    window.location.href = '<?php echo base_url();?>brand/show';
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