'use strict';

angular.module('hdashApp')
  .controller('EventeditCtrl', function ($scope,$stateParams, Event, UtilF) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
        var id = $stateParams.id;

        Event.VIEW(
            {id:id},
            function(data){
                $scope.event = data;
                $scope.values = data.values;
            },
            function(data){
                UtilF.catchConnectionError(data);
            }
        )

        $scope.update = function(){
            Event.UPDATE(
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
