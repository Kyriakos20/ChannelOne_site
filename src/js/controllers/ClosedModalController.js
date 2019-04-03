c1App.controller('ClosedModalController', ['$scope','$log','ClosedModalService', 'HelperService',
    function ($scope, $log,ClosedModalService, HelperService) {

        $log.log('ClosedModalController');
        var that = this;
        that.iTypes= [];
        that.closed = {mortgage:{}};

        that.proceed = function () {
            
            ClosedModalService.setClosed(that.closed);
            $('#closedModal').modal('hide');
        };

        $scope.$on('closed-loan-data-ready', function () {
            that.closed = {mortgage:{}};
            that.iTypes = HelperService.indexTypes();
            $('#closedModal').modal('show');
        });


}]);
