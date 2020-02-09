 <?php
$dir = dirname(dirname(__FILE__));
require_once($dir.'/config/config.php');
$home = $options->host.((strlen(trim($options->base_html_dir))>0)?'/'.$options->base_html_dir:'');//'/'.$options->base_html_dir;
$home_inc =$options->base_include_dir;
?>

 <form method="post" action="<?=$home?>/go.php" id="form" class="form-horizontal">
	<fieldset>
			<div class="control-group">
			<label class="control-label" for="keyword">Enter your keyword</label>
	  <div class="controls" data-tip='Enter search separate words with space. 
	                Example: forex, diabetes, online trading, real estate.'>
	  <input type="text"  id="keyword" name="keyword" style="width: 250px;" title="KEYWORD" data-content='Enter your keyword here. Use plus sign spave if your keyword more than one word. Example: forex, diabetes, online trading, real estate.' required />
	  <div style=font-size:80%;>
		<font color="grey">(TIP)Search specific site for keywords Example:web+profit+site:about.com</font></div>
	  </div>
		</div>
	</fieldset>
		<fieldset>
		<div class="control-group">
	<label class="control-label" for="feedsource">Source</label>
	<div class="controls" data-tip='Select One of 6 Source'>
	<select name="feedsource" id="feedsource" class="input-medium" title="Content Source" data-content="By default, links within the content are preserved. Change this field if you'd like links removed.">
		<option value="bing" title='Search Bing Engine for Selected KeyWord'>Bing News Search</option>
		<option value="google" title='Search Google Engine for Selected KeyWord'>Google News Search</option>
		<option value="yahoo" title='Search Yahoo Engine for Selected KeyWord'>Yahoo News Search</option>
		
		<option value="yahooanswers" title='Search yahooanswers Engine for Selected KeyWord'>Yahoo Answers Search</option>
        <option value="user_urls" title='Enter URL Into Text Area, one per line.(Tip)Use google to search and after that just copy Url from google search result and Paste into Text Area'>Custom URLs</option>
        <option value="only_spin" title="Copy and Paste Text or HTML Text into Text Area and Will Extract the Article Content.(Tip)Use Google Search and Open desired url on separate tab , right click for the browser menu and select 'View Page as Source', copy everything Ctr+A and Paste Into Text Area , will extract the Article Only">Only Spin</option>
		
	</select>
	</div>
	</div>
	</fieldset>
    <div id="showurls" style="display:none">
     <div class="control-group" >
         <label class="control-label" for="accesskey">Enter Custom URLs</label>
         <div class="controls" >
            <textarea name="custom_urls" id="custom_urls" style=" width: 388px; height:180px" ></textarea>
         
             <br />
            <div style=font-size:80%;>
            <font color="grey">Enter Articles urls <code>One per line</code> to be extracted , spin modified <br>
                        If this option slelected <code>Number of Articles</code> will be ignored
                        <br> Use this option if search engines blocking this ip.<br>
                        Search Google and right click on one of google search result url, select <code>'Copy Link Address'</code>, Paste the result here"</font></div>
          </div>
     </div>
    </div>
    <div id="only_spin" style="display:none">
     <div class="control-group">
         <label class="control-label" for="only_spin">Entert Text(or HTML) To Spin</label>
         <div class="controls" >
            <textarea name="only_spin_txt" id="only_spin_txt" style=" width: 388px; height:480px" ></textarea>
         
             <br />
            <div style=font-size:80%;>
            <font color="grey">Copy and Paste Text or HTML Text into Text Area and Will Extract the <code>Article Content</code>.(Tip)Use Google Search and Open desired url on separate tab , right click for the browser menu and select 'View Page as Source', copy everything Ctr+A and Paste Into Text Area , <code>will extract the Article Only</code></font></div>
          </div>
     </div>
    </div>
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
        <option value="1" selected="selected">1</option>
        <option value="2" >2</option>
		<option value="3">3</option>
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
            
			<!-- div class="control-group">
			<label class="control-label" for="accesskey">Enter Access Key</label>
	  <div class="controls"><input type="text" id="accesskey" name="accesskey" style="width: 150px;" title="ACCESS KEY" data-content='Enter your Access Key here.' />
		<br /><div style=font-size:80%;><font color="grey">Access key is required when you select "Make unique".</font></div>
		</div></div -->
		<!--  Phrases separate by |  -->
		<div class="control-group">
			<label class="control-label" for="keywords">Enter KeyWords seprated by "|"</label>
	  <div class="controls"><input type="text" id="keywords" name="keywords" style="width: 150px;" 
					title="Enter KeyWords" data-content='Enter KeyWords and long tail keywords separated by "|".Program will try to replace most relevant words and phrases with this keywords ' />
		<br />
		<div style=font-size:80%;>
		<font color="grey">(Optional)If Article Creator find this keywords (When spin the article) will not <br/>
		                  replace them , instead will encapsulate then in <code>&lt;strong&gt;&lt;/strong&gt; </code><br>
                          if not <code>Anchor URL link</code> has been selected. Or will try to find best suitable <br>keyword to replace original word with
                           <br/>
                            Also will place one <code>outbound link</code> to authority site like <code>wikipedia</code> with keywords research</font></div>
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
    		blog good idea will be to place internal link to one of your precious post.
            </font></div>
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
    document.getElementById('feedsource').addEventListener('change', function () {
        var style = this.value == 'user_urls' ? 'block' : 'none';
        //only_spin
        if (this.value == 'user_urls')
        {
            document.getElementById('showurls').style.display = 'block';
            document.getElementById('only_spin').style.display = 'none';
            document.getElementById("keyword").required = false;
        }else if (this.value == 'only_spin')
        {
             document.getElementById('showurls').style.display = 'none';
            document.getElementById('only_spin').style.display = 'block';
             document.getElementById("keyword").required = false;
        }else
        {
             document.getElementById('showurls').style.display = 'none';
            document.getElementById('only_spin').style.display = 'none';
             document.getElementById("keyword").required = true;
        }
	});
    
		document.getElementById('rewrite').addEventListener('change', function () {
	var style = this.value == 'unique' ? 'block' : 'none';
    document.getElementById('showaccesskey').style.display = style;
	});
    /*
    document.getElementById('numbers').addEventListener('change', function () {
	var style = this.value !== '3' ? 'block' : 'none';
    document.getElementById('showaccesskey').style.display = style;
	});
    */
	</script>
		
        </fieldset>

	<div class="form-actions">
        
		<input type="submit" id="submit" name="submit" value="Submit" class="btn btn-primary" />
	    
    </div>
	</form>
	