<form role="form" name="myForm" class="form-horizontal" enctype="multipart/form-data" action="" method="post" autocomplete="off" >
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
     <div class="form-group">
     <label class="col-md-2 control-label">Brand</label>
       <div class="col-md-3">
            <input type="text" class="form-control"  name="brand_name" id="brand_name" value="<?php echo set_value("brand_name"); ?>" >  
       </div>
       <?php echo form_error("brand_name"); ?> 
     </div>

     <div class="form-group">        
     	<div class="col-sm-offset-2 col-sm-10">     
     		<button type="submit" class="btn btn-default">Submit</button>       
     	</div>     
     </div>
</form>