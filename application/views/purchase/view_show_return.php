<?php if(count($records) > 0) { ?>
<table class="table table-striped table-bordered" cellspacing="0" width="100%" align="center" id="gtable">
   <thead>
      <tr>
         <th>Sl</th>
         <th>Return Date</th>
         <th>Party</th>
         <th>Return Against- Invoice#</th>
         <th style="text-align:right;">Total Amount</th>
         <th style="text-align:right;">Entry By</th>
         <th style="text-align:right;">Details</th>
      </tr>
   </thead>
   <tbody>
      <?php $i = 0; foreach ($records as $row){ $i++; ?>
      <tr>
         <td style="width: 6%;"><?php echo $i; ?>.</td>
         <td style="width: 12%;"><?php echo date("d-M-Y", strtotime($row['return_date']));?></td>
         <td style="width: 22%;"><?php echo $row['party_name'];?></td>
         <td style="width: 18%;"><?php echo $row['return_against_invoice'];?></td>
         <td style="width: 15%; text-align:right;"><?php echo $row['return_total_amount'] ;?></td>
         <td style="text-align:right;"><?php echo $row['admin_name'];?></td>
         <td style="text-align:right;"><a href="<?echo base_url();?>purchase/purchase_return_details/<?php echo $row['p_return_id'];?>">Details</a></td>
      </tr>
      <?php  } ?>
   </tbody>
</table>
<?php } else {echo "No Records Found";}?>