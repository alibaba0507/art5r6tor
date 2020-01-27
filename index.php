<?php

// Article Creator Script
// This script can grab articles from any keyword and rewrite them to unique articles
// Author: FullContentRSS.com
// Script URL: http://articlecreator.fullcontentrss.com

require_once(dirname(__FILE__).'/config.php');
?><!DOCTYPE html>
<html>
  <head>
    <title>FREE Unique Article Creator Online</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
	<meta name="robots" content="INDEX" />
	<meta name="description" content="SEO Optimized Article Creator. This is a article rewriting tool, that search the web search engines based on input keywords and generate unique articles.">
<meta name="keywords" content="SEO,seo optimized article,article rewriter,article spinner,free article spinner">
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="screen" />
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-tooltip.js"></script>
	<script type="text/javascript" src="js/bootstrap-popover.js"></script>
	<!-- script type="text/javascript" src="js/bootstrap-tab.js"></script -->
	<script type="text/javascript">
	var baseUrl = 'http://'+window.location.host+window.location.pathname.replace(/(\/index\.php|\/)$/, '');
	$(document).ready(function() {
		
		
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
		//$('a[rel=tooltip]').tooltip();
		$('[data-toggle="tooltip"]').tooltip();
	});
	
	
	
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-52932706-2', 'auto');
  ga('send', 'pageview');

</script>
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
	line-height: 20px !important;
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
	
	[data-tip] {
    position:relative;

}
[data-tip]:before {
    content:'';
    /* hides the tooltip when not hovered */
    display:none;
    content:'';
    display:none;
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-bottom: 5px solid #1a1a1a;
    position:absolute;
    top:30px;
    left:35px;
    z-index:8;
    font-size:0;
    line-height:0;
    width:0;
    height:0;
    position:absolute;
    top:30px;
    left:35px;
    z-index:8;
    font-size:0;
    line-height:0;
    width:0;
    height:0;
}
[data-tip]:after {
    display:none;
    content:attr(data-tip);
    position:absolute;
    top:35px;
    left:0px;
    padding:5px 8px;
    background:#1a1a1a;
    color:#fff;
    z-index:9;
    font-size: 0.75em;
    height:18px;
    line-height:18px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    white-space:nowrap;
    word-wrap:normal;
}
[data-tip]:hover:before,
[data-tip]:hover:after {
    display:block;
}
    </style>
  </head>
  <body>
	<div class="container" style="width: 600px; border: 2px; border-radius: 0px; background-color: #FFFFFF; padding: 30px; margin-top: 30px; margin-bottom: 50px;">

	<center>
	  <div align="center" style="margin-bottom:10px;"><a href="index.php" title="FREE Unique Article Creator Online"><img src="images/ArticleCreatorLogo.png"></a></div>
	  <div style="font-size:14px; color:grey;">Automatic generate high quality seo friendly articles from your keyword</div><br /><br />
	</center>

	<form method="get" action="gotabs.php" id="form" class="form-horizontal">
	<fieldset>
			<div class="control-group">
			<label class="control-label" for="keyword">Enter your keyword</label>
	  <div class="controls" data-tip='Use plus sign "+" if your keyword more than one word. 
	                Example: forex, diabetes, online+trading, real+estate.'>
	  <input type="text"  id="url" name="keyword" style="width: 250px;" title="KEYWORD" data-content='Enter your keyword here. Use plus sign "+" if your keyword more than one word. Example: forex, diabetes, online+trading, real+estate.' required />
	  <div style=font-size:80%;>
		<font color="grey">(TIP)Search specific site for keywords Example:web+profit+site:about.com</font></div>
	  </div>
		</div>
	</fieldset>
		<fieldset>
		<div class="control-group">
	<label class="control-label" for="feedsource">Source</label>
	<div class="controls">
	<select name="feedsource" id="feedsource" class="input-medium" title="Content Source" data-content="By default, links within the content are preserved. Change this field if you'd like links removed.">
		<option value="bing">Bing News Search</option>
		<option value="google">Google News Search</option>
		<option value="yahoo">Yahoo News Search</option>
		
		<option value="yahooanswers">Yahoo Answers Search</option>
		
	</select>
	</div>
	</div>
	</fieldset>

		<fieldset>
		<div class="control-group">
	<label class="control-label" for="rewrite">Rewrite articles</label>
	<div class="controls">
	<select name="rewrite" id="rewrite" class="input-medium" title="Rewrite articles" data-content="By default, links within the content are preserved. Change this field if you'd like links removed.">
		<option value="original">keep original</option>
		<option value="unique">make unique</option>
	</select>
	</div>
	</div>
	
		<div class="control-group">
	<label class="control-label" for="numbers">Number of Articles</label>
	<div class="controls">
	<select name="numbers" id="numbers" class="input-medium" title="Number of Articles" data-content="By default, links within the content are preserved. Change this field if you'd like links removed.">
		<option value="3" selected="selected">3</option>
		<option value="4">4</option>
		<option value="4">5</option>
		<option value="4">6</option>
		<option value="4">7</option>
		<option value="4">8</option>
		<option value="4">9</option>
		<option value="4">10</option>
	</select>
	</div>
	</div>
	
	<div id="showaccesskey" style="display:none">
			<div class="control-group">
			<label class="control-label" for="accesskey">Enter Access Key</label>
	  <div class="controls"><input type="text" id="accesskey" name="accesskey" style="width: 150px;" title="ACCESS KEY" data-content='Enter your Access Key here.' />
		<br /><div style=font-size:80%;><font color="grey">Access key is required when you select "Make unique".</font></div>
		</div></div>
		<!--  Phrases separate by |  -->
		<div class="control-group">
			<label class="control-label" for="keywords">Enter KeyWords seprated by "|"</label>
	  <div class="controls"><input type="text" id="keywords" name="keywords" style="width: 150px;" 
					title="Enter KeyWords" data-content='Enter KeyWords and long tail keywords separated by "|".Program will try to replace most relevant words and phrases with this keywords ' />
		<br />
		<div style=font-size:80%;>
		<font color="grey">(Optional)When Article Creator if find this keywords and phrase will not <br/>
		                  replace them. Or will try to find best suitable keyword to replace original word with</font></div>
		</div></div>
		<!-- Link to be with this keywords -->
        <div class="control-group">
			<label class="control-label" for="urllink">Enter Anchor URL link</label>
	  <div class="controls"><input type="text" id="urllink" name="urllink" style="width: 150px;" 
					title="Enter Anchor URL link" data-content='Enter Anchor URL link.' />
		<br />
		<div style=font-size:80%;>
		<font color="grey">(Optional) This url link will be associated with one of the above keywords
		<br/> According to best SEO practice one anchor links is good enough.If this is your<br/>
    		blog good idea will be to place internal link to one of your precious post.<br/>
			Also will place one outbound link to authority site like wikipedia with keywords research</font></div>
		</div>
		</div>
		
		<!--
		<hr>
		<div class="control-group">
			<label class="control-label" for="urlinternal">Enter Anchor URL internal link</label>
	  <div class="controls"><input type="text" id="urlinternal" name="urlinternal" style="width: 150px;" 
					title="Enter Anchor URL internal link" data-content='Enter Anchor URL internal link.' />
		<br />
		<div style=font-size:80%;>
		<font color="grey">(Optional) For better SEO need a link pointing to internal page of your site.</font></div>
		</div>
		</div>
		-->
		</div>
		
	<script type="text/javascript">
		document.getElementById('rewrite').addEventListener('change', function () {
	var style = this.value == 'unique' ? 'block' : 'none';
    document.getElementById('showaccesskey').style.display = style;
	});
			document.getElementById('numbers').addEventListener('change', function () {
	var style = this.value !== '3' ? 'block' : 'none';
    document.getElementById('showaccesskey').style.display = style;
	});
	</script>
		
        </fieldset>

	<div class="form-actions">
		<input type="submit" id="submit" name="submit" value="Submit" class="btn btn-primary" />
	</div>
	</form>
	<hr>
	 <ul class="nav nav-tabs">
    
    <li class="active"><a href="#about">About</a></li>
    <li><a href="#getaccesskey">Buy Access Key</a></li>
	<li><a href="#freeaccesskey">Free Access Key</a></li>
	<li><a href="#blogtopics">Related topics</a></li>
  </ul>
    <div class="tab-content">
	 <div id="about" class="tab-pane active">
	   <h3>SEO optimized Article Creator</h3> Optimized ArticleCreator is <b>the best article creation tool to generate 
	   SEO optimized unique content</b> from selected keyword. Tool will fetch articles from various content sources: 
	   Bing, Yahoo or Google News. 
	   Our tool will automatically grab fresh new article, blog or news which then will be rewritten to make them unique and better for SEO.
	   <b>It's completely free to use, just enter your keyword, select the article source &amp; click submit button</b>. 
	   <font color="teal">You will be redirected to a new page to view the article in HTML mode. 
	   In the new page user will have a option to make aricle unique to edit the article or to re-spin the content. 
	   On the last tab </font><b>SPINTAX format</b> - {phrase1|phrase2|phrase3|} - will also available when you activate rewrite feature.
	   Because some of the words has a lot of synonyms and will be use unfriendly to list them we offer the rewrite option the will spin phrases 
till you find the right one 
  <p>
   Because of our phrase algorithm article creator will <font color="red">search and replace any word with phrase keyword</font>
   if is specified in keyword input box, and will  <font color="red">create url link to it </font> if url link is specified in the 
   input box.
  </p>
  <p>
  <img src="images/art_raw_edit.png" alt="Rewrite phrases for  Article Generator " title="Rewrite phrases for  Article Generator">
  </p>
   <p></p>
	<p>Future development for Article Creator will be to supports multiple languages: <b>English, Brazil,Germany, Spanish, French,Dutch (Netherlands), Chinese, Japanese, Turkish,Russia, Sweden, Polish (Poland), Korean &amp; Sweden. 
	</b>Note that article rewriter (article spinner) available for English only. </p>
	<p><img src="images/Multi-Language-Article-Generator.png" alt="Multi language Article Generator " title="Multi language Article Generator"></p>
	<p>Please don't spam &amp; abuse this tool. 
	 It will make this tool still available for free. 
	 You can also support our tool by linking back to us.</p>
	 <p> 
	 <img src="https://lh3.googleusercontent.com/-NhRXxENUhaA/Uy1UXIKYGVI/AAAAAAAAAaQ/Uw-M4yRSiMw/w140-h140-p/unnamed.png" alt="Ali Baba SEO Optimization expert" title="Ali Baba SEO Optimization expert">
	 <br/>
	 Ali Baba is passionate about SEO optimization and article optimization. <br/>
	 His vision and "Less is More". He try to help others by changing himself.<br/>
	 <p> Following the best practices of SEO optimization to achieve maximum result for shorter time.
	 <p> His unorthodox approach to marketing problems helps others to achieve there goals with higher satisfaction.
	 
	 </div>
	  <div id="getaccesskey" class="tab-pane fade">
	  <div style="float: left; width: 55%; padding:10px;">
 	Access Key is required when you activate "Rewrite articles" option or set the number of articles to more than three articles.
	Activating <b>article rewriter</b> or <b>article spinner</b> feature will make your article unique and better for 
	search engine indexing and SERP. Buy the access key  <font color="red">$4</font> per month for monthly subscription. 
	<b>we will send the access key to your PayPal email in few minutes.</b>
	  </div>
	   <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
	   <!-- form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top" -->
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="hosted_button_id" value="HK8UL4VMY86YS">
		<table>
		<tr><td><input type="hidden" name="on0" value=""></td></tr><tr><td><select name="os0">
			<option value="$4/month">$4/month : $4.00 USD - monthly</option>
		</select> </td></tr>
		</table>
		<input type="hidden" name="currency_code" value="USD">
		<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
		</form>

	 </div>
	 
	  <div id="freeaccesskey" class="tab-pane fade">
	  <div style="float: left; width: 55%; padding:10px;">
 	Access Key is required when you activate "Rewrite articles" option or set the number of articles to more than three articles.
	Activating <b>article rewriter</b> or <b>article spinner</b> feature will make your article unique and better for 
	search engine indexing and SERP. Get your <font color="red">free</font> access key  <font color="red">today</font> . 
	<font color="red">Free access key</font> will be valid for next 3 days , from the time of your request.<br/>
	<b>After request the access key  will be send to your email in few minutes.</b>
	  </div>
	   <form action="freetoken.php" method="post" target="_top">
	   <!-- form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top" -->
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="hosted_button_id" value="HK8UL4VMY86YS">
		<table>
		  <tr>
		   <td>Email:</td>
		   <td> <input type="text" name="email" value=""></td>
		   </tr><td>
		   <td><input type="submit"  value="Get Access Key" /></td>
		   <td></td>
		  </tr>
		</table>
		</form>

	 </div>
	  <div id="blogtopics" class="tab-pane fade">
	   <div style="float: left; width: 55%; padding:10px;">
	    <h3> Related internet topics about article creator</h3>
		<div>
		<h2>seo web page optimization</h2>
		 <p>if you require to see real results from your base , you need to assay it. You need to assay for <a href="/seo-web-page-optimization" target="_blank">optimum SEO</a>. You need to optimize your limit and assay for errors.</p>
	    </div>
		<div>
		<h2><a href="/How-Does-Your-Website-SEO-reference-Up" target="_blank">How Does Your Website SEO reference Up</a></h2>
		 <p>
		 Here's umpteen immoral news around small-scale businesses: merely fractional of small-scale 
		  commercialism that get websites use activity self-propelled vehicle optimization (SEO), 
		  a study by Clutch reports. Why does that unconditioned reflex me? 
		  Well, if you aren�t bothering with website SEO, you're fundamentally effort the results of your 
		  website your virtually essential mercantilism tool up to chance. 
		  And why go to the difficulty of scope up a website if you�re not exploit to become the virtually of it?
		 </p>
	    </div>
	   </div>
	  </div>
	</div>
	<br /><?php include ("footer.php"); ?>

	</div>
  </body>
</html>