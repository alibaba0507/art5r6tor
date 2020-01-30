<?php
// Article Creator Script
// This script can grab articles from any keyword and rewrite them to unique articles
// Author: FullContentRSS.com
// Script URL: http://articlecreator.fullcontentrss.com
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once(dirname(__FILE__).'/config.php');
require_once(dirname(__FILE__).'/utils/utils.php'); // for debug call  debug($msg,$obj)

error_reporting(1);

$baseurl =((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);

$keyword= filter_var($_POST['keyword'], FILTER_SANITIZE_SPECIAL_CHARS); 
$keywords= $_POST['keywords'];
$urllink = $_POST['urllink'];
$type= "POST";
$fields = null;
if ($_POST['feedsource'] == 'google') {
	$urlsource = $baseurl ."/googlenews.php";//?keyword=" .urlencode($keyword);
    $fields = "keyword=" .urlencode($keyword);
 }
if ($_POST['feedsource'] == 'yahoo') {
	$urlsource = $baseurl ."/yahoonews.php";//?
    $fields = "keyword=" .urlencode($keyword); 
}
if ($_POST['feedsource'] == 'bing') {
	$urlsource = $baseurl ."/bingnews.php";//?
    $fields = "keyword=" .urlencode($keyword);
}
if ($_POST['feedsource'] == 'yahooanswers'){
	  $urlsource = $baseurl ."/yahooanswers.php";//?
      $fields = "keyword=" .urlencode($keyword);
}
if ($_POST['feedsource'] == 'user_urls')
	{
	  $urlsource = $baseurl ."/custom_urls.php";//?
      $fields = "keyword=" .urlencode($_POST['custom_urls']);
}
if ($_POST['feedsource'] == 'only_spin')
{
  $urlsource = $baseurl ."/only_spin.php";
  $fields = "spin=".($_POST['only_spin_txt']);
  debug(">>>>>>>>>>>>>>> ONLY SPIN BEFORE  >>>>>>>>>>>>>>>>>>>>>");
}
 // this in future need to be change
// we will introduce file based token generator and will be associated 
// with email , there will be two type of tokens 
// free token  for n days 
// payd monthly token.
// file will be :
// email|token|expired day|type(1 = free,2 = payd)
include ('accesskey.php');
$getkey= filter_var($_POST['accesskey'], FILTER_SANITIZE_SPECIAL_CHARS); 
$numbers = filter_var($_POST['numbers'], FILTER_SANITIZE_SPECIAL_CHARS);


?>
<!DOCTYPE html>
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
    <input type="hidden" id="keyword" value="<?php echo $keyword;?>">
    <input type="hidden" id="keywords" value="<?php echo $keywords;?>">
    <input type="hidden" id="urllink" value="<?php echo $urllink;?>">
    
   <?php
    // return error on direct access
    if ($_POST['feedsource'] == '') {
        echo "<center><h1>You don't have permission to access this page!</h1></center><br><br><br>";
            include ("./html_tmp/footer.php");
            exit;
        }
     if ((validatetoken($getkey) == 1 or (($_POST['rewrite'] == 'original') and ($numbers == 3)) )) 
    {
        $gettitle = $keyword ." :: Article Creator";
        echo("<title>$gettitle</title>");
        $feed = processFeed($urlsource,$type,$fields);
        
        $count = 0;
	    $maxitems = ($_POST['feedsource'] == 'user_urls')?sizeof($feed->channel->item): $numbers;
        //debug(" >>>>>>>>>>>>>>>>>>>>>>>>>>>> FEED URL [" .$urlsource ."]>>>>",$feed);
       // debug(" >>>>>>>>>>>>>>>>>>>>>>>>>>>> FEED MAX CNT [" .$maxitems ."]>>>>");
        
        //******************* LOOP FOR ARTICLES **********************//
       // debug("############################## CAHNELS ITEMS  ##########################\n",$feed);
        foreach ($feed->channel->item as $item) 
        {
            if ($count > $maxitems) break;
            $title = $item->title;
            $title = str_replace("<b>", "", $title);
            $subject = str_replace("</b>", "", $title);
            $link = $item->link;

            $description = $item->description;
            $description = str_replace("<b>", "", $description);
            $body = str_replace("</b>", "", $description);
        ?>
        <div class="tab-wrapper">
        <ul class="nav nav-tabs">
            <li class="active " ><a href="#menu1<?php echo $count;?>">Original</a></li>
            <li ><a href="#menu2<?php echo $count;?>">Unique</a></li>
            <!-- li ><a href="#menu3<?php //echo $count;?>">Edit</a></li -->
		</ul>
        <div class="tab-content">
          <div id="menu1<?php echo $count;?>" class="tab-pane active">
            <div class="needs-rewrite<?php echo $count;?>" style="overflow-y: scroll; height:400px;">
            <?php shell_exec('arp '.$ip.' | awk \'{print $4}\'');?>
                <?php
                   // this tab is original content
                   // debug(">>>>>>>>>>>>>> SUBJECT [" .$subject ."]>>>>>>>>\n");
                    echo "<h3>" .$subject ."</h3>";
                    echo $body;
                ?>
                <input type="hidden" id="headline<?php echo $count; ?>" value="<?php echo $subject;?>">
            </div>
           </div><!------ END <div id="menu1 ----->
           <div id="menu2<?php echo $count;?>" class="tab-pane">
           <?php
               if ($_POST['rewrite'] == 'unique' or $_POST['feedsource'] == 'only_spin') 
                { 
                    $prefix = mt_rand(100,1000);
                    $myFile = "article_".$prefix.".txt";

                    if(file_exists("$myFile")) unlink("$myFile");

                ?>
                <div style="text-align: center;"> 
                    <!-- This is spin button -->
                    <button ng-disabled="siteFunctionalityDisabled"  class='btn btn-primary'  style="border: medium groove ; height: 30px; width: 105px; font-size: medium;" id="<?php echo $count;?>" onclick="rewriteArticle(this.id);">New Spin ...</button>  <button ng-disabled="siteFunctionalityDisabled"  class='btn btn-primary'  style="border: medium groove ; height: 30px; width: 345px; font-size: medium;" id="<?php echo $count;?>" onclick="downloadArticle(this.id,'text/html',<?php echo $myFile; ?>);">Click here to download  article in TXT file</button>
                 </div>
                  <div id="divId<?php echo $count;?>"class="spin_txt<?php echo $count;?>"  style="overflow-y: scroll; height:400px;"  ondblclick="showPosAjax(event,this.class)" onclick="document.getElementById('PopUp').style.display = 'none'">
                <?php 
                 echo "";
                }else{ ?>
                <div id="divId<?php echo $count;?>"class="spin_txt<?php echo $count;?>"  style="overflow-y: scroll; height:400px;">
                <?php
                  echo "";
                }
                   if ($_POST['rewrite'] == 'unique' or $_POST['feedsource'] == 'only_spin') 
                    {
                        //echo 'REWRITE UNIQUES .....<br>';
                        $source = $body;
                        include 'unike.php';
                        $newbody = $article;
                        
                        $newsubject = $subject;
                       
                    }
                    else
                    {
                        $newbody = $body;
                        $newsubject = $subject;
                    }
                    echo "<h3>" .$newsubject ."</h3>";
                    echo $newbody;
                ?>
             </div> <!---- END div id="divId --->
           </div> <!----- END div id="menu2 ------->
           
        </div><!------- END div class="tab-content" ----->
        
       
        </div><!----- END  div class="tab-wrapper" ------>
        
     <?php  
            $count++;
        }// end for foreach ($feed->channel->item as $item) 
        /*if ($count > 0)
        {
            $prefix = mt_rand(100,1000);
            $myFile = 'tempfiles/' .$prefix ."_generatedfile.txt";

           if(file_exists("$myFile")) unlink("$myFile");

            // this is sounload buttons
            echo "<br /><div align='center'><a href='$myFile' target='_blank'><div align='center' class='btn btn-primary'>Click here to download  article in TXT file </div></a> " ." <a href='$baseurl'><div align='center' class='btn btn-secondary'>Click here to generate new articles</div></a></div><br />";
        }*/
        echo "<br /><div align='center'><a href='$baseurl'><div align='center' class='btn btn-secondary'>Click here to generate new articles</div></a></div><br />";
    }// end if ((validatetoken($getkey) == 1 or (($_POST['rewrite'] == 'original') and ($numbers == 3)) )) 
    else
	{
        $page_title = "Invalid Access Key!";
        echo("<title>$page_title</title>");
        echo "<center><h1>Invalid Access Key!</h1></center>";
	}
    ?>
    <br />
    <?php include ("./html_tmp/footer.php"); ?>

  </div><!---- END DIV container ---->
  
  <!------------------ MODAL BOX  ---->
    <!--div class="modal" width="50%" -->
    <!-- div id="myModal" class="modal fade" role="dialog" -->
    <div id="dialog" style="display: none; position: absolute; left: 100px; top: 50px; text-align: justify; font-size: 12px; width: 128px; height: 128px;"  >
 
        <div class="center"> <img alt="" src="loader.gif"> </div>
    </div>
    
    <!--------------- Popup drop-down box with syntax words ------>
    
    <div id="PopUp" style="border: 1px solid black; padding: 10px; display: none; position: absolute; left: 100px; top: 50px; background-color: rgb(200, 100, 100); text-align: justify; font-size: 12px; width: 225px;">
    <!--SPAN id='PopUpText'>TEXT</SPAN -->
    <select id="selectWord" onclick="updateTextAea();">
    <option></option>
    </select>
    </div>
	<!------------------------- End Scripts ---------------->
    
  </body>
  </html>