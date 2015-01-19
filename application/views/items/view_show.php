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
      <tr>
         <td style="width:3%;"><?php echo $i; ?>.</td>
         <td style="width:40%;"><?php echo $row['item_name'];?></td>
         <td><?php echo $row['item_type_name'];?></td>      		
      </tr>
      <?php  } ?>
   </tbody>
</table>
<?php } else {echo "No Records Found";} ?>
