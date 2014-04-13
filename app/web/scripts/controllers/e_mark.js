'use strict';

angular.module('hackatonAApp')
  .controller('EMarkCtrl', function ($scope, $routeParams, $resource) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
        console.log($routeParams.id);

        var ListCriteria=$resource("/json/criteria");
        $scope.listCriteria=ListCriteria.query();

        $scope.proj = {
            mark: ['user']
        };
        $scope.send=function(){
            console.log($scope.mark)
        }
        $scope.addCheck=function(index){

            console.log(index)
        }
        //console.log(proj.mark);
  });
