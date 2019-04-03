c1App.controller('SourceModalController', ['$scope','$log','SourceModalService', 'HelperService',
    function ($scope, $log,SourceModalService, HelperService) {

        $log.log('SourceModalController');
        var that = this;
        that.sources = [];
        that.source = null;

        that.proceed = function () {
            if(!that.source) {
                sweetAlert('Oops', 'You must choose a source option.', 'error');
                return;
            }
            SourceModalService.setSource(that.source);
            $('#sourceModal').modal('hide');
        };

        $scope.$on('lead-source-data-ready', function () {
            that.sources = HelperService.sources();
            that.source = null;
            $('#sourceModal').modal('show');
        });


}]);
