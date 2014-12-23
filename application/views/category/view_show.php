<?php if(count($records) > 0) { ?>
<table class="table table-striped table-bordered" cellspacing="0" width="100%" align="center" id="gtable">
   <thead>
      <tr>
         <th>Sl</th>
         <th>Category Name</th>
          <?php if( $this->authex->get_user_level() == 1 ){?>	 	 							  			
         <th>Edit</th>
         <th>Delete</th>
         <?php }?>	
      </tr>
   </thead>
   <tbody>
      <?php $i = $this->uri->segment(3) + 0; foreach ($records as $row){ $i++; ?>
      <tr id="trid_<?php echo $row['category_id']; ?>">
         <td><?php echo $i; ?>.</td>
         <td><?php echo $row['category_name'];?></td>
        <?php if( $this->authex->get_user_level() == 1 ){?>	
         <td> 
         	<a class="btn btn-xs" href="<?php echo base_url();?>category/edit/<?php echo $row['category_id'];?>">
       		<i class="glyphicon glyphicon-edit"></i>Edit
       		</a> 
        </td>
       <td>  
       		<a href="#" data-id="<?php echo $row['category_id'] ;?>" class="btn btn-xs" data-toggle="modal" data-target="#confirmDelete" data-message="Are you sure you want to delete this item ?">
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
<span id="url_address" style="display: none;"><?php echo base_url(); ?>category/delete_item</span> 
<?php $this->load->view('includes/delete_modal');?>
<?php } else {echo "No Records Found";} ?>
