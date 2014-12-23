<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"  "http://www.w3.org/TR/html4/strict.dtd"> 
<html lang="en"> 
<head> 
<?php $this->load->view('includes/head');?>
<style>
.head{
	font-size:16px; font-weight:bold; padding: 10px;  width:50%
}
.subhead{
padding: 8px;  font-size:12px;
}
.left{
	width:25%; text-align:right; padding: 8px; 
}
.right{
	width:25%; text-align:right; padding: 8px; font-weight:bold;
}
.subtotal{
	font-size:13px; font-weight:bold; 
}
.total{
	font-size:15px; font-weight:bold; 
}
</style>
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
	  <div class="prepend-1 append-1">
	 
   <h2 align="center">Income Statement <?php echo "From " . $daterange1 ." To ". $daterange2 ; ?></h2> 
   
  	
	     
	    <table id="gtable" class="gtable">
  <tr>
    <td class="head"><u>Sales Revenue</u></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="subheadings">Sales</td>
    <td class="left"><?php if($sales<0) {echo "<font color='red'> number_format( $sales, 2 ) </font>";} else{ echo number_format( $sales, 2 );} ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="subheadings">-Sales Return</td>
    <td class="left"><?php if($sales_return<0) {echo "<font color='red'> number_format( $sales_return, 2 )  </font>";} else{ echo number_format( $sales_return, 2 ) ;} ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="subheadings">-Sales Rebate</td>
    <td class="left"><?php if($sales_return<0) {echo "<font color='red'> number_format( $rebate, 2 )  </font>";} else{ echo number_format( $rebate, 2 ) ;} ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="subheadings">-Cost of Goods Sold</td>
    <td class="left"><?php if($cogs<0) {echo "<font color='red'> number_format( $cogs, 2 )  </font>";} else{ echo number_format( $cogs, 2 ) ;} ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="subtotal">Gross Margin</td>
    <td>&nbsp;</td>
    <?php  $gross_margin=$sales-($sales_return+$cogs+$rebate); ?>
    <td class="right"><?php if($gross_margin<0) {echo "<font color='red'><b>number_format( $gross_margin, 2 )</b> </font>";} else{ echo "<b>".number_format( $gross_margin, 2 ) ."</b>" ;} ?></td>
  </tr>
  <tr>
    <td class="head"><u>Expenses</u></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php if(count($expenses)>0){ ?>
  <?php $total_expenses=0; foreach ($expenses as $row){ ?>
  <tr>
    <td class="subheadings"><?php echo $row['account_name'];?></td>
    <td class="left"><?php echo number_format($row['expense_amount'], 2 ) ;?></td>
    <td>&nbsp;</td>
  </tr>
  <?php $total_expenses +=$row['expense_amount'];?>
  <?php  }  ?>
  <?php  } else {$total_expenses=0;} ?>
  <tr>
    <td class="subtotal">Total Expenses</td>
    <td>&nbsp;</td>
    <td class="right"><?php echo  number_format($total_expenses, 2);?></td>
  </tr>
  <tr>
    <td class="head"><u>Income From Other Sources</u></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td class="subheadings">Income From Other Sources</td>
    <td>&nbsp;</td>
    <td class="right"><?php if($income_frm_other_src<0) {echo "<font color='red'> number_format( $income_frm_other_src, 2 ) </font>";} else{ echo number_format( $income_frm_other_src, 2 );} ?></td>
   
  </tr>
  <tr>
   <tr>
    <td class="total">Net Income</td>
    <td>&nbsp;</td>
    <?php  $total=($gross_margin+$income_frm_other_src)-$total_expenses; $total= number_format($total, 2);?>				
    <td class="right"><?php if($total<0) {echo "<font color='red'>Tk $total </font>";} else{ echo "Tk ". $total;} ?></td>
  </tr>
</table> 
	     
	     
  	</div>
               
 	</div>
 <!-- End of Main Area/Content  -->      
         
 <!-- Footer --> 
<div id="footer" class="span-24">
<?php $this->load->view('includes/footer');?>
</div>
<!-- Footer Ends -->  
     
      
 </div>      


  </body> 
</html> 