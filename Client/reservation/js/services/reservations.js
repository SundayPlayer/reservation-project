app.factory('reservations', ['$http', function($http) {
    var url = 'http://10.4.10.96:8000/web/reservations';
    var data;
    return {
        read: function() {
            var promise;
            if ( !promise ) {
                // $http returns a promise, which has a then function, which also returns a promise
                promise = $http.get(url)
                    .then(function (response) {
                        // The then function here is an opportunity to modify the response
                        // The return value gets picked up by the then in the controller.
                        data = response.data;
                        console.log(data);
                        return data;
                    });
            }
            // Return the promise to the controller
            return promise;
        }/*,
        save: function(reservation) {
            data.reservations.push(reservation);
        },
        get: function() {
            return data;
        }*/
    };
}]);