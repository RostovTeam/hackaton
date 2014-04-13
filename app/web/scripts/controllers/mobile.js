'use strict';

angular.module('hackatonAApp')
  .controller('MobileCtrl', function ($scope,$resource) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];

        var ListProj=$resource("/api/project?name=:name&event_id=:eventId",{name:"@name",eventId:"@id"});
        $scope.listProj=ListProj.query();

        $scope.renderType=function(){

        }
  });
