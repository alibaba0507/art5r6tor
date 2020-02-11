<?php
require_once('../config/config.php');
$home_inc =$options->base_include_dir;
?>
<html>
  <head>
   <?php include($home_inc.'/inc/head.php');?>
  </head>
  <body>
	<?php include($home_inc.'/inc/body_top.php');?>
	
	
	<!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	-->
	<link rel="stylesheet" href="../css/style_gif.css">
	<!-- include your own success html here -->
  <div class="table-responsive">
	  <table class="table" border="1" style =“clear:both”>
		  <tr><td >
		  <p><b>Hover over the image</b></p><br>
		<img class="static" src="../images/img2.png" height="60%" width="35%"><img class="active" src="../images/captured_1_mod_v2.gif" >
		<br><br>
		<p><strong> Using Search Engines to extract Articles </strong></p>
		<!-- partial -->
		</td>
		</tr><tr>
		<td >

		<img class="static" src="../images/img1.png"  height="60%" width="37%"><img class="active" src="../images/captured_5_v2.gif" >
		<!-- partial -->
		<p><strong> Custom URL Article extraction. One Can do browser search (Google , Bing ...e.t.c.) <br>
     	 After that copy link from search engine and Paste into Custom URL Box, One per line <br>
		 Article Creator will search the site for Article and extract if find any</strong></p>
		</td></tr>
		<tr>
		<td>
		<br><br>
		<img class="static" src="../images/img3.png" height="40%" width="43.8%" ><img class="active" src="../images/captured_6_v2_source.gif" >
		<p><strong> Source Code Article extraction. One Can do browser search (Google , Bing ...e.t.c.) or  <br>
     	 any web site use web broeser right click menu \'View Page Source\' , copy the source and paste into Text Bos <br>
		 also you can insert any text Html or not <br>
		 Article Creator will parse the text and will extract Articles</strong></p>
		</td>
		</tr>

	</table>
</div>  
 	<!-- ?php include ("./html_tmp/tabs.php"); ? -->
	<br /><?php include ($home_inc."/inc/footer.php"); ?>

	</div>
  </body>