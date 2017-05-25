<?php $incPage = $objCommon->getAdminPage(trim($_GET['p'])); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="<?php echo SITE_URL;?>images/favicon.png">
<title> || Express Rent a Car || </title>
<!-- jQuery Visualize Styles -->
<link rel='stylesheet' type='text/css' href='<?php echo SITE_URL;?>css/plugins/jquery.visualize.css'>
<!-- jQuery jGrowl Styles -->
<link rel='stylesheet' type='text/css' href='<?php echo SITE_URL;?>css/plugins/jquery.jgrowl.css'>
<!-- CSS styles -->
<link rel='stylesheet' type='text/css' href='<?php echo SITE_URL;?>css/huraga-red.css'>
<!-- Fav and touch icons -->
<link rel="shortcut icon" href="<?php echo SITE_URL;?>img/icons/favicon.ico">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo SITE_URL;?>img/icons/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo SITE_URL;?>img/icons/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="<?php echo SITE_URL;?>img/icons/apple-touch-icon-57-precomposed.png">
<!-- JS Libs -->
<script src="<?php echo SITE_URL;?>jscript/jquery-1.8.1.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php echo SITE_URL;?>js/libs/jquery.js"><\/script>')</script>
<script src="<?php echo SITE_URL;?>js/libs/modernizr.js"></script>
<script src="<?php echo SITE_URL;?>js/libs/selectivizr.js"></script>

<!--<link rel="stylesheet" media="all" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo SITE_URL;?>css/jquery-ui-timepicker-addon.css" />-->
<!--<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>-->
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery-ui-sliderAccess.js"></script>

<script>
$(document).ready(function(){
	// Tooltips
	// Tooltips
	$('[title]:not(.Popover)').tooltip({
		placement: 'top'
	});
	$('.Popover').popover({
					trigger: 'hover'
	});
	// Dropdowns
	$('.dropdown-toggle').dropdown();
	// Tabs
	$('.demoTabs a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	})				
});
</script>
<script type="text/javascript" src="<?php echo $_CONFIG['editor_path']; ?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $_CONFIG['editor_path']; ?>ckeditor/config.js"></script>
<meta charset="UTF-8">
</head>
<body>
<!-- WRAPPER START -->
<?php include_once("includes/header.php");?>
<!-- MENU START -->
<?php include_once("includes/menu.php");?>
<!-- CONTENT START -->
<?php require_once("$incPage"); ?>
</section>
<?php include_once("includes/footer.php");?>
</body>
</html>