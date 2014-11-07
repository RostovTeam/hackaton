'use strict';

angular.module('hdashApp')
  .factory('Event', function Event($resource, apiurl) {

        return $resource(apiurl+"/api/Event/:id", {id:"@id"},{
            CREATE: {method: "POST", params:{}, isArray: false},
            VIEW: {method: "GET", params:{id:"@id"}, isArray: false},
            LIST: {method: "GET", params:{}, isArray: true},
            UPDATE: {method: "PUT", params:{id:"@id"}, isArray: false},
            DELETE: {method: "DELETE", params:{id:"@id"}, isArray: false}
        });
  });
