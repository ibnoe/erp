<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MicroElephant ERP</title>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/login.css" type="text/css" media="screen, projection">
</head>
<body>
	<div style="text-align:center; margin-bottom:10px; margin-left:10px;">
			
			<div style="font-family: 'Open Sans',arial;color: #555; font-size: 18px; font-weight: 400;">Sign In to Continue</div>
	</div>
	
	<div class="container" id="box">
   
   <form autocomplete="off" enctype="multipart/form-data" class="form-signin" role="form" method="post" action="" >
      
      <input type="email" class="form-control" name="user_id" placeholder="Email address">
       <?php echo form_error("user_id"); ?> 
      <br>
      <input type="password" class="form-control" name="user_pass" placeholder="Password">
      <br>
      <div style="text-align: center;"><?php echo $this->session->flashdata('msg');?></div>
      <br>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
   </form>
</div>
<!-- /container -->

</body>
</html>

