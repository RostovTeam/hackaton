'use strict';

angular.module('hdashApp')
  .controller('CriteriasCtrl', function ($scope, Criteria, CriteriaValue, UtilF) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
        Criteria.LIST(
            function(data){
                $scope.criterias = data;
            },
            function(data){
                UtilF.catchConnectionError(data);
            }
        )
  });
