'use strict';

angular.module('hackatonAApp')
  .controller('ProjCtrl', function ($scope, $routeParams, $resource) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
        
        var Proj = $resource("/api/project/:proj_id",{proj_id:"@id"});

        var pr=Proj.get({proj_id:$routeParams.proj_id});

        $scope.Title=pr.name;
        $scope.Des=pr.description;

  });
