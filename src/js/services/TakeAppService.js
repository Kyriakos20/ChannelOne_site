c1App.service('TakeAppService',['$rootScope', function($rootScope){

    this.lead = null;
    this.app = null;

    return {
        setLead:function (l) {
            this.lead = l;
            $rootScope.$broadcast('take-app-data-ready');
        },
        getLead:function () {
            return this.lead;
        },
        setApp:function (l) {
            this.app = l;
        },
        getApp:function () {
            return this.app;
        }
    }
}]);
