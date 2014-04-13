'use strict';

angular.module('hackatonAApp', [
  'ngCookies',
  'ngResource',
  'ngSanitize',
  'ngRoute'
])
  .config(function ($routeProvider) {
    $routeProvider
      .when('/', {
        templateUrl: 'views/main.html',
        controller: 'MainCtrl'
      })
      .when('/proj/:id', {
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
      .when('/addProj', {
        templateUrl: 'views/addproj.html',
        controller: 'AddprojCtrl'
      })
      .otherwise({
        redirectTo: '/'
      });


  });
