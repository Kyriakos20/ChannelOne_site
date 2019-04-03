c1App.service('SourceModalService',['$rootScope', function($rootScope){

    this.lead = null;
    this.source = null;

    return {
        setLead:function (l) {
            this.lead = l;
            $rootScope.$broadcast('lead-source-data-ready');
        },
        getLead:function () {
            return this.lead;
        },
        getSource:function () {
            return this.source;
        },
        setSource: function (s) {
          this.source = s;
          $rootScope.$broadcast('lead-with-source-ready');
        }
    }
}]);
