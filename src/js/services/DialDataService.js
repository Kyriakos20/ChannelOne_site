c1App.factory('DialDataService', ['$rootScope','$log','$cookies','$http', function ($rootScope, $log, $cookies,$http) {
    return {
        lead:{},
        getPhones: function () {
            return this.lead.phones;
        },
        getAddress:function () {
            return this.lead.address.street1+', '+this.lead.address.city+', '+this.lead.address.state+' '+this.lead.address.zip;
        },
        getBorrowers:function () {
            return this.lead.owner.primary.name.first+' '+this.lead.owner.primary.name.last;
        },
        setLead:function (lead) {
            this.lead = lead;
            $rootScope.$broadcast('dial-data-ready');
        }
    };
}]);
