 <?php echo validation_errors(); ?>
<div id="response" class="alert hide"></div>
 <div class="col-md-6">
   <form role="form" id="myForm" name="myForm" class="form-horizontal" enctype="multipart/form-data" action="" method="post" autocomplete="off" >
      <div class="form-group">
         <label class="col-md-4 control-label">Category</label>
         <div class="col-md-5">
            <?php echo form_dropdown('category_id', $dropdown_category,'', 'id="category_id" class="form-control"' ); ?>
         </div>
      </div>
      <div class="form-group">
         <label class="col-md-4 control-label">Brand</label>
         <div class="col-md-5">
            <?php 
               $brand = array(
                               ''  => 'Select',
                               );
               echo form_dropdown('brand_id', $brand,'', 'id="brand_id" class="form-control"' ); ?>
         </div>
      </div>
      <div class="form-group">
         <label class="col-md-4 control-label">Product Item</label>
         <div class="col-md-5">
            <?php 
               $product_id = array(
                               ''  => 'Select',
                               );
               
               echo form_dropdown('product_id', $product_id,'', 'id="product_id" class="form-control"' ); ?> 
         </div>
      </div>
      <div class="form-group">
         <label class="col-md-4 control-label">Purchase Voucher#</label>
         <div class="col-md-5">
            <input type="text" class="form-control" name="purchase_voucher" id="purchase_voucher">
         </div>
      </div>
      
      <div class="form-group">
         <label class="col-md-4 control-label">Warranty In Days</label>
         <div class="col-md-5">
            <input type="text" class="form-control" name="warranty_period" id="warranty_period">
         </div>
      </div>
      
      <div class="form-group">
         <label class="col-md-4 control-label">Product Serial 1</label>
         <div class="col-md-5">
            <input type="text" class="form-control" name="product_serial[]" id="">
         </div>
      </div>
      
      <div class="form-group">
         <label class="col-md-4 control-label">Product Serial 2</label>
         <div class="col-md-5">
            <input type="text" class="form-control" name="product_serial[]" id="">
         </div>
      </div>
      
      <div class="form-group">
         <label class="col-md-4 control-label">Product Serial 3</label>
         <div class="col-md-5">
            <input type="text" class="form-control" name="product_serial[]" id="">
         </div>
      </div>
     
     
     
      <div class="form-group">
         <div class="col-sm-offset-4 col-sm-10">
            <button type="submit" class="btn btn-primary">Submit</button>
         </div>
      </div>
      
      
   </form>
</div>
<div class="col-md-6">
   <span class="result" style="font-size:14px;"></span><br>
   <span class="errormsg2" style="font-size:14px;color:red;"></span>
   <div id="loading" style="display:none;"><img src="<?php echo base_url();?>support_admin/images/ajax-loader.gif"></div>
</div>



<script>
$(function () {   

    // validate signup form on keyup and submit
    var validator = $("#myForm").validate({
        showErrors: function (errorMap, errorList) {
            $(".errormsg2").html($.map(errorList, function (el) {
                return el.message;
            }).join(", "));
        },
        wrapper: "span",
        rules: {
            category_id: "required",
            brand_id: "required",
            product_id: "required",

            warranty_period: {
                required: true,
                number: true
              },
            product_serial: "required",
            purchase_voucher: {
                required: true,
                remote: {
                    url: '<?php echo base_url();?>serial/validity_check_purchase_voucher',
                    async: false,
                    type: 'post'
                }
            }
        },
        messages: {

            category_id: "Select Category",
            brand_id: "Select Brand",
            product_id: "Select Product",

            warranty_period: {
                required: "Enter Warranty",
                number: "Warranty in Days"
              },
            product_serial: "Please select an Excel File with your product's serials in it",
            purchase_voucher: {
                required: "Enter Purchase Voucher",
                remote: jQuery.format("Wrong Voucher Number Provided")
            },
        }
    });


});

</script>


 	 	 
 	
	        

 
<script  type="text/javascript">
$(function () {
    $('#category_id').change(function () {
        var a_href = $(this).val();


        if (a_href == "") {

            $("#brand_id").html("<option value=''>Select</option>");
            $("#product_id").html("<option value=''>Select</option>");


        } else {
            //Do stuff

            $.ajax({

                type: "POST",
                url: "<?php echo base_url(); ?>common/get_brands_custom",
                data: "category_id=" + a_href,
                success: function (server_response) {

                    $("#brand_id").html(server_response);

                    $("#product_id").html("<option value=''>Select</option>");

                }

            }); //$.ajax ends here

        } //if else		
        return false
    }); //.click function ends here



}); // function ends here														   
      	
 </script>
 
 <script  type="text/javascript">
 $(function () { // added
     $('#brand_id').change(function () {
         var b_href = $(this).val();
         var a_href = $('#category_id').val();

         if (b_href == "") {


             $("#product_id").html("<option value=''>Select</option>");


         } else {
             //Do stuff

             $.ajax({

                 type: "POST",
                 url: "<?php echo base_url(); ?>common/get_products_custom",

                 data: {
                     category_id: a_href,
                     brand_id: b_href
                 },
                 success: function (server_response) {

                     $("#product_id").html(server_response);


                 }

             }); //$.ajax ends here

         } //if else		
         return false
     }); //



 }); // function ends here														   
      	
 </script>
 
 <script  type="text/javascript">
 $(function () { 
	    $('#purchase_voucher').change(function () {
		    
	    	var purchase_voucher  = $(this).val();
	        var product_id =  $('#product_id').val();     

	        $.ajax({

	            type: "POST",
	            url: "<?php echo base_url(); ?>serial/number_of_serial_to_fill",

	            data: {product_id : product_id, purchase_voucher : purchase_voucher },
	            success: function (server_response) {

					if(server_response)
					{	
		                var resText = "Total serial needed to adjust with the stock level is " + server_response;
		                $(".result").html(resText);
					}
	            }
	        }); //$.ajax ends here				  

	        return false
	    }); //			

	}); // function ends here														   
 	
   </script>	

 

<script type="text/javascript"> 

$(function () {
    var options = {
        //target:        '#output1',   // target element(s) to be updated with server response 
        beforeSubmit: showRequest,
        success: showResponse // post-submit callback 


    };

    // bind form using 'ajaxForm' 
    $('#myForm').ajaxForm(options);
});

function showRequest() {

    $("#loading").show();
}

// post-submit callback 
function showResponse(responseText, statusText, xhr, $form) {

    if (responseText == 1) {

   
        $("#loading").hide();
       
        $('#myForm').resetForm();
        $("#response").removeClass("alert-danger") ;
        $("#response").html('Successfully Added').addClass('alert-success').removeClass("hide").hide().fadeIn("slow");
         setTimeout(function() {
             $('#response').addClass('hide').fadeIn("slow");
         }, 5000); 


        $('#product_code').val('');
        $('#product_serial').val('');
        $('.result').html('');
       
    }

    if (responseText == 2) {
        $("#loading").hide();
        $("#response").removeClass("alert-success") ;
        $("#response").html('Sorry ! Some of the provided Serial number already exists in database').addClass('alert-danger').removeClass("hide").hide().fadeIn("slow");
         setTimeout(function() {
             $('#response').addClass('hide').fadeIn("slow");
         }, 5000); 


        
    }

    if (responseText == 3) {
        $("#loading").hide();
        
        $("#response").removeClass("alert-success") ;
        $("#response").html('Sorry ! Duplicate Serial Number Found in the Excel File').addClass('alert-danger').removeClass("hide").hide().fadeIn("slow");
         setTimeout(function() {
             $('#response').addClass('hide').fadeIn("slow");
         }, 5000); 
    }

    if (responseText == 4) {
        $("#loading").hide();
        
        $("#response").removeClass("alert-success") ;
        $("#response").html('Sorry ! You are trying to enter extra serial numbers than the number of products you bought').addClass('alert-danger').removeClass("hide").hide().fadeIn("slow");
         setTimeout(function() {
             $('#response').addClass('hide').fadeIn("slow");
         }, 5000); 

        
    }
    if (responseText == 5) {
        $("#loading").hide();
        
        $("#response").removeClass("alert-success") ;
        $("#response").html('The uploaded file was not an excel document').addClass('alert-danger').removeClass("hide").hide().fadeIn("slow");
         setTimeout(function() {
             $('#response').addClass('hide').fadeIn("slow");
         }, 5000); 
    }
    if (responseText == 7) {
        $("#loading").hide();
        
        $("#response").removeClass("alert-success") ;
        $("#response").html('The Product Item does not belong to the provided voucher number').addClass('alert-danger').removeClass("hide").hide().fadeIn("slow");
         setTimeout(function() {
             $('#response').addClass('hide').fadeIn("slow");
         }, 5000); 
    }



}

</script> 		

					
	
 