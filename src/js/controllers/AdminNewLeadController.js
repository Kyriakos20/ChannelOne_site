c1App.controller('AdminNewLeadController', ['$scope','$http','$log','AuthService','HelperService', function ($scope, $http, $log, AuthService,HelperService) {

    $log.log('AdminNewLeadController');
    var that = this;

    $scope.$on('Logged In', function (event, data) {
        $log.log('Logged In');

    
    });

    AuthService.loggedIn();
}]);
