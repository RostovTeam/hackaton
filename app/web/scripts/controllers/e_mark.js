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

        var ListProjCriteria=nestedResource("/api/ProjectCriteria",{
            query: {method:'GET'},
            post: {method:'POST'},
            update: {method:'PUT'},
            remove: {method:'DELETE'}
        })

        $scope.listCriteria=ListCriteria.query();

        $scope.send_mark=function(){

        }
  });
