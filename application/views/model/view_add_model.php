<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"  "http://www.w3.org/TR/html4/strict.dtd"> 
<html lang="en"> 
<head> 
<?php $this->load->view('includes/head');?>

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
  	<h2 >Create New Model</h2>
 	 <hr>
   
    <div class="span-15">
  <form autocomplete="off" class="myform" id="myForm" enctype="multipart/form-data" action="<?php echo base_url();?>model/added" method="post" name="myForm">
		<label>Category</label> 
		<?php echo form_dropdown('category_id', $dropdown_category,'', 'id="category_id"' ); ?> <br>
		<label>Sub Category</label> 
		<?php 
		$sub_category_id = array(
                  ''  => 'Select',
                  );

			echo form_dropdown('sub_category_id', $sub_category_id,'', 'id="sub_category_id"' );

		?>
		<br>
		<label>Brand</label> 
		<?php echo form_dropdown('brand_id', $dropdown_brands,'', 'id="brand_id"' ); ?> <br>
		
		<label>Model</label>
		<input type="text" name="model_name" value="" id="model_name" />  <br>
			
				
		<button class="button" style="margin-left: 400px;">Submit</button>		
				
	</form>
   
   
  	</div>
  
   <div class="span-8">
		 <span class="result" style="font-size:14px;color:green;"></span>
         <span class="errormsg2" style="font-size:14px;color:red;"></span>
	
	 </div>	
     
     </div>
        
  
                 
 	</div>
 <!-- End of Main Area/Content  -->      
  
 <!-- Footer --> 
<div id="footer" class="span-23">
<?php $this->load->view('includes/footer');?>
</div>
<!-- Footer Ends -->  
      
      
    </div><!-- Container Ends -->
<script  type="text/javascript">
   $(function(){ // added
	   $('#category_id').change(function(){
    				var a_href = $(this).val(); 
    				

    	if(a_href==""){

    		$("#sub_category_id").html("<option value=''>Select</option>");
        	
    	}
    	else {			
  //Do stuff
 		   	    	    				
  		 $.ajax({
   	        
     	 type: "POST",
     	 url: "<?php echo base_url(); ?>model/sub_category_custom",
     	data: "category_id="+a_href,
     	 success: function(server_response){

     		$("#sub_category_id").html(server_response);
     		
     					  
     	 	}
										   		
			});	//$.ajax ends here

    	}//if else		
    						return false
	});//.click function ends here


		
}); // function ends here														   
      	
 </script>
    
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
        	model_name: "required",
        	sub_category_id: "required",
            category_id: "required",
            brand_id: "required",
          
            
        },
        messages: {
        	model_name: "Enter A Model Name",
        	sub_category_id: "Select A Sub Category",
            category_id: "Select A Category",
            brand_id: "Select A Brand",
           
            
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
								$(".errormsg2").html("");	
								 var options = {id: 'message_from_top',
		                                   position: 'bottom',
		                                   size: 70,
		                                   backgroundColor: '#0CA0CB',
		                                   delay: 3000,
		                                   speed: 500,
		                                   fontSize: '30px'
										   
		                                  };
		                                   
		                    $.showMessage("A new Model has been added!", options); 

		                    $('#myForm').resetForm();
							
							} else {
								
								$.showMessage("The provided model name/code already exists!");
							}	
							
						
				} 
					
				</script>     
  </body> 
</html> 