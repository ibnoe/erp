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
  	<h2>Check Current Balance: Select An Account</h2>
 	 <hr>
   
    <div class="span-15">
  <form autocomplete="off" class="myform" id="myForm" enctype="multipart/form-data" action="<?php echo base_url();?>report/check_current_balance" method="post" name="myForm">
		
		<label>Account</label> 
		<?php echo form_dropdown('account_id', $getall_accounts,'', 'id="account_id"' ); ?> <br>
		<br>
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
        	
        	account_id: "required",
        	
            
        },
        messages: {
        	
        	account_id: "Select An Account",
        	
            
            
        }
    });
});

</script>		
				

  </body> 
</html> 