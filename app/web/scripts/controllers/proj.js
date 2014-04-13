'use strict';

angular.module('hackatonAApp')
  .controller('ProjCtrl', function ($scope, $routeParams, $resource) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
        console.log($routeParams.id);
        var Proj = $resource("/api/project/:proj_id",{proj_id:"@id"});

        $scope.Title=Proj.name;
        $scope.Des=Proj.description;

  });
