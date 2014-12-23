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

<script type="text/javascript" charset="utf-8">$(document).ready(function() {$('#gtable').dataTable();} );</script>	

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
	 
   <h2>Payment List</h2> 
<?php foreach ($accounts as $row){ 

	$acc_name[ $row['id'] ] = $row['account_name'];
	
}?>

<hr>
				<?php if(count($records) > 0) { ?>
					<table class="gtable" align="center" id="gtable">
					
				<thead>
						<tr>
							<th>Sl</th>
							
							<th>Voucher#</th>
							<th>Payment Date</th>
							<th>Paid To</th>
							<th>Amount</th>
							<th>Mode</th>
							<th>Cheque#</th>
							<th>Bank</th>							
							<th>Cheque Date</th>
							<th>Payment Reason</th>
														
						</tr>
				</thead>
				
				<tbody>
		
				 <?php $i = 0; foreach ($records as $row){ $i++; ?>
						
				  
				       <tr>
				       
				          <td><?php echo $i; ?>.</td>
				          <td><?php echo $row['voucher_number'];?></td>
				          <td><?php echo date("d-m-Y", strtotime($row['payment_date']));?></td>
				          <td><?php echo $acc_name[$row['dr_side']];?></td>
				          <td style="text-align: right;"><?php echo number_format( $row['amount'], 2 ) ;?></td>
				          <td><?php echo $acc_name[$row['cr_side']];?></td>
				          <td><?php echo $row['cheque_number'];?></td>
				          <td><?php if (!empty($row['cheque_number'])){ echo $acc_name[$row['bank_name']];}?></td>
				          <td><?php if(!empty($row['cheque_number'])){echo date("d-m-Y", strtotime($row['cheque_date']));} ?></td>
				        
				          <td><?php echo $row['narration'];?></td>
				          
				        		         
				    	 
				        </tr>
				       
				<?php  } ?>
				
				
				</tbody>
				</table>
						
		
	     <?php } else {echo "Sorry! No Records Found"; } ?>
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