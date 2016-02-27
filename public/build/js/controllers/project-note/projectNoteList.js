angular.module('app.controllers')
    .controller('ProjectNoteListController',[
        '$scope','$routeParams','ProjectNote',
        function($scope,$routeParams,ProjectNote){
        $scope.project_id = $routeParams.id;
        $scope.projectNotes = ProjectNote.query({id: $routeParams.id});
    }]);