<?php 
session_start();
function str_lreplace($search, $replace, $subject)
{
    //return preg_replace('~(.*)' . preg_quote($search, '~') . '~', '$1' . $replace, $subject, 1);
	//return preg_replace('/'.$search.'$/', $replace, $subject);
	 $pos = strrpos($subject, $search);

    if($pos !== false)
    {
        $subject = substr_replace($subject, $replace, $pos, strlen($search));
    }

    return $subject;
}

function sortByLength($a,$b){
 // if($a == $b) return 0;
 // $ret = (strlen($a) > strlen($b) ? -1 : 1);
  //echo "//*************** Call sortByLength [$a][$b]   ******************//";
  return  strlen($b)-strlen($a);
}

$errors = array(); //To store errors
$form_data = array(); //Pass back the data to `form.php`
// we have a post request
if ($_POST['article'] &&  $_POST['textareaId'])
{   
    
   $keywords = $_POST['keywords'];
	$urllink = $_POST['urllink'];
	$arr_keyword = explode("|",$keywords);
	usort($arr_keyword,'sortByLength');
	$keywords = implode("|", $arr_keyword);
	
     $tmp_arr = array();
	 $hassession = "NO DICT";
	 if (isset($_SESSION['dict']))
	 {
		 $hassession = "HAS DICT";
		 $tmp_arr = $_SESSION['dict'];
	 }	 
	 $body  = htmlspecialchars_decode($_POST['article']);
	 $source = $body;
	 // remove all links
	 $source = preg_replace("/<a[^>]+>/i", "", $source);
	$tmp_dic_arr = $tmp_arr;
	if (isset($_POST['articleOpenFile']))
	{
		$myIndxFile = "th_en_US_new.idx";
		$lines = file($myIndxFile);//file in to an array
		$fdat = fopen('th_en_US_new.dat', 'r');
	}
	include 'unike.php';
				
	$newbody = $article;
	
	if (strlen( trim($urllink)) > 0)
	{
		$urlword = "";
		$urloutbound = "";
		//error_log(print_R($arr_keyword));
		foreach($arr_keyword as $value)
		{   // we will look for a long tail key words in a text and 
			// put our links . array is already sorted from long tail to single words
			$ipos = strpos($newbody,$value);
			if ($ipos !== false)
			{ // we found now we must find long tail keywords
				if (strlen($urlword) == 0)
				{  
			
					 $fpos = strpos("|".$keywords."|","|".$value);
					 $epos = strpos("|".$keywords."|","|",$fpos + 1);
					$urlword = substr($keywords,$fpos,($epos - ($fpos)) - 1);
					$newbody = str_replace(" ".$value." "," ".$urlword." ",$newbody);
					$newbody = str_replace(",".$value." ",",".$urlword." ",$newbody);
					$newbody = str_replace(" ".$value.","," ".$urlword.",",$newbody);
					$newbody = str_replace(".".$value." ",".".$urlword." ",$newbody);
					$newbody = str_replace(" ".$value."."," ".$urlword.".",$newbody);
					$newbody = str_replace(" ".ucfirst(trim($value))." "," ".ucfirst(trim($urlword))." ",$newbody);
					$newbody = str_replace(" ".strtoupper(trim($value))." "," ".(trim($urlword))." ",$newbody);
						
				}	
				else if (strlen($urloutbound) == 0 && strpos($value," ") === false && strpos($urlword,$value) === false)
					$urloutbound = $value;
					
			} // end if
			if (strlen($urlword) > 0 && strlen($urloutbound) > 0)
				break;
			//$patterns[] = '/\b('.$value.')\b/i';						
		}// end foreach	
		// last check if this word is single or multiple
		// replace with the link last one
		//error_log("//****************** Replace last occurance with [".$urlword."]");
		if (strlen($urlword) > 0)
			$newbody = str_lreplace($urlword,'<a href="'.$urllink.'"\>'.$urlword.'</a>',$newbody);
		 //$newbody = preg_replace('~'.$urlword.'(?!.*'.$urlword.')~', '<a href="'.$urllink.'"\>'.$urlword.'</a>', $newbody);
		if (strlen($urloutbound) > 0)
			$newbody = str_lreplace($urloutbound,'<a href="https://en.wikipedia.org/w/index.php?search='.$urloutbound.'&title=Special%3ASearch&go=Go" target="_blank"\>'.$urloutbound.'</a>',$newbody);
			//$newbody = preg_replace('~'.$urlinternalword.'(?!.*'.$urlinternalword.')~', '<a href="'.$urlinternal.'"\>'.$urlword.'</a>', $newbody);
	}
				
	if (isset($_POST['articleOpenFile']))
	{
		fclose($fdat);
	}
	//$id = $_POST['textareaId'];
	/* if (strlen( trim($urllink)) > 0)
	{
		$patterns = array();
		foreach($arr_keyword as $value)
			$patterns[] = '/\b('.$value.')\b/i';

		$newbody = preg_replace($patterns, '<a href="'.$urllink.'"\>$1</a>', $newbody);
		/*foreach ($arr_keyword as $value)
		{
			$newbody = preg_replace("/".$value."/", "<a href=\"".$urllink."\>$value</a>", $newbody);
		
		}* /
	}*/
	//echo "Dictionary is [".sizeof($tmp_dic_arr)."]<br/>";
	//error_log("Dict Size is [".sizeof($tmp_dic_arr)."]");
	$form_data['posted'] = htmlspecialchars($newbody) ;
	//$from_data['id'] = $_POST['textareaId'];
	$form_data['success'] = $_POST['textareaId'];//"Dictionary is [".sizeof($tmp_dic_arr)."]";
	//Return the data back to form.php
    echo json_encode($form_data);
//	exit; // exit from here
}else if ($_POST['article'] &&  $_POST['rawtextareaId'])
{
	 $keywords = $_POST['keywords'];
	$urllink = $_POST['urllink'];
	$arr_keyword = explode("|",$keywords);
	usort($arr_keyword,'sortByLength');
	$keywords = implode("|", $arr_keyword);
	
	$tmp_arr = array();
	 $hassession = "NO DICT";
	 if (isset($_SESSION['dict']))
	 {
		 $hassession = "HAS DICT";
		 $tmp_arr = $_SESSION['dict'];
	 }	 
	 $body  = htmlspecialchars_decode($_POST['article']);
	 $source = $body;
	 //error_log("// *********************************************************************/");
	// error_log($source);
	 //error_log("//***********************************************************************/");
	$tmp_dic_arr = $tmp_arr;
	if (isset($_POST['readFrom']))
	{
		$myIndxFile = "th_en_US_new.idx";
		$lines = file($myIndxFile);//file in to an array
		$fdat = fopen('th_en_US_new.dat', 'r');
	}			
	//if (sizeof($tmp_dic_arr) > 0)
	//{
	//	error_log("Dict has words ...............................................[".(sizeof($tmp_dic_arr))."]");
	//	error_log(print_R($tmp_dic_arr,TRUE) );
	//}
	include 'unike.php';
	if (isset($_POST['readFrom']))
	{
		fclose($fdat);
    }		
	$newbody = $rawarticle;
	
	if (strlen( trim($urllink)) > 0)
	{
		$urlword = "";
		$urloutbound = "";
		//error_log(print_R($arr_keyword));
		foreach($arr_keyword as $value)
		{   // we will look for a long tail key words in a text and 
			// put our links . array is already sorted from long tail to single words
			$ipos = strpos($newbody,$value);
			if ($ipos !== false)
			{ // we found now we must find long tail keywords
				if (strlen($urlword) == 0)
				{  
			
					 $fpos = strpos("|".$keywords."|","|".$value);
					 $epos = strpos("|".$keywords."|","|",$fpos + 1);
					$urlword = substr($keywords,$fpos,($epos - ($fpos)) - 1);
					$newbody = str_replace(" ".$value." "," ".$urlword." ",$newbody);
					$newbody = str_replace(",".$value." ",",".$urlword." ",$newbody);
					$newbody = str_replace(" ".$value.","," ".$urlword.",",$newbody);
					$newbody = str_replace(".".$value." ",".".$urlword." ",$newbody);
					$newbody = str_replace(" ".$value."."," ".$urlword.".",$newbody);
					$newbody = str_replace(" ".ucfirst(trim($value))." "," ".ucfirst(trim($urlword))." ",$newbody);
					$newbody = str_replace(" ".strtoupper(trim($value))." "," ".(trim($urlword))." ",$newbody);
				}	
				else if (strlen($urloutbound) == 0 && strpos($value," ") === false && strpos($urlword,$value) === false)
					$urloutbound = $value;
					
			} // end if
			if (strlen($urlword) > 0 && strlen($urloutbound) > 0)
				break;
			//$patterns[] = '/\b('.$value.')\b/i';						
		}// end foreach	
		// last check if this word is single or multiple
		// replace with the link last one
		//error_log("//****************** Replace last occurance with [".$urlword."]");
		if (strlen($urlword) > 0)
			$newbody = str_lreplace($urlword,'<a href="'.$urllink.'"\>'.$urlword.'</a>',$newbody);
		 //$newbody = preg_replace('~'.$urlword.'(?!.*'.$urlword.')~', '<a href="'.$urllink.'"\>'.$urlword.'</a>', $newbody);
		if (strlen($urloutbound) > 0)
			$newbody = str_lreplace($urloutbound,'<a href="https://en.wikipedia.org/w/index.php?search='.$urloutbound.'&title=Special%3ASearch&go=Go" target="_blank"\>'.$urloutbound.'</a>',$newbody);
			//$newbody = preg_replace('~'.$urlinternalword.'(?!.*'.$urlinternalword.')~', '<a href="'.$urlinternal.'"\>'.$urlword.'</a>', $newbody);
	}
	/*if (strlen( trim($urllink)) > 0)
	{
		$patterns = array();
		foreach($arr_keyword as $value)
			$patterns[] = '/\b('.$value.')\b/i';

		$newbody = preg_replace($patterns, '<a href="'.$urllink.'"\>$1</a>', $newbody);
		/*foreach ($arr_keyword as $value)
		{
			$newbody = preg_replace("/".$value."/", "<a href=\"".$urllink."\>$value</a>", $newbody);
		
		}* /
	}*/
	//$id = $_POST['textareaId'];
	
	//echo "Dictionary is [".sizeof($tmp_dic_arr)."]<br/>";
	$form_data['posted'] = htmlspecialchars($newbody) ;
	//$from_data['id'] = $_POST['textareaId'];
	$form_data['success'] = $_POST['rawtextareaId'];//"Dictionary is [".sizeof($tmp_dic_arr)."]";
	//Return the data back to form.php
    echo json_encode($form_data);
}else
{
	$form_data['posted'] = "Parameters are empty";
	$form_data['success'] = true;
	echo json_encode($form_data);
}
?>