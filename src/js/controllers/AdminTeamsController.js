c1App.controller('AdminTeamsController', ['$scope','$http','$log','AuthService','HelperService',
    function ($scope, $http, $log, AuthService,HelperService) {

        $log.log('AdminTeamsController');

        var that = this;
        that.roles = [];
        that.teams = [];
        that.users = [];

        that.editTeam = function (u, i) {
            that.waitingTeam = i;
            that.editingTeam = angular.copy(u);
        };

        var fetchTeams = function () {
            $http.post(C1.api_url()+'api/teams/all', {t:AuthService.token},
                {headers: {'Content-Type': 'application/json'}}).success(function(data) {
                that.teams = data.teams;
                $log.log(that.teams);
                C1.hideLoader();
            }).error(function(err) {
                C1.hideLoader();
                sweetAlert('Teams List Error', 'error');
            });
        };

        var fetchUsers = function() {
            $http.post(C1.api_url() + 'api/users/all', {t: AuthService.token},
                {headers: {'Content-Type': 'application/json'}}).success(function (data) {
                that.users = data.users;
                $log.log(that.users);
                C1.hideLoader();
            }).error(function (err) {
                C1.hideLoader();
                sweetAlert('Users List Error', 'error');
            });
        };

        that.saveTeam = function () {
            C1.showLoader();
            var url = (that.editingTeam._id)?'edit':'new';
            $http.post(C1.api_url()+'api/teams/'+url,
                {
                    team:that.editingTeam,
                    t:AuthService.token
                },
                {headers: {'Content-Type': 'application/json'}}).success(function(data) {
                if(url == 'new')
                {
                    that.teams.push(data.team);
                } else {
                    that.teams[that.waitingTeam] = data.team;
                }
                that.editingTeam = null;
                $.notify('Team saved', 'success');
                C1.hideLoader();
            }).error(function(err) {
                C1.hideLoader();
                sweetAlert('Error saving team', 'error');
            });
        };

        $scope.$on('Logged In', function (event, data) {
            $log.log('Logged In');
            that.roles = HelperService.roles();
            fetchTeams();
            fetchUsers();
            C1.setMenu('admin');
        });

        C1.showLoader();
        AuthService.loggedIn();
}]);
