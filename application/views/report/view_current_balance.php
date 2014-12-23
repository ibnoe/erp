<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"  "http://www.w3.org/TR/html4/strict.dtd"> 
 <html lang="en"> 
  <head> 
<?php $this->load->view('includes/head');?>  

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
	  <div class="prepend-1 append-1">
  	<h2>Current Balance</h2>
 	 <hr>
   
   	<span style="font-size: 20px;">As of today the current balance of</span> <span style="color:purple;"><?php echo $account_name; ?></span> is <span style="color:green;"><?php echo number_format($balance, 2) ;?> Taka</span>
     
     </div>
        
  
                 
 	</div>
 <!-- End of Main Area/Content  -->      
  
   <!-- Footer --> 
<div id="footer" class="span-23">
<?php $this->load->view('includes/footer');?>
</div>
<!-- Footer Ends -->  
      
      
    </div><!-- Container Ends -->
    

  </body> 
</html> 