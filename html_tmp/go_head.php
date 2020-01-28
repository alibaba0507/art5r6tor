<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
	<meta name="robots" content="noindex, nofollow" />
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />
    <script type="text/javascript">
	
	var baseUrl = 'http://'+window.location.host+window.location.pathname.replace(/(\/index\.php|\/)$/, '');
	
	$(document).ready(function() {
		
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
		$('a[rel=tooltip]').tooltip();
	});
	</script>
	<script type="text/javascript" src="js/nicEdit-latest.js"></script>
     <script type="text/javascript">
		//<![CDATA[
		  bkLib.onDomLoaded(function() {
			   nicEditors.allTextAreas(); // convert all text areas to rich text editor on that page
				//new nicEditor({maxHeight : 200}).panelInstance('area');// convert text area with id area1 to rich text editor.
				//new nicEditor({fullPanel : true,maxHeight : 200}).panelInstance('area1'); // convert text area with id area2 to rich text editor with full panel.
		  });
		  
		  //]]>
	</script>