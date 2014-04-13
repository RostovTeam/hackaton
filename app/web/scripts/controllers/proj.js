'use strict';

angular.module('hackatonAApp')
  .controller('ProjCtrl', function ($scope, $routeParams, $resource) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
        var proj_id=$routeParams.id;

        var Proj = $resource("/api/project/:proj_id",{pid:"@id"});

        var pr=Proj.get({pid:proj_id},function(){
            $scope.commits_count=100;
            $scope.title=pr.name;
            $scope.des=pr.description;
        });


        var Statistik =$resource("/api/",{pid:"@id"});



        var dates;
        var counts_commit;
        Statistik.get({pid:proj_id},function(){

            $scope.projects_count=stat.projects_count;
            $scope.members_count=stat.members_count;
            $scope.commits_count=stat.commits_count;

            dates=stat.commit_detail.dates;
            counts_commit=stat.commit_detail.counts;

            var lineChartData = {
                labels: dates,
                datasets: [
                    {
                        fillColor: "rgba(79,206,174,0.1)",
                        strokeColor: "rgba(79,206,174,1)",
                        pointColor: "rgba(79,206,174,1)",
                        pointStrokeColor: "#f2f2f3",
                        data: counts_commit
                    }
                ]

            }

            var myLine = new Chart(document.getElementById("canvas").getContext("2d")).Line(lineChartData);

        })


  });
