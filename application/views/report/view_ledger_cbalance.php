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
	  <div >
	 
   <h2>Ledger: <?php echo $account_name ;?>  </h2> 

<hr>
			<?php if(count($records) > 0) { ?>
		<table class="gtable" align="center" id="gtable">
					
				<thead>
						<tr>
							<th>Date</th>
							<th>Voucher</th>
							<th>Account Name</th>
							<th>Narration</th>
							<th>Debit</th>
							<th>Credit</th>
							<th>Balance</th>
						</tr>
				</thead>
				
				<tbody>
				<tr>
				       
				          <td><?php echo $daterange1;?></td>
				          <td></td>
				          <td><span style="color: green">Balance Forward</span></td>
				          <td></td>
				          <td></td>
				          <td></td>
				           <td style="text-align: right;"><?php echo number_format($op_balance) ; ?></td>
				        								 
				      </tr>
		
				 <?php $i = $this->uri->segment(3) + 0; $sum = 0; foreach ($records as $row){ $i++; ?>
																			
										  
				       <tr>
				       
				          <td><?php echo $i; ?>.</td>
				           <td><?php echo date("d-M-Y", strtotime($row['trans_date']));?></td>
				          <td><?php echo $row['account_name'];?> <?php if($row['cheque_number']){ echo ",Cheque# ".$row['cheque_number'];}?></td>
				          <td><?php echo $row['narration'];?></td>
				          <td><?php if($row['balance']>0){echo number_format($row['balance']) ; }?> </td>
				          <td><?php if($row['balance']<0){echo number_format(str_replace("-", "", $row['balance'])); }?></td>
				          <td>
				          <?php 
				          		if($i=='1') {
				          			
				          			$bl= $op_balance-$row['balance'];
				          			echo number_format($bl,2);
				          		
				          		} 
				          		
				          		else {
				          			 $bl= $bl-$row['balance'];
				          			echo number_format($bl,2);
				          		}
				         ?>
				       
				          
				          </td>
				        	<?php $sum -= str_replace(",", "", $row['balance']);?> 							 
				      </tr>
				       
				<?php  } ?>
					<tr>
						<td></td>
					    <td></td>
					    <td><span style="color: green">Ending Balance</span></td>
					    <td></td>
					    <td></td>
					    <td></td>
					    <td style="text-align: right;"><b><?php echo $total= number_format($sum+$op_balance, 2);  ?></b></td>
				   </tr>
				
				</tbody>
				
				</table>
								
			
			
		
	<?php } else {echo "Sorry! No Record Found";} ?>		
					
	    
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