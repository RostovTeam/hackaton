'use strict';

angular.module('hdashApp')
    .controller('UsermanagerCtrl', function ($scope, User, UtilF) {
        $scope.awesomeThings = [
            'HTML5 Boilerplate',
            'AngularJS',
            'Karma'
        ];
        $scope.delUser = function (id) {
            User.DELETE(
                {id: id},
                function (data) {
                    UtilF.removeFromArray($scope.users, id);
                },
                function (data) {
                    UtilF.catchConnectionError(data);
                }
            )
        };

        User.LIST(
            function (data) {
                $scope.users = data;
            }, function (data) {
                UtilF.catchConnectionError(data);
            }
        );
    });
