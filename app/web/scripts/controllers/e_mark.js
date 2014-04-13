'use strict';

angular.module('hackatonAApp')
  .controller('EMarkCtrl', function ($scope, $routeParams, $resource) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
        console.log($routeParams.id);

        var ListCriteria=$resource("/json/criteria", {eventId:'@id'});
        $scope.listCriteria=ListCriteria.query();
        //$scope.listCriteria=ListCriteria.get();

        //$scope.listCriteria=ListCriteria.query();
  });
