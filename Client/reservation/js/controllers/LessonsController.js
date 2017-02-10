app.controller('LessonsController', [
    '$scope',
    '$http',
    'lessons',
    function($scope,
             $http,
             lessons) {

        $scope.clearData = function() {
            $scope.lessons = null;
        };

        $scope.getData = function() {
            lessons.read().then(function(data) {
                $scope.lessons = data;
            });
        };

        $scope.createData = function(data) {
            var url = 'http://10.4.10.96:8000/web/lessons/add';
            $http.post(url, data).then(function(response) {
                $scope.response = response;
                $scope.loading = false;
                $scope.getData();
            });
        };

        $scope.addLesson = function() {
            if($scope.lesson.name === undefined) {
                return;
            }
            $scope.createData({lesson: $scope.lesson});
        };

        $scope.clearData();
        $scope.getData();
    }]);