<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"  "http://www.w3.org/TR/html4/strict.dtd"> 
<html lang="en"> 
<head> 
<?php $this->load->view('includes/head');?>
</head>
 
<body> 
      
<div class="container"> 
  
<!-- Headers Starts -->
	<div  id="header" class="column span-24">  
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
	 
   
  	<h2 >Edit Party</h2>
 	 <hr>
 	 <div class="span-15">
 	 <?php if(count($records) > 0) { ?>
 	  <form autocomplete="off" class="myform" id="myForm" enctype="multipart/form-data" action="<?php echo base_url();?>party/party_updated" method="post" name="myForm">
		 <?php foreach ($records as $rows){?>
		 <label>Party Name</label>
		<input type="text" name="party_name" value="<?php echo $rows['party_name'];?>"  />  <br>
		<label>Party Contact Number</label>
		<input type="text" name="party_contact" value="<?php echo $rows['party_contact'];?>" />  <br>
		 
		<input type="hidden" name="party_id" value="<?php echo $rows['party_id'];?>" />  <br>

		<button class="button1" style="margin-left: 310px;" onClick="location.href = document.referrer;">Back</button>
		<button class="button" style="margin-left: 10px;">Update</button>
		 <?php  } ?>
		</form>
	
	 <?php  } else {echo "Sorry, No Records Found";}?>
 	 </div>
	 	
	 <div class="span-8">
		 <span class="result" style="font-size:14px;color:green;"></span>
         <span class="errormsg2" style="font-size:14px;color:red;"></span>
	 
	 </div>	
	      
         
         
</div>
 <!-- End of Main Area/Content  --> 
         
 <!-- Footer --> 
<div id="footer" class="span-24">
<?php $this->load->view('includes/footer');?>
</div>
<!-- Footer Ends -->  
      
      
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
      		           
        },
        messages: {
        	party_name: "Enter Party Name",
        	party_contact: "Enter Contact Number",
        	           
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
								$(".errormsg2").html("");
								$(".result").html('Successfully updated. Please Wait, Redirecting...');
								
								
								window.setTimeout(function() {
								    window.location.href = '<?php echo base_url();?>party/party_list';
								}, 2000);
								
							} if(responseText==2){
								$.showMessage("The Party Name Already Exists In Your Database");
								$(".result").html("");
							}	
							
						
				} 
					
				</script>    
     
  </body> 
</html> 