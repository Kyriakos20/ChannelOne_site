c1App.controller('LeadsController', ['$scope','$rootScope','$http','$log','AuthService','HelperService',
    'DetailModalService','DialDataService','EditPropService', function ($scope, $rootScope, $http, $log, AuthService,HelperService, DetailModalService,DialDataService,EditPropService) {

    $log.log('LeadsController');

    var that = this;
    that.selectedProps = [];
    that.states = [];
    that.viewUser;

    if(C1.page.leads.leads.length)
    {
        that.leads = C1.page.leads.leads;
        that.meta = C1.page.leads.meta;
        that.filters = C1.page.leads.filters;
    } else {
        that.leads = [];
        that.meta = {
            pages:0,
            page:1,
            perPage:25
        };
        that.filters = {};
    }
    var defaultFilters = {
        page:1,
        perPage:25,
        sortOn:'owner.primary.name.last',
        sortDir:'asc',
        states:[],
        counties:{},
        loanType:'Both',
        closingDate:{
            start:'1/1/1975',
            end:moment().format('M/D/YYYY')
        },
        mtgAmount:{
            min:0,
            max:2500000
        },
        prevValue:{
            min:0,
            max:2500000
        },
        zestimate:{
            min:0,
            max:2500000
        },
        equity:{
            min:0,
            max:1000000
        },
        equityPercent:{
            min:0,
            max:1000
        },
        doNot:'notdnc',
        pipelineStatuses:['Lead','WTD','TUD']
    };

    that.showEditPropModal = function() {
      $rootScope.$broadcast('edit-prop-data-ready');
    };

    that.showDialModal = function (lead) {
        DialDataService.setLead(lead);
    };

    that.refreshLeads = function() {
        $log.log('refresh Leads');
        that.page = 1;
        fetchLeads();
    };

    that.pageStart = function() {
        that.filters.page = 1;
        fetchLeads();
    };

    that.pageEnd = function() {
        that.filters.page = that.meta.totalPages;
        fetchLeads();
    };

    that.pageNext = function() {
        that.filters.page = that.meta.page + 1;
        fetchLeads();
    };

    that.pagePrev = function() {
        that.filters.page = that.meta.page - 1;
        fetchLeads();
    };

    that.changeFilterState = function(st) {

    };

    that.clearFilters = function() {
        $('.filter-panel').fadeOut('fast');
        that.filters = angular.copy(defaultFilters);
    };

    that.showDetail = function (lead) {
        DetailModalService.setLead(lead);
    };

    that.gotoPage = function () {
        if(this.selectedPage > 0 && this.selectedPage <= this.meta.totalPages)
        {
            this.filters.page = this.selectedPage;
            fetchLeads();
        } else {
            sweetAlert('Page Error', 'Please choose a valid page', 'error');
        }
    };

    that.saveFilter = function () {
        swal({
            title: "Save Filter",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: true,
            animation: "slide-from-top",
            inputPlaceholder: "Enter Name"
        }, function (inputValue) {
            if (inputValue === false) return false;
            if (inputValue === "") {
                swal.showInputError("You need to give it a name!");
                return false
            }
            var tosave = angular.copy(that.filters);
            $http.post(C1.api_url()+'api?action=saveFilter', {
                filter:tosave,
                filterName:inputValue,
                user:that.currentUser,
                t:AuthService.token
            }, {headers: {'Content-Type': 'application/json'}}).success(function(data){
                $.notify('Filter Saved', 'info');
                HelperService.userFilters.push(data.filter);
                that.userFilters = HelperService.userFilters;
            }).error(function(error){
                sweetAlert('Oops', 'We could not save that.', 'error');
            });


            $.notify(that.meta.total+' leads found', 'info');
        });
    };

    that.loadSavedFilter = function (filt) {

        that.filters = angular.copy(filt.params);
        that.filters.user = null;
        fetchLeads();
    };

    that.removeSavedFilter = function (f,i) {
        $http.post(C1.api_url()+'api?action=removeFilter', {
            filter:f,
            t:AuthService.token
        }, {headers: {'Content-Type': 'application/json'}}).success(function(data){
            $.notify('Filter Removed', 'info');
            that.userFilters = HelperService.userFilters.splice(i, 1);
        }).error(function(error){
            sweetAlert('Oops', 'We could not remove that.', 'error');
        });
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

    var clearSelectedProps = function () {
        that.selectedProps = [];
        $('.assignbox').prop('checked',false);
    };

    var fetchLeads = function() {
        $log.log('fetching');
        C1.showLoader();
        that.filters.user = (that.viewUser) ? that.viewUser : AuthService.user;
        $http.post(C1.api_url()+'api/properties/all', {
            filters:that.filters,
            t:AuthService.token
        }, {headers: {'Content-Type': 'application/json'}}).success(function(data){
            that.leads = data.leads;
            that.meta = data.meta;
            that.meta.totalPages = Math.ceil(that.meta.total/that.meta.perPage);
            C1.page.leads.leads = that.leads;
            C1.page.leads.meta = that.meta;
            C1.page.leads.filters = that.filters;
            C1.hideLoader();
            $.notify(that.meta.total+' leads found', 'info');
        }).error(function(error){
            sweetAlert('Access Denied', 'Invalid credentials', 'error');
            C1.hideLoader();
        });
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

    var fetchUserFilters = function () {
        if(!HelperService.userFilters) {
            $http.post(C1.api_url()+'api?action=getFilters', {
                t:AuthService.token,
                user:that.currentUser
            },{headers: {'Content-Type': 'application/json'}}
            ).success(function(data) {
                HelperService.userFilters = data.filters;
                that.userFilters = HelperService.userFilters;
            }).error(function(err) {
                sweetAlert('Users List Error', 'error');
            });
        }
    }

    var fetchCounties = function() {
        if(!HelperService.counties)
        {
            $http.get(C1.api_url()+'api/counties/simple').success(function(data) {
                HelperService.counties = data.counties;
                parseCounties();
                if(!that.leads.length)
                {
                    fetchLeads();
                } else {
                    C1.hideLoader();
                }

            }).error(function(err) {
                sweetAlert('Counties List Error', 'error');
            });
        } else {
            if(!that.leads.length)
            {
                fetchLeads();
            } else {
                C1.hideLoader();
            }
            parseCounties();

        }
    };

    var parseCounties = function() {
        that.counties = {};
        var c = HelperService.counties;
        for(var i = 0; i< c.length; i++)
        {
            that.counties[c[i]._id] = c[i].counties;
        }
    };

    $('.sort-btn').on('click', function() {
        var ths = $(this);
        var str = ths.data('sort');
        if(str == that.filters.sortOn)
        {
            that.filters.sortDir = (that.filters.sortDir == 'asc')?'desc':'asc';
        } else {
            that.filters.sortDir = 'asc';
        }
        that.filters.sortOn = str;
        that.filters.page = 1;
        ths.parent().siblings('th').removeClass('active');
        ths.parent().addClass('active');

        fetchLeads();
    });

    $('#selectAllStatuses').on('change', function () {
        var thebox = $(this);
        var tocheck = thebox.prop('checked');
        that.filters.pipelineStatuses = [];
        if(tocheck)
        {
            that.filters.pipelineStatuses = angular.copy(that.statuses);
        }
        $('.statusBox').prop('checked',tocheck);
    });

    $('#filter_state').bind('change','.county-all', function(e) {
        var thebox = $(e.target);
        if(!thebox.hasClass('county-all'))
        {
            return;
        }
        var tocheck = thebox.prop('checked');
        var state = thebox.data('state');
        that.filters.counties[state] = [];
        if(tocheck)
        {
            var all = that.counties[state];
            for(var i = 0; i < all.length; i++)
            {
                var it = all[i];
                that.filters.counties[state].push(it);
            }
        }
        thebox.closest('.row').children('div').last().find('input[type=checkbox]').prop('checked',tocheck);
    });

    $('#filter-list-group').children('button').click(function () {
        var targ = $(this).data('target');
        $('#'+targ).fadeIn('fast');
    });

    $('.filter-panel-close').click(function () {
        var targ = $(this).data('target');
        $(this).closest('.filter-panel').fadeOut('fast');
        $scope.$apply(function () {
            switch(targ)
            {
                case 'leadId':
                    that.filters.leadId = null;
                    break;
                case 'lastName':
                    that.filters.lastName = null;
                    break;
                case 'firstName':
                    that.filters.firstName = null;
                    break;
                case 'street':
                    that.filters.street = null;
                    break;
                case 'city':
                    that.filters.city = null;
                    break;
                case 'states':
                    $('.county-all, .countyBox').prop('checked',false);
                    that.filters.states = angular.copy(defaultFilters.states);
                    that.filters.counties = angular.copy(defaultFilters.counties);
                    break;
                case 'zip':
                    that.filters.zip = null;
                    break;
                case 'phone':
                    that.filters.phone = null;
                    break;
                case 'loanType':
                    that.filters.loanType = 'Both';
                    break;
                case 'mtgAmount':
                    that.filters.mtgAmount = angular.copy(defaultFilters.mtgAmount);
                    break;
                case 'closingDate':
                    that.filters.closingDate = angular.copy(defaultFilters.closingDate);
                    break;
                case 'prevValue':
                    that.filters.prevValue = angular.copy(defaultFilters.prevValue);
                    break;
                case 'zestimate':
                    that.filters.zestimate = angular.copy(defaultFilters.zestimate);
                    break;
                case 'equity':
                    that.filters.equity = angular.copy(defaultFilters.equity);
                    break;
                case 'equityPercent':
                    that.filters.equityPercent = angular.copy(defaultFilters.equityPercent);
                    break;
                case 'pipelineStatuses':
                    that.filters.pipelineStatuses = angular.copy(defaultFilters.pipelineStatuses);
                    break;
                case 'doNot':
                    that.filters.doNot = angular.copy(defaultFilters.doNot);
                    break;
                case 'user':
                    that.filters.user = null;
                    break;
            }
        });
    });

    $scope.usersComments = function () {
        return function (comment) {
            return comment.user == that.currentUser._id;
        };
    };

    $scope.$on('new-prop-data-ready', function () {
        var lead = EditPropService.getLead();
        that.leads.unshift(lead);
    });

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
        that.leads.splice(i,1);
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
        if(!that.users)
        {
            fetchUsers();
        }
        fetchCounties();
        fetchUserFilters();
        C1.setMenu('leads');
    });
    if(!that.leads.length)
    {
        that.filters = angular.copy(defaultFilters);
    }

    C1.showLoader();
    AuthService.loggedIn();

    $('#filter_state').on('click','.county-toggle', function () {
        var row = $(this).closest('.row');
        row.find('.county-selector').toggle('slide');
    });
}]);
