<?php
$dir = dirname(dirname(__FILE__));
require_once($dir.'/config/config.php');
$base_url = $options->host.((strlen(trim($options->base_html_dir))>0)?'/'.$options->base_html_dir:'');//'/'.$options->base_html_dir;
$home = $base_url; 
$news =  $base_url.'/html/news.php';
$contactus = $base_url.'/html/contactUs.php';
$about = $base_url.'/html/about.php';
?>
<!-- BEGIN EZMOB TAG -->
<SCRIPT TYPE="text/javascript">
var __jscp=function(){for(var b=0,a=window;a!=a.parent;)++b,a=a.parent;if(a=window.parent==window?document.URL:document.referrer){var c=a.indexOf("://");0<=c&&(a=a.substring(c+3));c=a.indexOf("/");0<=c&&(a=a.substring(0,c))}var b={pu:a,"if":b,rn:new Number(Math.floor(99999999*Math.random())+1)},a=[],d;for(d in b)a.push(d+"="+encodeURIComponent(b[d]));return encodeURIComponent(a.join("&"))};
document.write('<S' + 'CRIPT TYPE="text/javascript" SRC="//cpm.ezmob.com/tag?zone_id=105642&size=320x50&subid=&j=' + __jscp() + '"></S' + 'CRIPT>');
</SCRIPT>
<!-- END EZMOB TAG -->
                                
<center>
<a href="<?=$home?>">Free Unique Article Apinner</a> Powered by <code>Article Rewriter TOOL</code> <!--Powered by. <a href="http://fullcontentrss.com" target="_blank">Full RSS</a --> | <a href="<?= $contactus?>" target="_top">Contact Us</a>
<br/>
<span style="display:inline-block;width:160px;height:30px;text-align:center;border:#000 1px dotted;font-family:Arial,Helvetica,sans-serif;font-size:11px;background-color:#FFFFFF;"><strong style="display:block;padding:0px;margin:0px;">Submit Express</strong><a href="<?=$home?>" title="Local SEO" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;">Local SEO</a> & <a href="<?=$home?>" title="Spinbot" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;">Spin Bot</a></span>
<footer>&copy; Copyright 2020 <a href="<?=$home?>">Journal Article</a></footer>

</center>
<script type="text/javascript"
>var subscribersSiteId='ef732d89-ad79-4e86-ad07-1a4117ffe869';
var version = "1.5.1";
importScripts("https://cdn.subscribers.com/assets/subscribers-sw.js");
</script>
<script type="text/javascript" src="https://cdn.subscribers.com/assets/subscribers.js"></script>
