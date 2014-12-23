<?php if (count($cart)>0) {?>
<table class="gtable" align="center" style="table-layout:fixed; overflow-x:hidden">

 <tr>
	 	
     <th><b>Description</b></th>
		   
  </tr>

	
	<?php $i = 0; foreach($cart as $item_id=>$row){ $i++; ?>
						
	<tr>
	   	<td><?php echo $i; ?>.</td>
		
		<input type="hidden" name="product_serial[]" value="<?php echo $row['sold_product_serial'];?>" />
						
		<?php $product_name= $row['brand_name'] ." " . $row['category_name']. " ". $row['product_item'];  ?>
									          	 
	    <td style="width: 40px;"><?php echo "<b>".$product_name."</b>";?> </td>
	      
	     <td><?php echo $row['sold_product_serial'];?></td> 
	      <td><?php echo $row['invoice_number'];?></td> 
	       <td><?php echo $row['sold_date'];?></td>     
	    <td><a href="<?php echo $row['sold_product_serial'];?>" title="Delete" class="delete"><img src="<?php echo base_url();?>support_admin/images/icons/remove.png"></a></td>
				             
	</tr>
				       
		
		 		     
	<?php  } ?>			
						
	
												
	
	
	</table>
	
	<div align="right"><button id="button1" name="confirm_print" class="button">Confirm</button> </div>					
						
						
						
<script  type="text/javascript">
   $(function(){ // added
	  
    $('a.delete').click(function(){
   	var a_href = $(this).attr('href'); 

    				if (confirm("Are you sure you want to contiune with this request?")) {
    				     //Do stuff
    	  								
    				
    				    	    				
   		 $.ajax({
    	        
      	 type: "POST",
      	 url: "<?php echo base_url(); ?>rma/delete_cart_item_warranty",
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
			