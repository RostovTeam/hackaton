'use strict';

angular.module('hdashApp')
    .controller('UseraddCtrl', function ($scope, Event, User, UtilF) {
        $scope.awesomeThings = [
            'HTML5 Boilerplate',
            'AngularJS',
            'Karma'
        ];
        $scope.user = {};
        Event.LIST(
            function (data) {
                $scope.events = data;
                if (data.length == 1) {
                    $scope.user.event_id = data[0].id;
                }
            },
            function (data) {
                UtilF.catchConnectionError(data);
            }
        );
        $scope.add = function () {
            User.CREATE(
                $scope.user,
                function (data) {
                    UtilF.addAlert("Успешно сохранено", "success");
                },
                function (data) {
                    UtilF.catchConnectionError(data);
                }
            )
        }

    });
