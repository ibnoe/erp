<!DOCTYPE div PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" href="<?php echo base_url();?>support_admin/css/print_warranty_invoice.css" type="text/css">
<style>
@media print {
.noPrint {
    display:none;
  }
}
</style>
<title>INVOICE</title> 
</head>

<body>
<div class="noPrint"><a href="<?php echo base_url();?>rma/add_to_warranty">Back to Warranty Claim</a></div>
<?php

foreach ($records1 as $row){

	$invoice_number=$row['warranty_invoice'];
	$customer_name=$row['customer_name'];
	$customer_contact=$row['customer_contact'];
	$prepared_by=$row['admin_name'];
	$generated_date=$row['generated_date'];
}	

?>
<div id="container">
<div align="center">
	<h1>PC Carnival</h1>
	<span class="address">Show Room # 102(2nd Floor), 117(3rd Floor), Syed Grand Center Plot # 89, Road # 28, Sector # 07 Uttara C/A Dhaka-1230 Bangladesh<br />
	Phone: +88 02 8958671, Mobile: +88 01819234199, +88 01819490468, Email: pccarnival@gmail.com, Web: www.pc-carnival.com
	</span>
</div>
<br />
<div id="content">

<h2 align="center"><u>Inovice-RMA</u></h2>

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
	
	<br />
	<br />
	<br />
	<br />	
	
		
	<table>	
		
		<tr>
		<td width="95%"><div id="leftsignature">
	<span>_____________________________</span> <br />
		<span>Customer's Signature</span>	
	</div></td>
	<td><div id="rightsignature">
	<span>_____________________________</span> <br />
		<span>Authorized Signature</span>	
	</div></td>
		</tr>
		</table>
	
</div>	


	

</div>
</body>
</html>
