'use strict';

angular.module('hdashApp')
  .controller('CriteriaaddCtrl', function ($scope, Criteria, UtilF) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
        $scope.add = function(){
            Criteria.CREATE(
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
