'use strict';

angular.module('hdashApp')
  .controller('CriteriaeditCtrl', function ($scope, $stateParams, Criteria, CriteriaValue, UtilF) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
        var id = $stateParams.id;

        $scope.newValue = {};

        Criteria.VIEW(
            {id:id},
            function(data){
                $scope.criteria = data;
                $scope.values = data.values;
            },
            function(data){
                UtilF.catchConnectionError(data);
            }
        )

        $scope.delValue = function(id){
            CriteriaValue.DELETE(
                {id:id},
                function(data){
                    UtilF.removeFromArray($scope.values,id);
                },
                function(data){
                    UtilF.catchConnectionError(data);
                }
            )
        }
        $scope.addValue = function(){
            if(!$scope.newValue.label || !$scope.newValue.value){
                UtilF.addAlert("Заполните поля", "error");
            }
            else{
                $scope.newValue.criteria_id = id;
                CriteriaValue.CREATE(
                    $scope.newValue,
                    function(data){
                        $scope.values.push(data);
                        $scope.newValue = {};
                    },
                    function(data){
                        UtilF.catchConnectionError(data);
                    }
                )
            }
        }
        $scope.update = function(){
            Criteria.UPDATE(
                $scope.event,
                function(data){
                    UtilF.addAlert("Успешно сохранено", "success");
                },
                function(data) {
                    UtilF.catchConnectionError(data);
                }
            )
        }
  });
