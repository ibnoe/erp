<?php if(Authex::Permission("items-edit")) { ?>
<style>
.table-hover tbody tr:hover > td {
  cursor: pointer;
  cursor: hand;
}
</style>
<script>
$(function() {
	$('tr').on("click", function() {
	    if($(this).data('href') !== undefined){
	        document.location = $(this).data('href');
	    }
	});
});
</script>
<?php } ?>
<?php if(count($records) > 0) { ?>
<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" id="gtable">
   <thead>
      <tr>
         <th>Sl</th>
         <th>Item</th>         
          <th>Type</th>    
      </tr>
   </thead>
   <tfoot>
      <tr>
         <th>Sl</th>
         <th>Item</th>         
          <th>Type</th>    
      </tr>
   </tfoot>
   <tbody>
      <?php $i = 0; foreach ($records as $row){ $i++; ?>
      <tr data-href="<?php echo ( Authex::Permission("items-edit") ? base_url("items/edit/".$row['item_id']) : '' ); ?>">
         <td style="width:3%;"><?php echo $i; ?>.</td>
         <td style="width:40%;"><?php echo $row['item_name'];?></td>
         <td><?php echo $row['item_type_name'];?></td>      		
      </tr>
      <?php  } ?>
   </tbody>
</table>
<?php } else {echo "No Records Found";} ?>


