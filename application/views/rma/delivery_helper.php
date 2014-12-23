<?php if (count($cart)>0) {?>

				       
	<table class="gtable" style="table-layout:fixed; overflow-x:hidden">
		
		  <tr>
		 	
		      <td><b>Description</b></td>
		   		<td><b>Cancel</b></td>
		  </tr>
		 
		 <?php $sum1=0; $sum2=0; $i = 0; foreach($cart as $item_id=>$row){ $i++; ?> 
		  <tr class="item-row" style="border-bottom:1px dotted black;">
		  	
		  	<input type="hidden" name="previous_product_id[]" value="<?php echo $row['product_id'];?>" />
		  	<input type="hidden" name="previous_product_serial[]" value="<?php echo $row['product_serial'];?>" />
		  	<input type="hidden" name="product_name[]" value="<?php echo $row['product_name'];?>" />
		  	<input type="hidden" name="sales_invoice[]" value="<?php echo $row['sold_invoice'];?>" />
		  	
		  	<input type="hidden" name="new_product_id[]" value="<?php echo $row['new_product_id'];?>" />
		  	<input type="hidden" name="new_product_serial[]" value="<?php echo $row['new_serial'];?>" />
		  	<input type="hidden" name="new_product_name[]" value="<?php echo $row['new_product_name'];?>" />
		  	<input type="hidden" name="acc_rec[]" value="<?php echo $row['acc_rec'];?>" />
		  	<input type="hidden" name="acc_pay[]" value="<?php echo $row['acc_pay'];?>" />
		  	 
		  	  <td><b>Received Product</b>: <br><br>
		  	  <?php echo $row['product_name']; ?>, Product Serial: <?php echo $row['product_serial']; ?>, <br> Sales Invoice# <?php echo $row['sold_invoice']; ?>, Sold Date <?php echo date("d-m-Y",strtotime($row['sold_date'])); ?>
		  	  
		  	  </td>
		  	  <td><a href="<?php echo $row['product_serial'];?>" title="Delete" class="delete"><img src="<?php echo base_url();?>support_admin/images/icons/remove.png"></a></td>
		  </tr>
		  
		   <tr class="item-row" style="border-top:1px dotted black; border-bottom:1px dotted black;">
		  	  <td><b>Delivery Product</b>: <br><br>
		  	 
		  	 		  	  
		  	  <?php echo $row['new_product_name']; ?>, Product Serial: <?php echo $row['new_serial']; ?>
		  	   <br><br> <span>Receivable: <?php echo $row['acc_rec'];?></span> <span style="margin-left: 50%;">Payble: <?php echo $row['acc_pay'];?></span>
		  	  </td>
		  	    <td>&nbsp;</td>	 
		  </tr>
				<?php $sum1 += str_replace(",", "", $row['acc_rec']);  $sum2 += str_replace(",", "", $row['acc_pay']);?>	

		<?php  } ?>
		
		<tr class="item-row" style="border-top:1px dotted black;">
		  	  <td>
		  	  <span><b>Total Receivable</b>: <?php echo number_format($sum1, 2) ;?></span> <span>, <b>Total Payble</b>: <?php echo number_format($sum2, 2) ;?></span>
		  	  </td>
		  	  <td>&nbsp;</td>
		  	  
		  </tr>
		
		</table>
		
		 		     
	
	<div align="right"><button id="button1" name="confirm_print" class="button">Confirm & Print</button> </div>					
						
						
						
<script  type="text/javascript">
   $(function(){ // added
	  
    $('a.delete').click(function(){
   	var a_href = $(this).attr('href'); 

    				if (confirm("Are you sure you want to contiune with this request?")) {
    				     //Do stuff
    	  								
    				
    				    	    				
   		 $.ajax({
    	        
      	 type: "POST",
      	 url: "<?php echo base_url(); ?>rma/delete_cart_item_delivery",
      	 data: "id="+a_href,
      	 success: function(server_response){

      				$(".result").html(server_response);
      		 
      	 			}				
					  												
												   		
   				});	//$.ajax ends here

    				}//if confirmation ends here
   					return false
   		});//.click function ends here
   }); // function ends here											   
</script> 							
				
				

<?php }else { $this->session->unset_userdata('cart');}?>
			