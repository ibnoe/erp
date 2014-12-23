<?php if (count($cart)>0) {?>
<table class="gtable" align="center" style="table-layout:fixed; overflow-x:hidden">
<thead>
	<tr>
		<th width="20px">#</th>
		<th width="35%">Product Name</th>
		<th>Unit Cost</th>
		<th>Sold Price</th>
		
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
	    <td ><?php echo $row['product_name'];?></td>
	    <td><input class="numeric" readonly="readonly" name="unit_cost[]" value="<?php echo str_replace(",", "", $row['unit_cost']);?>" size="10"></td>
	    <td><input class="rate numeric" type="text" name="rate[]" value="<?php echo str_replace(",", "", $row['price']);?>" size="10"></td>
	    
	    <td><input readonly="readonly" name="quantity[]" value="<?php echo $row['quantity'];?>" size="5"></td>
	    <td><input class="total" readonly="readonly" name="total[]" value="<?php echo $subtotal=$row['price']*$row['quantity'];?>" size="15"></td>      
			            
	    <td><a href="<?php echo $row['product_id'];?>" title="Delete" class="delete"><img src="<?php echo base_url();?>support_admin/images/icons/remove.png"></a></td>
				             
		<?php $total +=$subtotal;?> 		            	 
								 
				        
	<?php  } ?>			       
				      
				
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td colspan="3" style="background:#CCCCCC; text-align:center;">Total Amount</td>
		<td><input readonly="readonly" name="total_amount" id="total_amount" value="<?php echo $total;?>"  style="border: 0px; background:transparent;"></td>
    	<td>&nbsp;</td>
    </tr>
	
						
						
	</tbody>											
	</table>					
						
	<div align="right"><button id="button1" name="confirm_print" class="button">Confirm</button> </div>				

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
    var productID = $(this).closest('tr').find('input[name^="product_id"]').val();
    var qty = $(this).closest('tr').find('input[name^="quantity"]').val();
    var unit_cost = $(this).closest('tr').find('input[name^="unit_cost"]').val();
    var price = $(this).val();
    
    $.ajax({type: "POST",url: "<?php echo base_url(); ?>sales/sales_return_edit_cart_items",
    	data: {product_id: productID, quantity: qty,price: price,unit_cost:unit_cost},
    });	//$.ajax ends here	 
    // End of updating				   		
			
    
    $("#total_amount").val("");
    $("#total_amount").val(totalamount).formatCurrency();
  
   	var balance= totalamount-amountpaid;
   		$("#balance").val(""); 
        $("#balance").val(balance).formatCurrency();
       
});



$(":text[name='quantity[]']").bind("keyup", function() {
    var totalamount = 0;
    $("tr").each(function() {
        var quantity = +$(this).find(":text[name='quantity[]']").val() || 0;
        var rate = +$(this).find(":text[name='rate[]']").val() || 0;
        var subtotal = accounting.unformat(quantity) * accounting.unformat(rate);
        $(this).find(":text[name='total[]']").val(subtotal).formatCurrency();
        totalamount += subtotal;
        
    });

    //Updating the values in session
    var productID = $(this).closest('tr').find('input[name^="product_id"]').val();
    var price = $(this).closest('tr').find('input[name^="rate"]').val();
    var unit_cost = $(this).closest('tr').find('input[name^="unit_cost"]').val();
    var qty = $(this).val();
   
    $.ajax({type: "POST",url: "<?php echo base_url(); ?>sales/sales_return_edit_cart_items",
    	data: {product_id: productID, quantity: qty,price: price,unit_cost:unit_cost},
    });	//$.ajax ends here	 
    // End of updating
     
    $("#total_amount").val("");
    $("#total_amount").val(totalamount).formatCurrency();
  
   	var balance= totalamount-amountpaid;
   		$("#balance").val(""); 
     	$("#balance").val(balance).formatCurrency();

   	


         
});

</script>

<script  type="text/javascript">
   $(function(){ // added
	  
    $('a.delete').click(function(){
   	var a_href = $(this).attr('href'); 

    				if (confirm("Are you sure you want to contiune with this request?")) {
    				     //Do stuff
    	  								
    				
    				    	    				
   		 $.ajax({
    	        
      	 type: "POST",
      	 url: "<?php echo base_url(); ?>sales/sales_return_delete_cart_item",
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
<?php }else { $this->session->unset_userdata('cart');}?>