<?php
$objCommon 		= new Common;
$objMail 		= new Mail;
$objOrder 		= new Order;
$objContent 	= new Content;
$objValidate 	= new Validate;
$objProduct 	= new Product;
$objCart 		= new Cart;
$objCustomer 	= new Customer;
$objTemplate 	= new Template;
$objAdminUser 	= new AdminUser;
$objOther	 	= new Other;
?>
<!DOCTYPE html>
<!--[if IE 8 ]>
<html class="no-js ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]>
<html class="no-js ie9" lang="en"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1, shrink-to-fit=no">


<title> || Express Rent a Car || </title>
  <!--<title><?php echo $site_title;?></title>-->
    <meta name="description" content="<?php echo $objCommon->getConfigValue("meta_desc");?>" />
    <meta name="keywords" content="<?php echo $objCommon->getConfigValue("meta_keywords");?>" />

<link rel="stylesheet" href="<?php echo SITE_URL;?>css/w3.css">    
<link rel="stylesheet" href="<?php echo SITE_URL;?>css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo SITE_URL;?>css/font-awesome.min.css">
<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php echo SITE_URL;?>css/animate.min.css">
<link rel="stylesheet"  href="<?php echo SITE_URL;?>css/jqClock.css" />
<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL;?>css/flexslider.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL;?>css/owl.carousel.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL;?>css/owl.theme.css" media="screen" />
<link id="main-style" rel="stylesheet" href="<?php echo SITE_URL;?>css/style.css">
<link href="<?php echo SITE_URL;?>css/select2.css" rel="stylesheet" type="text/css">
<link id="main-style" rel="stylesheet" href="<?php echo SITE_URL;?>css/jquery.jscc.css">
<link rel="stylesheet" href="<?php echo SITE_URL;?>css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
<link rel="stylesheet" href="<?php echo SITE_URL;?>css/custom.css">
<link rel="stylesheet" href="<?php echo SITE_URL;?>css/responsive.css">
<!-- CSS for IE -->
<!--[if lte IE 9]>
<link rel="stylesheet" type="text/css" href="css/ie.css" />
<![endif]-->
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script type='text/javascript' src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<script type='text/javascript' src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
<![endif]-->
<script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL;?>css/jquery.smartsuggest.css" />
<script type="text/javascript" src="<?php echo SITE_URL;?>js/prettify.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.smartsuggest.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>js/jqClock.min.js"></script>
</head>
<body>
<div id="page-wrapper">