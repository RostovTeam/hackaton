define([
  'jquery',
  'underscore',
  'backbone',
  'text!templates/login/loginTemplate.html'
], function($, _, Backbone, loginTemplate){

  var LoginView = Backbone.View.extend({
    el: $(".content-backbone"),
    
    initialize:function () {
        console.log('Initializing Login View');
    },
    render: function(){
      
      this.$el.html(loginTemplate);
    }
  });

  return LoginView;
  
});
