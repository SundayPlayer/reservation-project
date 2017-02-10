app.controller('ClassroomsController', [
    '$scope',
    '$http',
    'classrooms',
    function($scope,
             $http,
             classrooms) {

    $scope.clearData = function() {
        $scope.classrooms = null;
    };

    $scope.getData = function() {
        classrooms.read().then(function(data) {
            $scope.classrooms = data;
        });
    };

    $scope.createData = function(data) {
        var url = 'http://10.4.10.96:8000/web/classrooms/add';
        $http.post(url, data).then(function(response) {
            $scope.response = response;
            $scope.loading = false;
            $scope.getData();
        });
    };

    $scope.addClassroom = function() {
        if($scope.classroom.name === undefined) {
            return;
        }
        $scope.createData({classroom: $scope.classroom});
    };

    $scope.clearData();
    $scope.getData();
}]);