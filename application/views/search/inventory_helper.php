<?php if(count($records) > 0) { ?>
					<table class="gtable" align="center" id="gtable">
					
				<thead>
						<tr>
							<th>Sl</th>
							<th>Product Name</th>
							<th>Product Serial</th>
							<th>Purchase Voucher</th>
							<th>Party</th>
							<th>Party Invoice</th>
							<th>Purchase Date</th>
							<th>Warranty</th>
							<th>Warranty Left</th>
							<?php if($level==1){?>
							<th>Delete</th>
							<?php }?>							
						</tr>
				</thead>
				
				<tbody>
		
				 <?php $i = 0; $total=0; foreach ($records as $row){ $i++; ?>
						
				  
				       <tr>
				       
				          <td><?php echo $i; ?>.</td>
				          <td><?php echo $row['brand_name'] ." ". $row['category_name']." ". $row['product_item'];?></td>
				          <td><?php echo $row['product_serial'] ;?></td>
				          <td><?php echo $row['purchase_voucher'] ;?></td>
				          <td><?php echo $row['party_name'];?></td>
				          <td><?php echo $row['party_invoice'];?></td>
				          <td><?php echo date("d-m-Y",strtotime($row['purchase_date'])) ;?></td>
				          <td><?php echo $row['product_warranty'];?></td>
				         <td><?php if(is_numeric($row['product_warranty'])){
				         	
				         	date_default_timezone_set('Asia/Dhaka'); 
				     		$now= strtotime(date("Y-m-d"));			     		 
				     		$your_date = strtotime($row['purchase_date']);
				     		$datediff = $now - $your_date;
				     		$warranty=$row['product_warranty']-floor($datediff/(60*60*24));
				         	
				         	echo $warranty ;} else {echo $row['product_warranty'];} ?></td>
				         <?php if($level==1){?>
				        <td><a href="<?php echo $row['serial_id'];?>" title="Delete" class="delete"><img src="<?php echo base_url();?>support_admin/images/icons/cross.png"></a></td>
				         <?php }?>	
				        </tr>
				
				
				<?php  } ?>
				
									
				
				</tbody>
							
				
				</table>
						
	    
			
<?php if($level==1){?>	

<script  type="text/javascript">
   $(function(){ // added
	   $('a.delete').live('click', function(event) {
    		var a_href = $(this).attr('href'); 

    if (confirm("Are you sure you want to contiune with this request?")) {

       	//Do stuff
   	    	    				
  		 $.ajax({
   	        
     	 type: "POST",
     	 url: "<?php echo base_url(); ?>purchase/delete_serial",
     	 data: "id="+a_href,
     	 success: function(server_response){
				if(server_response == '1'){

					location.reload();
					
						}
				if(server_response == '2'){
						
					$.showMessage("Sorry, couldn't perform the requested action. ");						  
												   
				 }
														  
     	 }//success function ends										   
												  
  		});	//$.ajax ends here									   
													
				}//if confirmation ends here
    						return false
	});//.click function ends here
}); // function ends here														   
      	
    </script>    

	<?php  } ?>			
	
	 <?php } else {echo "Sorry! No Records Found"; } ?>	