'use strict';

angular.module('hdashApp')
    .controller('ManagersCtrl', function ($scope, Manager, UtilF) {
        $scope.awesomeThings = [
            'HTML5 Boilerplate',
            'AngularJS',
            'Karma'
        ];
        Manager.LIST(
            function (data) {
                $scope.managers = data;
            }, function (data) {
                UtilF.catchConnectionError(data);
            }
        );

        $scope.delManager = function (id){
            Manager.DELETE(
                {id:id},
                function(data){
                    UtilF.removeFromArray($scope.managers, id);
                },
                function(data){
                    UtilF.catchConnectionError(data);
                }
            )
        }
    });
