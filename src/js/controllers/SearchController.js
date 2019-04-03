c1App.controller('SearchController', ['$scope','$http','$log','AuthService','HelperService','DetailModalService','DialDataService',function ($scope, $http, $log, AuthService,HelperService,DetailModalService,DialDataService) {

    $log.log('SearchController');

    var that = this;

    if(C1.page.search.leads.length)
    {
        that.leads = C1.page.search.leads;
        that.filter = C1.page.search.filter;
        that.sortField = C1.page.search.sortField;
        that.sortDir = C1.page.search.sortDir;
    } else {
        that.filter = {};
        that.sortField = 'owner.primary.name.last';
        that.sortDir = '';
    }

    that.showDialModal = function (lead) {
        DialDataService.setLead(lead);
    };

    that.sortOn = function (f) {


        if(that.sortField == f)
        {
            that.sortDir = (that.sortDir == '-')?'':'-';
        } else {
            that.sortDir = '';
            that.sortField = f;
        }

    };

    that.showDetail = function (lead) {
        DetailModalService.setLead(lead);
    };

    $scope.preferWhitePages = function (item) {
        if(item.source == 'Internal')
        {
            return 1;
        } else if(item.source == 'WhitePages')
        {
            return 2;
        } else {
            return 3;
        }
    };

    that.search = function () {
        var ok = false;
        if(that.filter.oldId)
        {
            ok = true;
        }
        if(that.filter.last && that.filter.last.length > 2)
        {
            ok = true;
        }
        if(that.filter.first && that.filter.first.length > 2)
        {
            ok = true;
        }
        if(that.filter.street && that.filter.street.length > 3)
        {
            ok = true;
        }
        if(that.filter.phone && that.filter.phone.length >= 10)
        {
            ok = true;
        }
        if(!ok)
        {
            sweetAlert('Search Warning', 'You must refine your search criteria', 'warning');
            return;
        }
        C1.showLoader();
        $http.post(C1.api_url()+'api/properties/search', {
            filter:that.filter,
            t:AuthService.token
        }, {headers: {'Content-Type': 'application/json'}}).success(function(data){
            that.leads = data.leads;
            C1.hideLoader();
            if(that.leads.length > 500)
            {
                sweetAlert('Search Warning', 'Your search returned more than 500 results.  ONLY 500 are shown.  Please refine your search criteria.', 'warning');
            }
            C1.page.search.leads = that.leads;
            C1.page.search.filter = that.filter;
            C1.page.search.sortField = that.sortField;
            C1.page.search.sortDir = that.sortDir;
        }).error(function(error){
            sweetAlert('Search Error', 'Please try again.', 'error');
            C1.hideLoader();
        });
    };

    $scope.$on('Logged In', function (event, data) {
        $log.log('Logged In');
        C1.hideLoader();
        C1.setMenu('search');
    });

    C1.showLoader();
    AuthService.loggedIn();
}]);
