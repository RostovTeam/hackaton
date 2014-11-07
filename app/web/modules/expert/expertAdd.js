'use strict';

angular.module('hdashApp')
  .controller('ExpertaddCtrl', function ($scope, Event, Expert,UtilF) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
        Event.LIST(function(data){
            $scope.events = data;
        });
        $scope.add = function(){
            Expert.CREATE(
                $scope.expert,
                function(data){
                    UtilF.addAlert("Успешно сохранено", "success");
                },
                function(data){
                    UtilF.catchConnectionError(data);
                }
            )
        }
  });
