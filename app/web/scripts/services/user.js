'use strict';

angular.module('hdashApp')
  .factory('User', function ($resource, apiurl) {

        return $resource(apiurl+"/api/Member/:id", {id:"@id"},{
            CREATE: {method: "POST", params:{}, isArray: false},
            VIEW: {method: "GET", params:{id:"@id"}, isArray: false},
            LIST: {method: "GET", params:{}, isArray: true},
            UPDATE: {method: "PUT", params:{id:"@id"}, isArray: false},
            DELETE: {method: "DELETE", params:{id:"@id"}, isArray: false}
        });
  });
