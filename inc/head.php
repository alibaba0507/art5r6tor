    <?php
     //$server = $_SERVER['DOCUMENT_ROOT'];
     $dir = dirname(dirname(__FILE__));
    require_once($dir.'/config/config.php');
    $base_url = $options->host.((strlen(trim($options->base_html_dir))>0)?'/'.$options->base_html_dir:'');
     $home_inc = $options->base_include_dir ;
     ?>
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" type="image/gif" href="animated_favicon1.gif">
    <title>FREE Unique Article Creator Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
	<meta name="robots" content="INDEX" />
	<meta name="description" content="SEO Optimized Article Creator. This is a article rewriting tool, that search the web search engines based on input keywords and generate unique articles.">
    <meta name="keywords" content="journal article,spinbot,SEO,seo optimize,article rewriter,article spinner,free article spinner">
	 <!--
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     -->
    <link rel="stylesheet" href="<?=$base_url?>/css/bootstrap.min.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?=$base_url?>/css/main.css" type="text/css" media="screen" />
	<script src="<?=$base_url?>/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=$base_url?>/js/bootstrap-tooltip.js"></script>
	<script type="text/javascript" src="<?=$base_url?>/js/bootstrap-popover.js"></script>
    <!--
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    -->
    <!--
    <script type="text/javascript" src="js/jquery.min.js"></script>
    -->
    <?php include($home_inc.'/inc/nav_bar_js.php');?>
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script type="text/javascript" src="<?=$base_url?>/js/spin.js"></script>
	<script type="text/javascript" src="<?=$base_url?>/js/bootstrap-tab.js"></script>
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

<script src="https://www.google.com/recaptcha/api.js?render=6Lc50tcUAAAAACvpYNpL5bbUve6DjaX8S2LCMG1E"></script>
<script>
grecaptcha.ready(function() {
    grecaptcha.execute('6Lc50tcUAAAAACvpYNpL5bbUve6DjaX8S2LCMG1E', {action: 'homepage'}).then(function(token) {
       ...
    });
});
</script>
