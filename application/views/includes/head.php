<?php     
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?> 
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<title>POS:: Software</title>
<link rel="shortcut icon" href="<?php echo base_url();?>support_admin/images/fav.ico" /> 
<link rel="stylesheet" href="<?php echo base_url();?>support_admin/css/screen.css" type="text/css" media="screen, projection"> 
<link rel="stylesheet" href="<?php echo base_url();?>support_admin/bootstrap/style.css" type="text/css" media="screen, projection"> 
	
<script type="text/javascript" src="<?php echo base_url();?>support_admin/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>support_admin/js/jquery.slidingmessage.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>support_admin/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>support_admin/js/jquery.validate.js"></script>	 
   
   
 <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>support_admin/menu/ddsmoothmenu.css" />
 <link rel="stylesheet" href="<?php echo base_url();?>support_admin/css/jquery.dataTables.css" type="text/css" media="screen, projection">
  <script src="<?php echo base_url();?>support_admin/menu/ddsmoothmenu.js" type="text/javascript"></script>							  
 <script type="text/javascript">

	ddsmoothmenu.init({
		mainmenuid: "smoothmenu1", //menu DIV id
		orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
		classname: 'ddsmoothmenu', //class added to menu's outer DIV
		//customtheme: ["#55AB2C", "#18374a"],
		contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
	})


</script>

</head>

<body>

<div id="wrap">
<div style="padding:0 15px;">

<!-- Header -->
  <div class="row" style="background-color:#0CA0CB; height:65px;">     	           
				
	<!-- School Name -->
    <div class="col-md-6"><h3 style="color:#FFF;"> PC Carnival</h3></div>
	<!-- End of School Name -->
    
                
    <!-- Begining of User Information -->
    <div class="col-md-3 pull-right">
             <div style="text-align:right; margin-top:20px;">               
                    Welcome, <?php echo $user_name ;?>                    
                    <a style="color:white; text-decoration:none;" href="<?php echo base_url();?>auth/logout" title="logout">Logout</a>
              </div>  
      </div>                     
	  <!-- End of User Information -->	
                    
  </div>             
 <!-- Header -->               
            




