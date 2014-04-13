'use strict';

angular.module('hackatonAApp')
  .controller('ProjCtrl', function ($scope, $routeParams, $resource) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
        var proj_id=$routeParams.id;

        var Proj = $resource("/api/project/:pid",{pid:"@id"});

        var pr=Proj.get({pid:proj_id},function(){
            $scope.commits_count=100;
            $scope.title=pr.name;
            $scope.des=pr.description;
        });


        var Statistik =$resource("/api/ProjectStats?project_id=:pid",{pid:"@id"});



            var dates;
            var counts_commit;

            var stat=Statistik.get({pid:proj_id},function(){

            $scope.projects_count=stat.projects_count;
            $scope.members_count=stat.members_count;
            $scope.commits_count=stat.commits_count;

            
        })


  });
