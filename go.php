<?php

// Article Creator Script
// This script can grab articles from any keyword and rewrite them to unique articles
// Author: FullContentRSS.com
// Script URL: http://articlecreator.fullcontentrss.com

require_once(dirname(__FILE__).'/config.php');
?><!DOCTYPE html>
<html>
  <head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
	<meta name="robots" content="noindex, nofollow" />
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="screen" />
	<style>
	html, body { background-color: #cad2d7;}
	body {
	margin: 0;
	line-height: 1.4em;
	font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;

}
	label, input, select, textarea { font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; }
	li { color: #404040; }
	li.active a { font-weight: bold; color: #666 !important; }
	form .controls { margin-left: 220px !important; }
	label { width: 200px !important; }
	fieldset legend {
	padding-left: 220px;
	line-height: 20px !important;
	margin-bottom: 0px !important;
}
	.form-actions { padding-left: 220px !important; }
	.popover-inner { width: 205px; }
	h1 {
	margin-bottom: 4px;
}
	body,td,th {
	font-family: Arial, Helvetica, sans-serif;
}
    .style1 {font-family: "Times New Roman", Times, serif}
    </style>
  </head>
  <body>
	<div class="container" style="width: 600px; border: 2px;
 border-radius: 0px; background-color: #FFFFFF; padding: 30px; margin-top: 30px; margin-bottom: 50px;">
	
	<center>
	  <div align="center" style="margin-bottom:10px;"><a href="index.php" title="FREE Unique Article Creator Online"><img src="images/ArticleCreatorLogo.png"></a></div>
	  <div style="font-size:14px; color:grey;">Automatic generate high quality seo friendly articles from your keyword</div><br /><br />
	</center>
  
  
  <?php

error_reporting(1);

// return error on direct access
if ($_GET['feedsource'] == '') {
	echo "<center><h1>You don't have permission to access this page!</h1></center><br><br><br>";
        include ("footer.php");
        exit;
	}


// set base url
$baseurl = "http://localhost/dev/articlecreator/";
$keyword= filter_var($_GET['keyword'], FILTER_SANITIZE_SPECIAL_CHARS); 

// get the content source
if ($_GET['feedsource'] == 'google') {
	$urlsource = $baseurl ."googlenews.php?keyword=" .urlencode($keyword);
	}
if ($_GET['feedsource'] == 'yahoo') {
	$urlsource = $baseurl ."yahoonews.php?keyword=" .urlencode($keyword); 
	}
if ($_GET['feedsource'] == 'bing') {
	$urlsource = $baseurl ."bingnews.php?keyword=" .urlencode($keyword);
	}

// this in future need to be change
// we will introduce file based token generator and will be associated 
// with email , there will be two type of tokens 
// free token  for n days 
// payd monthly token.
// file will be :
// email|token|expired day|type(1 = free,2 = payd)
include ('accesskey.php');
$getkey= filter_var($_GET['accesskey'], FILTER_SANITIZE_SPECIAL_CHARS); 
$numbers = filter_var($_GET['numbers'], FILTER_SANITIZE_SPECIAL_CHARS);

if (in_array($getkey, $accesskey) or (($_GET['rewrite'] == 'original') and ($numbers == 3)) ) {
	$gettitle = $keyword ." :: Article Creator";
	echo("<title>$gettitle</title>");

$prefix = mt_rand(100,1000);
$myFile = 'tempfiles/' .$prefix ."_generatedfile.txt";
if(file_exists("$myFile")) unlink("$myFile");

 //echo "Before curl ...<br/>";
			// extract rss
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $urlsource);
			curl_setopt($ch, CURLOPT_FAILONERROR, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_TIMEOUT, 30);
			$returned = curl_exec($ch);
			curl_close($ch);
			
			// Clean the document for parsing
			$indx = stripos($returned,"<rss version=\"2.0\" xmlns:dc=\"http://purl.org/dc/elements/1.1/\" xmlns:media=\"http://search.yahoo.com/mrss/\">");
			$returned  = substr($returned,$indx);
			
			$feed = simplexml_load_string($returned);
            //echo var_dump($returned);
           // Here before the feeds we must open this files for the 
		   // dictionary only if rewrite is true
		   if ($_GET['rewrite'] == 'unique') 
		   {
			    $myIndxFile = "th_en_US_new.idx";
				$lines = file($myIndxFile);//file in to an array
				$fdat = fopen('th_en_US_new.dat', 'r');
				$tmp_dic_arr = array(); // buffer array for used words
				
		   }// end unique check
			$count = 0;
			$maxitems = $numbers;
			
			//******************* LOOP FOR ARTICLES **********************//
			foreach ($feed->channel->item as $item) 
			{

			if ($count < $maxitems) 
				{
		?>
		<ul class="nav nav-tabs">
          
             <li class="active"><a href="#menu1<?php echo $count;?>">Original</a></li>
			<li><a href="#menu2<?php echo $count;?>">Unique</a></li>
			<li><a href="#menu3<?php echo $count;?>">Edit</a></li>
		</ul>
		<div class="tab-content">
       <?php
			$title = $item->title;
			$title = str_replace("<b>", "", $title);
			$subject = str_replace("</b>", "", $title);
			$link = $item->link;

			$description = $item->description;
			$description = str_replace("<b>", "", $description);
			$body = str_replace("</b>", "", $description);


			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=utf-8" . "\r\n";
		?>
		 
	   <div id="menu1<?php echo $count;?>" class="tab-pane fade">
		<?php
		   // this tab is original content
		    echo "<h3>" .$subject ."</h3>";
			echo $body;
		?>
	   </div>
		<div id="menu2<?php echo $count;?>" class="tab-pane fade">
		<?php
			// rewrite article if the option is selected
			if ($_GET['rewrite'] == 'unique') 
			{
				echo 'REWRITE UNIQUES .....<br>';
				$source = $body;
				//include 'unik.php';
				include 'unike.php';
				
				$newbody = $article;
				
				$source = $subject;
				//include 'unik.php';
				include 'unike.php';
				$newsubject = $article;
				
				
				}
				
				else{
					$newbody = $body;
					$newsubject = $subject;
					}
				

				echo "<h3>" .$newsubject ."</h3>";
				echo $newbody;
		?>
		  </div>
		 <div id="menu3<?php echo $count;?>" class="tab-pane fade">
		<?php
				if ($_GET['rewrite'] == 'unique') 
				{
					// we must add hidden div with
					// edit plugin where we select or highligh the words and will
					// display replacement for selected word
					// also provide option to email this to blogger email account
					echo "<div> ";
					echo "<textarea name=\"area\" id=\"area".$count."\" style=\"width:90%;height:100px;\">";
					echo $newbody; 
					echo "</textarea></div>";
				}
		?>
		</div>
		</div><!-- div id="content" -->
		
		<?php
				echo "<br>";
						
				$newbody = preg_replace ('/<[^>]*>/', ' ', $newbody);
   
				// save the txt to file
				$filecontent = $newsubject ."\n" ."\n" .$newbody ."\n" ."\n" ."\n";
				$fh = fopen($myFile, 'a');
				fwrite($fh, "\xEF\xBB\xBF".$filecontent);
                        

				}
			$item++;
			$count++;
                        fclose($fh);
						break;
            }// end foreach
			
            if ($_GET['rewrite'] == 'unique') 
		   { // we must close the file
	         fclose($fdat);
		   }
	echo "<br /><div align='center'><a href='$myFile' target='_blank'><div align='center' class='btn btn-primary'>Click here to download  article in TXT file </div></a> " ." <a href='$baseurl'><div align='center' class='btn btn-secondary'>Click here to generate new articles</div></a></div><br />";
	}
	else
	{
	$page_title = "Invalid Access Key!";
	echo("<title>$page_title</title>");
	echo "<center><h1>Invalid Access Key!</h1></center>";
	}
	
?>

	<br /><?php include ("footer.php"); ?>



	</div>
	
	<!------------------ All Scripts goes here ---->
	<script type="text/javascript" src="js/jquery-1.6.4.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-tooltip.js"></script>
	<script type="text/javascript" src="js/bootstrap-popover.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
	
	var baseUrl = 'http://'+window.location.host+window.location.pathname.replace(/(\/index\.php|\/)$/, '');
	
	$(document).ready(function() {
		
		// remove http scheme from urls before submitting
		$('#form').submit(function() {
			$('#url').val($('#url').val().replace(/^http:\/\//i, ''));
			return true;
		});
		// popovers
		$('#url').popover({offset: 10, placement: 'left', trigger: 'focus', html: true});
		$('#key').popover({offset: 10, placement: 'left', trigger: 'focus', html: true});
		$('#max').popover({offset: 10, placement: 'left', trigger: 'focus', html: true});
		$('#links').popover({offset: 10, placement: 'left', trigger: 'focus', html: true});
		$('#exc').popover({offset: 10, placement: 'left', trigger: 'focus', html: true});
		// tooltips
		$('a[rel=tooltip]').tooltip();
	});
	</script>
	<script type="text/javascript" src="js/nicEdit-latest.js"></script>
     <script type="text/javascript">
		//<![CDATA[
		  bkLib.onDomLoaded(function() {
			   nicEditors.allTextAreas(); // convert all text areas to rich text editor on that page
				//new nicEditor({maxHeight : 200}).panelInstance('area');// convert text area with id area1 to rich text editor.
				//new nicEditor({fullPanel : true,maxHeight : 200}).panelInstance('area1'); // convert text area with id area2 to rich text editor with full panel.
		  });
		  
		  //]]>
	</script>
	<!------------------------- End Scripts ---------------->
  </body>
</html>