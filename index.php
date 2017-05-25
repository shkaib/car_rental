<?php 
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

 
require_once("config/config.php");

// require the language file
//require_once('lang/' . strtolower(SITE_LANG) . '/rs_lang.website.php');
require_once('lang/' . 'en' . '/rs_lang.website.php');



require_once("config/rewrite.php");
require_once("classes/thumbnail.class.php");
include_once(HTML_PATH . 'default.php');

mysql_close();