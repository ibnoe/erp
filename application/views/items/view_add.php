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
   .content-title {
   font-size:16px;
   border-bottom: 1px solid #EEE;
   margin-bottom:5%;
   }
   .content-title-2 {
   font-size:16px;
   border-bottom: 1px solid #EEE;
   margin-bottom:1%;
   }
   .form-control{
   height: 27px !important;
   padding: 5px 10px;
   font-size: 12px;
   line-height: 1.2;
   border-radius: 0px !important;
   }
   .dropdownMenu1 {
   height: 23px !important;
   border-radius: 0px !important;
   }
   .f-control {
   width: 100%;
   height: 23px !important;
   padding: 5px 10px;
   font-size: 11.5px;
   line-height: 1;
   color: #555;
   vertical-align: middle;
   background-color: #FFF;
   background-image: none;
   border: 1px solid #CCC;
   border-radius: 0px !important;
   box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.075) inset;
   transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
   }
   #bill_of_materials .btn  {
   height: 23px !important;
   	padding: 2px 10px;
   }
   .transactionalRegular  .btn {
   	height: 27px !important;
   	padding: 2px 10px;
   }
   
</style>
<form role="form" name="myForm" class="form-horizontal" enctype="multipart/form-data" action="" method="post" autocomplete="off" >
   <!-- Row 1 -->
   <!-- Column 1 -->
   <div class="col-md-3">
      <div class="content-title">Basic</div>
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
            <?php echo form_dropdown('parent_item_id', $dropdown_items, '','class="form-control input-sm parent_item_id"'); ?> 
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
      
     <div class="form-group pull-right">
      <div class="col-md-12">     
         <button type="submit" class="btn btn-default btn-lg">Submit</button>        
      </div>
   	 </div>
      <div style="clear:both;"></div>
      <div id="inventoryInformation">
         <div class="content-title">Inventory Information</div>
         <div id="Display_on_assembly">
            <div class="form-group">
               <label class="col-md-5 control-label">Unit</label>
               <div class="col-md-7">
                  <?php echo form_dropdown('unit_id', $dropdown_units, '','class="form-control item-unit"'); ?> 
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
                  <?php echo form_dropdown('asset_account', $assets_accounts, '','class="form-control asset_account"'); ?> 
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
   </div>
   <!-- End of Column 1 -->
   <div class="col-md-offset-1 col-md-8">
      <!-- Column 2 -->
      <div  class="col-md-6 transactionalRegular"> 
         <div class="content-title">Purchase</div>
         <div class="form-group">
            <label class="col-md-5 control-label">Cost</label>
            <div class="col-md-7">
               <input type="text" class="form-control currency"  name="cost" id="cost" value="<?php echo set_value("cost"); ?>" >  
               <?php echo form_error("cost"); ?> 
            </div>
         </div>
         <div class="form-group">
            <label class="col-md-5 control-label">COGS Account</label>
            <div class="col-md-7">
               <?php echo form_dropdown('cogs_account', $cogs_accounts, '','class="form-control cogs_account"'); ?> 
               <?php echo form_error("cogs_account"); ?> 
            </div>
         </div>
      </div>
      <!-- End of Column 2 -->
      <!-- Column 3 -->
      <div class="col-sm-6 transactionalRegular">
         <div class="content-title">Sales</div>
         <div class="form-group">
            <label class="col-md-5 control-label">Price</label>
            <div class="col-md-7">
               <input type="text" class="form-control input-sm currency"  name="price" id="price" value="<?php echo set_value("price"); ?>" >  
               <?php echo form_error("price"); ?> 
            </div>
         </div>
         <div class="form-group">
            <label class="col-md-5 control-label">Income Account</label>
            <div class="col-md-7">
               <?php echo form_dropdown('income_account', $income_accounts, '','class="form-control income_account"'); ?> 
               <?php echo form_error("income_account"); ?> 
            </div>
         </div>
      </div>
      <!-- End of Column 3 -->
      <div class="col-md-12">
      <hr>
      <div class="content-title-2">Bill of Materials</div>
      <div style="max-height:350px;overflow: auto; border:1px solid #EEE; ">
         <table class="table table-striped" id="bill_of_materials">
            <thead>
               <tr>
                  <th class="col-md-6">Product</th>                  
                  <th>Cost</th>
                  <th>QTY</th>
                  <th>Total</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td class="col-md-6">
                     <div class="input-group">
                        <div class="input-group-btn">
                           <div class="btn btn-default dropdown-toggle product dropdownMenu1" data-toggle="dropdown" aria-expanded="true"><span class="caret"></span></div>                          
                           <ul class="dropdown-menu" role="menu" style="max-height:100px;overflow: auto;">                             	                                         	          
                              <li><a href="#" data-id="1" data-cost="200">Action Separated link Separated link</a></li>
                              <li><a href="#" data-id="2" data-cost="250">Another action</a></li>
                              <li><a href="#" data-id="3" data-cost="120">Something else here</a></li>                              
                              <li><a href="#">Separated link</a></li>
                              <li><a href="#">Action</a></li>
                              <li><a href="#">Another action</a></li>
                              <li><a href="#">Something else here</a></li>                              
                              <li><a href="#">Separated link</a></li>
                           </ul>
                        </div>
                        <!-- /btn-group -->
                        <input type="hidden" class="product_id" name="product_id[]" >
                        <input type="text" class="f-control product">
                     </div>
                     <!-- /input-group -->
                  </td>
                  <td><input type="text" name="cost[]" class="f-control cost"></td>
                  <td><input type="text" name="quantity[]" class="f-control quantity"></td>
                  <td><input type="text" name="total[]" class="f-control total"></td>                  
               </tr>
               
            </tbody>
         </table>
        </div> 
      </div>
   </div>

</form>

<script>
   $(function() {
   
   	$("#inventoryInformation").hide();	
       $( ".item-type" ).change(function() {
   			
           if( ( this.value == 2) || ( this.value == 3) )
           {  
   			$("#inventoryInformation").show();
           }
           else
           {
           	$("#inventoryInformation").hide();
           }	             
       });


       $(".quantity").TouchSpin();
       $(".currency").TouchSpin({
           min: 0,           
           step: 1,
           decimals: 2,
           boostat: 5,
           maxboostedstep: 10, 
                     
       });    	 
    	       
       
   });
</script>

<!-- Code -->
<script>
$('body').on('focus', '.product', function() {
    
    var b = $(this).closest('tr').nextAll().length;   
    if(b < 3)
    {
        $("#bill_of_materials").find("tbody").find("tr:last");    
        for(var i=0;i<3;i++)
        {
          var $newTr = $('#dbtable tr:last').clone();     
          $("#bill_of_materials").find("tbody").append($newTr);
        }        
    }    
});


$('body').on('click', '.dropdown-menu li a', function(event) {
	   event.preventDefault();    	   
	   var selText = $(this).text();
	   var id = $(this).data("id");
	   var cost = $(this).data("cost");
	   var row = $(this).closest('tr');
	   row.find(".product").val(selText);    	
	   row.find(".product_id").val(id);	
	   row.find(".cost").val(cost);	   
 	
	 });

</script>
<table id="dbtable" style="display:none">
   <tr>
      <td class="col-md-6">
         <div class="input-group">
            <div class="input-group-btn">
               <div class="btn btn-default dropdown-toggle product dropdownMenu1" data-toggle="dropdown" aria-expanded="true"><span class="caret"></span></div>
               <ul class="dropdown-menu" role="menu" style="max-height:100px;overflow: auto;">
                 <li><a href="#" data-id="1" data-cost="200">Action Separated link Separated link</a></li>
                 <li><a href="#" data-id="2" data-cost="250">Another action</a></li>
                 <li><a href="#" data-id="3" data-cost="120">Something else here</a></li> 
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li><a href="#">Separated link</a></li>
               </ul>
            </div>
            <!-- /btn-group -->
            <input type="hidden" class="product_id" name="product_id[]" >
            <input type="text" class="f-control product">
         </div>
         <!-- /input-group -->
      </td>
      <td><input type="text" name="cost[]" class="f-control cost"></td>
      <td><input type="text" name="quantity[]" class="f-control quantity"></td>
      <td><input type="text" name="total[]" class="f-control total"></td>
   </tr>
</table>