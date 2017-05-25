<?php
require_once("../config/config.php");

if(!defined('PERPAGE')){
	define('PERPAGE', 20);
}

$objCommon 		= new Common;
$objMenu 		= new Menu;
$objNews 		= new News;
$objContent 	= new Content;
$objTemplate 	= new Template;
$objMail 		= new Mail;
$objCustomer 	= new Customer;
$objAdminUser 	= new AdminUser;
$objValidate 	= new Validate;
$objProduct		= new Product;
$objOrder		= new Order;

if($_GET['p'] == "logout"){
	require_once("./pages/logout.php");
}
if($_GET['p'] == "employee_form" or $_GET['p'] == "business_form"){
	require_once("../classes/thumbnail.class.php");
}

#=================
require_once('rs_lang.admin.php');
#=================

if(isset($_GET['forgot']) && $_GET['forgot'] == "forgot"){
	require_once("pages/forgot.passwd.php");
}
else{
	if($objAdminUser->is_login == true){
		require_once("pages/default.php");
	}
	else{
		$refurl = $_SERVER['QUERY_STRING'];
		require_once("pages/login.form.php");
	}
}
mysql_close();
?>