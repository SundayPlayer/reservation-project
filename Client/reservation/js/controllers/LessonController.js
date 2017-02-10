app.controller('LessonController', [
    '$scope',
    '$routeParams',
    'lessons',
    function($scope,
             $routeParams,
             lessons) {

    $scope.clearData = function() {
        $scope.lesson = null;
    };

    $scope.getData = function() {
        lessons.read().then(function(data) {
            for(var i = 0; i < data.length; i++) {
                if(data[i].id == $routeParams.id) {
                    $scope.lesson = data[i];
                }
            }
        });
    };

    $scope.clearData();
    $scope.getData();
}]);