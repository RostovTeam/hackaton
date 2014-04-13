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





    });
