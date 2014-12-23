<div id="response" class="alert hide"></div>
<div class="col-md-6" >
   <form role="form" id="myForm" name="myForm" class="form-horizontal" enctype="multipart/form-data" action="" method="post" autocomplete="off" >
      <div class="form-group">
         <label class="col-md-4 control-label">Product Category</label>
         <div class="col-md-5">
            <input type="text" class="form-control" name="category_name" id="category_name">
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
           	category_name: "required",
           	
           	category_code: "required",
           },
           messages: {
           	
           	category_name: "Enter A Category Name",
           	
           	category_code: "Enter A Category code",
            
               
           }
       });
   });
   
</script>
<script type="text/javascript" src="<? echo base_url();?>support_admin/js/jquery.form.js"></script>
<script type="text/javascript"> 
$(function () {
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