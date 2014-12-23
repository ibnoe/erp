<?php if((!empty($records1)) && (!empty($records2))) { ?>
<!DOCTYPE>
<html>
<head>
<link rel="stylesheet" href="<?php echo base_url();?>support_admin/bootstrap/bootstrap.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>support_admin/bootstrap/print_invoice.css" type="text/css">
<title>PRINT</title> 
</head>

<body>
<?php

foreach ($records1 as $row){

	
	$total_amount=$row['total_amount'];	
	$amount_received=$row['amount_received'];
	$balance=$row['balance'];
}	

	function number_to_words($number)
{
    $number= str_replace(",", "",$number);// to remove commas
	
	$Cr = floor($number / 10000000);  /* Crore  */
    $number -= $Cr * 10000000;
    $Gn = floor($number / 100000);  /* Lacs  */
    $number -= $Gn * 100000;
    $kn = floor($number / 1000);     /* Thousands */
    $number -= $kn * 1000;
    $Hn = floor($number / 100);      /* Hundreds */
    $number -= $Hn * 100;
    $Dn = floor($number / 10);       /* Tens  */
    $n = $number % 10;               /* Ones */
	$cn = round(($number-floor($number))*100); /* Cents */
    $result = ""; 
	
	if ($Cr)
    {  $result .= number_to_words($Cr) . " Crore ";  } 
	
    if ($Gn)
    {  $result .= number_to_words($Gn) . " Lac";  } 

    if ($kn)
    {  $result .= (empty($result) ? "" : " ") . number_to_words($kn) . " Thousand"; } 

    if ($Hn)
    {  $result .= (empty($result) ? "" : " ") . number_to_words($Hn) . " Hundred";  } 

    $ones = array("", "One", "Two", "Three", "Four", "Five", "Six",
        "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen",
        "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen",
        "Nineteen");
    $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty",
        "Seventy", "Eigthy", "Ninety"); 

    if ($Dn || $n)
    {
       if (!empty($result))
       {  $result .= " and ";
       } 

       if ($Dn < 2)
       {  $result .= $ones[$Dn * 10 + $n];
       }
       else
       {  $result .= $tens[$Dn];
          if ($n)
          {  $result .= "-" . $ones[$n];
          }
       }
    }

    if ($cn)
    {
       if (!empty($result))
       {  $result .= ' and ';
       }
       $title = $cn==1 ? 'paisa ': 'paisa';
       $result .= strtolower(number_to_words($cn)).' '.$title;
    }

    if (empty($result))
    {  $result = "zero"; } 

    return $result;
}

?>
<div class="noPrint"><a href="<?php echo base_url();?>sales/cash">Back to Sales Entry</a></div>
<div style="padding:0 15px;">
<div class="row">

  
    
    <div class="col-xs-6">
    		
	    <h2>PC Carnival</h2>
		<span class="address">
			Show Room # 102(2nd Floor), 117(3rd Floor), Syed Grand Center  
			<br> Plot # 89, Road # 28, Sector # 07 
			<br />Uttara C/A Dhaka-1230 Bangladesh
			<br />Phone: +88 02 8958671, Mobile: +88 01819234199, +88 01819490468, 
			Email: pccarnival@gmail.com, 
			Web: www.pc-carnival.com
		</span>    
	 </div>
    
    
    
    <div class="col-xs-6">    
    	<h2 align="right" style="font-weight: bold;">INVOICE</h2>

		<table class="table table-bordered">
			<tr>
				<td>Invoice# </td>
				<td>: <?php echo $records1[0]['invoice_number'];?></td>
			</tr>
			<tr>
				<td>Date - Time</td>
				<td>: <?php echo date("d-m-Y", strtotime($records1[0]['sold_date'])) ;?>  <?php echo $records1[0]['sold_time'];?></td>
			</tr>
			<tr>
				<td>Sold By</td><td>: <?php echo $records1[0]['admin_name'];?></td>
		   </tr>		
		</table>    
    </div>
    
    
    
    <div class="col-xs-12">
    
    <div class="customer">Customer Name : <?php echo $records1[0]['party_name'];?> (<?php echo $records1[0]['party_contact'];?>)</div>
   
	
		<table class="table table-bordered"  align="center">
		<tbody>
		  <tr>
		 	  <th>SL#</th>
		      <th>Item</th>
		      <th>Unit Cost</th>
		      <th>Quantity</th>
		      <th>Price</th>
		  </tr>
		  
		 <?php $i = 0; foreach ($records2 as $row){ $i++; ?>  
		  <tr class="item-row">
		  	  <td><?php echo $i; ?>.</td>
		  	  <td class="item-name"><span class="pro_name"><?php echo $row['brand_name']." ".$row['category_name']." ".$row['product_item'];?></span>
		  	  <?php if($row['sold_product_serial']){ ?>
		  	  <br /><span class="identity"> SN: <?php echo $row['sold_product_serial']; ?>, Warranty: <?php echo $row['warranty'];?></span></td>
		      
		      <?php } ?>
		      
		      <td class="unit-cost"><?php echo number_format( $row['selling_price'], 2 ); ?></td>
		      <td class="quantity"><?php echo $row['quantity']; ?></td>
		      <td class="price"><?php $sub_total=$row['selling_price']*$row['quantity']; echo number_format($sub_total, 2 ) ; ?></td>
		  </tr>
		<?php  } ?>
		</tbody>
			<tfoot>
			<tr>
	
			      <td colspan="2" class="blank"></td>
			      <td colspan="2" class="total-line">Total</td>
			      <td class="total-value price"><div id="total"><?php echo number_format($total_amount, 2 ) ;?></div></td>
			  </tr>
			  <tr>
			      <td colspan="2" class="blank"> </td>
			      <td colspan="2" class="total-line">Amount Paid</td>
	
			      <td class="total-value price"><?php echo number_format($amount_received, 2) ;?></td>
			  </tr>
			  <tr>
			      <td colspan="2" class="blank"> </td>
			      <td colspan="2" class="total-line balance">Balance Due</td>
			      <td class="total-value balance price"><div class="due"><?php echo number_format($balance, 2) ;?></div></td>
			  </tr>
			</tfoot>
		</table>
	
	<br />
			
	<div class="amount-to-word"> Amount In Words: Taka <?php echo number_to_words($total_amount);?></div>
	<br>
	<br>
	
	<div class="terms">Warranty Void - Sticker Removed Items, Burned Case and Physically Damaged Goods</div>
	
	<br>
	<br>
	<br>
		
				
	<table>
		<tr>
			<td width="95%">
					<div id="leftsignature">
					<span>_____________________________</span> <br />
					<span>Receiver's Signature</span>	
					</div>
			</td>
			<td>
					<div id="rightsignature">
					<span>_____________________________</span> <br />
					<span>Authorized Signature</span>	
					</div>
		  </td>
	   </tr>
	</table>
	


	<br>
	<br>
	<div class="invoice_footer">
				<span>Printing Date:<?php echo date("d-m-Y");?> </span>
				<span style="margin-left: 12px;">Printing Time:<?php echo date("h:i:s A");?></span>
				<span style="margin-left: 10px;">Software Developed By www.caneflex.com</span>
	</div>
		
	
	
	</div>	   
   
    
    
    
  
</div>
</div>

</body>
</html>

<?php } else {redirect('');}?>