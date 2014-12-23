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
	
  	<h2 >Add Receipt</h2>
  	
 	 <hr>
 	 <div class="span-15">
 	
 	  <form autocomplete="off" class="myform" id="myForm" enctype="multipart/form-data" action="<?php echo base_url();?>journal/add_receipt" method="post" name="myForm">
		<label>Receive/ Debit</label> 
		<?php echo form_dropdown('debit', $cash_bank_accounts,'', 'id="debit"' ); ?> <br>
		<span class="cheque"><label class="cheque">Cheque Number</label> 
		<input type="text" name="cheque_number" id="cheque_number" class="cheque"/> <br></span>
		<span class="cheque"><label class="cheque">Cheque Date</label> 
		<input type="text" name="cheque_date" id="datepicker2" class="cheque"/> <br></span>
		
		<span class="cheque"><label class="cheque">Bank Name</label> 
		<input type="text" name="bank_name" id="bank_name" class="cheque"/> <br></span>
		<label>Receive From/ Credit</label> 
		<?php echo form_dropdown('credit', $party_acc,'', 'id="credit"' ); ?> <br>
		
		<label>Amount</label>
		<input type="text" name="amount"/> <br>
		<label>Billing Against</label>
		<input type="text" name="bill_against" placeholder="Bill Number or Type: Previous Sale"/> <br>
		
		<label>Receipt Date</label>
		<input type="text" id="datepicker1" name="date"/> <br>
		<input type="hidden" name="entry_type" value="1"/> 
		<br>
		<button id="button1" name="confirm_print" class="button" style="margin-left: 240px;">Confirm and Print</button>
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
            	bill_against: "required",
            	
            	date: {
            		required:true,
                },
        			
                amount: {
            		required:true,
            		number: true
          		 },
          		
                
                
            },
            messages: {
            	
            	debit: "Select an Debit Account",
            	credit: "Select a Credit Account",
            	bill_against: "Enter The Bill Number You Are Billing Against",
            	date: {required: "Enter Date",
            	
        		},
            	
        		amount: {required: "Enter Receive Amount",
					number:"Incorrect Number"
        		},	
        		cheque_number: "Enter Cheque Number",
        		cheque_date: "Enter Cheque Date",
        		
        		bank_name: "Enter Bank Name",
                
            }
        });
});

$(document).ready(function() { 

	$('.cheque').hide();
	$('#cheque_number').removeClass("required");
	$('#datepicker2').removeClass("required");
	

	$('#debit').change(function() {

		var value=this.value;

		if(value=='9'){ //Received with cheque = 9
			$('.cheque').show();
			$('#cheque_number').addClass("required");
			$('#datepicker2').addClass("required");
			
			$('#bank_name').addClass("required");
			
		} else {

			$('.cheque').hide();
			$('#cheque_number').removeClass("required");
			$('#cheque_number').val('');
			$('#datepicker2').removeClass("required");
			$('#datepicker2').val('');
			
			$('#bank_name').removeClass("required");
			$('#bank_name').val('');
		}
	});
	
	
});

</script>


				         
     
  </body> 
</html> 