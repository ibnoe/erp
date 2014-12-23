<?php if(count($records) > 0) { ?>
<table class="table table-striped table-bordered" cellspacing="0" width="100%" align="center" id="gtable">
   <thead>
      <tr>
         <th>Sl</th>
         <th>Category</th>
         <th>Brand</th>
         <th>Product Item</th>
         <?php if( $this->authex->get_user_level() == 1 ){?>	
         <th style="text-align: right;">Avg. Cost</th>
         <?php }?>
         <th style="text-align: right;">Selling Price</th>
         <th style="text-align: right;">In Stock</th>
         <th style="text-align: right;">Serial</th>
         <?php if( $this->authex->get_user_level() == 1 ){?>			 							  			
         <th style="text-align: right;">Edit</th>
         <th style="text-align: right;">Delete</th>
         <?php }?>	
      </tr>
   </thead>
   <tbody>
      <?php $i = $this->uri->segment(3) + 0; foreach ($records as $row){ $i++; ?>
      <tr id="trid_<?php echo $row['product_id']; ?>">
         <td style="width: 6%;"><?php echo $i; ?>.</td>
         <td><?php echo $row['category_name'];?></td>
         <td><?php echo $row['brand_name'];?></td>
         <td><?php echo $row['product_item'];?></td>
         <?php if( $this->authex->get_user_level() == 1 ){?>	
         <td style="text-align: right;"><?php echo number_format($row['buy_price'],2) ;?></td>
         <?php }?>
         <td style="text-align: right;"><?php echo number_format($row['selling_price'],2) ;?></td>
         <td style="text-align: right;"><?php echo $row['in_stock'];?></td>
         <td style="text-align: right;"><?php echo $row['is_serial_available'];?></td>
         <?php if( $this->authex->get_user_level() == 1 ){?>	
         <td style="text-align: right;"> 
            <a class="btn btn-xs" href="<?php echo base_url();?>product/edit/<?php echo $row['product_id'];?>">
            <i class="glyphicon glyphicon-edit"></i>Edit
            </a> 
         </td>
         <td style="text-align: right;">  
            <a href="#" data-id="<?php echo $row['product_id'] ;?>" data-toggle="modal" data-target="#confirmDelete" data-message="Are you sure you want to delete this item ?">
            <i class="glyphicon glyphicon-trash"></i> Delete
            </a>
         </td>
         <?php }?>				 			
      </tr>
      <?php  } ?>
   </tbody>
</table>
<span id="csrf_hash" style="display: none;"><?php echo $this->security->get_csrf_hash(); ?></span>
<span id="url_id" style="display: none;"></span>
<span id="url_address" style="display: none;"><?php echo base_url(); ?>product/delete_item</span> 
<?php $this->load->view('includes/delete_modal');?>
<?php } else {echo "No Records Found";} ?>