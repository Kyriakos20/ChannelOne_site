c1App.controller('TopController', ['$scope','$log','AuthService','HelperService','$http', function ($scope, $log, AuthService, HelperService, $http) {

    $log.log('TopController');
    var that = this;
    that.seeAdmin = false;
    that.seeAllUsers = false;
    that.users = [];
    that.viewUser;

    that.switchViewUser = function () {
        HelperService.setViewUser(that.viewUser);
    }

    var fetchUsers = function() {
        if(!HelperService.users)
        {
            $http.get(C1.api_url()+'api/users/simple').success(function(data) {
                HelperService.users = data.users;
                that.users = data.users;
            }).error(function(err) {
                sweetAlert('Users List Error', 'error');
            });
        } else {
            that.users = HelperService.users;
        }
    };

    $scope.$on('Logged In', function (event, data) {
        that.currUser = AuthService.user;
        that.seeAdmin = ['Admin','Web Admin','Sales Manager','Team Manager'].indexOf(that.currUser.role) >= 0;
        that.seeAllUsers = ['Admin','Web Admin','Sales Manager'].indexOf(that.currUser.role) >= 0;
        if(that.seeAllUsers) {
            fetchUsers();
        }
    });
}]);
