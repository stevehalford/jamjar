var App = {
	 Models : {},
	 Collections : {},
	 Views : {}
};

App.Router = Backbone.Router.extend({
	routes:{
		"":"index",
		"client/:id":"viewClient"
	},

	initialize: function() {
		App.clients = new App.Collections.Clients;
		App.clientsListView = new App.Views.ClientsList({collection: App.clients});
	},

	index:function () {
		
	},

	viewClient:function (id) {

		App.clients.deferred.done(function() 
		{
			if(App.clientView) {
				App.clientView.model = App.clients.get(id);
				App.clientView.render();
			} else {
				App.clientView = new App.Views.Client({model: App.clients.get(id)});
				App.clientView.render();
			}
		});
	}
});


App.Models.Client = Backbone.Model.extend();

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
		$('li.client').removeClass('active');
		$(e.target).parent('li').addClass('active');
	}
});


App.Views.Client = Backbone.View.extend({
	el: '.content',
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