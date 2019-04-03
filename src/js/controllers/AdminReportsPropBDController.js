c1App.controller('AdminReportsPropBDController', ['$scope','$http','$log','AuthService','HelperService',
    function ($scope, $http, $log, AuthService,HelperService) {

        $log.log('AdminReportsPropBDController');

        var that = this;
        that.states = [];

        function fetchReport() {

                $http.post(C1.api_url() + 'api?action=propertyBreakdown', {t: AuthService.token},
                    {headers: {'Content-Type': 'application/json'}}).success(function (data) {
                    that.states = data.states;
                    C1.hideLoader();
                }).error(function (err) {
                    C1.hideLoader();
                    sweetAlert('Error retrieving report', 'error');
                });
            
        }


        $scope.$on('Logged In', function (event, data) {
            $log.log('Logged In');
            fetchReport();
            C1.setMenu('admin');
        });

        C1.showLoader();
        AuthService.loggedIn();
}]);
