<div id="response" class="alert hide"></div>
<div class="col-md-6" >
   <form role="form" id="myForm" name="myForm" class="form-horizontal" enctype="multipart/form-data" action="" method="post" autocomplete="off" >
      <div class="form-group">
         <label class="col-md-4 control-label">Brand Name</label>
         <div class="col-md-5">
            <input type="text" class="form-control" name="brand_name" id="brand_name">
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
   <span class="result" style="font-size:14px;color:green;"></span>
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
	        	brand_name: "required",	        	
	        	
	        },
	        messages: {
	        	
	        	brand_name: "Enter A Brand Name",         
	            
	        }
	    });
   });
   
</script>

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