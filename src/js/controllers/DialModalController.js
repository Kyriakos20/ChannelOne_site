c1App.controller('DialModalController', ['$scope','$rootScope','$log','$http','AuthService',
    'HelperService','DialDataService',
    function ($scope, $rootScope, $log,$http,AuthService,HelperService,DialDataService) {

        $log.log('DialModalController');
        var that = this;
        that.phones = [];
        that.owner = '';
        that.address = '';

        that.callPhone = function (num) {
            $http.post(C1.api_url()+'api?action=evolveDialPhone', {
                number:num,
                user_id:AuthService.user.phones.desk,
                t:AuthService.token
            }, {headers: {'Content-Type': 'application/json'}}).success(function(data){
                $.notify('Dialing...',"success");
            }).error(function(error){
                //$.notify('Not able to load app',"error");
            });
        };

        $scope.$on('dial-data-ready', function () {
            that.phones = DialDataService.getPhones();
            that.owner = DialDataService.getBorrowers();
            that.address = DialDataService.getAddress();
            $('#dialModal').modal('show');
        });


}]);
