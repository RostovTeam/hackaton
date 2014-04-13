'use strict';

angular.module('hackatonAApp', [
  'ngCookies',
  'ngResource',
  'ngSanitize',
  'ngRoute',
  'ngNestedResource'
])
  .config(function ($routeProvider) {
    $routeProvider
      .when('/', {
        templateUrl: 'views/main.html',
        controller: 'MainCtrl'
      })
      .when('/proj', {
        templateUrl: 'views/proj.html',
        controller: 'ProjCtrl'
      })
      .when('/mobile', {
        templateUrl: 'views/mobile.html',
        controller: 'MobileCtrl'
      })
      .when('/e_mark/:id', {
        templateUrl: 'views/e_mark.html',
        controller: 'EMarkCtrl'
      })
      .otherwise({
        redirectTo: '/'
      });


  });
