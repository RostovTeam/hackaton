// Filename: router.js
define([
  'jquery',
  'underscore',
  'backbone',
  'views/home/HomeView',
  'views/login/LoginView'
], function($, _, Backbone, HomeView, LoginView) {
  
  var AppRouter = Backbone.Router.extend({
    routes: {
      'login': 'loginAction',
      // Default
      '*actions': 'defaultAction'
    }
  });
  
  var initialize = function(){

    var app_router = new AppRouter;
    
    app_router.on('route:loginAction', function (actions) {
     
        var loginView = new LoginView();
        loginView.render();
    });
    
    app_router.on('route:defaultAction', function (actions) {
     
        var homeView = new HomeView();
        homeView.render();
    });

    // Unlike the above, we don't call render on this view as it will handle
    // the render call internally after it loads data. Further more we load it
    // outside of an on-route function to have it loaded no matter which page is
    // loaded initially.

    Backbone.history.start();
  };
  return { 
    initialize: initialize
  };
});
