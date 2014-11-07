'use strict';

angular.module('hdashApp')
    .controller('ExpertsmanagerCtrl', function ($scope, Expert, UtilF) {
        $scope.awesomeThings = [
            'HTML5 Boilerplate',
            'AngularJS',
            'Karma'
        ];

        $scope.delExpert = function (id) {
            Expert.DELETE(
                {id: id},
                function (data) {
                    UtilF.removeFromArray($scope.users, id);
                },
                function (data) {
                    UtilF.catchConnectionError(data);
                }
            )
        };

        Expert.LIST(
            function (data) {
                $scope.experts = data;
            }, function () {
                UtilF.catchConnectionError(data);
            }
        );

    });
