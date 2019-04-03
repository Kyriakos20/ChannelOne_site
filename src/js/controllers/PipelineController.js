c1App.controller('PipelineController', ['$scope','$rootScope','$http','$log','AuthService','HelperService',
    'DetailModalService','DialDataService', function ($scope, $rootScope, $http, $log, AuthService,HelperService, DetailModalService,DialDataService)
    {

        $log.log('PipelineController');

        var that = this;

        that.filters = {};
        that.sortField = 'owner.primary.name.last';
        that.sortDir = '';
        that.viewUser;

        that.sortOn = function (f) {


            if(that.sortField == f)
            {
                that.sortDir = (that.sortDir == '-')?'':'-';
            } else {
                that.sortDir = '';
                that.sortField = f;
            }

        };

        that.showDialModal = function (lead) {
            DialDataService.setLead(lead);
        };

        var defaultFilters = {
            pipelineStatuses:['Paper App','Work Up','Ready to Pitch','Booked','Docs Out',
                'Docs In','Counselling In','Case Num Orderded','Appraisal Ordered','Appraisal In',
                'Submitted to Processing','Sent to Lender', 'Stipped','Clear to Close','Closed'],
            doNot:'all'
        };

        that.leads = [];

        that.showDetail = function (lead) {
            DetailModalService.setLead(lead);
        };

        $scope.slideTo = function (which) {
            var id = '#'+which;
            $('html,body').animate({scrollTop: $(id).offset().top},'slow');
        };

        $scope.bestColor = function (l) {
            if(l.colors.length)
            {
                for(i = (l.colors.length-1); i>=0;i--)
                {
                    var c = l.colors[i];
                    if(c.user == that.currentUser._id)
                    {
                        return c.name;
                        break;
                    }
                }
            } else {
                return null;
            }
        };
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




        var fetchLeads = function() {
            C1.showLoader();
            that.filters.user = (that.viewUser) ? that.viewUser : AuthService.user;

            $http.post(C1.api_url()+'api/properties/all', {
                filters:that.filters,
                t:AuthService.token
            }, {headers: {'Content-Type': 'application/json'}}).success(function(data){
                that.leads = data.leads;
                that.meta = data.meta;
                that.meta.totalPages = Math.ceil(that.meta.total/that.meta.perPage);
                C1.hideLoader();
                $.notify(that.meta.total+' pipeline loans found', 'info');
            }).error(function(error){
                sweetAlert('Access Denied', 'Invalid credentials', 'error');
                C1.hideLoader();
            });
        };

        $scope.usersComments = function () {
            return function (comment) {
                return comment.user == that.currentUser._id;
            };
        };

        $scope.getBucket = function (which) {
            return function (lead) {
                return lead.bucket == which;
            };
        };

        $scope.$on('detail-lead-turned-down', function () {
            var lead = DetailModalService.getLead();
            var i = that.leads.indexOf(lead);
            that.leads.splice(i,1);
            $rootScope.$broadcast('detail-to-close');
        });

        $scope.$on('detail-color-change', function () {
            var lead = DetailModalService.getLead();
            var i = that.leads.indexOf(lead);
            that.leads[i] = lead;

        });

        $scope.$on('detail-lead-claim', function () {
            var lead = DetailModalService.getLead();
            var i = that.leads.indexOf(lead);
            that.leads[i] = lead;
            $rootScope.$broadcast('detail-to-close');
        });

        $scope.$on('view-user-ready', function () {
            that.viewUser = HelperService.getViewUser();
            fetchLeads();
        });


        $scope.$on('Logged In', function (event, data) {
            $log.log('Logged In');
            that.states = HelperService.states();
            that.buckets = HelperService.lead_buckets();
            that.statuses = HelperService.lead_statuses();
            that.users = HelperService.users;
            that.currentUser = AuthService.user;
            that.filters = angular.copy(defaultFilters);
            if(!that.users)
            {
                fetchUsers();
            }
            fetchLeads();
            C1.setMenu('pipeline');
        });

        C1.showLoader();
        AuthService.loggedIn();

        $('.pipe-show').click(function () {
            var that = $(this);
            that.find('i').toggle();
            that.parent('h3').next('.panel').slideToggle();
        });
}]);
