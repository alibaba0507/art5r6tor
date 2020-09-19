
<!--
<div id="navbar">
  <a class="active" href="javascript:void(0)">Home</a>
  <a href="javascript:void(0)">News</a>
  <a href="javascript:void(0)">Contact</a>
</div -->

<?php 

//echo $options->base_dir . "<br>";
// echo $fn;
$dir = dirname(dirname(__FILE__));
require_once($dir.'/config/config.php');
$base_url = $options->host.((strlen(trim($options->base_html_dir))>0)?'/'.$options->base_html_dir:'');//'/'.$options->base_html_dir;
$home = $base_url; 
$news =  $base_url.'/html/news.php';
$emailClener =  $base_url.'/html/emailCleanUp.php';
$contactus = $base_url.'/html/contactUs.php';
$about = $base_url.'/html/about.php';
$post = $base_url.'/html/post.php';//$base_url.'/post/google-index-strategy.php';
//$post1 = //$base_url.'/post/How-to-beat-competition-with-article-spinning-using-this-advanced-spinner.php';
//$post2 = //$base_url.'/post/do-it-yourself.php';
//$post3 = //$base_url.'/post/seo-article-rewrite.php';
//echo $home;
//echo $about;
?>

    <ul id="top_hav" class="nav navbar-nav">
      <li>
     
      <a  href="<?= $home ?>">Home</a>
      
      </li>
      <li><a href="<?=$news ?>">How it wors</a></li>
	  <li><a href="<?=$emailClener ?>">Clean Email List</a></li>
      <li><a href="<?=$contactus ?>">Contact</a></li>
	  <li><a href="<?=$post ?>">Posts</a></li>
      <li style="float:right"><a href="<?= $about ?>">About</a></li>
    </ul>


<!-- script>
$( '.navbar-nav a' ).on( 'click', function () {
	$( '.navbar-nav' ).find( 'li.active' ).removeClass( 'active' );
	$( this ).parent( 'li' ).addClass( 'active' );
});
</script -->
<div class="container" style="width: 600px; border: 2px; border-radius: 0px; background-color: #FFFFFF; padding: 30px; margin-top: 30px; margin-bottom: 50px;">

	<center>
	  <div align="center" style="margin-bottom:10px;"><a href="<?=$home?>" title="FREE Unique Article Spinner Online"><img src="<?=$base_url?>/images/ArticleCreatorLogo.png"></a></div>
	  <div style="font-size:14px; color:grey;"><h3>Fully automated article rewriter tool</h3></div><br />
	  <div style="font-size:14px; color:grey;">Automatic generate high quality seo friendly articles from your keyword</div><br /><br />
	</center>