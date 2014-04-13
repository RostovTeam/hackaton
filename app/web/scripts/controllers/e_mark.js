'use strict';

angular.module('hackatonAApp')
        .controller('EMarkCtrl', function($scope, $routeParams, $resource) {
            $scope.awesomeThings = [
                'HTML5 Boilerplate',
                'AngularJS',
                'Karma'
            ];
            console.log($routeParams.id);


            var ListCriteria = $resource("/api/criteria");

            var test = {"criteria_id": 1, "value": 1, "project_id": 1};

            var ProjCriter = $resource("/api/ProjectCriteria", null,
                    {
                        send: {method: "POST", data: {}, isArray: false}
                    });

            ProjCriter.send(test,function(){
                console.log(1)
            });
            
            
            $scope.listCriteria = ListCriteria.query();

            $scope.send_mark = function() {
                console.log($scope.checkbox)
            }
            
            $scope.addCheck=function(id){
                console.log(id)
            }
        });

