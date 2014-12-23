<?php if(!empty($records)) { ?> 
<form role="form" name="myForm" class="form-horizontal" enctype="multipart/form-data" action="" method="post" autocomplete="off" >
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
     <div class="form-group">
     <label class="col-md-2 control-label">Brand</label>
       <div class="col-md-3">
            <input type="text" class="form-control"  name="brand_name" id="brand_name" value="<?php echo $records[0]["brand_name"]; ?>" >  
       </div>
       <?php echo form_error("brand_name"); ?> 
     </div>

   <input type="hidden" name="brand_id" value="<?php echo $records[0]['brand_id']; ?>" > 
     <div class="form-group"> 
        <div class="col-sm-offset-2 col-sm-10"> 
           <a href="<?php echo base_url();?>brand/show" class="btn btn-success">Go Back</a> 
           <button type="submit" class="btn btn-default">Submit</button> 
        </div> 
     </div> 

</form><?php } else {echo "No Records Found" ;}?> 
