c1App.controller('EditPropController', ['$scope','$rootScope','$log','$http','AuthService',
    'HelperService','EditPropService',
    function ($scope, $rootScope, $log,$http,AuthService,HelperService,EditPropService) {

        $log.log('EditPropController');
        var that = this;
        that.states = HelperService.states();
        that.lead = {};

        that.cancel = function() {
            that.lead = {};
            $('#edit-prop').fadeOut();
        };

        that.save = function () {
          $log.log('saving');
          C1.showLoader();
          $http.post(C1.api_url()+'api?action=saveNewProp', {
              property: that.lead,
              user: AuthService.user,
              t:AuthService.token
          }, {headers: {'Content-Type': 'application/json'}}).success(function(data){
              var newLead = data.property;
              EditPropService.setNewLead(newLead);
              C1.hideLoader();
              $.notify('new lead added', 'success');
              that.lead = {};
              $('#edit-prop').fadeOut();
          }).error(function(error){
              sweetAlert('Oops', 'That lead could not be saved.  Make sure the address is not already in the system.', 'error');
              C1.hideLoader();
          });
        };

        $scope.$on('edit-prop-data-ready', function () {
            $('#edit-prop').fadeIn();
        });

}]);
