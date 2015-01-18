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
   .office_supply .btn{
   
    height: 27px !important;
   	padding: 2px 10px;
   } 


   
</style>

<form role="form" id="myForm" name="myForm" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url("items/add") ?>" method="post" autocomplete="off" >
   <!-- Row 1 -->
   <!-- Column 1 -->
   <div class="col-md-3">
      <div class="content-title">Basic</div>
      <div class="form-group">
         <label class="col-md-5 control-label">Item Type</label>
         <div class="col-md-7">
            <?php echo form_dropdown('item_type_id', $dropdown_item_types, set_value("item_type_id"),'class="form-control item-type boot-dropdown"');  ?> 
            <?php echo form_error("item_type_id"); ?> 
         </div>
      </div>
      <div class="form-group">
         <label class="col-md-5 control-label">Subitem of</label>
         <div class="col-md-7">
            <?php echo form_dropdown('parent_item_id', array('' => "None"), '','class="form-control boot-dropdown" id="parent_item_id" '); ?> 
            <?php echo form_error("parent_item_id"); ?> 
         </div>
      </div>
      <div class="form-group">
         <label class="col-md-5 control-label">Item Name</label>
         <div class="col-md-7">
            <input type="text" class="form-control"  name="item_name" id="item_name" value="<?php echo set_value("item_name"); ?>" >  
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
     
     <div id="item_information">	
         <div class="content-title">Item Information</div>
         <div id="Display_on_assembly">
            <div class="form-group">
               <label class="col-md-5 control-label">Unit</label>
               <div class="col-md-7">
                  <?php echo form_dropdown('unit_id', $dropdown_units, set_value("unit_id") ,'class="form-control boot-dropdown"'); ?> 
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
            <div id="inventoryInformation"> 
            <div class="form-group">
               <label class="col-md-5 control-label">Asset Account</label>
               <div class="col-md-7">
                  <?php echo form_dropdown('asset_account', $assets_accounts, '','class="form-control boot-dropdown"'); ?> 
                  <?php echo form_error("asset_account"); ?> 
               </div>
            </div>
            <div class="form-group">
               <label class="col-md-5 control-label">Re Order Level</label>
               <div class="col-md-7">
                  <input type="text" class="form-control"  name="reorder_level" id="reorder_level" value="<?php echo set_value("reorder_level"); ?>" >  <?php echo form_error("reorder_level"); ?> 
               </div>
            </div>
            
         </div>
        </div> 
      </div>
   </div>
   <!-- End of Column 1 -->
   <div id="right-column">
   <div class="col-md-offset-1 col-md-8">
      <!-- Column 2 -->
      <div  class="col-md-6 purchase transactionalRegular"> 
         <div class="content-title">Purchase</div>
         <div class="form-group purchase_cost">
            <label class="col-md-5 control-label">Cost</label>
            <div class="col-md-7">
               <input type="text" class="form-control currency"  name="purchase_cost" id="cost" value="<?php echo set_value("purchase_cost"); ?>" >  
               <?php echo form_error("purchase_cost"); ?> 
            </div>
         </div>
         <div class="form-group cogs">
            <label class="col-md-5 control-label">COGS Account</label>
            <div class="col-md-7">
               <?php echo form_dropdown('cogs_account', $cogs_accounts, '','class="form-control boot-dropdown"'); ?> 
               <?php echo form_error("cogs_account"); ?> 
            </div>
         </div>
         <div class="form-group expense">
            <label class="col-md-5 control-label">Expense Account</label>
            <div class="col-md-7">
               <?php echo form_dropdown('expense_account', $expense_accounts, '','class="form-control boot-dropdown"'); ?> 
               <?php echo form_error("expense_account"); ?> 
            </div>
         </div>
      </div>
      <!-- End of Column 2 -->
      <!-- Column 3 -->
      <div class="col-sm-6 sales transactionalRegular">
         <div class="content-title">Sales</div>
         <div class="form-group">
            <label class="col-md-5 control-label">Price</label>
            <div class="col-md-7">
               <input type="text" class="form-control currency"  name="price" id="price" value="<?php echo set_value("price"); ?>" >  
               <?php echo form_error("price"); ?> 
            </div>
         </div>
         <div class="form-group">
            <label class="col-md-5 control-label">Income Account</label>
            <div class="col-md-7">
               <?php echo form_dropdown('income_accounts', $income_accounts, '','class="form-control boot-dropdown"'); ?> 
               <?php echo form_error("income_accounts"); ?> 
            </div>
         </div>
      </div>
      <div class="col-sm-6 office_supply">
         <div class="content-title">Office Supply Information</div>
         <div class="form-group">
            <label class="col-md-5 control-label">Price</label>
            <div class="col-md-7">
               <input type="text" class="form-control input-sm currency"  name="office_supply_price" id="office_supply_price" value="<?php echo set_value("office_supply_price"); ?>" >  
               <?php echo form_error("office_supply_price"); ?> 
            </div>
         </div>
         <div class="form-group">
            <label class="col-md-5 control-label">Account</label>
            <div class="col-md-7">
               <?php echo form_dropdown('office_supply_accounts', $all_accounts_head, '','class="form-control boot-dropdown" data-live-search="true" data-size="5" '); ?> 
               <?php echo form_error("office_supply_accounts"); ?> 
            </div>
         </div>
      </div>
      
      
      <div class="col-md-12">
           <div class="form-group options_service">
           <hr>  
		         <div class="col-md-1">
		            <input  type="checkbox" name="options_service" id="options_service" data-size="small" data-flag="">	           
		         </div>
		         <label class="col-md-11 control-label">This service is used in assemblies or is performed by a subcontractor</label>
		         <hr>
		      </div>
		  <div class="form-group options_non_inventory">
           <hr>  
		         <div class="col-md-1">
		            <input  type="checkbox" name="options_non_inventory" id="options_non_inventory" data-size="small" data-flag="">	           
		         </div>
		         <label class="col-md-11 control-label">The item is used in assembles</label>
		         <hr>
		      </div>                 
      </div>
      
      
      
      <!-- End of Column 3 -->
      <div class="col-md-12 bill_of_materials">
      <input type="hidden" name="bill_of_materials">
      <hr>
      <div class="content-title-2">Bill of Materials</div>
      <div style="">
      <?php if(count($dropdown_items) > 0) :?>
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
                              <?php foreach ($dropdown_items as $row) { ?>
                              <li><a href="#" data-id="<?php echo $row['item_id']?>" data-cost="<?php echo $row['price']?>"><?php echo $row['item_name']?></a></li>                              
                              <?php }?>
                           </ul>
                        </div>
                        <!-- /btn-group -->
                        <input type="hidden" class="product_id" name="product_id[]" >
                        <input type="text" class="f-control product">
                     </div>
                     <!-- /input-group -->
                  </td>
                  <td class="col-md-2"><input type="text" name="cost[]" class="f-control cost" readonly></td>
                  <td class="col-md-2"><input type="text" name="quantity[]" class="f-control quantity"></td>
                  <td class="col-md-2"><input type="text" name="total[]" class="f-control total" readonly></td>                  
               </tr>               
            </tbody>
            <tfoot>
		            <tr>
					      <th></th>
					      <th><input type="hidden" name="complete_total" class="complete_total" /></th>
					      <th>Total</th>
					      <th id="complete_total"></th>
		    		</tr>
            </tfoot>
         </table>
         <?php else: echo "No items to add";?>
         <?php endif;?>
        </div> 
      </div>
   </div>
</div>
</form>

<script>
$(function() {

	$('html').bind('keypress', function(e){
		if(e.keyCode == 13)
		{
		    return false;
		}
	});

	jsonData_parent_item_types = <?php echo json_encode($parent_item_types) ;?>;
   
   	$("#inventoryInformation").hide();
   	$('#item_information').hide(); 
   	$(".options_service").hide();
	$(".options_non_inventory").hide();
   	$(".bill_of_materials").hide();
   	$(".expense").hide();
   	$('.purchase').hide();
   	$('.sales').hide();
   	$('.office_supply').hide();
   	$('#right-column').hide();
   	$('#has_subitem').bootstrapToggle('disable');
   	
    // Has Sub Item
    $('#has_subitem').change(function() {
        if($(this).is(":checked")) 
        {           
        	$('#item_information').show();
        	$('#right-column').show();  
        }
        else
        {
        	//$("#inventoryInformation").hide();
        	$("#item_information").hide();
           	$('#right-column').hide();           	
        }
              
    });
	
   
    $( ".item-type" ).change(function() {

    	change_subItemDropdown( this.value , jsonData_parent_item_types );
    	
    	//UnCheck Checkbox Options
    	$('#options_non_inventory').data('flag',0);
 	 	$('#options_service').data('flag', 0); 	 		   	 	    
 	 
 	 	$('#options_service').bootstrapToggle('off'); 	 	
 	 	$('#options_non_inventory').bootstrapToggle('off');
 	 	
 	 	$('#options_non_inventory').data('flag',1);
 	 	$('#options_service').data('flag', 1);
 	 		 	
 	 	
		if(this.value != '')
		{
			$('#has_subitem').bootstrapToggle('enable');
		}
		else
		{
			$('#has_subitem').bootstrapToggle('off');
			$('#has_subitem').bootstrapToggle('disable');
		}
		
 	 	if(this.value == 3)
        {
				$(".purchase_cost").hide();
				$(".purchase .content-title").text("Expense");
        }
        else
        {
        	   $(".purchase_cost").show();
			   $(".purchase .content-title").text("Purhcase");
        }
           // Service
           if(this.value == 1)
           {           
        	   hideAllItems();       	  
        	   $('.sales').show();       	  
			   $('.options_service').show();			  
			   removeAllInputValues(); 
			   
			  		
           }
           // Inventory Part
           else if(this.value == 2)
           {          	    
        	   hideAllItems();
        	  $('.sales').show();
        	  $('.purchase').show();
        	  $("#inventoryInformation").show(); 
        	  removeAllInputValues(); 		  		
           }

        // Inventory Assembly
           else if(this.value == 3)
           {         	  
        	  hideAllItems();               
        	  $('.sales').show();
        	  $('.purchase').show();
        	  $("#inventoryInformation").show();			 
			  $(".bill_of_materials").show();
			  removeAllInputValues();  
			  		
           }
        // Non Inventory
           else if(this.value == 4)
           {     
        	   
        	   hideAllItems();
        	   $('.options_non_inventory').show(); 
        	   $('.office_supply').show();
        	   removeAllInputValues();   		  		
           }
           else
           {
				// No duty
           }
           
          
     });

	// Service Option
    $('#options_service').change(function() {

    	var flag = $('#options_service').data('flag');

    	if(flag == 1)
    	{
	        if($(this).is(":checked")) 
	        {                    
	        	$('.purchase').show();
	        	$('.expense').show(); 
	        	$('.cogs').hide();
	        	removeAllInputValues(); 
	        }
	        else
	        {        	
	        	$('.purchase').hide();
	        	$('.expense').hide();
	        	$('.cogs').show(); 
	        	removeAllInputValues(); 
	        }
    	}   
              
    });

 // Non Inventory Option
    $('#options_non_inventory').change(function() {

    	var flag = $('#options_non_inventory').data('flag');

    	if(flag == 1)
    	{
	        if($(this).is(":checked")) 
	        {           	  	
	        	$('.office_supply').hide();
	        	$('.transactionalRegular').show();
	        	remove_InputValues(".office_supply");          
	        }
	        else
	        {
	        	
	        	$('.office_supply').show();
	        	$('.transactionalRegular').hide();
	        	remove_InputValues(".transactionalRegular");
	        	 
	        }
    	} 
              
    });        
    


       $(".quantity").TouchSpin();
       /* $(".currency").TouchSpin({
          /*  min: 0,           
           step: 1,
           decimals: 2, 
           //boostat: 5,
           //maxboostedstep: 10,
    	   min: 1,
           max: 1000000000,
           stepinterval: 50,
           maxboostedstep: 10000000,
            
                     
       });  */
       $('.currency').number( true, 2 );

	   function hideAllItems()
	   {
		   var Inputcontainers = [".sales",".purchase", ".options_service", ".bill_of_materials",".options_non_inventory", 
		               		   		".office_supply", "#inventoryInformation"];
		   for (var i = 0; i < Inputcontainers.length; i++) 
           {
			   $(Inputcontainers[i]).hide();
           }
	   }	

       function removeAllInputValues()
       {   
           var Inputcontainers = [".sales",".purchase", "#item_information", "#bill_of_materials",".office_supply"];
    	   var arrayLength = Inputcontainers.length;
    	   for (var i = 0; i < arrayLength; i++) 
           {
	      	     var $element = Inputcontainers[i];
	      	     $($element).children().find('input, textarea').each(function(){
	    		   $(this).val('');    		   
	    		 });   	   

	    	    $($element).children().find('option:selected').each(function(){        	 
	    		   $(this).prop("selected", false);	 
	    		   $('.boot-dropdown').selectpicker('refresh');  
	    		});	    	    
    	   }   	  
       }
       function remove_InputValues($element)
       {   
    	   var $element = Inputcontainers[i];

    	   $($element).children().find('input, textarea').each(function(){
  		   		$(this).val('');    		   
  		 	});   	   

  	    	$($element).children().find('option:selected').each(function(){        	 
  		   		$(this).prop("selected", false);	 
  		   	$('.boot-dropdown').selectpicker('refresh');  
  			});	    	      
       }
    	       
       <!-- Reload Page On Success After the submit button is clicked -->
       $('#modalButton').on('click', function(){
         
       	  	if(	$(this).data('sucess') == 1)
       	  	{
       	  	    $(".modal-text").append("Page reloading ...");
       	  		location.reload();
       	  	}	   	
       });

       // Adding Total
      MoneyOptions = <?php echo json_encode($this->authex->money_format_options()) ;?>;

       $('body').bind('keyup', ":input[name='quantity[]']" , function() {             
      
    	    var totalamount = 0;
    	    $("#bill_of_materials tbody tr").each(function() {    	    	
    	    	var product_id = $(this).find(":input[name='product_id[]']").val() || 0;    	    	
    	    	if(product_id != 0)
    	    	{
	    	        var quantity = +$(this).find(":input[name='quantity[]']").val() || 0;
	    	        var rate = +$(this).find(":input[name='cost[]']").val() || 0;
	    	        var subtotal = accounting.unformat(quantity) * accounting.unformat(rate);
	    	        $(this).find(":input[name='total[]']").val( accounting.formatMoney(subtotal, MoneyOptions) );
	    	        totalamount += subtotal;    
    	    	}
    	    });    	  
    	  $("#complete_total").html( accounting.formatMoney(totalamount, MoneyOptions)  );    	      
    	  $(".complete_total").val(totalamount);
    	});    
      // End of Adding Total 
       
});


   
</script>

<!-- Code -->
<script>
$('body').on('focus', '.product, .quantity', function() {
    
    var b = $(this).closest('tr').nextAll().length;   
    if(b < 1)
    {
        $("#bill_of_materials").find("tbody").find("tr:last");    
        for(var i=0; i<1 ;i++)
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
<?php if (count($dropdown_items) > 0) :?>
<table id="dbtable" style="display:none">
   <tr>
      <td class="col-md-6">
         <div class="input-group">
            <div class="input-group-btn">
               <div class="btn btn-default dropdown-toggle product dropdownMenu1" data-toggle="dropdown" aria-expanded="true"><span class="caret"></span></div>
               <ul class="dropdown-menu" role="menu" style="max-height:100px;overflow: auto;">
                  <?php foreach ($dropdown_items as $row) { ?>
                     <li><a href="#" data-id="<?php echo $row['item_id']?>" data-cost="<?php echo $row['price']?>"><?php echo $row['item_name']?></a></li>                              
                   <?php }?>
               </ul>
            </div>
            <!-- /btn-group -->
            <input type="hidden" class="product_id" name="product_id[]" >
            <input type="text" class="f-control product">
         </div>
         <!-- /input-group -->
      </td>
      <td><input type="text" name="cost[]" class="f-control cost" readonly></td>
      <td><input type="text" name="quantity[]" class="f-control quantity"></td>
      <td><input type="text" name="total[]" class="f-control total" readonly></td>
   </tr>
</table>
<?php endif;?>

<script>
//prepare the form when the DOM is ready 
$(function() {	
	
    var options = { 
        //target:        '#form-submit-status',   // target element(s) to be updated with server response 
        beforeSubmit:  showRequest,  // pre-submit callback 
        success:       showResponse,  // post-submit callback 
        //resetForm: true, 
    }; 
 
    // bind form using 'ajaxForm' 
    $('#myForm').ajaxForm(options); 
}); 
 
// pre-submit callback 
function showRequest(formData, jqForm, options) { 
   
	$('#FormSubmisionResponse').modal({
	    backdrop: 'static',
	    keyboard: false
	});		
    return true; 
} 
 
// post-submit callback 
function showResponse(responseText, statusText, xhr, $form)  { 

	$(".modal-title").html("");
	$(".modal-text").append("");
	
	if(responseText == "Successfully Added")
	{
		$(".modal-title").html("Status");
		$(".modal-text").html("Successfully Added");
		$("#modalButton").data('sucess', 1);		
	}
	else
	{
		$(".modal-title").html("Validation Error");
		$(".modal-text").html(responseText);
	}  
}

function change_subItemDropdown($find, jsonData)
{	   
	var options = $("#parent_item_id");
	options.val("").text("");
	options.append($("<option />").val("").text("None"));	
	$.each(jsonData, function(i, v) {
	    if (v.type == $find ) 
	    { 	    	
	      options.append($("<option />").val(v.id).text(v.name));
	      return;
	    }	    
	});
}

</script>

<!-- Delete Confirm Dialog -->
<div class="modal fade" id="FormSubmisionResponse" role="dialog" aria-labelledby="FormSubmisionResponse" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Status</h4>
      </div>
      <div class="modal-body">
        <p class="modal-text">Please wait, data is beign processing ...</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="modalButton" data-sucess="">Ok</button>       
      </div>
    </div>
  </div>
</div>