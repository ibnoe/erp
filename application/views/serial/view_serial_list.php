<?php if(count($records) > 0) { ?>
<table class="table table-hover" align="center" id="gtable">
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
         <?php if( $this->authex->get_user_level() == 1 ){?>	 	 							  			
         <th>Delete</th>
         <?php }?>	
      </tr>
   </thead>
   <tbody>
      <?php $i = $this->uri->segment(3) + 0; foreach ($records as $row){ $i++; ?>
      <tr id="trid_<?php echo $row['serial_id']; ?>">
         <td><?php echo $i; ?>.</td>
         <td><?php echo $row['brand_name'] ." ". $row['category_name']." ". $row['product_item'];?></td>
         <td><?php echo $row['product_serial'] ;?></td>
         <td><?php echo $row['purchase_voucher'] ;?></td>
         <td><?php echo $row['party_name'];?></td>
         <td><?php echo $row['party_invoice'];?></td>
         <td><?php echo date("d-M-y",strtotime($row['purchase_date'])) ;?></td>
         <td><?php echo $row['product_warranty'];?></td>
         <td><?php if(is_numeric($row['product_warranty'])){
            date_default_timezone_set('Asia/Dhaka'); 
            $now= strtotime(date("Y-m-d"));			     		 
            $your_date = strtotime($row['purchase_date']);
            $datediff = $now - $your_date;
            $warranty=$row['product_warranty']-floor($datediff/(60*60*24));
            
            echo $warranty ;} else {echo $row['product_warranty'];} ?></td>
         <?php if( $this->authex->get_user_level() == 1 ){?>	
         <td>  
            <a href="#" data-id="<?php echo $row['serial_id'] ;?>" class="btn btn-xs" data-toggle="modal" data-target="#confirmDelete" data-message="Are you sure you want to delete this item ?">
            <i class="glyphicon glyphicon-trash"></i> Delete
            </a>
         </td>
         <?php }?>				 			
      </tr>
      <?php  } ?>
   </tbody>
</table>
<span id="url_id" style="display: none;"></span>
<span id="url_address" style="display: none;"><?php echo base_url(); ?>serial/delete_item</span> 
<?php $this->load->view('includes/delete_modal');?>
<?php } else {echo "No Records Found";} ?>