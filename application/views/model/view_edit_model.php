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
  	<h2 >Edit Model</h2>
 	 <hr>
   
    <div class="span-15">
    <?php if(count($records) > 0) { ?>
  <form autocomplete="off" class="myform" id="myForm" enctype="multipart/form-data" action="<?php echo base_url();?>model/model_updated" method="post" name="myForm">
	 <?php foreach ($records as $rows){?>
		
		<label>Category Name</label> 
		<?php echo form_dropdown('category_id', $dropdown_category,$rows['category_id'], 'id="category_id"' ); ?> <br>
		<label>Sub Category</label> 
		<?php 
		$sub_category_id = array(
                  ''  => 'Select',
                  );

			echo form_dropdown('sub_category_id', $sub_category_id,'', 'id="sub_category_id"' );

		?>
		<input type="hidden" name="sub_cat" id="sub_cat" value="<?php echo $rows['sub_category_id'];?>" />
		<br>
		<label>Brand Name</label> 
		<?php echo form_dropdown('brand_id', $dropdown_brands,$rows['brand_id'], 'id="brand_id"' ); ?> <br>
		
		<label>Model</label>
		<input type="text" name="model_name" value="<?php echo $rows['model_name'];?>" id="model_name" />  <br>
		
		<br>		
		 <input type="hidden" name="model_id" value="<?php echo $rows['model_id']; ?>">
		 <button class="button1" style="margin-left: 310px;" onClick="location.href = document.referrer;">Back</button>
		<button class="button">Submit</button>		
		 <?php  } ?>		
	</form>
   
    <?php  } else {echo "Sorry, No Records Found";}?>
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
   $(function(){ 
	  
	// On load
   	var a_href = $('#category_id').val(); 
   	var b_href = $('#sub_cat').val();				

    	if(a_href==""){

    		$("#sub_category_id").html("<option value=''>Select</option>");
        	
    	}
    	else {			
  //Do stuff
 		   	    	    				
  		 $.ajax({
   	        
     	 type: "POST",
     	 url: "<?php echo base_url(); ?>model/sub_category_custom",
     		data: {category_id: a_href, sub_category_id: b_href}, 
     	 success: function(server_response){

     		$("#sub_category_id").html(server_response);
     	
     					  
     	 	}
										   		
			});	//$.ajax ends here

    	}//if else		

	//End of On load
		
 // For change of Category 


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
            category_id: "required",
            brand_id: "required",
          
            
        },
        messages: {
        	model_name: "Enter A Model Name",
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
								
								$(".result").html('Successfully Updated. Please Wait, Redirecting...');
								$(".result").show();	
								$('#myForm').resetForm();
								$(".errormsg2").hide();
								window.setTimeout(function() {
								    window.location.href = '<?php echo base_url();?>model/modellist';
								}, 2000);			
									
								
							} else if(responseText==2){
							
								$(".errormsg2").html('The Name of the Model Already Exists!');
								$(".result").html("");
							}	else{
									
								$(".errormsg2").html(responseText);
								$(".result").html("");				
								}
							
						
				} 
					
	</script>     
  </body> 
</html> 