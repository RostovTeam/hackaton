'use strict';

angular.module('hdashApp')
  .controller('ManageraddCtrl', function ($scope, Manager) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];

    $scope.add = function(){
        console.log($scope.manager);
        Manager.CREATE(
            $scope.manager,
            function(data){
                alert("success");
            },
            function(data){
                alert("error");
                console.log(data);
            }
        );
    }
  });
