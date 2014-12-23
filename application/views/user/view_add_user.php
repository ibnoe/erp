<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"  "http://www.w3.org/TR/html4/strict.dtd"> 
 <html lang="en"> 
  <head> 
<?php $this->load->view('includes/head');?> 
 		
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
  	<h2 >Add New User</h2>
 	 <hr>
   
    <div class="span-15">
  <form autocomplete="off" class="myform" id="myForm" enctype="multipart/form-data" action="<?php echo base_url();?>user/add_new_user" method="post" name="myForm">
	
		<label>Name</label>
		<input type="text" name="admin_name" value=""  />  <br>
		<label>Email / Login ID</label>
		<input type="text" name="admin_email" value="" />  <br>
		<label>Login Password</label>
		<input type="password" name="admin_password" value="" />  <br>
		<label>User Role</label>
		<?php 
			$options = array(
		     ''  => 'Select',
			 '1'    => 'Administrator',
			 '2'   => 'Manager',
			 '3'   => 'Sales Person',
			 );
			echo form_dropdown('level', $options, '','id="level"');?> <br>
		<label>Status</label>
		<?php 
			$options = array(
		     ''  => 'Select',
			 '1'    => 'Active',
			 '0'   => 'Inactive',
			 );
			echo form_dropdown('admin_status', $options, '','id="admin_status"');?> <br>
		 		
		
		<button class="button" style="margin-left: 400px;">Submit</button>		
				
	</form>
   
   
  	</div>
  
   <div class="span-8"">
		 <span class="result" style="font-size:14px;color:green;"></span>
         <span class="errormsg2" style="font-size:14px;color:red;"></span>
	
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
							
								var options = {id: 'message_from_top',
		                                   position: 'bottom',
		                                   size: 70,
		                                   backgroundColor: '#0CA0CB',
		                                   delay: 3000,
		                                   speed: 500,
		                                   fontSize: '30px'
										   
		                                  };
								   $.showMessage("A new User has been added!", options); 
									
									$('#myForm').resetForm();

								
							} if(responseText==2){
								
								$.showMessage("The Chosen Login ID Already In Use !");
							}	
							
						
				} 
					
				</script>     
  </body> 
</html> 