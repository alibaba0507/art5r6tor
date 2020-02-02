<?php

$prefix = mt_rand(100,1000);
$myFile = 'pub/' .$prefix ."_generatedfile.txt";

while(file_exists("$myFile")){
$prefix = mt_rand(100,1000);
$myFile = 'pub/journal-article-'.$prefix .".txt";
//    unlink("$myFile");
}
$head = '<!DOCTYPE html><html><head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
	<meta name="robots" content="INDEX" />
	<meta name="description" content="SEO Optimized Article Creator. This is a article rewriting tool, that search the web search engines based on input keywords and generate unique articles.">
    <meta name="keywords" content="journal article,spinbot,SEO,seo optimize,article rewriter,article spinner,free article spinner">
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="screen" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script type="text/javascript" src="js/spin.js"></script>
	<script type="text/javascript" src="js/bootstrap-tab.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </head>
  <body>';
  $head .= $_POST['article'];
  $head .= '</body></html>';
$fh = fopen($myFile, 'a');
fwrite($fh, $head);
fclose($fdat);
?>