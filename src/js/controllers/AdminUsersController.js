c1App.controller('AdminUsersController', ['$scope','$http','$log','AuthService','HelperService',
    function ($scope, $http, $log, AuthService,HelperService) {

    $log.log('AdminUsersController');

    var that = this;

    that.editUser = function (u, i) {
        that.waitingUser = i;
        that.editingUser = angular.copy(u);
        that.editingUser.password = null;
    };

    that.saveUser = function () {
        C1.showLoader();
        var url = (that.editingUser._id)?'edit':'new';
        if(url == 'edit')
        {
            if(!that.editingUser.password)
            {
                delete that.editingUser.password;
            }
        }
        $http.post(C1.api_url()+'api/users/'+url,
            {
                user:that.editingUser,
                t:AuthService.token
            },
            {headers: {'Content-Type': 'application/json'}}).success(function(data) {
            if(url == 'new')
            {
                that.users.push(data.user);
            } else {
                that.users[that.waitingUser] = data.user;
            }
            that.editingUser = null;
            $.notify('User saved', 'success');
            C1.hideLoader();
        }).error(function(err) {
            C1.hideLoader();
            sweetAlert('Error saving user', 'error');
        });
    };

    var fetchUsers = function() {
        $http.post(C1.api_url()+'api/users/all', {t:AuthService.token},
            {headers: {'Content-Type': 'application/json'}}).success(function(data) {
            that.users = data.users;
            C1.hideLoader();
        }).error(function(err) {
            C1.hideLoader();
            sweetAlert('Users List Error', 'error');
        });
    };

    $scope.$on('Logged In', function (event, data) {
        $log.log('Logged In');
        that.roles = HelperService.roles();
        fetchUsers();
        C1.setMenu('admin');
    });

    C1.showLoader();
    AuthService.loggedIn();
}]);
