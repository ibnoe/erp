<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"  "http://www.w3.org/TR/html4/strict.dtd"> 
<html lang="en"> 
<head> 
<?php $this->load->view('includes/head');?>
<link rel="stylesheet" href="<?php echo base_url();?>support_admin/css/print_invoice.css" type="text/css">
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
	 
  
  	<h2 >Search Invoice</h2>
  	
 	 <hr>
 	 <div class="span-15">
 	 
 	  <form autocomplete="off" class="myform2" id="myForm" enctype="multipart/form-data" action="<?php echo base_url();?>rma/rma_step_1" method="post" name="myForm">
		<label>Search By</label>
		<?php 
		$search_by = array(
                  '1'  => 'Invoice Number',
				  '2'  => 'Product Serial Number',
                  );

			echo form_dropdown('search_by', $search_by,'', 'id="search_by"' );

		?> 
		
		<input type="text" name="serial" size="40"/>
		
		
		<button class="button">Search</button>
		</form>
	 
 	 </div>
	 	
	 <div class="span-8">
		 <span class="result" style="font-size:14px;color:green;"></span>
         <span class="errormsg2" style="font-size:14px;color:red;"></span>
	 
	 </div>	
	 	
      <div class="span-24" id="search_result"></div>
      
      
        
</div>
 <!-- End of Main Area/Content  --> 
         
 <!-- Footer --> 
<div id="footer" class="span-24">
<?php $this->load->view('includes/footer');?>
</div>
<!-- Footer Ends -->  
      
      
 </div>      
 <!-- Container Ends -->  
 
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
        	serial: "required",
        	
        	
        },
        messages: {
        	
        	serial: "Enter A Invoice Number or Product Serial",
        	
        	
         
            
        }
    });
});

</script>
 

				       
     
  </body> 
</html> 