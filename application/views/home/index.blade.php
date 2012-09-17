<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Jamjar (Laravel)</title>
	<meta name="viewport" content="width=device-width">
	
	{{ Asset::styles() }}
    {{ Asset::scripts() }}
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

    @include('partial/handlebars/index')

</body>
</html>
