<?php if(count($records) > 0) { ?>
<table class="table table-hover" align="center" id="gtable">
   <thead>
      <tr>
         <th>Sl</th>
         <th>Brand Name</th>
          <?php if( $this->authex->get_user_level() == 1 ){?>	 	 							  			
         <th>Edit</th>
         <th>Delete</th>
         <?php }?>	
      </tr>
   </thead>
   <tbody>
      <?php $i = $this->uri->segment(3) + 0; foreach ($records as $row){ $i++; ?>
      <tr id="trid_<?php echo $row['brand_id']; ?>">
         <td><?php echo $i; ?>.</td>
         <td><?php echo $row['brand_name'];?></td>
        <?php if( $this->authex->get_user_level() == 1 ){?>	
         <td> 
         	<a class="btn btn-xs" href="<?php echo base_url();?>brand/edit/<?php echo $row['brand_id'];?>">
       		<i class="glyphicon glyphicon-edit"></i>Edit
       		</a> 
        </td>
       <td>  
       		<a href="#" data-id="<?php echo $row['brand_id'] ;?>" class="btn btn-xs" data-toggle="modal" data-target="#confirmDelete" data-message="Are you sure you want to delete this item ?">
			<i class="glyphicon glyphicon-trash"></i> Delete
			</a>
		</td>  
         
         
         
         
         <?php }?>				 			
      </tr>
      <?php  } ?>
   </tbody>
</table>

<span id="url_id" style="display: none;"></span>
<span id="url_address" style="display: none;"><?php echo base_url(); ?>brand/delete_item</span> 

<?php $this->load->view('includes/delete_modal');?>

<?php } else {echo "No Records Found";} ?>
