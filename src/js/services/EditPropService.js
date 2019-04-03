c1App.service('EditPropService',['$rootScope', function($rootScope){

    this.lead = null;

    return {
        setLead:function (l) {
            this.lead = l;
            $rootScope.$broadcast('edit-prop-data-ready');
        },
        getLead:function () {
            return this.lead;
        },
        setNewLead: function (l) {
          this.lead = l;
          $rootScope.$broadcast('new-prop-data-ready');
        }
    }
}]);
