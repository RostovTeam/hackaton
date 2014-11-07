'use strict';

angular.module('hdashApp')
  .controller('MainCtrl', function ($scope, Proj) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
        Proj.LIST(
            {event_id: 1},
            function(data){
                $scope.projects = data;
            },
            function(data){
                UtilF.catchConnectionError(data);
            }
        )
  });
