app.controller('ReservationsController', [
    '$scope',
    '$http',
    'reservations',
    'classrooms',
    'classes',
    'users',
    'lessons',
    function($scope,
             $http,
             reservations,
             classrooms,
             classes,
             users,
             lessons) {

        $scope.dateToDateTime = function(date) {
            date = new Date(date);
            date = {
                seconds: date.getSeconds(),
                minutes: date.getMinutes(),
                hours: date.getHours(),
                weekDay: {
                    value : date.getDay(),
                    name : $scope.showDay(date.getDay())
                },
                day: date.getDate(),
                month: {
                    value : date.getMonth() + 1,
                    name : $scope.showMonth(date.getMonth() + 1)
                },
                year: date.getFullYear(),
                datetime: date.getFullYear() + '-' +
                    ('00' + (date.getMonth() + 1)).slice(-2) + '-' +
                    ('00' + (date.getDate() + 0)).slice(-2) + ' ' +
                    ('00' + (date.getHours())).slice(-2) + ':' +
                    ('00' + date.getMinutes()).slice(-2) + ':' +
                    ('00' + date.getSeconds()).slice(-2) + '.000000'
            };
            return date;
        };

        console.log(parent.$scope);

        $scope.clearData = function() {
        $scope.reservations = null;
        $scope.classrooms = null;
        $scope.classes = null;
        $scope.users = null;
        $scope.lessons = null;
    };

        $scope.getData = function() {
            classrooms.read().then(function(data) {
                $scope.classrooms = data;
            });

            classes.read().then(function(data) {
                $scope.classes = data;
            });

            users.read().then(function(data) {
                $scope.users = data;
            });

            lessons.read().then(function(data) {
                $scope.lessons = data;
            });

            reservations.read().then(function(data) {
                $scope.reservations = data;
                for(var i = 0; i < $scope.reservations.length; i++) {
                    $scope.reservations[i].days = $scope.generateDays(new Date($scope.reservations[i].time.start.date), new Date($scope.reservations[i].time.end.date));
                }
            });
        };

        $scope.difference = function (date1, date2){
            var difference = 0;
            while(date2 - date1 > difference*(3600*1000*24)) {
                difference++;
            }
            return(difference);
        };
        $scope.showDay = function(day) {
            switch(day) {
                case 0:
                    return "Sunday";
                case 1:
                    return "Monday";
                case 2:
                    return "Tuesday";
                case 3:
                    return "Wednesday";
                case 4:
                    return "Thursday";
                case 5:
                    return "Friday";
                case 6:
                    return "Saturday";
            }
        };

        $scope.showMonth = function(month) {
            switch(month) {
                case 1:
                    return "January";
                case 2:
                    return "February";
                case 3:
                    return "March";
                case 4:
                    return "April";
                case 5:
                    return "May";
                case 6:
                    return "June";
                case 7:
                    return "July";
                case 8:
                    return "August";
                case 9:
                    return "September";
                case 10:
                    return "October";
                case 11:
                    return "November";
                case 12:
                    return "December";
            }
        };

        $scope.generateDays = function(date1, date2){
            var difference = $scope.difference(date1, date2);
            var days = [];
            var date;
            for(var i = 0; i <= difference; i++){
                date = new Date(date1);
                date = new Date(date.setDate(date.getDate() + i));
                if($scope.showDay(date.getDay()) != "Sunday" && $scope.showDay(date.getDay()) != "Saturday")
                days.push($scope.dateToDateTime(date));
            }
            return days;
        };

        $scope.today = new Date();

        $scope.generateWeekDays = function(number) {
            var today = new Date();
            today = new Date(today.setDate(today.getDate() + 7*number));
            var diff = today.getDay() - 1;
            var firstDay = new Date(today.setDate(today.getDate() - diff));
            var lastDay = new Date(today.setDate(today.getDate() + 4));
            var weekDays = $scope.generateDays(firstDay, lastDay);
            return weekDays;
        };

        $scope.changeWeekDays = function(number){
            $scope.weekDays = $scope.generateWeekDays(number);

        };

        $scope.weekNumber = 0;

        $scope.changeWeekDays($scope.weekNumber);

        $scope.plusOne = function(){
            $scope.weekNumber++;
            $scope.changeWeekDays($scope.weekNumber);
        };

        $scope.minusOne = function(){
            $scope.weekNumber--;
            $scope.changeWeekDays($scope.weekNumber);
        };

        $scope.orders = [
            {
                name: "First Name",
                value: "user.firstName"
            },
            {
                name: "Lesson",
                value: "lesson.name"
            },
            {
                name: "Classroom",
                value: "classroom.name"
            },
            {
                name: "Class",
                value: "class.name"
            }];

        $scope.directions = [
            {
                name: "Asc",
                value: "+"
            },
            {
                name: "Desc",
                value: "-"
            }];

        $scope.createData = function(data) {
            var url = 'http://10.4.10.96:8000/web/reservations/add/'
                +$scope.reservation.class.id+'/'
                +$scope.reservation.classroom.id+'/'
                +$scope.reservation.lesson.id+'/'
                +$scope.reservation.user.id;
            $http.post(url, data).then(function(response) {
                $scope.response = response;
                $scope.loading = false;
                $scope.getData();
            });
        };

        /*$scope.date = new Date();
        $scope.days = [];
        $scope.months = [];
        $scope.years = [];
        for(var i = 0; i < 7; i++) {
            $scope.days[i] = $scope.showDay($scope.getDay($scope.date, i));
            $scope.months[i] = $scope.showMonth($scope.getMonth($scope.date, i));
            $scope.years[i] = $scope.showYear($scope.getYear($scope.date, i));
        }*/
        $scope.addReservation = function() {
            var timeStart = $scope.dateToDateTime(new Date($scope.reservation.time.start));
            var timeEnd = $scope.dateToDateTime(new Date($scope.reservation.time.end));
            $scope.reservation.time.start = timeStart.datetime;
            $scope.reservation.time.end = timeEnd.datetime;
            if($scope.reservation.classroom === undefined
                || $scope.reservation.class.id === undefined
                || $scope.reservation.lesson.id === undefined
                || $scope.reservation.time.end === undefined
                || $scope.reservation.time.start === undefined
                || $scope.reservation.time.start === null
                || $scope.reservation.time.end === null
                || $scope.reservation.user.id === undefined) {
                return;
            }
            var i;
            for(i = 0; i < $scope.classrooms.length; i++) {
                if($scope.classrooms[i].id == $scope.reservation.classroom.id) {
                    $scope.reservation.classroom = $scope.classrooms[i];
                }
            }
            for(i = 0; i < $scope.classes.length; i++) {
                if($scope.classes[i].id == $scope.reservation.class.id) {
                    $scope.reservation.class = $scope.classes[i];
                }
            }
            for(i = 0; i < $scope.lessons.length; i++) {
                if($scope.lessons[i].id == $scope.reservation.lesson.id) {
                    $scope.reservation.lesson = $scope.lessons[i];
                }
            }
            for(i = 0; i < $scope.users.length; i++) {
                if($scope.users[i].id == $scope.reservation.user.id) {
                    $scope.reservation.user = $scope.users[i];
                }
            }
            $scope.createData({reservation: $scope.reservation});
        };
        $scope.clearData();
        $scope.getData();
}]);