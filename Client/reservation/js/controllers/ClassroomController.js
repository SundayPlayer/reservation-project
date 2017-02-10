app.controller('ClassroomController', [
    '$scope',
    '$routeParams',
    'classrooms',
    function($scope,
             $routeParams,
             classrooms) {

    $scope.clearData = function() {
        $scope.classroom = null;
    };

    $scope.getData = function() {
        classrooms.read().then(function(data) {
            for(var i = 0; i < data.length; i++) {
                if(data[i].id == $routeParams.id) {
                    $scope.classroom = data[i];
                }

            }
        });
    };

    $scope.clearData();
    $scope.getData();
}]);