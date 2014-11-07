'use strict';

angular.module('hdashApp')
  .controller('LoginCtrl', function ($scope, auth, $state) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
        $scope.login = function(){
            auth.loginManager(
                $scope.auth,
                function(data){
                    $state.go('manager.main');
                },
                function(data){
                    alert("error");
                }
            )
        }
  });
