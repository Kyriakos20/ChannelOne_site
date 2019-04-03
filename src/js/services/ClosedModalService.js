c1App.service('ClosedModalService',['$rootScope', function($rootScope){

    this.lead = null;
    this.closed = null;

    return {
        setLead:function (l) {
            this.lead = l;
            $rootScope.$broadcast('closed-loan-data-ready');
        },
        getLead:function () {
            return this.lead;
        },
        getClosed:function () {
            return this.closed;
        },
        setClosed: function (s) {
          this.closed = s;
          $rootScope.$broadcast('lead-with-closed-ready');
        }
    }
}]);
