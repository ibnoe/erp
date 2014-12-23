<?php if (count($cart)>0) {?>
<table class="table table-striped" align="center" style="table-layout:fixed; overflow-x:hidden">
<thead>
	<tr>
		<th style="width: 5%;">#</th>
		<th style="width: 44%;">Product Name</th>
		<th>Price</th>
		<th>Qty</th>							
		<th>Total</th>
		<th>Cancel</th>
	</tr>
</thead>
<tbody>
	
	<?php $i = 0; $total=0; foreach($cart as $item_id=>$row){ $i++; ?>
						
	<tr>
	   	<td><?php echo $i; ?>.</td>
		<input type="hidden" name="product_id[]" value="<?php echo $row['product_id'];?>" />
		<input type="hidden" name="product_serial[]" value="<?php echo $row['product_serial'];?>" />
		<input type="hidden" name="warranty[]" value="<?php echo $row['warranty'];?>" />
		
		<input type="hidden" name="buy_price[]" value="<?php echo $row['buy_price'];?>" />
		<input type="hidden" name="purchase_id[]" value="<?php echo $row['purchase_id'];?>" />
		
		<?php if($row['product_serial']){ $unique_id=$row['product_serial']; }else {$unique_id= $row['product_id'];}?>
		<input type="hidden" name="unique_id[]" value="<?php echo $unique_id;?>" />
								          	 
	    <td><?php echo "<b>".$row['product_name']."</b>"; if($row['product_serial']){echo "<br>Warranty Days: ". $row['warranty'] .",  Serial: " . $row['product_serial'];}   ?></td>
	    
	    <?php 
	    		if($this->authex->get_user_level() == 1)
	    		{ 
	    			$format='type="text"'; 
	    		} 
	    		else 
	    		{
	    			$format='readonly="readonly"';
	    		}
	    ?>
	    <td><input class="rate numeric form-control" <?php echo $format ;?> name="rate[]" value="<?php echo str_replace(",", "", $row['price']);?>" size="10"></td>
	    <td><input readonly="readonly" class="form-control" name="quantity[]" value="<?php echo $row['quantity'];?>" size="5"></td>
	    <td><input class="total form-control" readonly="readonly" name="total[]" value="<?php $subtotal=$row['price']*$row['quantity']; echo number_format($subtotal,2);?>" size="15"></td>      
	    <td><a href="<?php echo $unique_id;?>" title="Delete" class="delete"><i class="glyphicon glyphicon-remove"></i></a></td>
				             
	</tr>
				       
		 <?php $total +=$subtotal;?> 
		 		     
	<?php  } ?>			
	</tbody>
	 <tfoot>					
	<tr>
	    <td>&nbsp;</td>
		<td>&nbsp;</td>
		<td colspan="2" style="background:#CCCCCC; text-align:center;">Total Amount</td>
		 <td><input readonly="readonly" name="total_amount" id="total_amount" value="<?php echo number_format($total,2); ?>"  style="border: 0px; background:transparent;"></td>
    	<td>&nbsp;</td>
    </tr>
	</tfoot>											
	
	
	</table>
	
	 <div class="form-group pull-right">
         <div class="col-sm-10">
         	
            <button type="submit" id="button1" name="confirm_print"  class="btn btn-primary">Confirm</button>
         </div>
      </div>
	
					
						
							
				
				

<script type="text/javascript">

$(":text[name='rate[]']").bind("keyup", function() {
    var totalamount = 0;
    $("tr").each(function() {
        var quantity = +$(this).find(":text[name='quantity[]']").val() || 0;
        var rate = +$(this).find(":text[name='rate[]']").val() || 0;
        var subtotal = accounting.unformat(quantity) * accounting.unformat(rate);
        $(this).find(":text[name='total[]']").val(subtotal).formatCurrency();
        totalamount += subtotal;
        
        
    });

    //Updating the values in session
    var productID = $(this).closest('tr').find('input[name^="unique_id"]').val();
    var qty = $(this).closest('tr').find('input[name^="quantity"]').val();
    var price = $(this).val();
   
    $.ajax({type: "POST",url: "<?php echo base_url(); ?>sales/edit_cart_items",
    	data: {product_id: productID, quantity: qty,price: price},
    });	//$.ajax ends here	 
    // End of updating				   		
			
    
    $("#total_amount").val("");
    $("#total_amount").val(totalamount).formatCurrency();


      
});

</script>


<script  type="text/javascript">
   $(function(){
	  
    $('a.delete').click(function(){
   	var a_href = $(this).attr('href'); 

    				if (confirm("Are you sure you want to contiune with this request?")) {
    				     //Do stuff
    	  								
    				
    				    	    				
   		 $.ajax({
    	        
      	 type: "POST",
      	 url: "<?php echo base_url(); ?>sales/delete_cart_item_cash",
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

 <script type="text/javascript" src="<?php echo base_url();?>support_admin/js/accounting.js"></script>
 <script type="text/javascript" src="<?php echo base_url();?>support_admin/js/jquery.formatCurrency-1.4.0.js"></script>
 <script type="text/javascript" src="<?php echo base_url();?>support_admin/js/jquery.numeric.js"></script>
<script type="text/javascript">
	$(".numeric").numeric();
</script>	

<?php } else { $this->session->unset_userdata('cart');}?>
			