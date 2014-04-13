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

        var ListProjCriteria=$resource("/api/ProjectCriteria",{
            query: {method:'GET'},
            post: {method:'POST'},
            update: {method:'PUT'},
            remove: {method:'DELETE'}
        })

        ListProjCriteria.post({},{criteria_id:1},function(){
            
        })
        $scope.listCriteria=ListCriteria.query();

        $scope.send_mark=function(){

        }
  });
