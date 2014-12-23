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
<div class="noPrint"><a href="<?php echo base_url();?>">Back to Home Page</a></div>

<div id="container">
<div align="center">
	<h1>PC Carnival</h1>
	<span class="address">Show Room # 102(2nd Floor), 117(3rd Floor), Syed Grand Center Plot # 89, Road # 28, Sector # 07 Uttara C/A Dhaka-1230 Bangladesh<br />
	Phone: +88 02 8958671, Mobile: +88 01819234199, +88 01819490468, Email: pccarnival@gmail.com, Web: www.pc-carnival.com
	</span>
</div>
<br />
<div id="content">

<?php

foreach ($records1 as $row){

	$invoice_number=$row['rep_delivery_invoice'];
	$customer_name=$row['customer_name'];
	$customer_mobile=$row['customer_contact'];
	$prepared_by=$row['admin_name'];
	$rep_delivery_date=$row['rep_delivery_date'];

	
}
?>	

<h2 align="center"><u>Replacement Delivery</u></h2>

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
