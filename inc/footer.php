<?php
$dir = dirname(dirname(__FILE__));
require_once($dir.'/config/config.php');
$base_url = $options->host.((strlen(trim($options->base_html_dir))>0)?'/'.$options->base_html_dir:'');//'/'.$options->base_html_dir;
$home = $base_url; 
$news =  $base_url.'/html/news.php';
$contactus = $base_url.'/html/contactUs.php';
$about = $base_url.'/html/about.php';
?>
<center>
<a href="<?=$home?>">Free Unique Article Creator</a> Powered by Full RSS <!--Powered by. <a href="http://fullcontentrss.com" target="_blank">Full RSS</a --> | <a href="<?= $contactus?>" target="_top">Contact Us</a>
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
