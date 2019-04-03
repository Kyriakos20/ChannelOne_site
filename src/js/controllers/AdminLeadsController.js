c1App.controller('AdminLeadsController', ['$scope','$http','$log','AuthService','HelperService',
    'DetailModalService','DialDataService', function ($scope, $http, $log, AuthService,HelperService, DetailModalService,DialDataService) {

    $log.log('AdminLeadsController');

    var that = this;
    that.selectedProps = [];
    that.assignModal = {};
    that.states = [];
    that.buckets = [];
    that.statuses = [];
    that.leads = [];
    that.meta = {
        pages:0,
        page:1,
        perPage:25
    };
    that.filters = {};
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
        onlyPhones:'No',
        doNot:'none',
        pipelineStatuses:[],
        firstTime: 'Hecm'
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

    that.processAssignments = function () {

        $('#assignModal').modal('hide');
        C1.showLoader();
        if(that.assignModal.type == 'all' && that.meta.total > 10000)
        {
            sweetAlert('Assignment Error', 'You are attempting to assign over 10,000 leads.', 'error');
            C1.hideLoader();
            return;
        }
        if(!that.assignModal.user) {
            sweetAlert('Assignment Error', 'You must select a user.', 'error');
            C1.hideLoader();
            return;
        }
        var sel = angular.copy(that.selectedProps);
        clearSelectedProps();
        var ass = angular.copy(that.assignModal);
        that.assignModal = {};
        $http.post(C1.api_url()+'api/leads/assign', {
            selected:sel,
            assignData:ass,
            filters:that.filters,
            t:AuthService.token
        }, {headers: {'Content-Type': 'application/json'}}).success(function(data){
            sweetAlert('Assignment Success', 'Your assignments are being process.   Large batches may take a minute to complete.', 'success');
            C1.hideLoader();
        }).error(function(error){
            sweetAlert('Assignment Error', 'Please try again.', 'error');
            C1.hideLoader();
        });
    };

    that.showDialModal = function (lead) {
        DialDataService.setLead(lead);
    };

    that.assign = function(which) {

        if(which == 'selected' && !that.selectedProps.length)
        {
            sweetAlert('Assignment Error', 'Please select some leads to assign.', 'error');
            return;
        }

        that.assignModal.title = 'Assign to User';
        that.assignModal.user = null;
        that.assignModal.type = which;
        that.assignModal.assign = true;
        $('#assignModal').modal('show');
    };

    that.unassign = function(which) {

        if(which == 'selected' && !that.selectedProps.length)
        {
            sweetAlert('Assignment Error', 'Please select some leads to assign.', 'error');
            return;
        }

        that.assignModal.title = 'Remove from User';
        that.assignModal.user = null;
        that.assignModal.type = which;
        that.assignModal.assign = false;
        $('#assignModal').modal('show');
    };

    that.export = function () {
        C1.showLoader();
        $http.post(C1.api_url()+'api/properties/export', {
            filters:that.filters,
            t:AuthService.token
        }, {headers: {'Content-Type': 'application/json'}}).success(function(data){
            if(data.path)
            {
                location.href=C1.api_url()+data.path;
            }
            C1.hideLoader();
        }).error(function(error){
            sweetAlert('Export Error', 'Please try again.', 'error');
            C1.hideLoader();
        });
    };

    that.showDetail = function (lead) {
        DetailModalService.setLead(lead);
    };

    var clearSelectedProps = function () {
        that.selectedProps = [];
        $('.assignbox').prop('checked',false);
    };

    var fetchLeads = function() {
        C1.showLoader();
        $http.post(C1.api_url()+'api/properties/all', {
            filters:that.filters,
            t:AuthService.token
        }, {headers: {'Content-Type': 'application/json'}}).success(function(data){
            that.leads = data.leads;
            that.meta = data.meta;
            that.meta.totalPages = Math.ceil(that.meta.total/that.meta.perPage);
            C1.hideLoader();
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

    var fetchCounties = function() {
        if(!HelperService.counties)
        {
            $http.get(C1.api_url()+'api/counties/simple').success(function(data) {
                HelperService.counties = data.counties;
                parseCounties();
                C1.hideLoader();
            }).error(function(err) {
                sweetAlert('Counties List Error', 'error');
            });
        } else {
            C1.hideLoader();
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
                case 'firstTime':
                    that.filters.firstTime = angular.copy(defaultFilters.firstTime);
                    break;
            }
        });
    });

    $scope.$on('Logged In', function (event, data) {
        $log.log('Logged In');

        that.states = HelperService.states();
        that.buckets = HelperService.lead_buckets();
        var adminStatuses = angular.copy(HelperService.lead_statuses());
        adminStatuses.push('TUD');
        adminStatuses.push('WTD');
        that.statuses = adminStatuses;

        that.users = HelperService.users;
        if(!that.users)
        {
            fetchUsers();
        }
        fetchCounties();
        C1.setMenu('admin');

    });

    that.filters = angular.copy(defaultFilters);
    C1.showLoader();
    AuthService.loggedIn();

    $('#filter_state').on('click','.county-toggle', function () {
        var row = $(this).closest('.row');
        row.find('.county-selector').toggle('slide');
    });
}]);
