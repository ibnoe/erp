<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"  "http://www.w3.org/TR/html4/strict.dtd"> 
<html lang="en"> 
<head> 
<?php $this->load->view('includes/head');?>

<style>
label{
 color: #FF0000;
 width: 350px;
}

input{
height: 20px;
}
</style>

<script type="text/javascript" charset="utf-8">$(document).ready(function() {$('#gtable').dataTable();} );</script>	

 
</head> 
     
  
 <body>  
  
  
 <div class="container"> 
<!-- Headers Starts -->
	<div  id="header" class="column span-24">  
	<?php $this->load->view('includes/header');?>
 	</div>
 <!-- Headers Ends -->
	  
<!-- Navigation Start -->
	<div id="nav" class="span-24 last"> 
		<?php $this->load->view('includes/menu');?>
	</div>
 <!-- Navigation End -->
	  
<!-- Main Area/Content Starts -->
    <div id="content" class="span-24"> 
	  <div >
	 
   <h2>Products On Warranty Claim</h2> 

<hr>
				<?php if(count($records) > 0) { ?>
					<table class="gtable" align="center" id="gtable">
					
				<thead>
						<tr>
							<th>Sl</th>
							<th>Product Name</th>
							<th>Product Serial</th>
							<th>Invoice</th>
							<th>Generated Date</th>
							<th>Customer Name</th>
							<th>Customer Contact</th>
							<th>Action</th>
												 							  			
							
						</tr>
				</thead>
				
				<tbody>
		
				 <?php $i = $this->uri->segment(3) + 0; foreach ($records as $row){ $i++; ?>
						
				  
				       <tr>
				       
				          <td><?php echo $i; ?>.</td>
				          <td><?php echo $row['brand_name']." ". $row['category_name'] ." ". $row['product_item'] ;?></td>
				          <td><?php echo $row['on_warranty_serial'];?></td>
				          <td><?php echo $row['warranty_invoice'];?></td>
				          <td><?php echo date("d-m-Y", strtotime($row['generated_date']));?></td>
				          <td><?php echo $row['customer_name'];?></td>
				          <td><?php echo $row['customer_contact'];?></td>
				          <td><a href="<?php echo $row['warr_id'];?>" title="Delete" class="delete"><img src="<?php echo base_url();?>support_admin/images/icons/cross.png"></a></td>
				  
				    	 
				        </tr>
				       
				<?php  } ?>
				
				
				</tbody>
				</table>
						
		
	     <?php } else {echo "Sorry! No Records Found"; } ?>
  	</div>
   
                 
 	</div>
 <!-- End of Main Area/Content  -->      
  
  
 
 <!-- Footer --> 
<div id="footer" class="span-24">
<?php $this->load->view('includes/footer');?>
</div>
<!-- Footer Ends -->  
 
<script  type="text/javascript">
   $(function(){ // added
	   $('a.delete').live('click', function(event) {
    				var a_href = $(this).attr('href'); 

    				if (confirm("Are you sure you want to contiune with this request?")) {
   				     //Do stuff
   	    	    				
  		 $.ajax({
   	        
     	 type: "POST",
     	 url: "<?php echo base_url(); ?>rma/delete_product_on_warranty",
     	 data: "id="+a_href,
     	 success: function(server_response){
											   if(server_response == '1'){
												   
												   location.reload();
												  
											   }
											   if(server_response == '2'){
						
												  
												   $.showMessage("Sorry, couldn't perform the requested action. ");

													
												   }
											   
											  
     	 			}
										   		
			});	//$.ajax ends here

				}//if confirmation ends here
    						return false
	});//.click function ends here
}); // function ends here														   
      	
    </script>         
      
    </div><!-- Container Ends -->
  </body> 
</html> 