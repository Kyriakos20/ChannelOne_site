c1App.controller('DocsOutController', ['$scope','$rootScope','$log','$http','AuthService',
    'HelperService','DocsOutService',
    function ($scope, $rootScope, $log,$http,AuthService,HelperService,DocsOutService) {

        $log.log('DocsOutController');
        var that = this;
        var modal = null;
        that.lead = null;
        that.form = {};

        that.hideModal = function () {
            that.lead = null;
            modal = $('#docs-out').fadeOut('fast');
        };


        $scope.$on('docs-out-data-ready', function () {
            that.lead = DocsOutService.getLead();

            $('#docs-out').fadeIn();
        });


}]);
