app.controller('ClassesController', [
    '$scope',
    '$http',
    'classes',
    function($scope,
             $http,
             classes) {

    $scope.clearData = function() {
        $scope.classes = null;
    };

    $scope.getData = function() {
        classes.read().then(function(data) {
            $scope.classes = data;
        });
    };

    $scope.createData = function(data) {
        var url = 'http://10.4.10.96:8000/web/classes/add';
        $http.post(url, data).then(function(response) {
            $scope.response = response;
            $scope.loading = false;
            $scope.getData();
        });
    };

    $scope.addClass = function() {
        if($scope.class.name === undefined) {
            return;
        }
        $scope.createData({class: $scope.class});
    };

    $scope.clearData();
    $scope.getData();
}]);