
<html>
<head>
	<title>JamJar</title>
	<link rel="stylesheet/less" type="text/css" href="css/bootstrap/bootstrap.less">
	<script type="text/javascript" charset="utf-8">less = {}; less.env = 'development';</script>
	<script src="js/less-1.2.2.min.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
</head>
<body>
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container">
	        	<a class="brand" href="#">JamJar</a>
	    	</div>
    	</div> 
	</div>
	<div class="container">
			
			<div class="row">
				<div class="sidebar span4">
					<div class="well">
						<ul class="client-list nav nav-list">
							<li class="nav-header">Clients</li>
						</ul>
					</div>
				</div>
				<div class="span8 content">
					
				</div>
			</div>
			
	</div>

	<script src="http://documentcloud.github.com/underscore/underscore-min.js"></script>
	<script src="http://documentcloud.github.com/backbone/backbone-min.js"></script>   
	<script src="js/handlebars-1.0.0.beta.6.js" type="text/javascript"></script>
	<script src="js/app.js"></script>  

	<script id="clientListItem" type="text/x-handlebars-template">
  		<a href="#client/{{id}}" title="{{name}}">{{name}}</a>
	</script>

	<script id="clientView" type="text/x-handlebars-template">
  		<h1>{{name}}</h1>
  		<h2>Projects</h2>
  		<ul class="projects-list">
  			
  		</ul>
	</script>
	<script id="clientProjectListItem" type="text/x-handlebars-template">
		<a href="#project/{{id}}" title="{{name}}">{{name}}</a>
	</script>
</body>
</html>