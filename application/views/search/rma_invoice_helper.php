<?php

foreach ($records1 as $row){

	$invoice_number=$row['rep_delivery_invoice'];
	$customer_name=$row['customer_name'];
	$customer_mobile=$row['customer_contact'];
	$prepared_by=$row['admin_name'];
	$rep_delivery_date=$row['rep_delivery_date'];

	
}
?>	

<hr>
<table width="100%" id="info"  align="center">
<tr>
<td class="item-left">Invoice# </td><td class="data" >: <?php echo $invoice_number;?></td>
<td>&nbsp;</td>
<td class="item-right">Date</td><td class="data">: <?php echo date("d-m-Y", strtotime($rep_delivery_date)) ;?></td>

</tr>
<tr>
<td class="item-left">Customer Name</td><td class="data">: <?php echo $customer_name;?>, <?php echo $customer_mobile;?></td>
<td>&nbsp;</td>
<td class="item-right">Prep. By</td><td>: <?php echo $prepared_by;?></td>
</tr>


</table>

<br />

<table id="items">
		
		  <tr>
		 	
		      <td><b>Description</b></td>
		   
		  </tr>
		  
		 <?php $sum1=0; $sum2=0; $i = 0; foreach ($records2 as $row){ $i++; ?> 
		  <tr class="item-row" style="border-bottom:1px dotted black;">
		  	 
		  	   	 <?php $previous_product_name= $row['previous_brand_item']." ". $row['previous_category_item']." ". $row['previous_product_item'] ;?>
		  	 
		  	  <td><b>Received Product</b>: <br><br>
		  	 <?php echo $previous_product_name; ?>, Product Serial: <?php echo $row['previous_product_serial']; ?>, <br> Sales Invoice# <?php echo $row['sales_invoice']; ?>, Sold Date <?php echo date("d-m-Y",strtotime($row['sold_date'])); ?>
		  	  
		  	  </td>
		  </tr>
		  
		   <tr class="item-row" style="border-top:1px dotted black; border-bottom:1px dotted black;">
		  	  <td><b>Delivery Product</b>: <br><br>
		  	 <?php $new_product_name= $row['new_brand_item']." ". $row['new_category_item']." ". $row['new_product_item'] ;?>
		  	 		  	  
		  	  <?php echo $new_product_name; ?>, Product Serial: <?php echo $row['new_product_serial']; ?>
		  	   <br><br> <span>Receivable: <?php echo $row['acc_rec'];?></span> <span style="margin-left: 50%;">Payble: <?php echo $row['acc_pay'];?></span>
		  	  </td>
		  </tr>
				<?php $sum1 += str_replace(",", "", $row['acc_rec']);  $sum2 += str_replace(",", "", $row['acc_pay']);?>	

		<?php  } ?>
		
		<tr class="item-row" style="border-top:1px dotted black;">
		  	  <td>
		  	  <span><b>Total Receivable</b>: <?php echo number_format($sum1, 2) ;?></span> <span>, <b>Total Payble</b>: <?php echo number_format($sum2, 2) ;?></span>
		  	  </td>
		  	  	  
		  	  
		  </tr>
		
		</table>