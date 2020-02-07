<?php
$dir = dirname(dirname(__FILE__));
require_once($dir.'/config/config.php');
$home_inc =$options->base_include_dir;
?><!DOCTYPE html>
<html>
  <head>
   <?php include($home_inc.'/inc/head.php');?>
  </head>
  <body>
	<?php include($home_inc.'/inc/body_top.php');?>
	<!--form method="get" action="gotabs.php" id="form" class="form-horizontal" -->
    <?php include($home_inc.'/html/contactForm.php');?>   
    
 	<!-- ?php include ("./html_tmp/tabs.php"); ? -->
	<br /><?php include ($home_inc."/inc/footer.php"); ?>

	</div>
  </body>
</html>