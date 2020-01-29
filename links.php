<?php
require_once(dirname(__FILE__).'/utils/utils.php'); // for debug call  debug($msg,$obj)
$newbody = $article;

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

    $newrowbody = $newbody;
	if (strlen( trim($urllink)) > 0)
    {
        $patterns = array();
        $urlword = "";
        $urlinternalword = "";
        $urloutbound = "";
        //error_log(print_R($arr_keyword));
        foreach($tagkeywords as $value)
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
    $newbody = $newrowbody;
   // debug(">>>>>>>>>>>>>>>>>>>>>>> AFTER LINK >>>>>>>>>>>>>>>>>>>\n",$newbody);            
?>