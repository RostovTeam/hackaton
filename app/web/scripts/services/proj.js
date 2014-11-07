'use strict';

angular.module('hdashApp')
    .factory('Proj', function Proj($resource, apiurl) {

        return $resource(apiurl + "/api/Project/:id", {id: "@id"}, {
            CREATE: {method: "POST", params: {}, isArray: false},
            VIEW: {method: "GET", params: {id: "@id"}, isArray: false},
            LIST: {method: "GET", params: {event_id: "@event_id"}, isArray: true},
            UPDATE: {method: "PUT", params: {id: "@id"}, isArray: false},
            DELETE: {method: "DELETE", params: {id: "@id"}, isArray: false}
        });
    });
