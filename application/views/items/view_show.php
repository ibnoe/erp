<?php if(!empty($records)) { ?> 
<table class='table table-hover' id='gtable'> 
  <thead> 
    <tr> 
       <th>SL#</th> 
       <th>Item_type_id</th> 
       <th>Parent_item_id</th> 
       <th>Item_name</th> 
       <th>Has_subitem</th> 
       <th>Unit_id</th> 
       <th>Item_code</th> 
       <th>Is_active</th> 
       <th>Asset_account</th> 
       <th>Reorder_level</th> 
       <th>On_hand</th> 
       <th>Total_value</th> 
       <th>Description_purchase</th> 
       <th>Cost</th> 
       <th>Cogs_account</th> 
       <th>Description_sales</th> 
       <th>Price</th> 
       <th>Income_account</th> 
       <th>Tax_code_id</th> 
       <th>Edit</th> 
       <th>Delete</th> 
    </tr> 
  </thead> 


  <tbody> 
    <?php $i = 0; foreach($records as $rows) { $i++ ?> 
    <tr> 
       <td><?php echo $i ; ?></td> 
       <td><?php echo $rows['item_type_id'] ; ?></td> 
       <td><?php echo $i ; ?></td> 
       <td><?php echo $rows['parent_item_id'] ; ?></td> 
       <td><?php echo $i ; ?></td> 
       <td><?php echo $rows['item_name'] ; ?></td> 
       <td><?php echo $i ; ?></td> 
       <td><?php echo $rows['has_subitem'] ; ?></td> 
       <td><?php echo $i ; ?></td> 
       <td><?php echo $rows['unit_id'] ; ?></td> 
       <td><?php echo $i ; ?></td> 
       <td><?php echo $rows['item_code'] ; ?></td> 
       <td><?php echo $i ; ?></td> 
       <td><?php echo $rows['is_active'] ; ?></td> 
       <td><?php echo $i ; ?></td> 
       <td><?php echo $rows['asset_account'] ; ?></td> 
       <td><?php echo $i ; ?></td> 
       <td><?php echo $rows['reorder_level'] ; ?></td> 
       <td><?php echo $i ; ?></td> 
       <td><?php echo $rows['on_hand'] ; ?></td> 
       <td><?php echo $i ; ?></td> 
       <td><?php echo $rows['total_value'] ; ?></td> 
       <td><?php echo $i ; ?></td> 
       <td><?php echo $rows['description_purchase'] ; ?></td> 
       <td><?php echo $i ; ?></td> 
       <td><?php echo $rows['cost'] ; ?></td> 
       <td><?php echo $i ; ?></td> 
       <td><?php echo $rows['cogs_account'] ; ?></td> 
       <td><?php echo $i ; ?></td> 
       <td><?php echo $rows['description_sales'] ; ?></td> 
       <td><?php echo $i ; ?></td> 
       <td><?php echo $rows['price'] ; ?></td> 
       <td><?php echo $i ; ?></td> 
       <td><?php echo $rows['income_account'] ; ?></td> 
       <td><?php echo $i ; ?></td> 
       <td><?php echo $rows['tax_code_id'] ; ?></td> 
       <td> <a href='<?php echo base_url();?>items/edit/<?php echo $rows['item_id']; ?>'>Edit</a> 
       <a href='<?php echo $rows['item_id']; ?>'>Delete</a> </td> 
    </tr> 
   <?php } ?> 
  </tbody> 

</table> 
<span id="url_id" style="display: none;"></span> 
<span id="url_address" style="display: none;"><?php echo base_url(); ?>items/delete_item</span> 
<?php $this->load->view('includes/delete_modal');?> 
<?php } else {echo 'No Records Found';} ?>