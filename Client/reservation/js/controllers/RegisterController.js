app.controller('RegisterController', [
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
                $scope.classes = data.classes;
            });
        };

        $('#classSelect').hide();

        $scope.changeType = function () {
            console.log($scope.user.accessType);
            if($scope.user.accessType === "Student") {
                $('#classSelect').show();
            } else {
                $('#classSelect').hide();
            }
        };

        console.log($scope);

        $scope.createData = function(data) {
            var url = 'http://10.4.10.96:8000/web/users/add';
            $http.post(url, data).then(function(response) {
                $scope.response = response;
                $scope.loading = false;
                $scope.getData();
            });
        };

        $scope.addUser = function() {
            console.log($scope);
            if($scope.user) {
                if($scope.user.firstName === undefined
                    || $scope.user.lastName === undefined
                    || $scope.user.accessType === undefined
                    || $scope.user.password === undefined
                    || $scope.user.phoneNumber === undefined
                    || $scope.user.email === undefined) {
                    console.log('error');
                    return;
                }
                $scope.createData({user: $scope.user});
            }
            return;
        };
        $scope.clearData();
        $scope.getData();
}]);