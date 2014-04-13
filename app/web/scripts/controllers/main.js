'use strict';

angular.module('hackatonAApp')
    .controller('MainCtrl', function ($scope, $resource) {
        $scope.awesomeThings = [
            'HTML5 Boilerplate',
            'AngularJS',
            'Karma'
        ];

        var Stats = $resource(" /api/EventStats?event_id=:eventId", {eventId:"@id"});
        var ListProj=$resource("/api/project?name=:name&event_id=:eventId",{name:"@name",eventId:"@id"});


        var dates;
        var counts_commit;
        var stat=Stats.get({eventId:1},function(){
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
        });



        $scope.listProj=ListProj.get();
        //$scope.listProj=ListProj.get({name:"",eventId:""})

        $scope.setMedal=function(index){
            switch (index){
                case 0:
                    return "b-item__medal_gold";
                    break;

                case 1:
                    return "b-item__medal_silver";
                    break;

                case 2:
                    return "b-item__medal_bronze";
            }
        }



    });
