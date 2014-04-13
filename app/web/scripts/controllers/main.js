'use strict';

angular.module('hackatonAApp')
    .controller('MainCtrl', function ($scope, $resource) {
        $scope.awesomeThings = [
            'HTML5 Boilerplate',
            'AngularJS',
            'Karma'
        ];

        var Stats = $resource("/json/EventStats/", {eventId:"@id"});
        var ListProj=$resource("/json/project",{name:"@name",eventId:"@id"});

        var stat=Stats.get({eventId:1},function(){
            $scope.projects_count=stat.projects_count;
            $scope.members_count=stat.members_count;
            $scope.commits_count=stat.commits_count;
        });



        $scope.listProj=ListProj.query();
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


        var lineChartData = {
            labels: ["20:00","21:00","22:00","23:00","00:00","01:00","02:00","03:00","04:00","05:00","06:00","07:00","08:00","09:00","10:00","11:00","12:00","13:00"],
            datasets: [
                {
                    fillColor: "rgba(79,206,174,0.1)",
                    strokeColor: "rgba(79,206,174,1)",
                    pointColor: "rgba(79,206,174,1)",
                    pointStrokeColor: "#f2f2f3",
                    data: [12,6,1,0,0,2,5,1,0,0,0,0,1,1,0,0,0,0]
                }
            ]

        }

        var myLine = new Chart(document.getElementById("canvas").getContext("2d")).Line(lineChartData);
    });
