<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
	$username 	= trim($_POST['username']);
	$pass 		= trim($_POST['password']);
	$salt		= trim($_POST['salt']);
	$FinalPass = $salt . $pass . $salt;
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("username", LOGIN_FLD_VAL_USERNAME, "S");
	$objValidate->setCheckField("password", LOGIN_FLD_VAL_PASSWD, "S");
	//$objValidate->setCheckField("salt", LOGIN_FLD_VAL_SALT, "S");
	$vResult = $objValidate->doValidate();
	
	if(!$vResult){
		$objAdminUser->setProperty("username", $username);
		$objAdminUser->setProperty("pass", md5($pass));
		//$objAdminUser->setProperty("pass", $pass);
		$objAdminUser->lstAdminUser();
		
		if($objAdminUser->totalRecords() >= 1){
			$rows = $objAdminUser->dbFetchArray(1);
			$fullname = $rows['first_name'] . " " . $rows['last_name'];
			$objAdminUser->setProperty("admin_id", $rows['admin_id']);
			$objAdminUser->setProperty("username", $rows['username']);
			$objAdminUser->setProperty("fullname_name", $fullname);
			$objAdminUser->setProperty("user_type", $rows['user_type']);
			$objAdminUser->setProperty("logged_in_time", $rows['last_login_date']);
			$objAdminUser->setAdminLogin();
			
					$objAdmin = new AdminUser;
					$objAdmin->setProperty("admin_id", $rows['admin_id']);
					$objAdmin->setProperty("last_login_date", date('Y-m-d H:i:s'));
					$objAdmin->setProperty("last_login_ip", $_SERVER['REMOTE_ADDR']);
					$objAdmin->actAdminUser('U');
					redirect('./?p=sitecms_mgmt');
		}
		else{
			$objCommon->setMessage(LOGIN_FLD_INVALID, 'Error');
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> || Express Rent a Car || </title>
<link rel='stylesheet' type='text/css' href='<?php echo SITE_URL;?>css/huraga-red.css'>
<!-- Fav and touch icons -->
<link rel="shortcut icon" href="img/icons/favicon.ico">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo SITE_URL;?>images/icons/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo SITE_URL;?>images/icons/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="<?php echo SITE_URL;?>images/icons/apple-touch-icon-57-precomposed.png">
<!-- JS Libs -->
<script src="<?php echo SITE_URL;?>jscript/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php echo SITE_URL;?>js/libs/jquery.js"><\/script>')</script>
<script src="<?php echo SITE_URL;?>js/libs/modernizr.js"></script>
<script src="<?php echo SITE_URL;?>js/libs/selectivizr.js"></script>
<script>
$(document).ready(function(){
	$('[title]').tooltip({
		placement: 'top'
	});
});
</script>
</head>
<body>
	<section class="container login" role="main">
			<!--<h1><a href="./" class="brand">Huraga</a></h1>-->
			<div class="data-block">
            	<?php echo $objCommon->DisplayLoginMessage();?>  
				<form method="post" action="">
					<fieldset>
						<div class="control-group">
							<label class="control-label" for="login">Username</label>
							<div class="controls">
								<input id="username" type="text" placeholder="Admin username" name="username">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="password">Password</label>
							<div class="controls">
								<input id="password" type="password" placeholder="Password" name="password">
							</div>
						</div>
						<div class="form-actions">
							<button class="btn btn-large btn-inverse btn-alt" type="submit"><span class="awe-signin"></span> Log in</button>
						</div>
					</fieldset>
				</form>
			</div>
			<!--<p><a href="./?forgot=forgot" class="pull-right"><small>Password reset</small></a></p>-->
		</section>
</body>
</html>
<script language="javascript" type="text/javascript">
function frmValidate(frm){
	var msg = "<?php echo _JS_FORM_ERROR;?>\r\n-----------------------------------------";
	var flag = true;
	if(frm.username.value == ""){
		msg = msg + "\r\n<?php echo 'Username is a required field.';?>";
		flag = false;
	}	
	if(frm.password.value == ""){
		msg = msg + "\r\n<?php echo 'Password is a required field.';?>";
		flag = false;
	}
	if(flag == false){
		alert(msg);
		return false;
	}
} 
</script>