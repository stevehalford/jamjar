
<html>
<head>
	<title>JamJar</title>
	<link rel="stylesheet/less" type="text/css" href="css/bootstrap/bootstrap.less">
	<script type="text/javascript" charset="utf-8">less = {}; less.env = 'development';</script>
	<script src="js/less-1.2.2.min.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
</head>
<body>
	<div class="container">
		<ul class="appnav">
			<li class="clients active"><a href="#clients" title="Clients">Clients</a></li>
			<li class="projects"><a href="#projects" title="Projects">Projects</a></li>
			<li class="tasks"><a href="#tasks" title="Tasks">Tasks</a></li>
		</ul>
		<ul class="breadcrumb">
			<li><a href="#">Home</a> <span class="divider">/</span></li>
		</ul>
			

		<div class="page clients hide">
			<h2>Clients</h2>
			<ul class="client-list">
				
			</ul>
		</div>	

		<div class="page clientView hide">
			
		</div>	

		<div class="page projects hide"></div>
	</div>

	<script src="http://documentcloud.github.com/underscore/underscore-min.js"></script>
	<script src="http://documentcloud.github.com/backbone/backbone-min.js"></script>   
	<script src="js/handlebars-1.0.0.beta.6.js" type="text/javascript"></script>

	<script src="js/app.js"></script>

	<script id="clientListItem" type="text/x-handlebars-template">
		<div class="well">
			<h3>{{name}} <small>Client ID #{{id}}</small></h3>
		</div>
	</script>

	<script id="clientView" type="text/x-handlebars-template">
		<div class="row">
			<div class="span8">
				<h1>{{name}} <small>Client ID #{{id}}</small></h1>
			</div>
			<div class="span4">
				<div class="well">
					<h3>Current Projects</h3>
					<ul class="projects-list nav nav-list">
						
					</ul>
				</div>			
			</div>
		</div>
  		
	</script>
	<script id="projectListItem" type="text/x-handlebars-template">
		<a href="#project/{{id}}" title="{{name}}">{{name}}</a>
	</script>
</body>
</html>