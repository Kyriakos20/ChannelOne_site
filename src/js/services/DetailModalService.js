c1App.service('DetailModalService',['$rootScope','$log', function($rootScope,$log){

    this.lead = null;

    return {
        setLead:function (l) {
            this.lead = l;
            $rootScope.$broadcast('detail-data-ready');
        },
        getLead:function () {
            return this.lead;
        },
        updateLead:function (l, props) {
            for(var i = 0; i<props.length;i++)
            {
                $log.log(props[i]);
                this.lead[props[i]] = l[props[i]];
            }
        }
        
    }
}]);
