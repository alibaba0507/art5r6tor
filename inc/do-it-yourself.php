<?php

// Article Creator Script
// This script can grab articles from any keyword and rewrite them to unique articles
// Author: FullContentRSS.com
// Script URL: http://articlecreator.fullcontentrss.com

require_once(dirname(dirname(__FILE__)).'/config/config.php');
?><!DOCTYPE html>
<html>
  <head>
   
   <?php
   $meta_descr =  "Ranking high in Google’s search results can have a phenomenal impact on the success of your business. 
You can either engage the expertise of a Search Engine Optimisation company, or if you have the time, there are some changes you can make to your website yourself.";
   $meta_keywords = "ppc";
   include('../inc/head.php');?>
  </head>
  <body>
  <?php include('../inc/body_top.php');?>
  <?php
   require_once '../adm/vendor/autoload.php';
	use hisorange\BrowserDetect\Parser as Browser;
	$browser = new Browser;
	if (!$browser->isBot()) {
		include('../inc/form.php');
	}else
	{
  ?>
  <font face="arial" color="000000" size=4>
   Ranking high in Google’s search results can have a unparalleled impact on the success of your business. 
You can either engage the expertise of a Search Engine Optimisation company, or if you have the time, there are some changes you can make to your website yourself.
</size>
<br><br>

<b>Step 1: Keyword Research</b>
<font face="arial" color="000000" size=4>
<p>What keywords do you think your customers would type in to explore for your products or services? A keyword can be one word (e.g. “optimisation”), but multiple keywords or keyword phrases are usually preferred, because they are more specific and more likely to be what your customers are looking for (eg. “<a href= /spinbot/ > Search Engine Optimisation Australia</a>”). 
</size>
<br><br>
Create down as many as you can imagine of. Breakthrough with your team. Think of other words. Bear in mind geographical phrases if they are of the essence to your client(e.g. “house cleaning Hornsby”). Also, get some ideas from your competitors ’ websites. Try to make a list of 20-30 keyword phrases.


<br><br>
Choose the two keyword phrases you think would be searched for the most. But also recall, the more competition there is for a keyword, the harder it is to gettop rankings.  If you want to rank high in Google for the keyword “insurance”, you have a very lengthy journey into the future. So try your best to choose two keyword phrases that are the most related to you business but that are not abstractednor competitive. It’s a good idea to have 2 or 3 words in each phrase (e.g. “wedding catering services”)

<br><br>

Once you’ve select your two best keyword phrases the next step shows you how to achieve some improvements to your home page. 


<br><br>
<b>Step 2: Web Copy </b>
<p>Web copy refers to all the words or content on your website. Because content is king in the world of search engines, your keyword phrases need to be sited strategically on your webpage to convince  Google that your content is highly relevant  to those keywords.  The more prominent they are, the better. (Keep in mind that as important as search engines are, customers come first, so make sure your copy also reads well.)
	

Here’s how you can boost each keyword’s distinction:
<ul>
<li>	Position your keywords in headings, preferably  at the beginning  of the heading;</li>

<li>	Incorporate keywords towards the top of the page;</li>

<li>	Bold or italicise keywords where proper;</li>

<li>	Instead of having a link to a different page that says "Click here to read more ", rework it to include your keywords, e.g. "Read more about our <a href= /spinbot/ >seo copywriting Services</a>".
</li>
</ul>
<br><br>
An important tip is to also incorporate these keywords in your HTML “title tag”. Use your content management system to make these changes yourself, or possibly ask your web developer to do it if you’re unsure how.

<br><br>
Once you have fine-tuned your home page, consider adding new content, such as comprehensive descriptions of what you offer, FAQs and informative articles about your products and services. (If you don’t want to write these yourself, they can be located for free on the internet - do a search for “articles directory”).

<br><br>
It’s also lovely to bear in mind that search engines can only read text, not pictures. Often web developers embed words in images to look improved for website visitors or use Flash for animation, but this is a major obstacle to search engines. 

<br><br>
<b>Step 3: Linking</b>
<p>Each link from a different website to your website (not from your website) is measured by search engines as a vote of popularity for your industry and will perk up your rankings.

<br><br>
But it is the quality, not quantity, of the links that is crucial. The other websites should be applicable to your industry, and preferably  highly regarded themselves. Ten quality links count far more than 500 links from arbitrary websites. In the same way your own  business network can have a majorimpact on the achievement of your business, so too the online network you build on the internet.

 <br><br>
Suggest all the relevant websites that could link to you, such as non-competing companies, and industry bodies and organisations. Write a open email to each describing the profit their visitors would get in knowing about your business, and call for them to create a link to your website. Most people will not answer back first time round, so a follow-up phone call is usually required. 

<br><br>
<b>How do I monitor  my results?</b>
<p>Supervise your rankings in Google over the next few months by typing your chosen  keywords into the search box, and recording your ranking. Also look at your hosting information to be aware of what search terms your visitors are using to find your website. 

<br><br>
The above progression can be also be repeated for each page of your website. Remember  to keep updating your content, and continually i ncrease the number of links to your website.
<br><br>

As you see your rankings climb you should see a corresponding increase in web traffic and a large increase in sales enquiries. Be sure to keep a note the source of your customer enquiries, so you can determine the success  of your marketing efforts. 
<br><br>

Remember, if you measure it, you can improve it.
<br><br>
</font>
<?}?>
 	<!-- ?php include ("./html_tmp/tabs.php"); ? -->
	<br /><?php include ("../inc/footer.php"); ?>

	</div>
	
  </body>
</html>
	
?>