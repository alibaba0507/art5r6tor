<?php

$dir = (dirname(__FILE__));
require_once($dir.'/config/config.php');
include $dir.'/utils/utils.php';
$base_url = $options->host.'/'.$options->base_html_dir;
$home = $base_url; 
$home_inc =$options->base_include_dir;
$numbers = filter_var($_POST['numbers'], FILTER_SANITIZE_SPECIAL_CHARS);
if ($_POST['feedsource'] == '') {
    echo "<center><h1>You don't have permission to access this page!</h1></center><br><br><br>";
    include ($home_inc."/inc/footer.php");
    exit;
}
 $hasValidUser =  true;
 if (($numbers > 3)) 
    {
        // TODO: Check If user is log in.
        // If yes check if has paid 
        // if yes everytonh ok else 
        $hasValidUser = false;
    }
   if ($_POST['feedsource'] == 'only_spin' || $_POST['feedsource'] == 'user_urls')
   {
       $hasValidUser = true;
   }
   $keyword= filter_var($_POST['keyword'], FILTER_SANITIZE_SPECIAL_CHARS); 
    //debug(">>>>>>>>>>>>>>>>>>>> SEND KEYWORD >>>>>>>>>>>",$keyword);
    $keywords=filter_var($_POST['keywords'], FILTER_SANITIZE_SPECIAL_CHARS);// $_POST['keywords'];
    $urllink =filter_var($_POST['urllink'], FILTER_SANITIZE_SPECIAL_CHARS);// $_POST['urllink'];
?>

<!DOCTYPE html>
<html>
  <head>

	<?php include($home_inc.'/inc/head.php');?>
  </head>
  <body>
   <?php include($home_inc.'/inc/body_top.php');?>
    <input type="hidden" id="keyword" value="<?php echo $keyword;?>">
    <input type="hidden" id="keywords" value="<?php echo $keywords;?>">
    <input type="hidden" id="urllink" value="<?php echo $urllink;?>">
    <?php
    if ($hasValidUser === true) 
    {
         if ($_POST['feedsource'] == 'only_spin')
        {
            // debug(">>>>>>>>>>>>>>> BEFORE ONLY SPIN BEFORE  >>>>>>>>>>>>>>>>>>>>>");
            $fields = array ('spin' => urlencode($_POST['only_spin_txt'])); 
            //debug(">>>>>>>>>>>>>>> BEFORE ONLY SPIN BEFORE  >>>>>>>>>>>>>>>>>>>>>",$fields);            
            $rss = '';
            include 'only_spin.php';
          //  debug(">>>>>>>>>>>>>>> ONLY SPIN AFTER SPIN PHP  >>>>>>>>>>>>>>>>>>>>>",$rss);
            $feed = createFeed($rss);
                   
           
        }
         else if ($_POST['feedsource'] == 'user_urls')
        {
             $fields = array ('keyword' => (urlencode($_POST['custom_urls'])));
            $rss = '';
            include 'custom_urls.php';
          //  debug(">>>>>>>>>>>>>>> ONLY SPIN AFTER SPIN PHP  >>>>>>>>>>>>>>>>>>>>>",$rss);
            $feed = createFeed($rss);
           
        }else{
            if ($_POST['feedsource'] == 'yahooanswers'){
                 // $urlsource = $baseurl ."/yahooanswers.php";//?
                 $fields = array ('keyword' => (($keyword)),
                                  'url' =>  ('http://answers.yahoo.com/search/search_result?p='),
                                   'end' => ('&submit-go=Search+Y!+Answers') );
            }else if ($_POST['feedsource'] == 'bing') {
                //$urlsource = $baseurl ."/bingnews.php";//?
                $fields = array ('keyword' => (($keyword)),
                                  'url' =>  ('http://www.bing.com/news/search?q='),
                                   'end' => ('&format=RSS') );
            }else if ($_POST['feedsource'] == 'google') {
                 $fields = array ('keyword' => (($keyword)),
                                  'url' =>  ('http://news.google.com/news?q='),
                                   'end' => ('&output=rss') );
             }else if ($_POST['feedsource'] == 'yahoo') {
                $fields = array ('keyword' => (($keyword)),
                                  'url' =>  ('https://news.yahoo.com/rss/?p='),
                                   'end' => ('') );
                
            }
             $rss = '';
             include 'rssnews.php';
             $feed = createFeed($rss);
        }
         //******************* LOOP FOR ARTICLES **********************//
       // debug("############################## CAHNELS ITEMS  ##########################\n",$feed);
       $count = 0;
        foreach ($feed->channel->item as $item)
        //foreach ($feed['channel']->item as $item)         
        {
             // debug("############################## FOREACH ITEMS  ##########################\n",$item);
            //if ($count > $maxitems) break;
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
            <?php //shell_exec('arp '.$ip.' | awk \'{print $4}\'');?>
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
                    $myFile = "article_".$prefix;//.".txt";

                    if(file_exists("$myFile")) unlink("$myFile");

                ?>
                <div style="text-align: center;"> 
                    <!-- This is spin button -->
                    <button ng-disabled="siteFunctionalityDisabled"  class='btn btn-primary'  style="border: medium groove ; height: 30px; width: 105px; font-size: medium;" id="<?php echo $count;?>" onclick="rewriteArticle(this.id);">New Spin</button>  
                    <?php
                   // echo '<br>';
                  /* if ($_SESSION['user'] == 'alibaba0507')
                   {
                        echo "<button ng-disabled='siteFunctionalityDisabled'  class='btn btn-primary'  style='border: medium groove ; height: 30px; width: 225px; font-size: medium;' id='$count' onclick='downloadToSite(".$newbody.");'>Download  article as HTML to this Site</button>";
                   }else{ */
                        echo "<button ng-disabled='siteFunctionalityDisabled'  class='btn btn-primary'  style='border: medium groove ; height: 30px; width: 225px; font-size: medium;' id='$count' onclick='downloadArticle(this.id,\"text/plain\",\"".$myFile."\");'>Download  article as TXT</button>";
                        echo "<button ng-disabled='siteFunctionalityDisabled'  class='btn btn-primary'  style='border: medium groove ; height: 30px; width: 225px; font-size: medium;' id='$count' onclick='downloadArticle(this.id,\"text/html\",\"".$myFile."\");'>Download  article as HTML</button>";
                   //}
                    ?>
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
                        include $dir.'/unike.php';
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
         <br><br>
        
     <?php  
            $count++;
        }// end foreach ($feed->channel->item as $item)
    }else{
      echo "<center><h1>You don't have permission to this request!</h1></center><br><br><br>
           <div class=\"tab-content\"><center><h3>Please sign up or Login</h3></center></div><br><br><br>";
    }
    ?>
    <br>
    <?php   include ($home_inc."/inc/footer.php");?>
    </div><!---- END DIV container ---->
  
  <!------------------ MODAL BOX  ---->
    <!--div class="modal" width="50%" -->
    <!-- div id="myModal" class="modal fade" role="dialog" -->
    <div id="dialog" style="display: none; position: absolute; left: 100px; top: 50px; text-align: justify; font-size: 12px; width: 128px; height: 128px;"  >
 
        <div class="center"> <img alt="" src="<?= $home ?>/images/loader.gif"> </div>
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