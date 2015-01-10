<style>
.control-label{
padding-top: 5px !important;
font-size:12px !important;
text-align:left !important;
}

.btn, ul > li a{
font-size:12px;
color: #555;
}

</style>

<form role="form" name="myForm" class="form-horizontal" enctype="multipart/form-data" action="" method="post" autocomplete="off" >

<!-- Row 1 -->


<!-- Column 1 -->
<div class="col-md-3">

     <div class="form-group">
     <label class="col-md-5 control-label">Item Type</label>
       <div class="col-md-7">
       <?php echo form_dropdown('item_type_id', $dropdown_item_types, '','class="form-control input-sm item-type"');  ?> 
       <?php echo form_error("item_type_id"); ?> 
       </div>
     </div>
     <div class="form-group">
     <label class="col-md-5 control-label">Parent Item</label>
       <div class="col-md-7">
       <?php echo form_dropdown('parent_item_id', $dropdown_items, '','class="form-control input-sm"'); ?> 
       <?php echo form_error("parent_item_id"); ?> 
       </div>
     </div> 
     <div class="form-group">
     <label class="col-md-5 control-label">Item Name</label>
       <div class="col-md-7">
            <input type="text" class="form-control input-sm"  name="item_name" id="item_name" value="<?php echo set_value("item_name"); ?>" >  
            <?php echo form_error("item_name"); ?> 
       </div>
     </div>   
     <div class="form-group">
     <label class="col-md-5 control-label">Will have sub items</label>
       <div class="col-md-7">
        <input  type="checkbox" name="has_subitem" id="has_subitem" data-size="small">      
    	<?php echo form_error("has_subitem"); ?> 
       </div>
     </div>
         
     
     <div id="Display_on_assembly">
     <div class="form-group">
     <label class="col-md-5 control-label">Unit</label>
       <div class="col-md-7">
       <?php echo form_dropdown('unit_id', $dropdown_units, '','class="form-control"'); ?> 
       <?php echo form_error("unit_id"); ?> 
       </div>
     </div>

     <div class="form-group">
     <label class="col-md-5 control-label">Item Code</label>
       <div class="col-md-7">
            <input type="text" class="form-control"  name="item_code" id="item_code" value="<?php echo set_value("item_code"); ?>" >  
            <?php echo form_error("item_code"); ?> 
       </div>     
     </div>

    

     <div class="form-group">
     <label class="col-md-5 control-label">Asset Account</label>
       <div class="col-md-7">
            <?php
     $options = array(''  => 'Select','small' => 'Small Shirt',); 
     echo form_dropdown('asset_account', $options, '','class="form-control"');
   ?> 
    <?php echo form_error("asset_account"); ?> 
       </div>
     </div>

     <div class="form-group">
     <label class="col-md-5 control-label">Re Order Level</label>
       <div class="col-md-7">
            <input type="text" class="form-control"  name="reorder_level" id="reorder_level" value="<?php echo set_value("reorder_level"); ?>" >  <?php echo form_error("reorder_level"); ?> 
       </div>
     </div>

     <div class="form-group">
     <label class="col-md-5 control-label">On Hand</label>
       <div class="col-md-7">
            <input type="text" class="form-control"  name="on_hand" id="on_hand" value="<?php echo set_value("on_hand"); ?>" >  <?php echo form_error("on_hand"); ?> 
       </div>
     </div>

     <div class="form-group">
     <label class="col-md-5 control-label">Total Value</label>
       <div class="col-md-7">
            <input type="text" class="form-control"  name="total_value" id="total_value" value="<?php echo set_value("total_value"); ?>" >  <?php echo form_error("total_value"); ?> 
       </div>
     </div>
     
     
     </div>
     
     
     
     
     
     
     
     

</div>
<!-- End of Column 1 -->

<div class="col-md-9">
<!-- Column 2 -->
<div  class="col-md-6">

     <div class="form-group">
     <label class="col-md-5 control-label">Cost</label>
       <div class="col-md-7">
            <input type="text" class="form-control input-sm"  name="cost" id="cost" value="<?php echo set_value("cost"); ?>" >  
            <?php echo form_error("cost"); ?> 
       </div>
     </div>
     <div class="form-group">
     <label class="col-md-5 control-label">COGS Account</label>
       <div class="col-md-7">
       <?php $options = array(''  => 'Select','small' => 'Small Shirt',); 
     echo form_dropdown('cogs_account', $options, '','class="form-control cogs_account"');
   ?> 
    <?php echo form_error("cogs_account"); ?> 
       </div>
     </div>


</div>
<!-- End of Column 2 -->

<!-- Column 3 -->
<div class="col-sm-6">

<div class="form-group">
     <label class="col-md-5 control-label">Price</label>
       <div class="col-md-7">
            <input type="text" class="form-control input-sm"  name="price" id="price" value="<?php echo set_value("price"); ?>" >  
            <?php echo form_error("price"); ?> 
       </div>
     </div>	
     <div class="form-group">
     <label class="col-md-5 control-label">Income Account</label>
       <div class="col-md-7">
            <?php
     $options = array(''  => 'Select','small' => 'Small Shirt',); 
     echo form_dropdown('income_account', $options, '','class="form-control input-sm"');
   ?> 
    <?php echo form_error("income_account"); ?> 
       </div>
     </div>	
     <div class="form-group">
     <label class="col-md-5 control-label">Tax Code</label>
       <div class="col-md-7">
            <?php
     $options = array(''  => 'Select','small' => 'Small Shirt',); 
     echo form_dropdown('tax_code_id', $options, '','class="form-control input-sm"');
   ?> 
    <?php echo form_error("tax_code_id"); ?> 
       </div>
     </div>
</div>
<!-- End of Column 3 -->

<div class="col-md-12">
adasd
</div>

</div>




    




     
     

     
     <div class="form-group">        
     	<div class="col-sm-offset-2 col-sm-10">     
     		<button type="submit" class="btn btn-default">Submit</button>        
     	</div>     
     </div>
</form>
<script>
$(function() {
    
    $( "#item_type" ).change(function() {
          alert($(this).find(":selected").data("title"));
    });   
    
});
</script>
