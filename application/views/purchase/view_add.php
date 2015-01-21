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
      <div class="content-title">Purchase Order</div>
      <div class="form-group">
         <label class="col-md-5 control-label">Vendor</label>
         <div class="col-md-7">
            <?php echo form_dropdown('vendor_id', $dropdown_vendors, set_value("vendor_id"),'class="form-control boot-dropdown"');  ?> 
            <?php echo form_error("vendor_id"); ?> 
         </div>
      </div>

      <div class="form-group">
         <label class="col-md-5 control-label">Order Date</label>
         <div class="col-md-7">
            <input type="text" class="form-control"  name="order_date" id="order_date" value="<?php echo set_value("order_date"); ?>" >  
            <?php echo form_error("order_date"); ?> 
         </div>
      </div>
      <div class="form-group">
         <label class="col-md-5 control-label">FOB Date</label>
         <div class="col-md-7">
            <input type="text" class="form-control"  name="fob_date" id="fob_date" value="<?php echo set_value("fob_date"); ?>" >      
            <?php echo form_error("fob_date"); ?> 
         </div>
      </div>
      
      <div class="form-group">
         <label class="col-md-5 control-label">Instruction</label>
         <div class="col-md-7">
           <textarea name="instruction" class="form-control" rows="20"><?php echo set_value("instruction"); ?></textarea>            
            <?php echo form_error("instruction"); ?> 
         </div>
      </div>
      
     <div class="form-group pull-right">
      <div class="col-md-12">     
         <button type="submit" class="btn btn-default btn-lg">Submit</button>        
      </div>
   	 </div>
      <div style="clear:both;"></div>

   </div>
   <!-- End of Column 1 -->

   <div class="col-md-offset-1 col-md-8">

     
      <input type="hidden" name="bill_of_materials">
      
      <div class="content-title-2">Items</div>
      <div style="">
      <?php if(count($dropdown_items) > 0) :?>
         <table class="table table-striped" id="bill_of_materials">
            <thead>
               <tr>
                  <th class="col-md-5">Item</th>                
                  <th>Quantity</th>
                  <th>Unit</th>
                  <th>Price</th>                  
                  <th>Total</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td class="col-md-5">
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
                  <td class="col-md-2"><input type="text" name="quantity[]" class="f-control quantity"></td>
                  <td class="col-md-1"><input type="text" name="unit[]" class="f-control unit"></td>                  
                  <td class="col-md-2"><input type="text" name="cost[]" class="f-control cost"></td>
                  <td class="col-md-2"><input type="text" name="total[]" class="f-control total"></td>                  
               </tr>               
            </tbody>
            <tfoot>
		            <tr>
					      <th></th>
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
</form>

<script>
$(function() {

	$('html').bind('keypress', function(e){
		if(e.keyCode == 13)
		{
		    return false;
		}
	});

	

       $(".quantity").TouchSpin();
       $('.currency').number( true, 2 );

	  
    	       
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


$('body').on('click', '#bill_of_materials .dropdown-menu li a', function(event) {
	   event.preventDefault();    	   
	   var selText = $(this).text();
	   var id = $(this).data("id");
	   var cost = $(this).data("cost");
	   var row = $(this).closest('tr');
	   row.find(".product").val(selText);    	
	   row.find(".product_id").val(id);	
	   
 	
	 });




</script>
<?php if (count($dropdown_items) > 0) :?>
<table id="dbtable" style="display:none">
   <tr>
      <td class="col-md-3">
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
     <td class="col-md-2"><input type="text" name="quantity[]" class="f-control quantity"></td>
     <td class="col-md-1"><input type="text" name="unit[]" class="f-control unit"></td>                  
     <td class="col-md-2"><input type="text" name="cost[]" class="f-control cost"></td>
     <td class="col-md-2"><input type="text" name="total[]" class="f-control total"></td> 
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