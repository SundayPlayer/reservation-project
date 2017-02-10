app.controller('ClassController', [
    '$scope',
    '$routeParams',
    'classes',
    function($scope,
             $routeParams,
             classes) {

    $scope.clearData = function() {
        $scope.class = null;
    };

    $scope.getData = function() {
        classes.read().then(function(data) {
            for(var i = 0; i < data.length; i++) {
                if(data[i].id == $routeParams.id) {
                    $scope.class = data[i];
                }
            }
        });
    };

    $scope.clearData();
    $scope.getData();
}]);