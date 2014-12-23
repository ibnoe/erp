<!DOCTYPE div PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" href="<?php echo base_url();?>support_admin/css/print_warranty_invoice.css"  type="text/css">
<style>
@media print {
.noPrint {
    display:none;
  }
}

.bottom_border{
border-bottom:1px dotted black;
}

</style>
<title>RECEIPT</title> 
</head>

<body>
<div class="noPrint"><a href="<?php echo base_url();?><?php echo $back_link;?>">Back</a></div>

<div id="container">
<div align="center">
	<h1>PC Carnival</h1>
	<span class="address">Show Room # 102(2nd Floor), 117(3rd Floor), Syed Grand Center Plot # 89, Road # 28, Sector # 07 Uttara C/A Dhaka-1230 Bangladesh<br />
	Phone: +88 02 8958671, Mobile: +88 01819234199, +88 01819490468, Email: pccarnival@gmail.com, Web: www.pc-carnival.com
	</span>
</div>
<br />
<div id="content">
<?php foreach ($accounts as $row){ 

	$acc_name[ $row['id'] ] = $row['account_name'];
	
}?>
<?php

foreach ($records as $row){

	$invoice_number=$row['voucher_number'];
	$customer_name=$row['party_name'];
	$customer_mobile=$row['party_contact'];
	$prepared_by=$row['admin_name'];
	$date=$row['receipt_date'];
	$receipt_type_id=$row['receipt_type_id'];
	$amount=$row['amount'];
	$bill_against=$row['narration'];
	$dr =$row['dr_side'];
	 
		
	
	
	if($receipt_type_id=='2'){ //2 =cheque
	$cheque_number=$row['cheque_number'];
	$bank_name=$row['bank_name'];
	$cheque_date=$row['cheque_date'];
	
	}
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

<h2 align="center"><u><b>Money Receipt</b></u></h2>
<br>





<table width="100%" id="info"  align="center">
<tr>
<td class="item-left">Money Receipt# </td><td class="data" >: <?php echo $invoice_number;?></td>
<td>&nbsp;</td>
<td class="item-right">Date</td><td class="data">: <?php echo $date;?></td>
</tr>
<tr>
<td class="item-left">Prep. By</td><td>: <?php echo $prepared_by;?></td>
</tr>
</table>


<table width="100%" id="info" align="center">

<tr>
<td class="item-left">Received with thanks from</td><td class="data" >:  <?php echo $customer_name;?>, Contact: <?php echo $customer_mobile;?> </td>
</tr>
<tr>
<td class="item-left">The amount of Taka</td><td class="data" >:  <?php echo number_format( $amount, 2 ) ;?> </td>
</tr>
<tr>
<td class="item-left">The amount of Taka in words</td><td class="data" >:  <?php echo number_to_words($amount);?> Taka Only </td>
</tr>
<tr>
<td class="item-left">Against our bill No.</td><td class="data" >:  <?php echo $bill_against;?> </td>
</tr>
<tr>
<td class="item-left">Payment Mode</td><td class="data" >:  <?php if($receipt_type_id=='1'){ echo "Cash";} elseif($receipt_type_id=='2'){echo "Cheque";} else {echo  "Deposited in ". $acc_name[$dr];;}?> </td>
</tr>

</table>


<?php  if($receipt_type_id=='2') { ?>
	<table width="100%" id="items" align="center">
		<tr>
		<th>Cheque#</th>
		<th>Cheque Date</th>
		<th>Bank</th>
		<th>Amount</th>
		</tr>

		<tr>
		<td><?php echo $cheque_number;?></td>
		<td><?php echo date("d-m-Y", strtotime($cheque_date));?></td>
		<td><?php echo $bank_name;?></td>
		<td style="text-align: right;"><?php echo number_format( $amount, 2 ) ;?></td>
		</tr>
	</table>
	
<?php }?>
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
