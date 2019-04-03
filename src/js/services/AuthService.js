c1App.factory('AuthService', ['$rootScope','$log','$cookies','$http', function ($rootScope, $log, $cookies,$http) {
    return {
        token:null,
        user:null,
        isAdmin:false,
        teamMembers:[],
        refreshUser:function (user) {
            this.user = user;
            $cookies.putObject('c1Auth', {token:this.token,user:this.user,teamMembers:this.teamMembers},{
                path:'/'
            });
        },
        loggedIn:function () {
            var auth = $cookies.getObject('c1Auth');
            if(!this.token && !auth)
            {
                window.location.href = C1.base_url+'login';
            } else {
                this.token = auth.token;
                this.user = auth.user;
                this.teamMembers = auth.teamMembers;
                if(['Web Admin','Admin','Sales Manager'].indexOf(this.user.role) >= 0)
                {
                    this.isAdmin = true;
                }
                $rootScope.$broadcast('Logged In');
            }

        },
        logIn:function(user, teamMembers, token)
        {

            this.token = token;
            this.user = user;
            //var filts = user.filters;
            //this.user.filters = [];
            this.teamMembers = teamMembers;

            if(['Web Admin','Admin','Sales Manager'].indexOf(this.user.role) >= 0)
            {
                this.isAdmin = true;
            }
            $cookies.putObject('c1Auth', {token:token,user:user,teamMembers:teamMembers},{
                path:'/'
            });
            window.location.href = C1.base_url;

        },
        logOut:function()
        {

            var auth = $cookies.getObject('c1Auth');

            if(this.token || auth) {
                $cookies.remove('c1Auth');

                this.user = null;
                this.token = null;
                window.location.href = C1.base_url+'login';
                $rootScope.$broadcast('Logged Out');
            }
        }
    };
}]);
