angular.module('app.controllers')
    .controller('ProjectFileNewController',[
        '$scope','$location','$routeParams','appConfig','Url','Upload',
        function($scope,$location,$routeParams,appConfig,Url,Upload){

        $scope.save = function(){
            console.log($scope.form);
            if($scope.form.$valid){
                var url = appConfig.baseUrl + Url.getUrlSymbol(appConfig.urls.projectFile,{
                        id: $routeParams.id,
                        idFile:''
                    });
                Upload.upload({
                    url: url,
                    file: $scope.projectFile.file,
                    fields: {
                        name: $scope.projectFile.name,
                        description: $scope.projectFile.description,
                        project_id: $routeParams.id
                    }

                }).success(function (resp) {
                    $location.path('/project/'+$routeParams.id + '/files');
                });
            }
        };
    }]);