<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"  "http://www.w3.org/TR/html4/strict.dtd"> 
<html lang="en"> 
<head> 
<?php $this->load->view('includes/head');?>

<style>


label{
 color: #FF0000;
 width: 350px;
}

input{
height: 20px;
}


</style>

	

<script type="text/javascript">
$(function () {
    $('.checkall').click(function () {
        $(this).parents('#content').find(':checkbox').attr('checked', this.checked);
    });
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
	  <div >
	 
   <h2>Receipt- Cheque Schedule List</h2> 
<?php foreach ($accounts as $row){ 

	$acc_name[ $row['id'] ] = $row['account_name'];
	
}?>

<hr>
				<?php if(count($records) > 0) { ?>
				
		
					
	<form autocomplete="off" class="myform" id="myForm" enctype="multipart/form-data" action="<?php echo base_url();?>journal/change_receipt_cheque_status" method="post" name="myForm">			
		<?php if($level==1){?><button class="" name="cancel">Cancel</button><?php }?>
		<?php if($level==1){?><button class="" name="cleared">Cleared</button><?php }?>
		<?php if($level==1){?><button class="" name="dishonered">Dishonered</button><br><?php }?>		
					
			<table class="gtable" align="center" id="gtable">
					
				<thead>
						<tr>
							<th>Sl</th>
							<th><input type="checkbox" class="checkall"></th>
							
							<th>Cheque Date</th>
							<th>Cheque#</th>
							<th>Bank</th>
							<th>Amount</th>	
							<th>Receipt From</th>
							
						</tr>
				</thead>									
							 							  			
						
				
				<tbody>
		
				 <?php $i = 0; foreach ($records as $row){ $i++; ?>
						
				  
				       <tr>
				       
				          <td><?php echo $i; ?>.</td>
				          <td><input type="checkbox" name="id[]" value="<?php echo $row['cheque_id']; ?>"/></td>
				        <input type="hidden" name="cheque[]" value="<?php echo $row['cheque_number'];?>" >
				        <input type="hidden" name="cheque_date[]" value="<?php echo $row['cheque_date'];?>" >
				        <input type="hidden" name="bank_name[]" value="<?php echo $row['bank_name'];?>" >
				         <input type="hidden" name="amount[]" value="<?php echo $row['amount'];?>" >
				          <input type="hidden" name="cr_side[]" value="<?php echo $row['cr_side'];?>" >
				          
				          <td><?php echo date("d-m-Y", strtotime($row['cheque_date']));?></td>	
				          <td><?php echo $row['cheque_number'];?></td>
				          <td><?php  echo $row['bank_name']; ?></td>
				          <td><?php echo number_format( $row['amount'], 2 ) ;?></td>
				          <td><?php echo $acc_name[$row['cr_side']];?></td>
				          		                      		         
				    	 
				        </tr>
				       
					<?php }?>	
				
				
				</tbody>
				
				</table>
				
			
			<?php }  ?>
				
		</form>
	     
  	</div>
   
                 
 	</div>
 <!-- End of Main Area/Content  -->      
  
  
 
 <!-- Footer --> 
<div id="footer" class="span-24">
<?php $this->load->view('includes/footer');?>
</div>
<!-- Footer Ends -->  
      
      
    </div><!-- Container Ends -->
  </body> 
</html> 