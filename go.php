<?php

// Article Creator Script
// This script can grab articles from any keyword and rewrite them to unique articles
// Author: FullContentRSS.com
// Script URL: http://articlecreator.fullcontentrss.com

require_once(dirname(__FILE__).'/config.php');
require_once(dirname(__FILE__).'/utils/utils.php'); // for debug call  debug($msg,$obj)
?><!DOCTYPE html>
<html>
  <head>

	<?php include('./html_tmp/head.php');?>
  </head>
  <body>
  <!--
	<div class="container" style="width: 600px; border: 2px;
 border-radius: 0px; background-color: #FFFFFF; padding: 30px; margin-top: 30px; margin-bottom: 50px;">
	
	<center>
	  <div align="center" style="margin-bottom:10px;"><a href="index.php" title="FREE Unique Article Creator Online"><img src="images/ArticleCreatorLogo.png"></a></div>
	  <div style="font-size:14px; color:grey;">Automatic generate high quality seo friendly articles from your keyword</div><br /><br />
	</center>
  -->
  <div class="container" style="width: 600px; border: 2px; border-radius: 0px; background-color: #FFFFFF; padding: 30px; margin-top: 30px; margin-bottom: 50px;">

	<center>
	  <div align="center" style="margin-bottom:10px;"><a href="index.php" title="FREE Unique Article Creator Online"><img src="images/ArticleCreatorLogo.png"></a></div>
	  <div style="font-size:14px; color:grey;">Automatic generate high quality seo friendly articles from your keyword</div><br /><br />
	</center>

  
  <?php

error_reporting(1);

// return error on direct access
if ($_GET['feedsource'] == '') {
	echo "<center><h1>You don't have permission to access this page!</h1></center><br><br><br>";
        include ("./html_tmp/footer.php");
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
if ($_GET['feedsource'] == 'yahooanswers')
	{
	  $urlsource = $baseurl ."yahooanswers.php?keyword=" .urlencode($keyword);
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

//if (in_array($getkey, $accesskey) or (($_GET['rewrite'] == 'original') and ($numbers == 3)) ) {
if ((validatetoken($getkey) == 1 or (($_GET['rewrite'] == 'original') and ($numbers == 3)) )) 
{
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
			curl_setopt($ch, CURLOPT_TIMEOUT, 60);
			$returned = curl_exec($ch);
			curl_close($ch);
            
			// Clean the document for parsing
			$indx = stripos($returned,"<rss version=\"2.0\" xmlns:dc=\"http://purl.org/dc/elements/1.1/\" xmlns:media=\"http://search.yahoo.com/mrss/\">");
			$returned  = substr($returned,$indx);
			
			$feed = simplexml_load_string($returned);
            // Remove empty items
            /*
            while (($node_list = $feed->query('//*[not(*) and not(@*) and not(text()[normalize-space()])]')) && $node_list->length) {
                foreach ($node_list as $node) {
                    $node->parentNode->removeChild($node);
                }
            }// end while
            */
           // debug("----------------- AFTER call [".$urlsource."]\n",$feed);
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
            //debug("############################## CAHNELS ITEMS  ##########################\n",$feed->channel);
            foreach ($feed->channel->item as $item) 
            {
                //debug("############################## CAHNELS ITEMS  ##########################\n",$item);
                if ($count < $maxitems) 
				{
                     $title = $item->title;
                    $title = str_replace("<b>", "", $title);
                    $subject = str_replace("</b>", "", $title);
                    $link = $item->link;

                    $description = $item->description;
                    $description = str_replace("<b>", "", $description);
                    $body = str_replace("</b>", "", $description);
                   // debug("############################## CAHNEL ITEM TITLE  ##########################\n",$subject);
                  ?>
        <ul class="nav nav-tabs">
            <li class="active " ><a href="#menu1<?php echo $count;?>">Original</a></li>
            <li ><a href="#menu2<?php echo $count;?>">Unique</a></li>
            <li ><a href="#menu3<?php echo $count;?>">Edit</a></li>
		</ul>
		<div class="tab-content">
            <div id="menu1<?php echo $count;?>" class="tab-pane active">
            <div style="overflow-y: scroll; height:400px;">
                <?php
                   // this tab is original content
                    echo "<h3>" .$subject ."</h3>";
                    echo $body;
                ?>
            </div>
           </div>
           <div id="menu2<?php echo $count;?>" class="tab-pane">
           <div style="overflow-y: scroll; height:400px;">
            <?php
               if ($_GET['rewrite'] == 'unique') 
			{
				echo 'REWRITE UNIQUES .....<br>';
				$source = $body;
				//include 'unik.php';
				//include 'unike.php';
				include 'unike.php';
				
				$newbody = $article;
			    //include 'links.php';
				$newsubject = $subject;
				}
				
				else{
					$newbody = $body;
					$newsubject = $subject;
					}
				

				echo "<h3>" .$newsubject ."</h3>";
				echo $newbody;
            ?>
            </div>
          
           </div>
           <div id="menu3<?php echo $count;?>" class="tab-pane">
            <div style="overflow-y: scroll; height:400px;">
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
            
           </div>
        </div><!-- div id="content" -->
          <?php
                    $count++;
                
                
                /*		
				$newbody = preg_replace ('/<[^>]*>/', ' ', $newbody);
   
				// save the txt to file
				$filecontent = $newsubject ."\n" ."\n" .$newbody ."\n" ."\n" ."\n";
				$fh = fopen($myFile, 'a');
				fwrite($fh, "\xEF\xBB\xBF".$filecontent);
                  */      
                
                
                fclose($fh);
			    //break;
                } // end if ($count < $maxitems) 
			}// end foreach ($feed->channel->item as $item) 
          
            if ($_GET['rewrite'] == 'unique') 
		   { // we must close the file
	         fclose($fdat);
		   }
        if ($count > 0)
        {
            // this is sounload buttons
            echo "<br /><div align='center'><a href='$myFile' target='_blank'><div align='center' class='btn btn-primary'>Click here to download  article in TXT file </div></a> " ." <a href='$baseurl'><div align='center' class='btn btn-secondary'>Click here to generate new articles</div></a></div><br />";
        }
    }
	else
	{
	$page_title = "Invalid Access Key!";
	echo("<title>$page_title</title>");
	echo "<center><h1>Invalid Access Key!</h1></center>";
	}
	
?>

	<br />
    <?php include ("./html_tmp/footer.php"); ?>



	</div>
	
	<!------------------ All Scripts goes here ---->
  
	<!------------------------- End Scripts ---------------->
  </body>
</html>