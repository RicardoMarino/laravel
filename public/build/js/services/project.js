angular.module('app.services')
    .service('Project', ['$resource','$filter', 'appConfig',
        function($resource, $filter, appConfig) {
            function transformData(data){
                if(angular.isObject(data) && data.hasOwnProperty('due_date')){
                    var project = angular.copy(data);
                    project.due_date = $filter('date')(data.due_date,'yyyy-MM-dd');
                    return appConfig.utils.transformRequest(project);
                }
                return data;
            }
            return $resource(appConfig.baseUrl + '/project/:id', {id: '@id'},{
                save:{
                    method:'POST',
                    transformRequest: transformData
                },
                get:{
                    method: 'GET',
                    transformResponse: function(data,headers){
                        var obj = appConfig.utils.transformResponse(data,headers);
                        if(angular.isObject(obj) && obj.hasOwnProperty('due_date')){
                            var dateArray = obj.due_date.split('-');
                            var mouth = dateArray[1] - 1;
                            obj.due_date = new Date(dateArray[0],mouth,dateArray[2]);
                        }
                        return obj;
                    }
                },
                update: {
                    method: 'PUT',
                    transformRequest: transformData
                }
            });
    }]);