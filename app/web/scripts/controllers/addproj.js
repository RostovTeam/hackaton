'use strict';

angular.module('hackatonAApp')
  .controller('AddprojCtrl', function ($scope, $resource) {
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
            proj.event_id=1;
            proj.owner_id=5;

            Project.create(proj);
        }
  });
