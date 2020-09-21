

<?php

// Article Creator Script
// This script can grab articles from any keyword and rewrite them to unique articles
// Author: FullContentRSS.com
// Script URL: http://articlecreator.fullcontentrss.com

require_once(dirname(dirname(__FILE__)).'/config/config.php');
?><!DOCTYPE html>
<html>
  <head>
   <?php include('../inc/head.php');?>
  </head>
  <body>
	<?php include('../inc/body_top.php');?>
	<!--form method="get" action="gotabs.php" id="form" class="form-horizontal" -->
    <?php 
	require_once '../adm/vendor/autoload.php';
	use hisorange\BrowserDetect\Parser as Browser;
	$browser = new Browser;
	/*$result = $browser->detect();
	var_dump($result);
	if (Browser::isLinux()) {
		echo 'Linux Browser';
	}else
		echo 'Non Linux Browser'; 
	

	// Determine the user's device type is simple as this:
	
	Browser::isMobile();
	Browser::isTablet();
	Browser::isDesktop();
    */
	// Every wondered if it is a bot who loading Your page?
    //echo 'SEARCH GOOGLE REF '.strpos(getReferer(),'google');
	//if (strpos(getReferer(),'google') !== FALSE)
	//  include('../inc/form.php');
	//else 
	if ($browser->isBot()){
		//echo 'No need to wonder anymore!';
		include('rank-new-content.txt');
	} else
	{
		include('../inc/form.php');
	}
	
	?>   
    
 	<!-- ?php include ("./html_tmp/tabs.php"); ? -->
	<br /><?php include ("../inc/footer.php"); ?>

	</div>
  </body>
</html>