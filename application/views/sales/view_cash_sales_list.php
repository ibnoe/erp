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
	 
   <h2>Cash Sales List </h2> 

<hr>
				<?php if(count($records) > 0) { ?>
					<table class="gtable" align="center" id="gtable">
					
				<thead>
						<tr>
							<th>Sl</th>
							<th>Invoice</th>
							<th>Total</th>
							<th>A. Received</th>
							<th>Customer Name</th>
							<th>Customer Contact</th>
							<th>Sold By</th>
							<th>Sold Time</th>
							<th>Sold Date</th>
							<th>Print Invoice</th>
															 							  			
							
						</tr>
				</thead>
				
				<tbody>
		
				 <?php $i = $this->uri->segment(3) + 0; foreach ($records as $row){ $i++; ?>
						
				  
				       <tr id="trid_<?php echo $row['id']; ?>">
				       
				          <td><?php echo $i; ?>.</td>
				          <td><?php echo $row['invoice_number'];?></td>
				          <td><?php echo number_format($row['total_amount'], 2);?></td>
				          <td><?php echo number_format($row['amount_received'], 2) ;?></td>
				          <td><?php echo $row['customer_name'];?></td>
				          <td><?php echo $row['customer_mobile'];?></td>
				          <td><?php echo $row['admin_name'];?></td>
				          <td><?php echo $row['sold_time'];?></td>
				          <td><?php echo date("d-m-Y", strtotime($row['sold_date']));?></td>
				    	 <td><?php if($row['sales_return']=='0'){ ?><a href="<?php echo base_url();?>sales/print_cashsales/<?php echo $row['id'];?>">Print</a><?php } else { echo "Returned";}?></td>
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