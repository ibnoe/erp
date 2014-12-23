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

<script type="text/javascript" charset="utf-8">
$(document).ready(function() {$('#gtable').dataTable();} );
</script>		

<script  type="text/javascript">
   $(function(){ // added
	   $('a.delete').live('click', function(event) {
    				var a_href = $(this).attr('href'); 

    				if (confirm("Are you sure you want to contiune with this request?")) {
   				     //Do stuff
   	    	    				
  		 $.ajax({
   	        
     	 type: "POST",
     	 url: "<?php echo base_url(); ?>party/delete_party",
     	 data: "id="+a_href,
     	 success: function(server_response){

				  if(server_response == '1'){
												   
					  location.reload();					   
												  
				  }						   
				  if(server_response == '2'){							  
						
					  $.showMessage("Sorry, The party name is in use. You cannot delete the party now ");								  
												
				  }
				  if(server_response == '3'){							  
						
					  $.showMessage("Sorry, Could Not Perform The Requested Action");								  
												
				  }
													
     	 }									 
  		});	//$.ajax ends here									   

    }//if confirmation ends here
		return false											
		
		});//.click function ends here
	}); // function ends here														   
 </script>
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
		 
   <h2>Party List</h2>
   
   <hr>
   <div class="error_message1" style="display:none; color:red;">Error1</div>
     <div class="error_message2" style="display:none; color:red;">Error2</div>
     
				<?php if(count($records) > 0) { ?>
					<table class="gtable" align="center" id="gtable">
				<thead>
						<tr>
							<th>Sl</th>
							
							<th>Party Name</th>
							<th>Party Contact Number</th>
							
							<?php if($level==1){?>			 							  			
							<th>Edit</th>
				 			<th>Delete</th>
							 <?php }?>	
						</tr>
				</thead>
				<tbody>
				 <?php $i = $this->uri->segment(3) + 0; foreach ($records as $row){ $i++; ?>
						
				  
				       <tr id="trid_<?php echo $row['party_id']; ?>">
				       
				          	<td><?php echo $i; ?>.</td>
				          	 <td><?php echo $row['party_name'];?></td>
				          	  <td><?php echo $row['party_contact'];?></td>
				            	             
				          <?php if($level==1){?>	 
						 <td><a href="<?php echo base_url();?>party/edit_party/<?php echo $row['party_id'];?>"><img src="<?php echo base_url();?>support_admin/images/icons/edit.png"></a></td>
				 			
				 		 <td><a href="<?php echo $row['party_id'];?>" title="Delete" class="delete"><img src="<?php echo base_url();?>support_admin/images/icons/cross.png"></a></td>			            			  			
				            <?php }?>				 			
				 						            
				            	 
								 
				        </tr>
				       
				<?php  } ?>
				
				
				</tbody>
				</table>
				<?php } else {echo "No Records Found";} ?>
	  
                 
 	</div>
 <!-- End of Main Area/Content  -->      
 <!-- Footer --> 
<div id="footer" class="span-24">
<?php $this->load->view('includes/footer');?>
</div>
<!-- Footer Ends -->  
      
      
    </div><!-- Container Ends -->
  </body> 
</html> 