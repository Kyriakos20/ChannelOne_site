c1App.controller('TakeAppController', ['$scope','$rootScope','$log','$http','AuthService',
    'HelperService','TakeAppService','DetailModalService',
    function ($scope, $rootScope, $log,$http,AuthService,HelperService,TakeAppService,DetailModalService) {

        $log.log('TakeAppController');
        var that = this;
        var modal = null;
        that.lead = null;
        that.canSaveApp = false;
        that.app = {
            coborrower:{
                name:{},
                incomes:[],
                assets:[]
            },
            borrower:{
                name:{},
                incomes:[],
                assets:[]
            },
            address:{},
            home:{},
            loan:{},
            phones:[],
            emails:[]

        };

        that.hideModal = function () {
            that.lead = null;
            modal = $('#take-app').fadeOut('fast');
        };
        
        that.saveApp = function () {
            $http.post(C1.api_url()+'api/apps/save', {
                property:that.lead._id,
                user:AuthService.user,
                app:that.app,
                t:AuthService.token
            }, {headers: {'Content-Type': 'application/json'}}).success(function(data){
                this.app = data.app;
                if(data.property)
                {
                    that.lead = data.property;
                    DetailModalService.setLead(that.lead);
                }
                $.notify('Application Saved',"success");
            }).error(function(error){
                $.notify('Error saving application',"error");
            });  
        };

        that.print = function () {
            var url = C1.base_url + 'print/app/' + that.app._id;
            var win = window.open(url, '_blank');
            win.focus();
        }


        $scope.$on('take-app-data-ready', function () {
            that.lead = TakeAppService.getLead();
            var a = TakeAppService.getApp();
            if(a)
            {
                that.app = a;
                if(that.app.user == AuthService.user._id)
                {
                    that.canSaveApp = true;
                } else {
                    return false;
                }
            } else {
                that.canSaveApp = true;
                if(that.lead.owner.primary)
                {
                    that.app.borrower.name = that.lead.owner.primary.name;
                }
                if(that.lead.owner.secondary)
                {
                    that.app.coborrower.name = that.lead.owner.secondary.name;
                }
                if(that.lead.address)
                {
                    that.app.address = that.lead.address;
                }
                if(that.lead.mortgage.previousValue)
                {
                    that.app.home.oldValue = that.lead.mortgage.previousValue;
                }
                if(that.lead.mortgageValue.value)
                {
                    that.app.home.zestimate = that.lead.mortgageValue.value;
                }
                if(that.lead.mortgage.rate)
                {
                    that.app.loan.rate = that.lead.mortgage.rate;
                }
                if(that.lead.mortgage.rateType)
                {
                    that.app.loan.type = that.lead.mortgage.rateType;
                }
            }

            $('#take-app').fadeIn();
        });


}]);
