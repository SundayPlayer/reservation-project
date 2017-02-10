app.controller('ReservationController', [
    '$scope',
    '$routeParams',
    'reservations',
    function($scope,
             $routeParams,
             reservations) {

    $scope.clearData = function() {
        $scope.reservation = null;
    };

    $scope.getData = function() {
        reservations.read().then(function(data) {
            for(var i = 0; i < data.length; i++) {
                if(data[i].id == $routeParams.id) {
                    $scope.reservation = data[i];
                }
            }
        });
    };

    $scope.clearData();
    $scope.getData();
}]);