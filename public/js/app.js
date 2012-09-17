var App = {
	 Models : {},
	 Collections : {},
	 Views : {}
};

/**
*	Models * Collections
*/

App.Models.Client = Backbone.Model.extend({
	urlRoot: '/clients'
});

App.Collections.Clients = Backbone.Collection.extend({
	model: App.Models.Client,
	initialize: function() {
		this.deferred = this.fetch();
	},
	url: function() {
		return '/clients';
	}
});


App.Models.Project = Backbone.Model.extend({
	urlRoot: '/projects'
});

App.Collections.Projects = Backbone.Collection.extend({
	model: App.Models.Project,
	url: function() {
		if (this.hasOwnProperty('clientRef')) {
			return '/clients/'+this.clientRef+'/projects';
		} else {
			return '/projects';
		}
	}
});


App.Models.Task = Backbone.Model.extend({
	urlRoot: '/tasks'
});

App.Collections.Tasks = Backbone.Collection.extend({
	model: App.Models.Task,
	url: function() {
		if (this.hasOwnProperty('clientRef')) {
			return '/projects/'+this.ProjectRef+'/tasks';
		} else {
			return '/tasks';
		}
	}
});


/**
*	Views
*/

App.Views.ClientsList = Backbone.View.extend({
	el: '.client-list',
	_viewIds: {},

	initialize: function() {
		_.bindAll(this, "render");

		this.collection.on('reset',this.render, this);
		this.collection.on('add',this.addOne, this);
		this.collection.on('remove',this.removeOne, this);
	},

	render: function() {
		var self = this;

		this.collection.each(function(model) {
			self.addOne(model);
		});
	},
	
	addOne: function(model) {
		var view = new App.Views.ClientListItem({model: model});
		$(this.el).append(view.render().el);

		this._viewIds[model.cid] = view;

		return this;
	},

	removeOne: function(model) {
		this._viewIds[model.cid].remove();
	}
});

App.Views.ClientListItem = Backbone.View.extend({
	tagName: "li",
	className: 'client',
	events: {
		"click":"clickClient"
	},

	render: function(){
		var template = Handlebars.compile($('#clientListItem').html());
		$(this.el).html(template(this.model.toJSON()));
		return this;
	},

	clickClient: function(e) {
		e.preventDefault();
		App.router.navigate('#client/'+this.model.id, {trigger: true});
	}
});


App.Views.Client = Backbone.View.extend({
	el: '.clientView',
	initialize: function() {
		_.bindAll(this, "render");

		this.model.on('change', this.render, this);
	},

	render: function() {
		var template = Handlebars.compile($('#clientView').html());
		$(this.el).html(template(this.model.toJSON()));

		//get clients projects
		clientProjects = new App.Collections.Projects;
		clientProjects.clientRef = this.model.id;

		App.clientProjectsList = new App.Views.ProjectsList({'collection':clientProjects});

		clientProjects.fetch();

		return this;
	}
});

App.Views.ProjectsList = Backbone.View.extend({
	el: '.projects-list',
	_viewIds: {},

	initialize: function() {
		_.bindAll(this, "render");

		this.collection.on('reset',this.render, this);
		this.collection.on('add',this.addOne, this);
		this.collection.on('remove',this.removeOne, this);
	},

	render: function() {
		var self = this;

		this.collection.each(function(model) {
			self.addOne(model);
		});
	},
	
	addOne: function(model) {
		var view = new App.Views.ProjectListItem({model: model});
		$(this.el).append(view.render().el);

		this._viewIds[model.cid] = view;

		return this;
	},

	removeOne: function(model) {
		this._viewIds[model.cid].remove();
	}
});

App.Views.ProjectListItem = Backbone.View.extend({
	tagName: "li",
	className: 'project',
	events: {
		"click":"clickProject"
	},

	render: function(){
		var template = Handlebars.compile($('#projectListItem').html());
		$(this.el).html(template(this.model.toJSON()));
		return this;
	},

	clickProject: function(e) {
		e.preventDefault();
		App.router.navigate('#project/'+this.model.id, {trigger: true});
	}
});


/**
*	Router
*/

App.Router = Backbone.Router.extend({
	routes:{
		"":"allClients",
		"clients":"allClients",
		"client/:id":"viewClient",
		"projects":"allProjects",
		"project/:id":"viewProject",
		"tasks":"allTasks"
	},

	initialize: function() {

	},

	allClients: function () {
		$('.page').hide();
		$('.page.clients').fadeIn();
		$('.appnav li.clients').addClass('active').siblings('li').removeClass('active');
	
		if(!App.clients) App.clients = new App.Collections.Clients;
		if(!App.clientsListView) App.clientsListView = new App.Views.ClientsList({collection: App.clients});
	},

	allProjects: function () {
		$('.page').hide();
		$('.page.projects').fadeIn();
		$('.appnav li.projects').addClass('active').siblings('li').removeClass('active');

		if(!App.projects) App.projects = new App.Collections.Projects;
		if(!App.projectsListView) App.projectsListView = new App.Views.ProjectsList({collection: App.projects});
	},

	allTasks: function () {
		$('.page').hide();
		$('.page.tasks').fadeIn();
		$('.appnav li.tasks').addClass('active').siblings('li').removeClass('active');

		if(!App.tasks) App.tasks = new App.Collections.Tasks;
		if(!App.tasksListView) App.tasksListView = new App.Views.TasksList({collection: App.tasks});
	},

	viewClient: function (id) {
		$('.page').hide();
		$('.page.clientView').fadeIn();
		$('.appnav li.clients').addClass('active').siblings('li').removeClass('active');

		App.client = new App.Models.Client;
		App.client.id = id;
		App.client.fetch({success: function() {
			if(App.clientView) {
				App.clientView.model = App.client;
				App.clientView.render();
			} else {
				App.clientView = new App.Views.Client({model: App.client});
				App.clientView.render();
			}
		}});
	},

	viewProject: function (id) {
		$('.page').hide();
		$('.page.projectView').fadeIn();
		$('.appnav li.projects').addClass('active').siblings('li').removeClass('active');

		App.project = new App.Models.Project;
		App.project.id = id;
		App.project.fetch({success: function() {
			if(App.projectView) {
				App.projectView.model = App.project;
				App.projectView.render();
			} else {
				App.projectView = new App.Views.Project({model: App.project});
				App.projectView.render();
			}
		}});
	}

});

$(function() {
	App.router = new App.Router();
	//Backbone.history.start({pushState: true, root: "/domains/"});
	Backbone.history.start();
});