<?php
function closeHTMLtags($html) {
    preg_match_all('#<([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
    $openedtags = $result[1];
    preg_match_all('#</([a-z]+)>#iU', $html, $result);

    $closedtags = $result[1];
    $len_opened = count($openedtags);

    if (count($closedtags) == $len_opened) {
        return $html;
    }
    $openedtags = array_reverse($openedtags);
    for ($i=0; $i < $len_opened; $i++) {
        if (!in_array($openedtags[$i], $closedtags)) {
            $html .= '</'.$openedtags[$i].'>';
        } else {
            unset($closedtags[array_search($openedtags[$i], $closedtags)]);
        }
    }
    return $html;
}

/**
 * Print all debug information to 
 * file 
 *@parms $msg - string message to be attached
 *@params $obj - object to be printed could be anyting (class,json,array ...)
 */
function debug($msg,$obj = null,$delete = false)
{
    if ($delete === true)
    {
       // echo " >>>> DELETE - TRUE </br>";        
        //$out = "";
       // if ($obj){$out = var_export($obj,true);}
       // file_put_contents('tempfiles/log_app.log', '>>>>>> DELETE TRUE >>>>\n'.$msg.$out." \n", FILE_APPEND);
        unlink( 'tempfiles/log_app.log' );
        return;
    }
    $out = "";
    if ($obj){$out = var_export($obj,true);}
    //file_put_contents('./log_'.date("j.n.Y").'.log', $msg.$out." \n", FILE_APPEND);
    file_put_contents('tempfiles/log_app.log', $msg.$out." \n", FILE_APPEND);
}		

function createFeed($rss)
{
     $indx = stripos($rss,"<rss version=\"2.0\" xmlns:dc=\"http://purl.org/dc/elements/1.1/\" xmlns:media=\"http://search.yahoo.com/mrss/\">");
    $rss  = substr($rss,$indx);
   // debug(">>>>>>>>>>>> PROCESS FILES CURL >>>>>>>>>>>>>>>>>",$returned);
    $feed = simplexml_load_string($rss);
   //  debug(">>>>>>>>>>>> PROCESS FILES CURL >>>>>>>>>>>>>>>>>",($feed));
    return $feed;
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
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://".$_SERVER['SERVER_NAME'].
    dirname($_SERVER['PHP_SELF']); 
   $filename = $actual_link.$filename;
   debug(">>>>>>>>>> INCLUDE >>>[".strval ($filename) ."]>>>>>>>>>>>>>\n");
   $rss = '';
   //$fn = "'".strval ($urlsource)."'";
   //debug(">>>>>>>>>> INCLUDE >>>[".$fn ."]>>>>>>>>>>>>>\n");
   //include ($fn);//'only_spin.php';//$urlsource;
   // if (is_file($filename)) {
       // ob_start();
        include $filename;
       // $b = ob_get_clean();
        //debug(">>>>>>>>>> INCLUDE (III)>>>[".$filename ."]>>>>>>>>>>>>>\n",$b);
    //}
   $returned = $rss;
   //$returned = json_decode($returned,true);
   debug(">>>>>>>>>>>> BEFORE PROCESS FILES CURL >>>>>>>>>>>>>>>>>",($returned));
   
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