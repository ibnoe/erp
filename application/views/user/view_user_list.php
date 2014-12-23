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
     	 url: "<?php echo base_url(); ?>user/delete_user",
     	 data: "id="+a_href,
     	 success: function(server_response){
											   if(server_response == '1'){
												   
												   $("#trid_"+a_href).hide('slow');
												     var options = {id: 'message_from_top',
							                                   position: 'bottom',
							                                   size: 70,
							                                   backgroundColor: '#0CA0CB',
							                                   delay: 3000,
							                                   speed: 500,
							                                   fontSize: '30px'
															   
							                                  };
							                                   
							                    $.showMessage("Successfully Deleted!", options); 
												  
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


     </head> 
  <body> 
  
  
  
 <div class="container"> 
  
<!-- Headers Starts -->
	<div  id="header" class="span-24">  
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
<?php 
function nicetime($date)
{
    if(empty($date)) {
        return "No date provided";
    }
    
    $periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths         = array("60","60","24","7","4.35","12","10");
    
    $now             = time();
    $unix_date         = strtotime($date);
    
       // check validity of date
    if(empty($unix_date)) {    
        return "Bad date";
    }

    // is it future date or past date
    if($now > $unix_date) {    
        $difference     = $now - $unix_date;
        $tense         = "ago";
        
    } else {
        $difference     = $unix_date - $now;
        $tense         = "from now";
    }
    
    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }
    
    $difference = round($difference);
    
    if($difference != 1) {
        $periods[$j].= "s";
    }
    
    return "$difference $periods[$j] {$tense}";
}


?>	 
	 
   <h2>Users</h2>
   
   <hr>
   				<?php if(count($records) > 0) { ?>
				<table class="gtable" align="center" id="gtable">
				<thead>
						<tr>
							<th>Sl</th>
							<th>Name</th>
							<th>Email</th>
							<th>Level</th>
							<th>Status</th>
							<th>Last Login</th>
																				
				 			<th>Edit</th>
				 			<th>Delete</th>				  			
														
						</tr>
				</thead>
				<tbody>
				 <?php $i = $this->uri->segment(3) + 0; foreach ($records as $row){ $i++; ?>
						
				  
				       <tr id="trid_<?php echo $row['admin_id']; ?>">
				       
				          	<td><?php echo $i; ?>.</td>
				          	
				            <td><?php echo $row['admin_name'];?></td>
				            <td><?php echo $row['admin_email'];?></td>
				            <td><?php echo $row['level_name'];?></td>
				            <td><?php if($row['admin_status']==1){echo "Active";}else {echo "Inactive";}?></td>
				            <td><?php echo nicetime($row['admin_last_login']);?></td>
				           
				             	             
				           <td><?php if($row['level']>=2){ ?><a href="<?php echo base_url();?>user/edit_user/<?php echo $row['admin_id'];?>"><img src="<?php echo base_url();?>support_admin/images/icons/edit.png"></a><?php } ?></td>
				 			
				 			 <td><?php if($row['level']>=2){ ?><a href="<?php echo $row['admin_id'];?>" title="Delete" class="delete"><img src="<?php echo base_url();?>support_admin/images/icons/cross.png"></a><?php } ?></td>			            			  			
				            			            
				            
				            		           
				            
				            	 
								 
				        </tr>
				       
				<?php  } ?>
				
				
				</tbody>
				</table>
				<?php } ?>
	
        
  
                 
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