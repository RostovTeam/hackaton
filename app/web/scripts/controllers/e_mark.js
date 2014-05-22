'use strict';

angular.module('hackatonAApp')
        .controller('EMarkCtrl', function($scope, $routeParams, $resource) {
            $scope.awesomeThings = [
                'HTML5 Boilerplate',
                'AngularJS',
                'Karma'
            ];
            var proj_id=$routeParams.id;

            var array_chench;

            var ListCriteria = $resource("/api/criteria");

            $scope.listCriteria = ListCriteria.query();

            var ProjCriter = $resource("/api/ProjectCriteria", null,
                    {
                        send: {method: "POST", data: {}, isArray: false}
                    });


            var test;

            $scope.addCheck=function(id){
                 test = {"criteria_id": id, "value": 1, "project_id": proj_id};

                ProjCriter.send(test,function(data){
                    Console.log("оценку принял");
                });
            }


        });

