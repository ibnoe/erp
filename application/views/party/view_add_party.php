<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"  "http://www.w3.org/TR/html4/strict.dtd"> 
<html lang="en"> 
<head> 
<?php $this->load->view('includes/head');?>
<!--Begining of Date Picker-->
	<link type="text/css" href="<?php echo base_url();?>support_admin/datepicker/css/jquery-ui-1.8.8.custom.css" rel="stylesheet" />
		<script type="text/javascript" src="<?php echo base_url();?>support_admin/datepicker/js/jquery-ui-1.8.20.custom.min.js"></script>
	
	<script>
	$(function() {
		$( "#datepicker1" ).datepicker({ changeMonth: true, changeYear: true,dateFormat: 'dd-mm-yy'});
		

		var myDate = new Date();
		var prettyDate = myDate.getDate() + '-' +(myDate.getMonth()+1) + '-' +  myDate.getFullYear();
		$("#datepicker1").val(prettyDate);
	});
	</script>	


  </head> 
  <body> 
  
<div class="row"> 
  
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
  	<h2 >Add New Party</h2>
 	 <hr>
   
    <div class="span-15">
  <form autocomplete="off" class="myform" id="myForm" enctype="multipart/form-data" action="<?php echo base_url();?>party/add_new_party" method="post" name="myForm">
	
		<label>Party Name</label>
		<input type="text" name="party_name" value=""  />  <br>
		<label>Party Contact Number</label>
		<input type="text" name="party_contact" value="" />  <br>
		<label>Party Begining Balance</label>
		<input type="text" name="begining_bal" value="" />  <br>
		<label>Opening Date</label>
		<input type="text" id="datepicker1" name="op_date"/> <br>			
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


<!-- Footer Ends -->  
      
      
    </div><!-- Container Ends -->
    <div class="row">
   <div id="footer" class="span-24">
<?php $this->load->view('includes/footer');?>
</div> 
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
        	party_name: "required",
           	party_contact: {
        		required:true,
        		number: true
      		 },
      		begining_bal: {
        		required:true,
        		number: true
      		 },
      		
      		           
        },
        messages: {
        	party_name: "Enter Party Name",
        	party_contact: "Enter Contact Number",
        	begining_bal: "Enter Begining Balance",
        	
        	           
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
							
								var options = {id: 'message_from_top',
		                                   position: 'bottom',
		                                   size: 70,
		                                   backgroundColor: '#0CA0CB',
		                                   delay: 3000,
		                                   speed: 500,
		                                   fontSize: '30px'
										   
		                                  };
								   $.showMessage("A New Party has been added!", options); 
									
									$('#myForm').resetForm();

								
							} if(responseText==2){
								
								$.showMessage("The Party Name Already Exists In Your Database");
							}	
						
				} 
					
				</script>     
  </body> 
</html> 