<?php
if(count($records1) > 0) {

foreach ($records1 as $row){

	$sales_return_invoice=$row['sales_return_invoice'];
	$against_sales_invoice=$row['against_sales_invoice'];
	if(!empty($row['party_name'])) {
	
	$customer_name=$row['party_name'];
	$customer_mobile=$row['party_contact'];
	} else {
		
	$customer_name=$row['customer_name'];
	$customer_mobile=$row['customer_mobile'];	
		
	}
	
	$prepared_by=$row['admin_name'];
	$sales_return_date=$row['sales_return_date'];
	$total_amount=$row['sales_return_total'];

	
	
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

<div id="content">

<h2 align="center"><u>Credit Note</u></h2>

<table width="100%" id="info"  align="center">
<tr>
<td class="item-left">Credit Note Invoice# </td><td class="data" >: <?php echo $sales_return_invoice;?></td>
<td>&nbsp;</td>
<td class="item-right">Date</td><td class="data">: <?php echo date("d-m-Y", strtotime($sales_return_date)) ;?></td>

</tr>
<tr>
<td class="item-left">Customer Name</td><td class="data">: <?php echo $customer_name;?> </td>
<td>&nbsp;</td>
<td class="item-right">Sales Invoice#</td><td class="data">: <?php echo $against_sales_invoice;?></td>
</tr>
<tr>
<td class="item-left">Customer Contact</td><td class="data">: <?php echo $customer_mobile;?></td>
<td>&nbsp;</td>
<td class="item-right">Prepared By</td><td class="data">: <?php echo $prepared_by;?></td>
</tr>

</table>

<br />

<table id="items">
		
		  <tr>
		 	  <th>SL#</th>
		      <th>Item</th>
		      <th>Price</th>
		      <th>Quantity</th>
		      <th>Sub Total</th>
		  </tr>
		  
		 <?php $i = 0; foreach ($records2 as $row){ $i++; ?>  
		  <tr class="item-row">
		  	  <td><?php echo $i; ?>.</td>
		  	  <td class="item-name"><span class="pro_name"><?php echo $row['brand_name']." ".$row['category_name']." ".$row['product_item'];?></span>
		  	 		      
		      <td class="unit-cost"><?php echo number_format( $row['return_unit_price'], 2 ); ?></td>
		      <td class="quantity"><?php echo $row['return_quantity']; ?></td>
		      <td class="price"><?php $sub_total=$row['return_unit_price']*$row['return_quantity']; echo number_format($sub_total, 2 ) ; ?></td>
		  </tr>
		<?php  } ?>
		
		<tr>

		      <td colspan="2" class="blank"></td>
		      <td colspan="2" class="total-line">Total</td>
		      <td class="total-value price"><div id="total"><?php echo number_format($total_amount, 2 ) ;?></div></td>
		  </tr>
		  
		
		</table>
	
	<br />
	<br />
		
	<div class="amount-to-word"> Amount In Words: Taka <?php echo number_to_words($total_amount);?></div>
	
<?php } echo "No Record Found";?>	
	