'use strict';

angular.module('hdashApp')
    .controller('ManagerCtrl', function ($scope,$rootScope) {
        $scope.awesomeThings = [
            'HTML5 Boilerplate',
            'AngularJS',
            'Karma'
        ];
        if (!$rootScope.alerts) {
            $rootScope.alerts = [];
        }
    });
