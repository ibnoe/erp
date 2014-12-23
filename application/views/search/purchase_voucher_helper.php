<?php if(count($records) > 0) { ?>
					<table class="gtable" align="center" id="gtable">
					
				<thead>
						<tr>
							<th>Sl</th>
							<th>Purchase Date</th>
							<th>Purchase Voucher</th>
							<th>Pary</th>
							<th>Party Invoice#</th>
							<th>Amount</th>
							<th>Entry By</th>
							<th>Purchase Details</th>								 							  			
							
						</tr>
				</thead>
				
				<tbody>
		
				 <?php $i = 0; foreach ($records as $row){ $i++; ?>
						
				  
				       <tr>
				       
				          <td><?php echo $i; ?>.</td>
				          <td><?php echo date("d-m-Y", strtotime($row['purchase_date']));?></td>
				          <td><?php echo $row['purchase_voucher'];?></td>
				           <td><?php echo $row['party_name'];?></td>
				            <td><?php echo $row['party_invoice'];?></td>
				           <td><?php echo $row['purchase_total'] ;?></td>
				         <td><?php echo $row['admin_name'];?></td>
				         <td><a href="<?echo base_url();?>purchase/purchase_details/<?php echo $row['purchase_id'];?>">Details</a></td> 
				        		         
				    	 
				        </tr>
				       
				<?php  } ?>
				
								
				</tbody>
				
				</table>
						
		
	     <?php } else {echo "Sorry! No Records Found"; } ?>