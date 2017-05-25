<?php 
include_once(INC_PATH . 'header.php');
if(!isset($_GET['show']) || empty($_GET['show'])){
			include_once(INC_PATH . 'top.php');
			include_once(HTML_PATH . 'home.php');
		}else{
			include_once(INC_PATH . 'top_sec.php');
			$inc_page = getPage($_GET['show']);
			include_once($inc_page);
		}
include_once(INC_PATH . 'footer.php');
?>