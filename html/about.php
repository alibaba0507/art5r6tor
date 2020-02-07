<?php
 $dir = dirname(dirname(__FILE__));
require_once($dir.'/config/config.php');
$home_inc =$options->base_include_dir;
?>
<html>
  <head>
   <?php include($home_inc.'/inc/head.php');?>
  </head>
  <body>
	<?php include($home_inc.'/inc/body_top.php');?>
	<!-- include your own success html here -->
    <div>
 <p>
 Coming Soon ....
    <p>
    </div>
 	<!-- ?php include ("./html_tmp/tabs.php"); ? -->
	<br /><?php include ($home_inc."/inc/footer.php"); ?>

	</div>
  </body>