<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"  "http://www.w3.org/TR/html4/strict.dtd"> 
<html lang="en"> 
<head> 
<link rel="shortcut icon" href="<?php echo base_url();?>support_admin/images/fav.ico" /> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<title>POS Software:: Admin Login</title> 
  
<link rel="stylesheet" href="<?php echo base_url();?>support_admin/login/style.css" type="text/css" media="screen, projection"> 
<script type="text/javascript" src="<?php echo base_url();?>support_admin/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>support_admin/js/jquery.validate.js"></script>
<script>
$(document).ready(function() {
    // validate signup form on keyup and submit
    var validator = $("#myForm").validate({
        showErrors: function(errorMap, errorList) {
            $(".errormsg2").html($.map(errorList, function (el) {
                return el.message;
            }).join(", "));
        },
        wrapper: "span",
        rules: {
        	
        	user_id: "required",
        	user_pass: "required",
      		
            
        },
        messages: {
        	
        	user_id: "Enter Login ID",
    		user_pass: "Enter Login Password",
    		
           
            
        }
    });
});

</script>		
				

  </head> 
  <body> 
  
  
  <div id="container">
  <span style="font-size:14px;color:red;"><?php if(!empty($message)){echo $message;}?></span>
         <span class="errormsg2" style="font-size:14px;color:red;"></span>
	<form autocomplete="off" class="myform" id="myForm" enctype="multipart/form-data" action="<?php echo base_url();?>auth/login_process" method="post" name="myForm">
	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<div class="login">LOGIN</div>
				<div class="username-text">Username:</div>
				<div class="password-text">Password:</div>
				<div class="username-field">
					<input type="text" name="user_id" value="" />
				</div>
				<div class="password-field">
					<input type="password" name="user_pass" value="" />
				</div>
				
				<input type="submit" name="submit" value="GO" />
			</form>
		</div>
		<div id="footer">
			Software Developed By Caneflex Limited <a href="http://www.caneflex.com">www.caneflex.com</a>
		</div>
  
  

  </body> 
</html> 