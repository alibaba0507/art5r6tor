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
?>