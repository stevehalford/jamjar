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