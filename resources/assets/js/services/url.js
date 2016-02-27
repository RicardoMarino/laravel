angular.module('app.services')
    .service('Url',['$interpolate', function($interpolate){
        return {
            getUrlSymbol:function(url,params){
                var urlMode = $interpolate(url)(params);
                return urlMode.replace(new RegExp('//','g'),'/')
                    .replace(/\/$/,'');
            },
            getUrlResource:function(url){
                return url.replace(new RegExp('{{','g'),':')
                    .replace(new RegExp('}}','g'),'');
            }
        };
    }]);