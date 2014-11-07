'use strict';

angular.module('hdashApp')
  .factory('auth', function ($resource, apiurl) {

        return $resource(apiurl + "/auth/:action", {},{
            loginManager: {
                method: "POST",
                params:{action:"login"}
            },
            loginMamber: {
                method: "POST",
                params:{action:"FullNameLogin"}
            },
            loginExpert: {
                method: "POST",
                params:{action:"ExpertLogin"}
            },
            logout: {
                method: "POST",
                params:{action:"logout"}
            },
            changepassword: {
                method: "POST",
                params:{action:"changepassword"}
            }
        });
    });
