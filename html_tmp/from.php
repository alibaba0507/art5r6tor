 <form method="get" action="go.php" id="form" class="form-horizontal">
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
	