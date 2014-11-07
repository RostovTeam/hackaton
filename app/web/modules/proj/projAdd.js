'use strict';

angular.module('hdashApp')
  .controller('ProjaddCtrl', function ($scope, Proj, Event, UtilF) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
        $scope.project = {};
        Event.LIST(
            function(data){
                $scope.events = data;
                if (data.length == 1) {
                    $scope.project.event_id = data[0].id;
                }
            },
            function(data){
                UtilF.catchConnectionError(data);
            }
        )
        $scope.add = function(){
            Proj.CREATE(
                $scope.project,
                function(data){
                    UtilF.addAlert("Успешно сохранено", "success");
                },
                function(data){
                    UtilF.catchConnectionError(data);
                }
            )
        }
  });
