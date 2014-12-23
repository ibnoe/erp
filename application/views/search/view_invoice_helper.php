
<?php
if(count($records2)>0){
	

foreach ($records1 as $row){

	$invoice_number=$row['invoice_number'];
	$sale_type=$row['sale_type'];
		
	if($sale_type=='1'){

	$customer_name=$row['customer_name'];
	$customer_mobile=$row['customer_mobile'];
			
	} else {
		
	$customer_name=$row['party_name'];
	$customer_mobile=$row['party_contact'];
			
	}
	
	
	$sold_by=$row['admin_name'];
	$sold_date=$row['sold_date'];
	$sold_time=$row['sold_time'];

	$total_amount=$row['total_amount'];
	$amount_received=$row['amount_received'];
	$balance=$row['balance'];
	$sales_return=$row['sales_return'];
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
<table width="100%" id="info"  align="center">
<tr>
<td class="item-left">Invoice# </td><td class="data" >: <?php echo $invoice_number;?></td>
<td>&nbsp;</td>
<td class="item-right">Date</td><td class="data">: <?php echo date("d-m-Y", strtotime($sold_date));?></td>

</tr>
<tr>
<td class="item-left">Sale Type</td><td>: <?php if($sale_type=='1'){echo "Cash Sale";}else {echo "Party Sale";}?></td>
<td>&nbsp;</td>
<td class="item-right">Sold By</td><td>: <?php echo $sold_by;?></td>
</tr>
<tr>
<td class="item-left">Customer Name</td><td class="data">: <?php echo $customer_name;?>, <?php echo $customer_mobile;?></td>
<td>&nbsp;</td>
<td class="item-right">Sold At</td><td>: <?php echo $sold_time;?></td>
</tr>
<tr>
<td class="item-left">Returned Any Product</td><td class="data">: <?php if($sales_return=='1'){ echo "Yes";}else {echo "No";}?></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>


</table>

<br />

<table id="items">
		
		  <tr>
		 	  <th>SL#</th>
		      <th>Item</th>
		      <th class="titles">Purchase Rate</th>
		      <th class="titles">Unit Cost</th>
		      <th class="titles">Quantity</th>
		      <th class="titles">Price</th>
		  </tr>
		  
		 <?php $i = 0; foreach ($records2 as $row){ $i++; ?>  
		  <tr class="item-row">
		  	  <td><?php echo $i; ?>.</td>
		  	  <td class="item-name"><span class="pro_name"><?php echo $row['brand_name']." ".$row['category_name']." ".$row['product_item'];?></span>
		  	  <?php if($row['sold_product_serial']){ 
		  	  
		  	  if(is_numeric($row['warranty'])){
				         	
				         	date_default_timezone_set('Asia/Dhaka'); 
				     		$now= strtotime(date("Y-m-d"));			     		 
				     		$your_date = strtotime($sold_date);
				     		$datediff = $now - $your_date;
				     		$warranty=$row['warranty']-floor($datediff/(60*60*24));
				         	
				         $war= $warranty ;} else {$war= $row['warranty'];}
		  	  	
		  	  	?>
		  	  <br /><span class="identity"> <b>SN:</b> <?php echo $row['sold_product_serial']; ?>, <b>Warranty:</b> <?php echo $row['warranty']; ?>, <b>Warranty Left: </b>  <?php echo $war;?> 
		  	  <br> Company Purchase Voucher for this product: <b><?php echo $row['purchase_voucher']; ?></b>, Purchase Date: <?php echo date("d-m-Y",strtotime($row['purchase_date'])); ?></span></td>
		      
		      <?php } ?>
		      
		      
			 <td class="unit-cost"><?php if($level==1){ echo number_format( $row['buy_price'], 2 );  }?></td>
		      <td class="unit-cost"><?php echo number_format( $row['selling_price'], 2 ); ?></td>
		      <td class="quantity"><?php echo $row['quantity']; ?></td>
		      <td class="price"><?php $sub_total=$row['selling_price']*$row['quantity']; echo number_format($sub_total, 2 ) ; ?></td>
		  </tr>
		<?php  } ?>
		
		<tr>

		      <td colspan="2" class="blank"></td>
		      <td colspan="3" class="total-line">Total</td>
		      <td class="total-value price"><div id="total"><?php echo number_format($total_amount, 2 ) ;?></div></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="3" class="total-line">Amount Paid</td>
		      <td class="total-value price"><?php echo number_format($amount_received, 2) ;?></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="3" class="total-line balance">Balance Due</td>
		      <td class="total-value balance price"><div class="due"><?php echo number_format($balance, 2) ;?></div></td>
		  </tr>
		
		</table>
	
	<br />
	<br />
		
	<div class="amount-to-word">Total Amount In Words: Taka <?php echo number_to_words($total_amount);?></div>
	
<?php } else {echo "No Record Found";}?>