<?php
if(count($records2)> 0) {
foreach ($records1 as $row){

	$invoice_number=$row['warranty_invoice'];
	$customer_name=$row['customer_name'];
	$customer_contact=$row['customer_contact'];
	$prepared_by=$row['admin_name'];
	$generated_date=$row['generated_date'];
}	

?>

<table width="100%" id="info"  align="center">
<tr>
<td class="item-left">Invoice# </td><td class="data" >: <?php echo $invoice_number;?></td>
<td>&nbsp;</td>
<td class="item-right">Date</td><td class="data">: <?php echo date("d-m-Y", strtotime($generated_date));?></td>

</tr>
<tr>
<td class="item-left">Customer Name</td><td class="data">: <?php echo $customer_name;?>, <?php echo $customer_contact;?></td>
<td>&nbsp;</td>
<td class="item-right">Prep. By</td><td>: <?php echo $prepared_by;?></td>
</tr>


</table>

<br />

<table id="items">
		
		  <tr>
		 	    <th width="15px;">#</th>
				<th>Product Name</th>
				<th>Product Serial</th>
				<th>Sales Invoice</th>
				<th>Sold Date</th>
		  </tr>
		  
		 <?php $i = 0; foreach ($records2 as $row){ $i++; ?>  
		  <tr class="item-row">
		  	  <td><?php echo $i; ?>.</td>
		  	  
		  	  <td class="item-name"><span class="pro_name"><?php echo $row['brand_name']." ".$row['category_name']." ".$row['product_item'];?></span>
		  			      
		      <td class="quantity"><?php echo $row['sold_product_serial'];?></td>
		      <td class="quantity"><?php echo $row['invoice_number'];?></td>
		      <td class="quantity"><?php echo $row['sold_date'];?></td>
		  </tr>
		<?php  } ?>
		
				
		</table>
		
<?php }else {echo "Items were deleted";}?>		