'use strict';

angular.module('hdashApp')
  .controller('EventaddCtrl', function ($scope, Event, UtilF) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
        $scope.add = function(){
            Event.CREATE(
                $scope.event,
                function(data){
                    UtilF.addAlert("Успешно сохранено", "success");
                },
                function(data){
                    UtilF.catchConnectionError(data);
                }
            )
        }
  });
