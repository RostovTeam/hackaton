'use strict';

angular.module('hackatonAApp')
  .controller('EMarkCtrl', function ($scope, $routeParams, $resource) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
        console.log($routeParams.id);

        var ListCriteria=$resource("/api/criteria");

        
        $scope.listCriteria=ListCriteria.query();

        $scope.send_mark=function(){

        }
  });
