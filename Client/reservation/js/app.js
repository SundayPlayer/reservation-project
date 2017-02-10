/**
 * Created by hamid on 31/01/17.
 */
var app = angular.module('Reservations', ['ngRoute', 'moment-picker'], function($httpProvider) {
    // Use x-www-form-urlencoded Content-Type
    $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';

    /**
     * The workhorse; converts an object to x-www-form-urlencoded serialization.
     * @param {Object} obj
     * @return {String}
     */
    var param = function(obj) {
        var query = '', name, value, fullSubName, subName, subValue, innerObj, i;

        for(name in obj) {
            value = obj[name];

            if(value instanceof Array) {
                for(i=0; i<value.length; ++i) {
                    subValue = value[i];
                    fullSubName = name + '[' + i + ']';
                    innerObj = {};
                    innerObj[fullSubName] = subValue;
                    query += param(innerObj) + '&';
                }
            }
            else if(value instanceof Object) {
                for(subName in value) {
                    subValue = value[subName];
                    fullSubName = name + '[' + subName + ']';
                    innerObj = {};
                    innerObj[fullSubName] = subValue;
                    query += param(innerObj) + '&';
                }
            }
            else if(value !== undefined && value !== null)
                query += encodeURIComponent(name) + '=' + encodeURIComponent(value) + '&';
        }

        return query.length ? query.substr(0, query.length - 1) : query;
    };

    // Override $http service's default transformRequest
    $httpProvider.defaults.transformRequest = [function(data) {
        return angular.isObject(data) && String(data) !== '[object File]' ? param(data) : data;
    }];
});
app.config(['$locationProvider', '$routeProvider', function($locationProvider, $routeProvider) {
    $locationProvider.hashPrefix('');
    $routeProvider
        .when('/', {
            controller: 'HomeController',
            templateUrl: 'views/home.html'
        })
        .when('/reservations', {
            controller: 'ReservationsController',
            templateUrl: 'views/reservations.html'
        })
        .when('/reservation/:id', {
            controller: 'ReservationController',
            templateUrl: 'views/reservation.html'
        })
        .when('/users', {
            controller: 'UsersController',
            templateUrl: 'views/users.html'
        })
        .when('/user/:id', {
            controller: 'UserController',
            templateUrl: 'views/user.html'
        })
        .when('/classes', {
            controller: 'ClassesController',
            templateUrl: 'views/classes.html'
        })
        .when('/class/:id', {
            controller: 'ClassController',
            templateUrl: 'views/class.html'
        })
        .when('/classrooms', {
            controller: 'ClassroomsController',
            templateUrl: 'views/classrooms.html'
        })
        .when('/classroom/:id', {
            controller: 'ClassroomController',
            templateUrl: 'views/classroom.html'
        })
        .when('/lessons', {
            controller: 'LessonsController',
            templateUrl: 'views/lessons.html'
        })
        .when('/lesson/:id', {
            controller: 'LessonController',
            templateUrl: 'views/lesson.html'
        })
        .when('/register', {
            controller: 'RegisterController',
            templateUrl: 'views/register.html'
        })
        .when('/login', {
            controller: 'LoginController',
            templateUrl: 'views/login.html'
        })
        .otherwise({
            redirectTo: '/'
        });
}]);