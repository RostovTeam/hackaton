'use strict';

angular.module('hdashApp')
  .controller('EventsCtrl', function ($scope, Event, UtilF) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
        Event.LIST(
            function(data){
                $scope.events = data;
            },
            function(data){
                UtilF.catchConnectionError(data);
            }
        )
        $scope.delEvent = function(id){
            Event.DELETE(
                {id:id},
                function(data){
                    UtilF.removeFromArray($scope.users, id);
                },
                function(data){
                    UtilF.catchConnectionError(data);
                }
            )
        }
  });
