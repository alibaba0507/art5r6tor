<?php
session_start();
// Article Creator Script
// This script can grab articles from any keyword and rewrite them to unique articles
// Author: FullContentRSS.com
// Script URL: http://articlecreator.fullcontentrss.com

require_once(dirname(__FILE__).'/config.php');
function dump_str($obj)
    {
        return var_export($obj,true);
    }
function str_lreplace($search, $replace, $subject)
{
	//error_log("//**************** BUILD URL Link [$search] with[$replace]");
    return preg_replace('~(.*)' . preg_quote($search, '~') . '~', '$1' . $replace, $subject, 1);
	//error_log("//**************** BUILD URL Link [$search] with[$replace]");
	//return preg_replace('/'.$search.'$/', $replace, $subject);
	 /*$pos = strrpos($subject, $search);

    if($pos !== false)
    {
        $subject = substr_replace($subject, $replace, $pos, strlen($search));
    }

    return $subject;
	*/
}

function sortByLength($a,$b){
 // if($a == $b) return 0;
 // $ret = (strlen($a) > strlen($b) ? -1 : 1);
  //echo "//*************** Call sortByLength [$a][$b]   ******************//";
  return  strlen($b)-strlen($a);
}

function str_lastreplace($search, $replace, $subject)
{
    $pos = strrpos(strtolower($subject), strtolower($search));

    if($pos !== false)
    {
		//error_log("//**************** str_lastreplace [$search] with[$replace]");
        $subject = substr_replace($subject, $replace, $pos, strlen($search));
    }

    return $subject;
}

?><!DOCTYPE html>
<html lang="en">
<head>
  <title>Article Creator</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
	<meta name="robots" content="noindex, nofollow" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
	line-height: 40px !important;
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
	<!--------------- Spiner Loader -------------->
	<style>
	 .spinner {
		    background : 'rgba(0, 0, 0, 0.7),
			position: fixed;
			top: 50%;
			left: 50%;
			margin-left: -50px; /* half width of the spinner gif */
			margin-top: -50px; /* half height of the spinner gif */
			text-align:center;
			z-index:1234;
			overflow: auto;
			width: 100px; /* width of the spinner gif */
			height: 102px; /*hight of the spinner gif +2px to fix IE8 issue */
		}
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

//error_reporting(0);
// use this for debuging only 
//ini_set('display_errors', 'On');
error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors", 1);
error_reporting(E_ALL);

$overalltime = microtime(true); // time in Microseconds
//error_log( "Overall Time Start .................................. ");
// return error on direct access
if ($_GET['feedsource'] == '') {
	echo "<center><h1>You don't have permission to access this page!</h1></center><br><br><br>";
        include ("footer.php");
        exit;
	}


// set base url
//$baseurl = "http://theprofitwebmaster.org/articlecreator/";
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
//$accesskey = array();
include ('accesskey.php');
$getkey= filter_var($_GET['accesskey'], FILTER_SANITIZE_SPECIAL_CHARS); 
$numbers = filter_var($_GET['numbers'], FILTER_SANITIZE_SPECIAL_CHARS);

//if ((in_array($getkey, $accesskey) or (($_GET['rewrite'] == 'original') and ($numbers == 3)) )) 
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
			curl_setopt($ch, CURLOPT_HEADER, 1 );
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_TIMEOUT, 30);
			$returned = curl_exec($ch);
			curl_close($ch);
		    file_put_contents('./log_'.date("j.n.Y").'.log', "---------------- gotabs ".dump_str($returned)." \n", FILE_APPEND); 
			// Clean the document for parsing
			$indx = stripos($returned,"<rss version=\"2.0\""/* xmlns:dc=\"http://purl.org/dc/elements/1.1/\" xmlns:media=\"http://search.yahoo.com/mrss/\">"*/);
			$returned  = substr($returned,$indx);
			//error_log("// *************** After curl ***************[$urlsource]");
			//error_log($returned);
            //var_dump($returned);
             
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
				/*if (!file_exists('th_en_US_new.dat') )
					error_log(" File Not Exists");
				
				if ($fdat === true)
					error_log(" Open file ....[true]");
			    else 
					error_log(" Open file ....[false]");
				error_log(" Close file ....");
				*/
		   }// end unique check
			$count = 0;
			$maxitems = $numbers;
			//******************* LOOP FOR ARTICLES **********************//
		foreach ($feed->channel->item as $item) 
		{
		

		if ($count < $maxitems) 
		{
			$title = $item->title;
			$title = str_replace("<b>", "", $title);
			$subject = str_replace("</b>", "", $title);
			$link = $item->link;

			$description = $item->description;
		    //error_log("*************** RAW SOURCE**********************");
			//error_log($description);
			//error_log("******************************");
			$description = str_replace("<b>", "", $description);
			$body = str_replace("</b>", "", $description);
            //error_log("*************** REPLACE SOURCE**********************");
			//error_log($body);
			//error_log("******************************");

			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=utf-8" . "\r\n";
?>

  <ul class="nav nav-tabs">
    
    <li class="active"><a href="#menu1<?php echo $count;?>">Original</a></li>
    <li><a href="#menu2<?php echo $count;?>">Unique</a></li>
	<?php 
	 if ($_GET['rewrite'] == 'unique') 
	  {	
      ?>
    <li><a href="#menu3<?php echo $count;?>">Edit</a></li>
	
	<li><a href="#menu4<?php echo $count;?>">Raw Edit</a></li>
	 
	 <?php 
	  }
	  ?>
  </ul>

  <div class="tab-content">
   
    <div id="menu1<?php echo $count;?>" class="tab-pane active">
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
				
				$source = $body;
				// remove all links
				$source = preg_replace("/<a[^>]+>/i", "", $source);
				// replace with selected keywords
				//include 'unik.php';
				$search = $_GET['keyword']; // search fields are also keywords
				$search_array  = explode("+",$search);
				foreach ($search_array as $val)
				{
					$search .= "|".$val;
				}
				$search = implode(" ",explode("+",$search));
				//error_log("// ************ SEARCH FOR KEYWORDS IS **[$search]****************");
				$keywords = $_GET['keywords']."|".$search;
				//error_log("// ************ SEARCH FOR KEYWORDS IS **[$keywords]****************");
				$urllink = $_GET['urllink'];
				//$urlinternal = $_GET['urlinternal'];
				$arr_keyword = explode("|",$keywords);
				// sort keywords array longest to shortest 
				// usort($arr_keyword, function($a, $b) {
				//		return strlen($b) - strlen($a);
				//});
				usort($arr_keyword,'sortByLength');
				$keywords = implode("|", $arr_keyword);
                $tagkeywords = implode(",",explode("|",$keywords));
				//sort($arr_keyword, SORT_NATURAL | SORT_FLAG_CASE);
			   // error_log(print_R($arr_keyword));
			   error_log( 'REWRITE UNIQUES ..... ['.$urllink.']<br>');
				include 'unike.php';
				$newbody = $article;
				
				if (strlen( trim($urllink)) > 0)
				{
					$patterns = array();
					$urlword = "";
					$urloutbound = "";
					//error_log(print_R($arr_keyword));
					$long_tail = array();
					foreach($arr_keyword as $value)
					{   // we will look for a long tail key words in a text and 
					    // put our links . array is already sorted from long tail to single words
						
						$ipos = strpos(strtolower ($newbody)," ".strtolower ($value)." ");
						//error_log("// ************ SEARC FOR KEY WORD **[$value]****************");
						if ($ipos !== false)
						{ // we found now we must find long tail keywords
					        if (strpos(trim($value)," ") === false)
							{ // single words
	                          // we must find the one that a long tail that has a single word
							  //error_log("// ************ FOUND KEY WORD **[$value]****************");
                              $lpos = strpos("|".strtolower($keywords)."|","|".strtolower($value." "));
							  if ($lpos !== false)
							  {
								    //error_log("// ************ ADD KEY WORDS TO LONG TAIL 1 111**[$lpos]****************");
								   $longEndPos = strpos(strtolower($keywords),strtolower("|"),$lpos + 1);
								   // error_log("// ************ ADD KEY WORDS TO LONG TAIL 1 2222**[".substr($keywords,$lpos,($longEndPos - $lpos))."]****************");
								   
								   $long_tail[$value] = substr($keywords,$lpos,($longEndPos - $lpos));
								//    error_log(var_dump($long_tail));
							  }else
							  {
								  
								 $lpos = strpos(strtolower($keywords),strtolower(" ".$value)); // secondary word 
								// error_log("// ************ ADD KEY WORDS TO LONG TAIL 2222222  *****[$lpos]*************");
								 if ($lpos !== false)
								 { // we found it
							        $startLonPos = strrpos(strtolower($keywords),strtolower("|"),(strlen($keywords) - $lpos)*(-1));
									$longEndPos = strpos(strtolower($keywords),strtolower("|"),$startLonPos + 1);
									// error_log("// ************ ADD KEY WORDS TO LONG TAIL 2 333333  *****[$startLonPos][$longEndPos]*************");
									 // error_log("// ************ ADD KEY WORDS TO LONG TAIL 2 333333  *****[$keywords]*************");
									//  error_log("// ************ ADD KEY WORDS TO LONG TAIL 2 333333  *****[".substr($keywords,$startLonPos  + 1,($longEndPos - $startLonPos) -1)."]*************");
								  
								   $long_tail[$value] = substr($keywords,$startLonPos + 1,($longEndPos - $startLonPos) -1); 
								 }
							  }
							}	
							if (strlen($urlword) == 0)
							{  
						
						         $fpos = strpos("|".strtolower ($keywords)."|","|".strtolower ($value));
								 $epos = strpos("|".strtolower ($keywords)."|","|",$fpos + 1);
								$urlword = substr($keywords,$fpos,($epos - ($fpos)) - 1);
								if (trim(strtolower($value)) == trim(strtolower($urlword)) 
									  && array_key_exists($value, $long_tail))
							         $urlword = $long_tail[$value];
								//error_log("//************ WE found the keyword [".$value."] WITH [".$urlword."] ******************//");
								if (trim(strtolower($value)) != trim(strtolower($urlword)))
								{
									// error_log("//************ WE found the keyword 1111 [".$value."] WITH [".$urlword."] ******************//");
									$newbody = str_replace(" ".$value." "," ".$urlword." ",$newbody);
									$newbody = str_replace(",".$value." ",",".$urlword." ",$newbody);
									$newbody = str_replace(" ".$value.","," ".$urlword.",",$newbody);
									$newbody = str_replace(".".$value." ",".".$urlword." ",$newbody);
									$newbody = str_replace(" ".$value."."," ".$urlword.".",$newbody);
									$newbody = str_replace(" ".ucfirst(trim($value))." "," ".ucfirst(trim($urlword))." ",$newbody);
									$newbody = str_replace(" ".strtoupper(trim($value))." "," ".(trim($urlword))." ",$newbody);
									$newpos = strpos(strtolower ($newbody)," ".strtolower ($urlword)." ");
								}
								//if ($newpos !== false)
								//	error_log("//************ WE found the keyword [".$urlword."] in new article ******************//");
								//else
								//	error_log("//************ WE DID NOT FOUND the keyword [".$urlword."] in new article ******************//");
							}	
							 else if (strlen($urloutbound) == 0 && strpos($value," ") === false && strpos($urlword,$value) === false)
									$urloutbound = $value;
								
						} // end if
						if (strlen($urlword) > 0 && strlen($urloutbound) > 0)
							break;
                        //$patterns[] = '/\b('.$value.')\b/i';						
					}// end foreach	
					
					if (strlen(trim($urlword)) == 0 && isset($long_tail) && sizeof($long_tail) > 0)
					{ // we did not find long tail keyword 
				      // check our seeds
					  $wordToReplace = "";
					  $replaceWith = "";
					  $longestLen = 0;
					  //error_log("// ******************* VAR DUMP LONG TAIL KEYWPRDDS ***************//");
					  //error_log(var_dump($long_tail));
					  foreach ($long_tail as $k => $v)
					  {
						if (strlen($long_tail[$k]) > $longestLen)
						{
							$longestLen = $long_tail[$k];
							$wordToReplace = $k;
						}							
					  }// end foreach
					 // error_log("// ******************* LONG TAIL [$wordToReplace] with [".$long_tail[$wordToReplace]."] ***************//");
						$newbody = str_replace(" ".$wordToReplace." "," ".$long_tail[$wordToReplace]." ",$newbody);
						$newbody = str_replace(",".$wordToReplace." ",",".$long_tail[$wordToReplace]." ",$newbody);
						$newbody = str_replace(" ".$wordToReplace.","," ".$long_tail[$wordToReplace].",",$newbody);
						$newbody = str_replace(".".$wordToReplace." ",".".$long_tail[$wordToReplace]." ",$newbody);
						$newbody = str_replace(" ".$wordToReplace."."," ".$long_tail[$wordToReplace].".",$newbody);
						$newbody = str_replace(" ".ucfirst(trim($wordToReplace))." "," ".ucfirst(trim($long_tail[$wordToReplace]))." ",$newbody);
						$newbody = str_replace(" ".strtoupper(trim($wordToReplace))." "," ".(trim($long_tail[$wordToReplace]))." ",$newbody);
						$urlword = $long_tail[$wordToReplace];
					}
					// last check if this word is single or multiple
				//	if (strpos($urlword," ") === false)
					//{ // try to find this word more than ones
				  //    for ($k = sizeof($arr_keyword) - 1;$k >= 0;$k--)
					//  {
					//	  $ipos = strpos($keywords,$urlword);
					//  }
						
					//}
					// replace with the link last one
					//error_log("//****************** Replace last occurance with [".$urlword."][".$urloutbound."]");
					if (strlen($urlword) > 0)
						$newbody = str_lreplace($urlword,'<a href="'.$urllink.'">'.$urlword.'</a>',$newbody);
					 //$newbody = preg_replace('~'.$urlword.'(?!.*'.$urlword.')~', '<a href="'.$urllink.'"\>'.$urlword.'</a>', $newbody);
					if (strlen($urloutbound) == 0)
					{
					//  error_log("//****************** Replace last occurance with 111 [".$urlword."][".$urloutbound."][".sizeof($arr_keyword)."]");
					  foreach($arr_keyword as $value)
					 {
					   $ipos = strpos(strtolower ($newbody)," ".strtolower ($value)." ");
					 //  error_log("//****************** Search for urloutbound [$value][$ipos][$urlword]");
                       if ($ipos !== false && strpos(strtolower($urlword),strtolower($value)) === false)
                       {
						   $urloutbound = $value;
						   break;
					   }			
					   
                     }						 
					}
					if (strlen($urloutbound) > 0)
						$newbody = str_lastreplace($urloutbound,'<a href="https://en.wikipedia.org/w/index.php?search='.$urloutbound.'&title=Special%3ASearch&go=Go" target="_blank">'.$urloutbound.'</a>',$newbody);
						//$newbody = preg_replace('~'.$urlinternalword.'(?!.*'.$urlinternalword.')~', '<a href="'.$urlinternal.'"\>'.$urlword.'</a>', $newbody);
					
					/*foreach ($arr_keyword as $value)
					{
						$newbody = preg_replace("/".$value."/", "<a href=\"".$urllink."\>$value</a>", $newbody);
					
					}*/
				}
				
				$newrowbody = $rawarticle;
				
				if (strlen( trim($urllink)) > 0)
				{
					$patterns = array();
					$urlword = "";
					$urlinternalword = "";
					$urloutbound = "";
					//error_log(print_R($arr_keyword));
					foreach($arr_keyword as $value)
					{   // we will look for a long tail key words in a text and 
					    // put our links . array is already sorted from long tail to single words
						$ipos = strpos(strtolower ($newrowbody),strtolower ($value));
						if ($ipos !== false)
						{ // we found now we must find long tail keywords
					       
					        if (strlen($urlword) == 0)
							{  
						
						         $fpos = strpos("|".strtolower ($keywords)."|","|".strtolower ($value));
								 $epos = strpos("|".strtolower ($keywords)."|","|",$fpos + 1);
								$urlword = substr($keywords,$fpos,($epos - ($fpos)) - 1);
								$newrowbody = str_replace(" ".$value." "," ".$urlword." ",$newrowbody);
								$newrowbody = str_replace(",".$value." ",",".$urlword." ",$newrowbody);
								$newrowbody = str_replace(" ".$value.","," ".$urlword.",",$newrowbody);
								$newrowbody = str_replace(".".$value." ",".".$urlword." ",$newrowbody);
								$newrowbody = str_replace(" ".$value."."," ".$urlword.".",$newrowbody);
								$newrowbody = str_replace(" ".ucfirst(trim($value))." "," ".ucfirst(trim($urlword))." ",$newrowbody);
								$newrowbody = str_replace(" ".strtoupper(trim($value))." "," ".(trim($urlword))." ",$newrowbody);
							}	
							 else if (strlen($urloutbound) == 0 && strpos($value," ") === false && strpos($urlword,$value) === false)
								$urloutbound = $value;
								
						} // end if
						
						if (strlen($urlword) > 0 && strlen($urloutbound) > 0)
							break;
                        //$patterns[] = '/\b('.$value.')\b/i';						
					}// end foreach	
                   if (strlen($urlword) > 0)
						$newrowbody = str_lreplace($urlword,'<a href="'.$urllink.'">'.$urlword.'</a>',$newrowbody);
					 //$newbody = preg_replace('~'.$urlword.'(?!.*'.$urlword.')~', '<a href="'.$urllink.'"\>'.$urlword.'</a>', $newbody);
					if (strlen($urloutbound) > 0)
						$newrowbody = str_lastreplace($urloutbound,'<a href="https://en.wikipedia.org/w/index.php?search='.$urloutbound.'&title=Special%3ASearch&go=Go" target="_blank">'.$urloutbound.'</a>',$newrowbody);
					
				}
				$source = $subject;
				
				//include 'unik.php';
				include 'unike.php';
				$newsubject = $article;
				// store for later reuse
				$_SESSION['dict'] =  $tmp_dic_arr; 
	            //error_log('REWRITE UNIQUES .....['.sizeof($tmp_dic_arr).']');
			    //var_dump($_SESSION['dict']); 
			}
			else
			{
				$newbody = $body;
				$newsubject = $subject;
			}
			
		    // write unique article
			echo "<h3>" .$newsubject ."</h3>";
			echo $newbody;
		?>
    </div>
	<?php
      if ($_GET['rewrite'] == 'unique') 
	  {		  
	?>
    <div id="menu3<?php echo $count;?>" class="tab-pane fade">
	 
	  <form method="post" name="postForm<?php echo $count;?>">
		<input type="hidden" name="textareaId" value="area<?php echo $count;?>" id="textareaId">
		<input type="hidden" name="article" value="<?php echo htmlspecialchars($body);?>" id="article">
		<input type="hidden" name="keywords" value="<?php echo $keywords;?>" id="keywords">
		<input type="hidden" name="urllink" value="<?php echo $urllink;?>" id="urllink">
		<!-- input type="hidden" name="urlinternal" value="<?php //echo $urlinternal;?>" id="urlinternal" --->
		<input type="submit" class="floated" value="Create Unique" />
	  </form>
	  
	  <form method="post" name="postForm<?php echo $count;?>">
		<input type="hidden" name="textareaId" value="area<?php echo $count;?>" id="textareaId">
		<input type="hidden" name="article" value="" id="article">
		<input type="hidden" name="articleOpenFile" value="1">
		<input type="hidden" name="keywords" value="<?php echo $keywords;?>" id="keywords">
		<input type="hidden" name="urllink" value="<?php echo $urllink;?>" id="urllink">
		<!-- input type="hidden" name="urlinternal" value="<?php //echo $urlinternal;?>" id="urlinternal" -->
		<input type="submit" class="floated" value="Rewrite Current" />
	  </form>
	  
	   <form method="post" name="postForm<?php echo $count;?>">
		<input type="hidden" name="copyArticle" value="1">
		<input type="hidden" name="textareaId" value="area<?php echo $count;?>" id="textareaId"> 
		<input type="hidden" name="tagkeywords" value="<?php echo $tagkeywords;?>" id="tagkeywords">
		<input type="hidden" name="title" value="<?php echo $newsubject;?>" id="title">
		<!-- input type="hidden" name="urlinternal" value="<?php //echo $urlinternal;?>" id="urlinternal" -->
		<input type="submit" class="floated" value="Copy as web page" />
	  </form>
	 
	 
 <?php
       	
			echo "<textarea name=\"area\" id=\"area".$count."\" style=\"width: 300px; height: 200px;\" >";
			echo "<h3>" .$newsubject ."</h3>";
			echo $newbody; 
			echo "</textarea>";
			echo "<br/>";
			
			?>
		    
			<?php
			//echo "</div>";
		//}
?>
   
    </div>
	  <style>
	  .floated {
		float:left;
		margin-right:5px;
		}
	  </style>
	  <div id="menu4<?php echo $count;?>" class="tab-pane fade">
	   <form method="post" name="postForm<?php echo $count;?>">
		<input type="hidden" name="rawtextareaId" value="rowarea<?php echo $count;?>">
		<input type="hidden" name="article" value="<?php echo htmlspecialchars($body);?>">
		<input type="hidden" name="keywords" value="<?php echo $keywords;?>" id="keywords">
		<input type="hidden" name="urllink" value="<?php echo $urllink;?>" id="urllink">
		<!-- input type="hidden" name="urlinternal" value="<?php //echo $urlinternal;?>" id="urlinternal" -->
		<input type="submit" class="floated" value="Rewrite Article" />
	  </form>
	   <form method="post" name="postForm<?php echo $count;?>">
		<input type="hidden" name="rawtextareaId" value="rowarea<?php echo $count;?>">
		<input type="hidden" name="readFrom" value="area<?php echo $count;?>">
		<input type="hidden" name="article" value="">
		<input type="hidden" name="keywords" value="<?php echo $keywords;?>" id="keywords">
		<input type="hidden" name="urllink" value="<?php echo $urllink;?>" id="urllink">
		<!-- input type="hidden" name="urlinternal" value="<?php //echo $urlinternal;?>" id="urlinternal" -->
		<input type="submit" class="floated" value="Spin Prev Tab Article" />
	  </form>
	  <form method="post" name="postForm<?php echo $count;?>">
		<input type="hidden" name="copyArticle" value="1">
		<input type="hidden" name="textareaId" value="rowarea<?php echo $count;?>">
		<input type="hidden" name="tagkeywords" value="<?php echo $tagkeywords;?>" id="tagkeywords">
		<input type="hidden" name="title" value="<?php echo $newsubject;?>" id="title">
		<!-- input type="hidden" name="urlinternal" value="<?php //echo $urlinternal;?>" id="urlinternal" -->
		<input type="submit" class="floated" value="Copy as web page" />
	  </form>
	<?php
	        echo "<textarea name=\"rowarea\" id=\"rowarea".$count."\" style=\"width: 300px; height: 200px;\" >";
			echo "<h3>" .$newsubject ."</h3>";
			echo $newrowbody; 
		    echo "</textarea>";
			echo "<br/>";
	?>
	  </div>
	<?php 
	  }
	 ?>
  </div>
  <br/>
  <hr>
  <br/>
 <?php
		    $newbody = preg_replace ('/<[^>]*>/', ' ', $newbody);

			// save the txt to file
			$filecontent = $newsubject ."\n" ."\n" .$newbody ."\n" ."\n" ."\n";
			$fh = fopen($myFile, 'a');
			fwrite($fh, "\xEF\xBB\xBF".$filecontent);
		} // end if ($count < $maxitems)
	    $item++;
		$count++;
       //fclose($fh);
	}// end foreach
	if ($_GET['rewrite'] == 'unique') 
	{
		fclose($fdat);
	}
	echo "<br /><div align='center'><a href='$myFile' target='_blank'><div align='center' class='btn btn-primary'>Click here to download  article in TXT file </div></a> " ." <a href='$baseurl'><div align='center' class='btn btn-secondary'>Click here to generate new articles</div></a></div><br />";
}else //if (!$_POST['reload'])
{
	$page_title = "Invalid Access Key!";
	echo("<title>$page_title</title>");
	$res = validatetoken($getkey);
	//if ($res == -1)
		echo "<center><h1>Invalid Access Key!</h1></center><br/>";
     if ($res == 0)
	{
		 
		//$val = explode("|", $accesskey[$getkey]);// $val[0] = email, $val[1] expired date.
		$exp = date('Y-m-d',getExpired($getkey));
		echo "<center><h1>Token expired at $exp</h1></center><br/>";
		echo "<center><h3>Please order new Access key .</h3></center><br/>";
	}
}
 ?>
 <br /><?php include ("footer.php"); ?>



</div>
  
  
  <div id="spinner" class="spinner" style="display:none;">
    <img id="img-spinner" src="images/ajax-loading.gif" alt="Loading"/>
</div>
 
<!------------------ All Scripts goes here ---->
   <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/ajax-loading.js"></script>
  
<script>
var baseUrl = 'http://'+window.location.host+window.location.pathname.replace(/(\/index\.php|\/)$/, '');
var loading = $.loading();
var w;
/*$(document).ajaxStart(function(){
	//alert("Ajax start ...");
   $('#spinner').show();
 }).ajaxStop(function(){
	// alert("Ajax stop ...");
    $('#spinner').hide();
 });*/
 
$(document).ready(function(){
	
	
	// Submit ajax form to php
	 $('form').submit(function(event) { //Trigger on form submit
	  
		//var values = $(this).serialize();
		var values = $(this).serializeArray();
		//copyArticle
		if ($(this).find('input[name="copyArticle"]').val())
		{
			var name = $(this).find('input[name="textareaId"]').val();
            var keywords = $(this).find('input[name="tagkeywords"]').val();	
			var title = $(this).find('input[name="title"]').val();				
			var html_txt = "<title>" + title + "</title>";
			html_txt += " <meta name=\"description\" content=\"" + title + "\">";
			html_txt += "<meta name=\"keywords\" content=\"" + keywords + "\">";
			
			 var w = window.open();
			 $(w.document.head).html(html_txt);
			   $(w.document.body).html(nicEditors.findEditor(name).getContent(  ));
		   return ;
		}			
		if ($(this).find('input[name="textareaId"]').val())
	    {
			var name = $(this).find('input[name="textareaId"]').val();  
			var txt = $(this).find('input[name="article"]').val(); 
			
			//alert("Form here ...[" + name + "]");		
			// Find and replace `content` if there
			//textareaId
			
			if ($.trim(txt) == "")
			{
				//alert(" Values are Emprty ...");
				for (index = 0; index < values.length; ++index) 
				{
				if (values[index].name == "article" ) {
					
					values[index].value = nicEditors.findEditor(name).getContent(  );
					//alert(" Populed values ...[" + values[index].value + "]");
					break;
				}
			   }// end for
			}
		} // end if
		if ($(this).find('input[name="rawtextareaId"]').val())
	    {
			var name = $(this).find('input[name="rawtextareaId"]').val();  
			var txt = $(this).find('input[name="article"]').val(); 
			var readFrom = $(this).find('input[name="readFrom"]').val(); 
			//alert("Form here ...[" + readFrom + "]");		
			// Find and replace `content` if there
			//textareaId
			
			if ($.trim(txt) == "")
			{
				//alert(" Values are Emprty ...");
				for (index = 0; index < values.length; ++index) 
				{
				if (values[index].name == "article" ) {
					values[index].value = nicEditors.findEditor(readFrom).getContent(  );
					//alert(" Populed values ...[" + values[index].value + "]");
					break;
				}
			   }// end for
			}
		} // end if
		
		//alert("Form here ...");
	
		values = jQuery.param(values);
		  $.ajax({ //Process the form using $.ajax()
			type      : 'POST', //Method type
			url       : 'ajax_unique.php', //Your form processing file URL
			data      : values, //Forms name
			dataType  : 'json',
			success   : function(data) {
							if (!data.success) { //If fails
								if (data.errors.name) { //Returned if any error from process.php
									//$('.throw_error').fadeIn(1000).html(data.errors.name); //Throw relevant error
									//window.alert("ajax error " + data.errors.name);
									window.alert("Errot processing request.Please try later");
								}
							}
							else {
								   // window.alert("Cache dict is [" + data.id + "]");
										nicEditors.findEditor( data.success ).setContent( $("<div/>").html(data.posted).text() );
									
								}
						       
							},
		      error: function(xhr, status, error) {
				  window.alert("Errot processing request.Please try later " + xhr.responseText);
                 //alert("Errors -- "  + xhr.responseText);
				 //alert("Errors -- " + status);
				// alert("Errors -- "  + error);
				// nicEditors.findEditor( "area0" ).setContent( $("<div/>").html(xhr.responseText).text() );
               }
		});
	    
		event.preventDefault(); //Prevent the default submit
	 });
	//------------------------------------------
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
    $('.nav-tabs a').on('shown.bs.tab', function(event){
        var x = $(event.target).text();         // active tab
        var y = $(event.relatedTarget).text();  // previous tab
        $(".act span").text(x);
        $(".prev span").text(y);
    });
	
   
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

// ****************** Check for selection based on timer *****************/
function getSelText()
{
    var txt = '';
    //alert("Mouse up ...");
     if (window.getSelection)
    {
        txt = window.getSelection();
             }
    else if (document.getSelection) // FireFox
    {
        txt = document.getSelection();
            }
    else if (document.selection)  // IE 6/7
    {
        txt = document.selection.createRange().text;
            }
    else return;
    if (txt != '')
    { // time to call ajax function to get all
      // synonyms
     	//var sel = getSelText();
		//.replace(/\W/g, '')
		//if( /[^a-zA-Z0-9]/.test(sel) ) {
       //     alert('Input is not alphanumeric');
       // }
		//alert("Selected [" + sel  +  "]");
		 var data = {
       "action": "test",
	   "word":"\"" + txt + "\""
      };	
	 
	   //alert("[" + data['word'] + "]");
		$.ajax({
			type: 'POST',
			dataType: 'text',
			url: 'dict.php', 
			data: data,
			success: function(data) {
				//alert(data);
				data = data.replace(/(?:\r\n|\r|\n)/g, '<br />');
				//var html_txt = 
				if (!w || w.closed)
				 w = window.open('', '_blank', 'toolbar=0,location=0,menubar=0');//w = window.open();
			 //$(w.document.head).html(html_txt);
			   $(w.document.body).html(data);
			   w.focus();
            },
			error: function(xhr, status, error) {
				//var err = eval("(" + xhr.responseText + ")");
				alert(xhr.responseText);
			}
		});	
		if (window.getSelection) {
		  if (window.getSelection().empty) {  // Chrome
			window.getSelection().empty();
		  } else if (window.getSelection().removeAllRanges) {  // Firefox
			window.getSelection().removeAllRanges();
		  }
		} else if (document.selection) {  // IE?
		  document.selection.empty();
		}		
	  //alert(txt);	
	}
	return txt;	
}
setInterval(getSelText, 2000);


</script>
<script type="text/javascript" src="js/nicEdit-latest.js"></script>
 <script type="text/javascript">
	//<![CDATA[
	  bkLib.onDomLoaded(function() {
		   nicEditors.allTextAreas(); // convert all text areas to rich text editor on that page
			//new nicEditor({maxHeight : 200}).panelInstance('area');// convert text area with id area1 to rich text editor.
			//new nicEditor({fullPanel : true,maxHeight : 200}).panelInstance('area1'); // convert text area with id area2 to rich text editor with full panel.
	       $('.nicEdit-panelContain').parent().width('95%');
           $('.nicEdit-panelContain').parent().next().width('100%');
		   $('.nicEdit-main').width('90%');
	  });
	  
	  //]]>
</script>
<!------------------------- End Scripts ---------------->
<?php
$time_diff = number_format (((microtime(true) - $overalltime)/1000),5);
//error_log("OVERALL TIME END .................................... $time_diff in sec ");
 
?>
</body>
</html>
