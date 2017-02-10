app.controller('UsersController', [
    '$scope',
    '$http',
    'users',
    function($scope,
             $http,
             users) {

    $scope.clearData = function() {
        $scope.users = null;
    };

    $scope.getData = function() {
        users.read().then(function(data) {
            $scope.users = data;
        });
    };
    $scope.clearData();
    $scope.getData();

        $scope.createData = function(data) {
            var url = 'http://10.4.10.96:8000/web/users/add';
            $http.post(url, data).then(function(response) {
                $scope.response = response;
                $scope.loading = false;
                $scope.getData();
            });
        };

        $scope.addUser = function() {
            if($scope.user.firstName === undefined
                || $scope.user.lastName === undefined
                || $scope.user.phoneNumber === undefined
                || $scope.user.email === undefined
                || $scope.user.accessType === undefined) {
                return;
            }
            $scope.createData({user: $scope.user});
        };

    }]);