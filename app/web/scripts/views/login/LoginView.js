define([
  'jquery',
  'underscore',
  'backbone',
  'text!templates/login/loginTemplate.html'
], function($, _, Backbone, loginTemplate){

  var LoginView = Backbone.View.extend({
    el: $("#content"),
    
    initialize:function () {
        console.log('Initializing Login View');
    },

    events: {
        "click #loginButton": "login"
    },
    render: function(){
      
      this.$el.html(loginTemplate);
    }
  });

  return LoginView;
  
});
