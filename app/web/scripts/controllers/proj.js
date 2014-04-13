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
        var pr=Proj.query();
        
        $scope.Title=pr.name;
        $scope.Des=pr.description;

  });
