var app = angular.module('app',[
    'ngRoute', 'angular-oauth2','app.controllers','app.services','app.filters',
    'ui.bootstrap.typeahead','ui.bootstrap.tpls'
]);

angular.module('app.controllers',['ngMessages','angular-oauth2']);
angular.module('app.filters',[]);
angular.module('app.services',['ngResource']);

app.provider('appConfig',['$httpParamSerializerProvider',function($httpParamSerializerProvider){
    var config = {
        baseUrl: 'http://localhost:8000',
        project:{
            status:[
                {value:'1',label:'Iniciado'},
                {value:'2',label:'Em andamento'},
                {value:'3',label:'Finalizado'}
            ]
        },
        utils:{
            transformRequest: function(data){
                if(angular.isObject(data)){
                    console.log($httpParamSerializerProvider.$get()(data));
                    return $httpParamSerializerProvider.$get()(data);
                }
                return data;
            },
            transformResponse: function(data, headers){
                var headerGet = headers();
                if(headerGet['content-type'] == 'application/json' ||
                    headerGet['content-type'] == 'text/json'){
                    var dataJson =  JSON.parse(data);

                    if(dataJson.hasOwnProperty('data')){
                        dataJson = dataJson.data;
                    }
                    return dataJson;
                }
                return data;
            }
        }
    }

    return{
        config:config,
        $get: function(){
            return config;        }
    };
}]);

app.config([
    '$routeProvider','$httpProvider','OAuthProvider','OAuthTokenProvider','appConfigProvider',
    function($routeProvider,$httpProvider, OAuthProvider,OAuthTokenProvider,appConfigProvider){
        $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
        $httpProvider.defaults.headers.put['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
        $httpProvider.defaults.transformRequest  = appConfigProvider.config.utils.transformRequest;
        $httpProvider.defaults.transformResponse = appConfigProvider.config.utils.transformResponse;

        $routeProvider
            .when('/login',{
                controller:'LoginController',
                templateUrl:'build/views/login.html'
            })
            .when('/',{
                controller:'HomeController',
                templateUrl:'build/views/home.html'
            })
            .when('/clients',{
                controller:'ClientListController',
                templateUrl:'build/views/client/list.html'
            })
            .when('/clients/new',{
                controller:'ClientNewController',
                templateUrl:'build/views/client/new.html'
            })
            .when('/clients/:id/edit',{
                controller:'ClientEditController',
                templateUrl:'build/views/client/edit.html'
            })
            .when('/clients/:id/remove',{
                controller:'ClientRemoveController',
                templateUrl:'build/views/client/remove.html'
            })
            .when('/projects/',{
                controller:'ProjectListController',
                templateUrl:'build/views/project/list.html'
            })
            .when('/projects/new',{
                controller:'ProjectNewController',
                templateUrl:'build/views/project/new.html'
            })
            .when('/projects/:id/edit',{
                controller:'ProjectEditController',
                templateUrl:'build/views/project/edit.html'
            })
            .when('/projects/:id/remove',{
                controller:'ProjectRemoveController',
                templateUrl:'build/views/project/remove.html'
            })
            .when('/project/:id/notes',{
                controller:'ProjectNoteListController',
                templateUrl:'build/views/project-note/list.html'
            })
            .when('/project/:id/notes/:idNote/show',{
                controller:'ProjectNoteShowController',
                templateUrl:'build/views/project-note/show.html'
            })
            .when('/project/:id/notes/new',{
                controller:'ProjectNoteNewController',
                templateUrl:'build/views/project-note/new.html'
            })
            .when('/project/:id/notes/:idNote/edit',{
                controller:'ProjectNoteEditController',
                templateUrl:'build/views/project-note/edit.html'
            })
            .when('/project/:id/notes/:idNote/remove',{
                controller:'ProjectNoteRemoveController',
                templateUrl:'build/views/project-note/remove.html'
            });
        OAuthProvider.configure({
            baseUrl: appConfigProvider.config.baseUrl,
            clientId: '1',
            clientSecret: 'secret', // optional
            grantPath: 'oauth/access_token'
        });
        OAuthTokenProvider.configure({
            name: 'token',
            options: {
                secure: false
            }
        });
}]);

app.run(['$rootScope', '$window', 'OAuth',
    function($rootScope, $window, OAuth) {
    $rootScope.$on('oauth:error', function(event, rejection) {
        // Ignore `invalid_grant` error - should be catched on `LoginController`.
        if ('invalid_grant' === rejection.data.error) {
            return;
        }

        // Refresh token when a `invalid_token` error occurs.
        if ('invalid_token' === rejection.data.error) {
            return OAuth.getRefreshToken();
        }

        // Redirect to `/login` with the `error_reason`.
        return $window.location.href = '/login?error_reason=' + rejection.data.error;
    });
}]);