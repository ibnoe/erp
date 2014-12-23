<?php if (count($cart)>0) {?>
<table class="table table-striped" align="center" style="table-layout:fixed; overflow-x:hidden">
   <thead>
      <tr>
         <th>#</th>
         <th width="35%">Product Name</th>
         <th>Price</th>
         <th>Qty</th>
         <th>Total</th>
         <th>Cancel</th>
      </tr>
   </thead>
   <tbody>
      <?php $i = 0; $total=0; foreach($cart as $item_id=>$row){ $i++; ?>
      <tr>
         <td class="pro"><?php echo $i; ?>.</td>
         <input type="hidden" name="product_id[]" value="<?php echo $row['product_id'];?>" />		          	 
         <td><?php echo $row['product_name'];?></td>
         <td><input class="rate numeric form-control" type="text" name="rate[]" value="<?php echo str_replace(",", "", $row['price']);?>" size="10"></td>
         <td><input type="text" class ="form-control" name="quantity[]" value="<?php echo $row['quantity'];?>" size="5"></td>
         <td><input class="total form-control" readonly="readonly" name="total[]" value="<?php echo $subtotal=$row['price']*$row['quantity'];?>" size="15"></td>
         <td>
         <a href="#" data-id="<?php echo $row['product_id'] ;?>" data-toggle="modal" data-target="#confirmDelete" data-message="Are you sure you want to delete this item ?">
         <i class="glyphicon glyphicon-remove"></i>
         </a>
         </td>
      </tr>
      <?php $total +=$subtotal;?> 
      <?php  } ?>
      </tbody>
    <tfoot>
      <tr>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td colspan="2" style="text-align:center;">Total Amount</td>
         <td><input readonly="readonly" name="total_amount" id="total_amount" value="<?php echo $total;?>"  style="border: 0px; background:transparent;"></td>
         <td>&nbsp;</td>
      </tr>
    </tfoot>
</table>

 <div class="form-group pull-right">
         <div class="col-sm-10">
         	
            <button type="submit" class="btn btn-primary">Submit</button>
         </div>
      </div>
				
<span id="productId" style="display: none;"></span>
<span id="csrf_hash" style="display: none;"><?php echo $this->security->get_csrf_hash(); ?></span>

<script type="text/javascript">
$(":text[name='rate[]']").bind("keyup", function() {
    var totalamount = 0;
    $("tr").each(function() {
        var quantity = +$(this).find(":text[name='quantity[]']").val() || 0;
        var rate = +$(this).find(":text[name='rate[]']").val() || 0;
        var subtotal = accounting.unformat(quantity) * accounting.unformat(rate);
        $(this).find(":text[name='total[]']").val(subtotal).formatCurrency();
        totalamount += subtotal;


    });

    //Updating the values in session
    var productID = $(this).closest('tr').find('input[name^="product_id"]').val();
    var qty = $(this).closest('tr').find('input[name^="quantity"]').val();
    var price = $(this).val();

    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>purchase/edit_cart_items",
        data: {
            product_id: productID,
            quantity: qty,
            price: price
        },
    }); //$.ajax ends here	 
    // End of updating				   		


    $("#total_amount").val("");
    $("#total_amount").val(totalamount).formatCurrency();

    var balance = totalamount - amountpaid;
    $("#balance").val("");
    $("#balance").val(balance).formatCurrency();

});



$(":text[name='quantity[]']").bind("keyup", function() {
    var totalamount = 0;
    $("tr").each(function() {
        var quantity = +$(this).find(":text[name='quantity[]']").val() || 0;
        var rate = +$(this).find(":text[name='rate[]']").val() || 0;
        var subtotal = accounting.unformat(quantity) * accounting.unformat(rate);
        $(this).find(":text[name='total[]']").val(subtotal).formatCurrency();
        totalamount += subtotal;

    });

    //Updating the values in session
    var productID = $(this).closest('tr').find('input[name^="product_id"]').val();
    var price = $(this).closest('tr').find('input[name^="rate"]').val();
    var qty = $(this).val();

    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>purchase/edit_cart_items",
        data: {
            product_id: productID,
            quantity: qty,
            price: price
        },
    }); //$.ajax ends here	 
    // End of updating

    $("#total_amount").val("");
    $("#total_amount").val(totalamount).formatCurrency();

    var balance = totalamount - amountpaid;
    $("#balance").val("");
    $("#balance").val(balance).formatCurrency();


});

</script>
<!-- ----------------------  Delete Modal ------------------------->
<script  type="text/javascript">

$('#confirmDelete').on('show.bs.modal', function(e) {
    $message = $(e.relatedTarget).attr('data-message');
    $(this).find('.modal-body p').text($message);
    $title = $(e.relatedTarget).attr('data-title');
    $(this).find('.modal-title').text($title);
})

$('#confirmDelete').on('show.bs.modal', function(e) {
    var id = $(e.relatedTarget).data("id");
    $('#productId').html(id);

});


$('#confirmDelete').find('.modal-footer #confirm').on('click', function() {

    $('#confirmDelete').modal('hide');
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
    
    var a_href = $('#productId').html();
    var csrf_hash = $('#csrf_hash').html();
    
    $.ajax({

        type: "POST",
        url: "<?php echo base_url(); ?>purchase/delete_cart_item",
        data: {id : a_href, ci_csrf_token: csrf_hash},
        success: function(server_response) {

            $(".result").html(server_response);

        }
    }); //$.ajax ends here   
})						   
</script>

<!-- Delete Confirm Dialog -->
<div class="modal fade" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Delete Parmanently</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure about this ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirm">Delete</button>
      </div>
    </div>
  </div>
</div>
<!-- End of Delete Confirm Dialog --> 

<!-- ---------------------- End of Delete Modal ------------------------->

 <script type="text/javascript" src="<?php echo base_url();?>support_admin/js/accounting.js"></script>
 <script type="text/javascript" src="<?php echo base_url();?>support_admin/js/jquery.formatCurrency-1.4.0.js"></script>
 <script type="text/javascript" src="<?php echo base_url();?>support_admin/js/jquery.numeric.js"></script>
<script type="text/javascript">
	$(".numeric").numeric();
</script>				
<?php }else { $this->session->unset_userdata('cart');}?>