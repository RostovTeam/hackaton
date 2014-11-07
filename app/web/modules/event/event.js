'use strict';

angular.module('hdashApp')
  .controller('EventCtrl', function ($scope, $stateParams, Proj) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
        var id = $stateParams.id;

        Proj.LIST(
            {event_id: id},
            function(data){
                $scope.projects = data;
            },
            function(data){
                UtilF.catchConnectionError(data);
            }
        )

        $scope.experts = [
            {"id":1, "name":"Иванов Иван", "photo":"https://pp.vk.me/c319121/v319121042/35fd/aWY9SFBeMl4.jpg", "des":"эксперт по стратегическим технологиям Microsoft" }
,
            {"id":1, "name":"Иванов Иван", "photo":"https://pp.vk.me/c319121/v319121042/35fd/aWY9SFBeMl4.jpg", "des":"эксперт по стратегическим технологиям Microsoft" }
,{"id":1, "name":"Иванов Иван", "photo":"https://pp.vk.me/c319121/v319121042/35fd/aWY9SFBeMl4.jpg", "des":"эксперт по стратегическим технологиям Microsoft" }
            ,
            {"id":1, "name":"Иванов Иван", "photo":"https://pp.vk.me/c319121/v319121042/35fd/aWY9SFBeMl4.jpg", "des":"эксперт по стратегическим технологиям Microsoft" }
        ];
  });
