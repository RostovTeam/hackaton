'use strict';

angular.module('hdashApp')
  .factory('Criteria', function Criteria($resource, apiurl) {

        return $resource(apiurl+"/api/Criteria/:id", {id:"@id"},{
            CREATE: {method: "POST", params:{}, isArray: false},
            VIEW: {method: "GET", params:{id:"@id"}, isArray: false},
            LIST: {method: "GET", params:{}, isArray: true},
            UPDATE: {method: "PUT", params:{id:"@id"}, isArray: false},
            DELETE: {method: "DELETE", params:{id:"@id"}, isArray: false}
        });
    })
  .factory('CriteriaValue', function CriteriaValue($resource, apiurl) {

        return $resource(apiurl+"/api/CriteriaValue/:id", {id:"@id"},{
            CREATE: {method: "POST", params:{}, isArray: false},
            VIEW: {method: "GET", params:{id:"@id"}, isArray: false},
            LIST: {method: "GET", params:{}, isArray: true},
            UPDATE: {method: "PUT", params:{id:"@id"}, isArray: false},
            DELETE: {method: "DELETE", params:{id:"@id"}, isArray: false}
        });
   })
  ;
