<?php
$base_url = '';
?>
<!DOCTYPE html>
<html lang="en">
<!-- This is a demonstration of HTML5 goodness with healthy does of CSS3 mixed in -->
<head>
    <title>TOTEM CMS</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />		
    <!--[if IE]>
    	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--[if IE 7]>
    	<link rel="stylesheet" href="ie7.css" type="text/css" media="screen" />
    <![endif]-->
    <link rel="stylesheet" href="/static/css/style.css" type="text/css" media="screen" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.min.js" type="text/javascript"></script>
    <script type='text/javascript' src='static/js/knockout2.js'></script>
</head>
<body>
    <header> <!-- HTML5 header tag -->
    	<div id="headercontainer">
    	<span data-bind="text: title">
    	</div>
    </header>
    <section id="contentcontainer"> <!-- HTML5 section tag for the content 'section' -->
    	<section id="intro">
    
    	</section>
    	<footer> <!-- HTML5 footer tag -->
    	
		</footer>	
    </section>
    
    <script type="text/javascript">
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
	</script>
	<script type="text/javascript">
		try {
		var pageTracker = _gat._getTracker("UA-9207090-1");
		pageTracker._trackPageview();
		} catch(err) {}
	</script>
	
	<script ype='text/javascript'>	
		$.ajax({
  			url: "http://localhost:8888/totemws/totemws.phpfogapp.com/index.php/cms/cms/search/?id=1",
  				success: function(data){
 					setView(data);
				}
		});
		
		function setView(obj)
		{
			var parsed = JSON.parse(obj);
						console.log(parsed);

			var viewModel = {
			title: parsed.title 
    	}
		ko.applyBindings(viewModel);
		}

	</script>
    
</body>

</html>