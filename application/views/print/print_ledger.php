<html>
<head>
<title>Ledger</title>
<style>
		
		#header { position: absolute; left: 0; top: -50px; right: 0; height: 140px; text-align: center;  }
	    #footer {position: fixed ; left: 0px; bottom: -20px; right: 0px; height: 30px; font-size:10; }
    	#footer .page:after { content: counter(page, upper-roman);  }
    	h2 { font-size:14px; text-decoration:underline;  }
 body {font-size:11px;color:#222; font-family: Geneva, Arial, Helvetica, sans-serif;  }   	
    	.style1{font-family:Veranda; font-size:12px;}
                   
           #table1 {
            width: 100%
			border: 1px solid #B0B0B0;
			 
			}
       		thead {
           	
			background-color:#EEEEEE;
       		 }
			tbody td{
				
			padding: 3px 1px;
			
			}
		
 					
			body{
			height:700px;
			}
			
			.style1{ font-family:Veranda; font-size:11px;}
	
	@media all {
	.page-break	{ display: none; }
}

@media print {
	.page-break	{ display: block; page-break-before: always; }
}		
 			
</style>	
 

</head>
			
<body>   
  <?php $address="Show Room # 102(2nd Floor), 117(3rd Floor), Syed Grand Center Plot # 89, Road # 28, Sector # 07 Uttara C/A Dhaka-1230 Bangladesh<br />
	Phone: +88 02 8958671, Mobile: +88 01819234199, +88 01819490468, Email: pccarnival@gmail.com, Web: www.pc-carnival.com" ;?>



<div id='header'>
  <h1>PC Carnival</h1>
 <span class='style1'><?php echo $address; ?></span> <br>
  
</div>			

<div id='footer'>
   	 <p class='page'>Page </p>
 </div>
    	

 <div id='content'>
  
<br>	
<br>	
	  
	  <h2 align='center'>Debitors/Creditors Ledger</h2><br> <br>
	  <div align='center'><span style="font-size: 13px;"><?php echo $account_name ;?></span></div>
	  <div align='center'>From <?php echo $daterange1;?> To <?php echo $daterange2;?></div>
	  <br> <br>
	  <?php if(count($records) > 0) { ?>
	  <table id='table1' width='100%'>
	<thead>
	  <tr>
	 	
		<th style="text-align: left; width:9%;">Date</th>
		<th style="text-align: left; width:29%;">Particulars</th>
		<th style="text-align: center; width:19%;">Voucher</th>
		<th style="text-align: right;">Debit</th>
		<th style="text-align: right;">Credit</th>
		<th style="text-align: right;">Balance</th>
	
	</tr>
	</thead>
							
	
		<tbody>
					<tr>
				           
				          <td><?php echo $daterange1; ?></td>
				          <td>Balance Forward</td>
				          <td></td>
				          <td></td>
				          <td style="text-align: right;"><?php echo $op_balance; ?></td>
				        								 
				      </tr>
		
				 <?php $i = $this->uri->segment(3) + 0; $sum = 0; foreach ($records as $row){ $i++; ?>
																			
										  
				       <tr>
				       
				          <td style="text-align: left; width:9%;"><?php echo date("d-m-Y", strtotime($row['trans_date']));?></td>
				          <td style="text-align: left; width:29%;"><?php echo $row['account_name'];?> <?php if($row['cheque_number']){ echo "/Cheque# ".$row['cheque_number'];}?></td>
				          <td style="text-align: center; width:19%;"><?php echo $row['voucher_number'];?> </td>
				          <td style="text-align: right;"><?php if($row['balance']>0){echo number_format($row['balance'], 2); }?> </td>
				          <td style="text-align: right;"><?php if($row['balance']<0){$v=str_replace("-", "", $row['balance']); echo number_format($v, 2);  }?></td>
				          <td style="text-align: right;">
				          <?php 
				          		if($i=='1') {
				          			
				          			$bl= $op_balance+$row['balance'];
				          			echo number_format($bl,2);
				          		
				          		} 
				          		
				          		else {
				          			 $bl= $bl+$row['balance'];
				          			echo number_format($bl,2);
				          		}
				         ?>
				       
				          
				          </td>
				        	<?php $sum += str_replace(",", "", $row['balance']);?> 							 
				      </tr>
				       
				<?php  } ?>
					<tr>
						
					    <td></td>
					    <td><b>Ending Balance</b></td>
					   
					    <td></td>
					    <td></td>
					     <td style="text-align: right;"><?php echo $total= number_format($sum+$op_balance, 2);  ?></td>
				   </tr>
				
				</tbody>
	
	
	
</table>
<?php } else {echo "Sorry! No Record Found";} ?>	

<br>
<br> 






</div>
</body>
</html>
	
