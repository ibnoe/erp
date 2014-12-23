<?php if(count($records) > 0) { ?>
<table class="table table-striped table-bordered" cellspacing="0" width="100%" align="center" id="gtable">
   <thead>
      <tr>
         <th>Sl</th>
         <th>Purchase Date</th>
         <th>Voucher</th>
         <th>Party</th>
         <th style="text-align:right;">Party Invoice#</th>
         <th style="text-align:right;">Amount</th>
         <th>Entry By</th>        
      </tr>
   </thead>
   <tbody>
      <?php $i = 0; foreach ($records as $row){ $i++; ?>
      <tr>
         <td style="width: 6%;"><?php echo $i; ?>.</td>
         <td style="width: 12%;"><?php echo date("d-M-Y", strtotime($row['purchase_date']));?></td>
         <td style="width: 15%;"><a href="<?php echo base_url();?>purchase/purchase-details/<?php echo $row['purchase_id'];?>"><?php echo $row['purchase_voucher'];?></a></td>
         <td style="width: 22%;"><?php echo $row['party_name'];?></td>
         <td style="width: 12%; text-align:right;"><?php echo $row['party_invoice'];?></td>
         <td style="width: 15%; text-align:right;"><?php echo number_format($row['purchase_total']) ;?></td>
         <td style="text-align:right;"><?php echo $row['admin_name'];?></td>         
      </tr>
      <?php  } ?>
   </tbody>
</table>
<?php } else {echo "No Records Found";}?>