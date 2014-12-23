<?php if(!empty($records)) { ?> 
<form role="form" name="myForm" class="form-horizontal" enctype="multipart/form-data" action="" method="post" autocomplete="off" >
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
     <div class="form-group">
     <label class="col-md-2 control-label">Category</label>
       <div class="col-md-3">
       <?php echo form_dropdown('category_id', $dropdown_category, $records[0]['category_id'], 'id="category_id" class="form-control"' ); ?>       
       </div>
       <?php echo form_error("category_id"); ?> 
     </div>

     <div class="form-group">
     <label class="col-md-2 control-label">Brand</label>
       <div class="col-md-3">
       <?php     
      echo form_dropdown('brand_id', $dropdown_brands,$records[0]['brand_id'], 'id="brand_id" class="form-control"' );
       ?>     
       </div>
       <?php echo form_error("brand_id"); ?> 
     </div>

     <div class="form-group">
     <label class="col-md-2 control-label">Product Name</label>
       <div class="col-md-3">
            <input type="text" class="form-control"  name="product_item" id="product_item" value="<?php echo $records[0]["product_item"]; ?>" >  <?php echo form_error("product_item"); ?> 
       </div>
     </div>

     <div class="form-group">
     <label class="col-md-2 control-label">Unit Name</label>
       <div class="col-md-3">
            <input type="text" class="form-control"  name="unit_name" id="unit_name" value="<?php echo $records[0]["unit_name"]; ?>" >  <?php echo form_error("unit_name"); ?> 
       </div>
     </div>

     <div class="form-group">
     <label class="col-md-2 control-label">Serial Available</label>
       <div class="col-md-3">
            <?php
            $warr = array(
            		''  => 'Select',
            		'1'  => 'Yes',
            		'2'  => 'No',
            );     
     echo form_dropdown('is_serial_available', $warr, $records[0]['is_serial_available'], 'id="is_serial_available" class="form-control"' );
   ?>     
       </div>
       <?php echo form_error("is_serial_available"); ?> 
     </div>
     
      <div class="form-group">
     <label class="col-md-2 control-label">SKU Number</label>
       <div class="col-md-3">            
            <input type="text" class="form-control" name="sku_number" id="sku_number" value="<?php echo $records[0]['sku_number'] ; ?>">   
       </div>
       <?php echo form_error("sku_number"); ?>
     </div>

     <div class="form-group">
     <label class="col-md-2 control-label">Selling Price</label>
       <div class="col-md-3">
            <input type="text" class="form-control" name="selling_price" id="selling_price" value="<?php echo $records[0]['selling_price'] ; ?>">    
       </div>
       <?php echo form_error("selling_price"); ?> 
     </div>

   <input type="hidden" name="product_id" value="<?php echo $records[0]['product_id']; ?>" > 
     <div class="form-group"> 
        <div class="col-sm-offset-2 col-sm-10"> 
           <a href="<?php echo base_url();?>product/show" class="btn btn-success">Go Back</a> 
           <button type="submit" class="btn btn-default">Submit</button> 
        </div> 
     </div> 

</form><?php } else {echo "No Records Found" ;}?> 
