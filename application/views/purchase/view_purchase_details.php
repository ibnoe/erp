<?php if(count($records) > 0) { ?>
<table class="table table-striped table-bordered" cellspacing="0" width="100%" align="center" id="gtable">
   <thead>
      <tr>
         <th>Sl</th>
         <th>Product Name</th>
         <th>Rate</th>
         <th>Quantity</th>
         <th>Sub Total</th>
      </tr>
   </thead>
   <tbody>
      <?php $i = 0; $total=0; foreach ($records as $row){ $i++; ?>
      <tr>
         <td><?php echo $i; ?>.</td>
         <td><?php echo $row['brand_name'] ." ". $row['category_name']." ". $row['product_item'];?></td>
         <td><?php echo number_format($row['p_unit_price'],2) ;?></td>
         <td><?php echo $row['p_quantity'];?></td>
         <td><?php $sub_total=$row['p_unit_price']*$row['p_quantity']; echo number_format($sub_total,2);?></td>
      </tr>
      <?php $total +=$sub_total;?>
      <?php  } ?>
   
   </tbody>
   <tfoot>
      <tr>
         <td></td>
         <td></td>
         <td></td>
         <td><b>Total:</b></td>
         <td><?php echo number_format($total,2) ;?></td>
      </tr>
   </tfoot>
   
</table>
<br>
<br>
<button type="submit" class="btn btn-default" onClick="location.href = document.referrer;">Back</button>

<?php } else {echo "Sorry! No Records Found"; } ?>