<div id="response" class="alert hide"></div>
<!-- Colmun 1 -->
<div class="col-md-3">
   <form role="form" id="myForm" name="myForm" class="" enctype="multipart/form-data" action="<?php echo base_url();?>purchase/add_to_cart" method="post" autocomplete="off" >
      <?php echo form_dropdown('category_id', $dropdown_category,'', 'id="category_id" class="form-control"' ); ?> <br>
      <?php 
         $brand = array(
                         ''  => 'Select Brand',
                         );
         echo form_dropdown('brand_id', $brand,'', 'id="brand_id" class="form-control"' ); ?> <br>
      <?php 
         $product_id = array(
                         ''  => 'Select Product',
                         );
         
         echo form_dropdown('product_id', $product_id,'', 'id="product_id" class="form-control"' ); ?> <br>
      <input type="text" name="quantity" id="quantity"  value="" class="form-control" placeholder="Quantity" /><br>
      <input type="text" name="price" id="price"  value="" size="10"  class="form-control" placeholder="Price" /><br><br>
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
      <button type="submit" class="btn btn-primary">Add Item</button>
      <br> <br>
      <p>
         <span class="errormsg2"></span>
         <span class="message"></span>
      </p>
   </form>
</div>
<!-- End of Colmun 1 -->
<!-- Colmun 2 -->
<div class="col-md-9">
   <form class="form-inline" role="form" autocomplete="off" class="" id="voucherform" name="voucherform" action="" method="post">
   <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
      <div class="form-group">
         <input type="text" size="10"  class="form-control" id="datepicker1" name="purchase_date" placeholder="">
      </div>
      <div class="form-group">			  
         <input type="text" name="party_name" id="party_name" data-provide="typeahead"  value="" class="form-control" placeholder="Party Name"/>
         <input type="hidden" name="party_id" id="party_id">
      </div>
      <div class="form-group">			  
         <input type="text" name="party_invoice" id="party_invoice"  value="" class="form-control" placeholder="Invoice Number"/>
      </div>
      <span class="purchase_errors"></span>
      <br><br>
      <span class="result"></span> 
   </form>
</div>
<!-- End of Column 2 -->  	
<span id="csrf_hash" style="display: none;"><?php echo $this->security->get_csrf_hash(); ?></span>
<script>
   $(function(){
   	
       // validate signup form on keyup and submit
   
       var validator = $("#myForm").validate({
           showErrors: function(errorMap, errorList) {
               $(".errormsg2").html($.map(errorList, function (el) {
                   return el.message;
               }).join(", "));
           },
           wrapper: "span",
           rules: {
           	category_id: "required",
           	brand_id: "required",
           	product_id: "required",
           	 quantity: {
            		required:true,
            		digits: true
          		 },
          		 price: {
             		required:true,
             		number: true
           		 },
           },
           messages: {
           	
           	category_id: "Select Category",
           	brand_id: "Select Brand",      
           	product_id: "Select Product",
           	quantity: {required: "Enter Quantity",
           		digits:"Incorrect Quantity"
       		},
       		price: {required: "Enter Price",
           		number:"Incorrect Price"
       		},
           }
       });
   
   
   
    // validate signup form on keyup and submit
   
       var validator = $("#voucherform").validate({
           showErrors: function(errorMap, errorList) {
               $(".purchase_errors").html($.map(errorList, function (el) {
                   return el.message;
               }).join(", "));
           },
           wrapper: "span",
           rules: {
           	
           	
           	purchase_date: "required",
           	"quantity[]": "required",
           	"rate[]": "required",
           	party_name: {
                   required: true,
                    remote: {
                       url: '<?php echo base_url(); ?>common/check_party_validity', async: false,
                       type: 'post',
                       data: {
                       	party_id: function() {
                             return $( "#party_id" ).val();
                           }
                       }
                   }
               }
           	
           	
           },
           messages: {
           	
           	
           	purchase_date: "Enter Date",
           	"quantity[]": "Enter Quantity",
           	"rate[]": "Enter Price",
           	party_name: {
                   required: "Enter Party Name",
                   remote: jQuery.format("Wrong Party Name Provided")
               },   
              	       
               
           }
       });
   
   
   
       $('#party_name').typeahead({
   	    source: function(query, process) {
   	        objects = [];
   	        map = {};
   			
   			var result = [];
   			    $.ajax({
   			    	url: "<?php echo base_url();?>common/get_party",
   			      type: "post",
   			      data: "search=" + query,
   			      dataType: "json",
   			      async: false,
   			      success: function(data) {
   			       
   			        result = data;
   			      
   			      }
   			    });
   			  var data = [result];
   			
   	       
   	        $.each(data, function(i, object) {
   	            map[object.label] = object;
   	            objects.push(object.label);
   	        });
   	        process(objects);
   	    },
   	    updater: function(item) {
   	        $('#party_id').val(map[item].id);
   	        return item;
   	    }
   	});
   	
      
       
   });
   
</script>
<script  type="text/javascript">
   $(function () {
	   var csrf_hash = $('#csrf_hash').html();
	   
   	<?php if($this->session->flashdata('item')) { ?>
   	 
   	$("#response").removeClass("alert-danger") ;
       $("#response").html('Purchase Complete').addClass('alert-success').removeClass("hide").hide().fadeIn("slow");
       setTimeout(function() {
           $('#response').addClass('hide').fadeIn("slow");
       }, 3000); 
   	<?php } ?>
   	
   
       $('#category_id').change(function () {
           var a_href = $(this).val();
   
   
           if (a_href == "") {
   
               $("#brand_id").html("<option value=''>Select</option>");
               $("#product_id").html("<option value=''>Select</option>");
   
   
           } else {
   
               // Do stuff
   
   
               $.ajax({
   
                   type: "POST",
                   url: "<?php echo base_url(); ?>common/get_brands_custom",
                   data: {category_id: a_href, ci_csrf_token: csrf_hash },
                   success: function (server_response) {
   
                       $("#brand_id").html(server_response);
   
                       $("#product_id").html("<option value=''>Select</option>");
   
                   }
   
               }); //$.ajax ends here
   
            
   
           } //if else		
           return false
       }); //.click function ends here
   
       //
   
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
                        brand_id: b_href,
                        ci_csrf_token: csrf_hash
                    },
                    success: function (server_response) {
   
                        $("#product_id").html(server_response);
   
   
                    }
   
                }); //$.ajax ends here
   
            } //if else		
            return false
        }); //.click function ends here
   
   
   
   }); // function ends here											   
         	
    
</script>
<script type="text/javascript"> 
   $(document).ready(function() { 
   var options = { 
   //target:        '#output1',   // target element(s) to be updated with server response 
   
   success:       showResponse  // post-submit callback 
   			
   
   }; 
   
   // bind form using 'ajaxForm' 
   $('#myForm').ajaxForm(options); 
   }); 
   
   // post-submit callback 
   function showResponse(responseText, statusText, xhr, $form)  { 
   
   if(responseText=="2") {
   
   	$("#response").removeClass("alert-success") ;
      $("#response").html('The product is not available in stock').addClass('alert-danger').removeClass("hide").hide().fadeIn("slow");
        setTimeout(function() {
            $('#response').addClass('hide').fadeIn("slow");
        }, 3000);
        
   	
   }	else if(responseText=="3"){
   
   	 $("#response").removeClass("alert-success") ;
   	   $("#response").html('The product is already in the cart').addClass('alert-danger').removeClass("hide").hide().fadeIn("slow");
   	     setTimeout(function() {
   	         $('#response').addClass('hide').fadeIn("slow");
   	     }, 3000);	
   
   	
   } else{
   $(".result").html(responseText);
   $(".message").hide();
   $('#myForm').resetForm();		
   	
   }
   	
   } 
   
</script>