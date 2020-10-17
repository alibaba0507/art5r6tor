<?php
 $dir = dirname(dirname(__FILE__));
require_once($dir.'/config/config.php');
$home_inc =$options->base_include_dir;
$base_url = $options->host.((strlen(trim($options->base_html_dir))>0)?'/'.$options->base_html_dir:'');//'/'.$options->base_html_dir;
$post0 = $base_url.'/post/google-index-strategy.php';
$post1 = $base_url.'/post/How-to-beat-competition-with-article-spinning-using-this-advanced-spinner.php';
$post2 = $base_url.'/post/do-it-yourself.php';
$post3 = $base_url.'/post/seo-article-rewrite.php';
$post4 = $base_url.'/post/rank-new-content.php';
$post5 = $base_url.'/post/how-to-paraphrase-a-quote-from-a-website.php';
$post6 = $base_url.'/post/how-to-rephrase-a-question-into-a-statement.php';
?>
<html>
  <head>
   <?php include($home_inc.'/inc/head.php');?>
  </head>
  <body>
	<?php include($home_inc.'/inc/body_top.php');?>
	<!-- include your own success html here -->
    <div>
 <hr>
 <ul>
     <li><a href="<?=$post6 ?>">How to rephrase a question into a statement</a></li>
     <li><a href="<?=$post5 ?>">How to paraphrase a quote from a website</a></li>
	 <li><a href="<?=$post0 ?>">Google Index Strategy</a></li>
	 <li><a href="<?=$post1 ?>">How to beat competition with article spinning using this advanced spinner</a></li>
	  <li><a href="<?=$post2 ?>">Do it yourself</a></li>
	  <li><a href="<?=$post3 ?>">rewrite article for SEO</a></li>
	  <li><a href="<?=$post4 ?>">How to Index fast new content on Google</a></li>
	</ul>
    <gr>
    </div>
 	<!-- ?php include ("./html_tmp/tabs.php"); ? -->
	<br /><?php include ($home_inc."/inc/footer.php"); ?>

	</div>
  </body>