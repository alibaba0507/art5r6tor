<?php

// Article Creator Script
// This script can grab articles from any keyword and rewrite them to unique articles
// Author: FullContentRSS.com
// Script URL: http://articlecreator.fullcontentrss.com

require_once(dirname(__FILE__).'/config.php');
?><!DOCTYPE html>
<html>
  <head>
   <?php include('./html_tmp/head.php');?>
  </head>
  <body>
	<div class="container" style="width: 600px; border: 2px; border-radius: 0px; background-color: #FFFFFF; padding: 30px; margin-top: 30px; margin-bottom: 50px;">

	<center>
	  <div align="center" style="margin-bottom:10px;"><a href="index.php" title="FREE Unique Article Creator Online"><img src="images/ArticleCreatorLogo.png"></a></div>
	  <div style="font-size:14px; color:grey;">Automatic generate high quality seo friendly articles from your keyword</div><br /><br />
	</center>

	<!--form method="get" action="gotabs.php" id="form" class="form-horizontal" -->
    <?php include('./html_tmp/from.php');?>   
    
 	<!-- ?php include ("./html_tmp/tabs.php"); ? -->
	<br /><?php include ("./html_tmp/footer.php"); ?>

	</div>
  </body>
</html>