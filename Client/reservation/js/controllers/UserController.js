app.controller('UserController', [
    '$scope',
    '$routeParams',
    'users',
    function($scope,
             $routeParams,
             users) {

    $scope.clearData = function() {
        $scope.user = null;
    };

    $scope.getData = function() {
        users.read().then(function(data) {
            for(var i = 0; i < data.length; i++) {
                if(data[i].id == $routeParams.id) {
                    $scope.user = data[i];
                }
            }
        });
    };

    $scope.clearData();
    $scope.getData();
}]);
