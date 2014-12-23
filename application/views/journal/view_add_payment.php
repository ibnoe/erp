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
		$( "#datepicker2" ).datepicker({ changeMonth: true, changeYear: true,dateFormat: 'dd-mm-yy'});
		$( "#datepicker3" ).datepicker({ changeMonth: true, changeYear: true,dateFormat: 'dd-mm-yy'});
		

		var myDate = new Date();
		var prettyDate = myDate.getDate() + '-' +(myDate.getMonth()+1) + '-' +  myDate.getFullYear();
		$("#datepicker1").val(prettyDate);
	});
	</script>	


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
	
  	<h2 >Add Payment</h2>
  	
 	 <hr>
 	 <div class="span-15">
 	 
 	  <form autocomplete="off" class="myform" id="myForm" enctype="multipart/form-data" action="<?php echo base_url();?>journal/add_payment" method="post" name="myForm">
		<label>Party</label> 
		<?php echo form_dropdown('debit', $party_acc,'', 'id="debit"' ); ?> <br>
		<label>Pay From</label> 
		<?php echo form_dropdown('credit', $cash_bank_accounts,'', 'id="credit"' ); ?> <br>
		<span class="cheque"><label class="cheque">Cheque Number</label> 
		<input type="text" name="cheque_number" id="cheque_number" class="cheque"/> <br></span>
		<span class="cheque"><label class="cheque">Cheque Date</label> 
		<input type="text" name="cheque_date" id="datepicker2" class="cheque"/> <br></span>
		<span class="cheque"><label class="cheque">Deduction From Account Date</label> 
		<input type="text" name="deduct_date" id="datepicker3" class="cheque"/> <br></span>
		<label>Amount</label>
		<input type="text" name="amount"/> <br>
		<label>Narration /Reason of Payment</label>
		<input type="text" name="narration" maxlength="80" /> <br>
		<label>Payment Issue Date</label>
		<input type="text" id="datepicker1" name="date"/> <br>
		<input type="hidden" name="entry_type" value="2"/> 
		<button class="button" style="margin-left: 400px;">Add New</button>
		</form>
	 
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
        	debit: "required",
        	credit: "required",
        	date: "required",
        	amount: {
        		required:true,
        		number: true
      		 },
        	
        	},
        messages: {
        	
        	debit: "Select A Pary",
        	credit: "Select Payment Mode",
        	date: "Enter Payment Date",
        	amount: {required: "Enter Amount",
				number:"Incorrect Number"
    		},
    		cheque_number: "Enter Cheque Number",
    		cheque_date: "Enter Cheque Date",
    		deduct_date: "Enter Deduct From Account Date",
        }
    });
});

$(document).ready(function() { 

	$('.cheque').hide();
	$('#cheque_number').removeClass("required");
	$('#datepicker2').removeClass("required");
	$('#datepicker3').removeClass("required");

	$('#credit').change(function() {

		var value=this.value;

		if(value!=='1'){ //cash id = 1
			$('.cheque').show();
			$('#cheque_number').addClass("required");
			$('#datepicker2').addClass("required");
			$('#datepicker3').addClass("required");
			
		} else {

			$('.cheque').hide();
			$('#cheque_number').removeClass("required");
			$('#cheque_number').val('');
			$('#datepicker2').removeClass("required");
			$('#datepicker2').val('');
			$('#datepicker3').removeClass("required");
			$('#datepicker3').val('');
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
								
							     var options = {id: 'message_from_top',
		                                   position: 'bottom',
		                                   size: 70,
		                                   backgroundColor: '#0CA0CB',
		                                   delay: 3000,
		                                   speed: 500,
		                                   fontSize: '30px'
										   
		                                  };
		                                   
		                    $.showMessage("A new payment information has been added!", options); 
								
								$('#myForm').resetForm();
								
								
							} else{
							
								 $.showMessage("Couldn't Peform The Requested Action");
							}	
							
						
				} 
					
				</script> 		
				   
  </body> 
</html> 