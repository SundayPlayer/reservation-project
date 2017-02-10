app.controller('LoginController', [
    '$scope',
    'classes',
    function($scope,
             classes) {

    $scope.clearData = function() {
        $scope.classes = null;
    };

    $scope.getData = function() {
        users.read().then(function(data) {
            for(var i = 0; i < data.length; i++) {
                if(data[i].id == $routeParams.id) {
                }
            }
        });
    };

    $scope.login = function() {
        if($scope.user.password === undefined
            || $scope.user.email === undefined) {
            return;
        }
    };
    $scope.clearData();
    $scope.getData();
}]);