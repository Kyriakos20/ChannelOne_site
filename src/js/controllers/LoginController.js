c1App.controller('LoginController', ['$scope','$http','$log','AuthService', function ($scope, $http, $log, AuthService) {

    var cntrl = this;
    cntrl.user = undefined;

    $log.log('LoginController');

    $scope.$on('Logged Out', function (event, data) {
        $log.log('Logged Out');
        sweetAlert('Thanks for Visiting!', 'You have been logged out of C1', 'info');
    });

    cntrl.login = function (valid) {
        if(!valid)
        {
            return;
        }
        C1.showLoader();
        var tosend = angular.copy(cntrl.user);
        cntrl.user = undefined;
        $http.post(C1.api_url()+'api/login', {
            email:tosend.email,
            password:tosend.password
        }, {headers: {'Content-Type': 'application/json'}}).success(function(data){
            data.user.password = null;
            AuthService.logIn(data.user, data.teamMembers, data.token);
        }).error(function(error){
            sweetAlert('Access Denied', 'Invalid credentials', 'error');
            C1.hideLoader();
        });
    };

    AuthService.logOut();
    C1.hideLoader();
}]);
