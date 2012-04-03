var App = {
	 Models : {},
	 Collections : {},
	 Views : {}
};

App.Router = Backbone.Router.extend({
	routes:{
		"":"allClients",
		"clients":"allClients",
		"client/:id":"viewClient",
		"projects":"allProjects",
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
	}

});


App.Models.Client = Backbone.Model.extend({
	urlRoot: '/api/clients'
});

App.Collections.Clients = Backbone.Collection.extend({
	model: App.Models.Client,
	initialize: function() {
		this.deferred = this.fetch();
	},
	url: function() {
		return '/api/clients';
	}
});

App.Models.Project = Backbone.Model.extend();

App.Collections.Projects = Backbone.Collection.extend({
	model: App.Models.Project,
	url: function() {
		if (this.hasOwnProperty('clientRef')) {
			return '/api/clients/'+this.clientRef+'/projects/';
		} else {
			return '/api/projects/';
		}
	}
});

App.Models.Task = Backbone.Model.extend();

App.Collections.Tasks = Backbone.Collection.extend({
	model: App.Models.Task,
	url: function() {
		if (this.hasOwnProperty('clientRef')) {
			return '/api/projects/'+this.ProjectRef+'/tasks/';
		} else {
			return '/api/tasks/';
		}
	}
});


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
		return this;
	}
});



$(function() {
	App.router = new App.Router();
	//Backbone.history.start({pushState: true, root: "/domains/"});
	Backbone.history.start();
});