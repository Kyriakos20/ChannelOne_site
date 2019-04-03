c1App.service('DocsOutService',['$rootScope', function($rootScope){

    this.lead = null;

    return {
        setLead:function (l) {
            this.lead = l;
            $rootScope.$broadcast('docs-out-data-ready');
        },
        getLead:function () {
            return this.lead;
        }
    }
}]);
