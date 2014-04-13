'use strict';

angular.module('hackatonAApp')
  .controller('MobileCtrl', function ($scope,$resource) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];

        var ListProj=$resource("/json/project",{name:"@name",eventId:"@id"});
        $scope.listProj=ListProj.query();

        $scope.renderType=function(){

        }
  });
