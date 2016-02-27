angular.module('app.directives')
    .directive('projectFileDownload', ['$timeout','appConfig','ProjectFile', function($timeout,appConfig,ProjectFile) {
        return {
            restrict:'E',
            templateUrl: appConfig.baseUrl + '/build/views/templates/projectFileDownload.html',
            link: function(scope, element, attr){
                var anchor = element.children()[0];
                scope.$on('finalizar-donwload',function(event,data){
                    $(anchor).attr({
                        href: 'data:application-octet-stream;base64,' + data.file,
                        download: data.name
                    });
                    $(anchor).removeAttr('ng-click');
                    $(anchor).removeClass('disabled').removeClass('btn-danger').addClass('btn-success');
                    $(anchor).text('Salvar');
                    $timeout(function(){
                        scope.donwloadFile = function(){};
                        $(anchor)[0].click();

                    });
                });

                scope.$on('error-donwload',function(event){
                    $(anchor).text('Arquivo deletado!');
                });

                scope.$on('iniciar-downalod',function(event){
                    $(anchor).addClass('disabled').removeClass('btn-warning').addClass('btn-danger');
                    $(anchor).text('Carregando...');
                });
            },
            controller: ['$scope','$element','$attrs', function($scope,$element,$attrs){
                var anchor = $element.children()[0];
                $scope.donwloadFile = function(){
                    $scope.$emit('iniciar-downalod');
                    ProjectFile.download({id:null,idFile:$attrs.idFile},function(data){
                        $scope.$emit('finalizar-donwload',data);
                    },function(){
                        $scope.$emit('error-donwload');
                    });

                };
            }]
        };
    }]);