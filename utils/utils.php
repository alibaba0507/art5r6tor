<?php

/**
 * Print all debug information to 
 * file 
 *@parms $msg - string message to be attached
 *@params $obj - object to be printed could be anyting (class,json,array ...)
 */
function debug($msg,$obj = null)
{
    $out = "";
    if ($obj){$out = var_export($obj,true);}
    file_put_contents('./log_'.date("j.n.Y").'.log', $msg.$out." \n", FILE_APPEND);
}		

function processFeed($filename,$type = null,$fields = null)
{
    //debug(">>>>>>>>>>>> PROCESS FILES CURL ".$type .">>>>> " .$urlsource ."   >>>>>>>>>",$fields);
   /* $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $urlsource);
    if ($type !== null && $fields !== null)
    {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$fields);
    }
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    $returned = curl_exec($ch);
    curl_close($ch);
    */
    $filename = $_SERVER['DOCUMENT_ROOT'].$filename;
   debug(">>>>>>>>>> INCLUDE >>>[".strval ($filename) ."]>>>>>>>>>>>>>\n");
   $rss = '';
   //$fn = "'".strval ($urlsource)."'";
   //debug(">>>>>>>>>> INCLUDE >>>[".$fn ."]>>>>>>>>>>>>>\n");
   //include ($fn);//'only_spin.php';//$urlsource;
    if (is_file($filename)) {
        ob_start();
        include $filename;
        $b = ob_get_clean();
        debug(">>>>>>>>>> INCLUDE (III)>>>[".$filename ."]>>>>>>>>>>>>>\n",$b);
    }
   $returned = $rss;
   //$returned = json_decode($returned,true);
  // debug(">>>>>>>>>>>> BEFORE PROCESS FILES CURL >>>>>>>>>>>>>>>>>",($returned));
   
   //return ($returned->rss);
    // Clean the document for parsing
    $indx = stripos($returned,"<rss version=\"2.0\" xmlns:dc=\"http://purl.org/dc/elements/1.1/\" xmlns:media=\"http://search.yahoo.com/mrss/\">");
    $returned  = substr($returned,$indx);
   // debug(">>>>>>>>>>>> PROCESS FILES CURL >>>>>>>>>>>>>>>>>",$returned);
    $feed = simplexml_load_string($returned);
   //  debug(">>>>>>>>>>>> PROCESS FILES CURL >>>>>>>>>>>>>>>>>",($feed));
    return $feed;
    
}
?>