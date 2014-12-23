<?php if(!empty($records)) { ?> 
<form role="form" name="myForm" class="form-horizontal" enctype="multipart/form-data" action="" method="post" autocomplete="off" >
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
     <div class="form-group">
     <label class="col-md-2 control-label">Category</label>
       <div class="col-md-3">
            <input type="text" class="form-control"  name="category_name" id="category_name" value="<?php echo $records[0]["category_name"]; ?>" >  <?php echo form_error("category_name"); ?> 
       </div>
     </div>

   <input type="hidden" name="category_id" value="<?php echo $records[0]['category_id']; ?>" > 
     <div class="form-group"> 
        <div class="col-sm-offset-2 col-sm-10"> 
           <a href="<?php echo base_url();?>category/show" class="btn btn-success">Go Back</a> 
           <button type="submit" class="btn btn-default">Submit</button> 
        </div> 
     </div> 

</form><?php } else {echo "No Records Found" ;}?> 
