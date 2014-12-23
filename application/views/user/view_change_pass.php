<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"  "http://www.w3.org/TR/html4/strict.dtd"> 
<html lang="en"> 
<head> 
<?php $this->load->view('includes/head');?>



<script type="text/javascript" src="<?php echo base_url();?>support_admin/js/jquery.validate.js"></script>
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
        	admin_name: "required",
        	admin_password: "required",
        	admin_email: {
        		required:true,
        		email: true
      		 },
      		admin_status: "required",
      		level: "required",
      	
            
        },
        messages: {
        	admin_name: "Enter A Name",
        	admin_password: "Enter Password",
        	admin_email: {required: "Enter Email",
				email:"Incorrect Email"
    		},
    		admin_status: "Select User's Status",
    		level: "Select User's Level",
    		
           
            
        }
    });
});

</script>		
				

  </head> 
  <body> 
  
<div class="container"> 
  
<!-- Headers Starts -->
	<div  id="header" class="span-24">  
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
	  <div class="prepend-1 append-1">
  	<h2 >Change Password</h2>
 	 <hr>
   
    <div class="span-15">
  <form autocomplete="off" class="myform" id="myForm" enctype="multipart/form-data" action="<?php echo base_url();?>user/password" method="post" name="myForm">
	
		
		<label>Current Password</label>
		<input type="password" name="curr_password" value="" /> <br>
		<label>New Password</label>
		<input type="password" name="new_password" value="" />  <br>
				 		
		
		<button class="button" style="margin-left: 400px;">Submit</button>		
				
	</form>
   
   
  	</div>
  
   <div class="span-8"">
		 <span class="result" style="font-size:14px;color:green;"></span>
         <span class="errormsg2" style="font-size:14px;color:red;"></span>
	 <div id="loading" style="display:none;"><img src="<?php echo base_url();?>support_admin/images/ajax-loader.gif"></div>
	 </div>	
     
     </div>
        
  
                 
 	</div>
 <!-- End of Main Area/Content  -->      
     
   <!-- Footer --> 
<div id="footer" class="span-24">
<?php $this->load->view('includes/footer');?>
</div>
<!-- Footer Ends -->  
      
      
    </div><!-- Container Ends -->
<script type="text/javascript" src="<? echo base_url();?>support_admin/js/jquery.form.js"></script> <!-- This jquery.form.js is for Submitting form data using jquery and Ajax  -->
				<script type="text/javascript"> 

				   $(document).ready(function() { 
						var options = { 
							//target:        '#output1',   // target element(s) to be updated with server response 
							beforeSubmit:  showRequest,
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
		function showRequest(){

			$("#loading").show();	

		}

				// post-submit callback 
			function showResponse(responseText, statusText, xhr, $form)  { 

							if(responseText==1){
								$("#loading").hide();	
								var options = {id: 'message_from_top',
		                                   position: 'bottom',
		                                   size: 70,
		                                   backgroundColor: '#0CA0CB',
		                                   delay: 3000,
		                                   speed: 500,
		                                   fontSize: '30px'
										   
		                                  };
								   $.showMessage("Successfully Updated!", options); 
									
									$('#myForm').resetForm();

								
							} if(responseText==2){
								$("#loading").hide();	
								$.showMessage("Current password didn't match");
							}	
							
						
				} 
					
				</script>     
  </body> 
</html> 