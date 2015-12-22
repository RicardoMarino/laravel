angular.module('app.services')
    .service('User',['$resource', 'appConfig', function($resource, appConfig){
        return $resource(appConfig.baseUrl + '/user',{},{
            authorizer:{
                url:appConfig.baseUrl + '/user/authorizer',
                method: 'GET'
            }
        });
    }]);