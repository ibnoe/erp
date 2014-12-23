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
	
  	<h2 >Edit Expense Account</h2>
  	
 	 <hr>
 	 <div class="span-15">
 	  <?php if(count($records) > 0) { ?>
  <form autocomplete="off" class="myform" id="myForm" enctype="multipart/form-data" action="<?php echo base_url();?>accounts/expense_updated" method="post" name="myForm">
	 <?php foreach ($records as $rows){?>
		<label>Expense Name</label> 
		<input type="text" name="expense_name" value="<?php echo $rows['account_name']; ?>"/> <br>
		
		<input type="hidden" name="id" value="<?php echo $rows['id']; ?>"/>
		<button class="button" style="margin-left: 400px;">Submit</button>
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

	
        var validator = $("#myForm").validate({
            showErrors: function(errorMap, errorList) {
                $(".errormsg2").html($.map(errorList, function (el) {
                    return el.message;
                }).join(", "));
            },
            wrapper: "span",
            rules: {
            	
            	expense_name: "required",
            	
            },
            messages: {
            	
            	expense_name: "Enter Expense Name",
            	
                
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
								$("#loading").hide();	
								$(".result").html('Successfully Updated. Please wait, Redirecting...');
								$(".result").show();	
								$('#myForm').resetForm();
								$(".errormsg2").hide();
								window.setTimeout(function() {
								    window.location.href = '<?php echo base_url();?>accounts/expense_list';
								}, 2000);			
									
								
							} else if(responseText==2){
								$("#loading").hide();	
								$(".errormsg2").html('The Name of the Expense Already Exists!');
								$(".result").hide();
							}	else{
								$("#loading").hide();	
								$(".errormsg2").html(responseText);
								$(".result").hide();					
								}
							
						
				} 
					
				</script> 		
				

		
         
     
  </body> 
</html> 