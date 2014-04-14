'use strict';

angular.module('hackatonAApp')
  .controller('AddprojCtrl', function ($scope, $resource,  $location) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
        var Project = $resource("/api/project", null,
        {
                create: {method: "POST", data: {}, isArray: false}
        });


        $scope.send=function(){
            var proj=$scope.project;
            if(proj!=null){
                proj.event_id=1;
                proj.owner_id=2;

                Project.create(proj,function(){
                    $location.path("/#/addProj");
                });
            }
        }
  });