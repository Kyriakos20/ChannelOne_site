c1App.controller('DetailModalController', ['$scope','$rootScope','$log','$http','DetailModalService','AuthService',
    'HelperService','TakeAppService','DocsOutService','DialDataService','SourceModalService', 'ClosedModalService', '$sce',
    function ($scope, $rootScope, $log,$http, DetailModalService,AuthService,HelperService,TakeAppService,DocsOutService,DialDataService,SourceModalService,ClosedModalService,$sce) {

    $log.log('DetailModalController');
    var that = this;
    var modal = null;
    that.lead;
    that.isAdmin = false;
    that.isOwner = false;
    that.canChangeStatus = false;
    that.canChangeOwner = false;
    that.users = [];
    that.statuses = [];
    that.filteredComments = [];
    that.addToCalendarForm = false;
    that.newOwner;
    that.newTud;
    that.newWtd;
    that.newStatus;
    that.isLead = false;
    that.wpResults = null;
    that.weatherAPIKey = "27d62af91ddce30ce81a0cc2c057d375";
    that.weatherAPIURL = "http://api.openweathermap.org/data/2.5/weather";
    that.weatherIconURL = "http://openweathermap.org/img/w/";
    that.weather;
    that.mapAPIKey = "AIzaSyAoKUa2yKLSax4gr0LB1jHoB8PCC4tKttY";
    that.mapAPIURL = "https://www.google.com/maps/embed/v1/place";
    that.mapSrc;

    var getWeather = function(zip) {
        console.log('getting weather');
        $http.get(that.weatherAPIURL+'?zip='+zip+'&units=imperial&APPID='+that.weatherAPIKey)
            .success(function (res) {
                console.log(res);
                that.weather = res;
            })
            .error(function (e) {
                console.log('Weather Error');
            });
    }

    var getMap = function (address) {
        that.mapSrc = $sce.trustAsResourceUrl(that.mapAPIURL + '?key=' + that.mapAPIKey + '&q=' + address.street1 + ', ' + address.city + ' ' + address.state);
    }

    var filterComments = function (n) {
        var ret = [];
        if(that.isAdmin)
        {
            ret = n;
        } else {

            for(var i = 0; i<n.length;i++)
            {
                if(n[i].user == that.currentUser._id)
                {
                    ret.push(n[i]);
                }
            }
        }
        return ret;
    };

    that.takeApp = function () {
        TakeAppService.setApp(null);
        TakeAppService.setLead(that.lead);
    };

    that.showDialModal = function () {
        DialDataService.setLead(this.lead);
    };

    that.docsOut = function () {
        DocsOutService.setLead(that.lead);
    };

    that.hideModal = function () {
        that.lead = null;
        modal = $('#detail-modal').fadeOut('fast');
    };

    that.clearCommentForm = function () {
        that.newComment = null;
        that.showCommentForm = false;
    };

    that.clearCalendarForm = function () {
        that.addToCalendarForm = false;
        that.newCalendarItem = null;
    };

    that.saveComment = function () {
        var toSave = angular.copy(that.newComment);
        $http.post(C1.api_url()+'api/properties/add_comment', {
            property:that.lead._id,
            comment:toSave,
            user:that.currentUser,
            t:AuthService.token
        }, {headers: {'Content-Type': 'application/json'}}).success(function(data){
            that.lead.comments = data.comments;
            that.newComment = null;
            that.showCommentForm = false;
            $.notify('new comment added',"success");
            that.filteredComments = filterComments(that.lead.comments);
        }).error(function(error){
            $.notify('Error saving comment',"error");
        });
    };

    that.deleteComment = function (c) {
        $http.post(C1.api_url()+'api/properties/delete_comment', {
            property:that.lead._id,
            comment:c,
            t:AuthService.token
        }, {headers: {'Content-Type': 'application/json'}}).success(function(data){
            that.lead.comments = data.comments;
            that.newComment = null;
            that.showCommentForm = false;
            $.notify('new comment added',"success");

        }).error(function(error){
            $.notify('Error saving comment',"error");
        });
    };

    that.clearPhoneForm = function () {
        that.newPhone = null;
        that.showAddPhoneForm = false;
    };

    that.savePhone = function () {
        var toSave = angular.copy(that.newPhone);
        $http.post(C1.api_url()+'api/properties/add_phone', {
            property:that.lead._id,
            phone:toSave,
            user:that.currentUser,
            t:AuthService.token
        }, {headers: {'Content-Type': 'application/json'}}).success(function(data){
            that.lead.phones = data.phones;
            that.newPhone = null;
            that.showAddPhoneForm = false;
            $.notify('new phone added',"success");

        }).error(function(error){
            $.notify('Error saving phone',"error");
        });
    };

    that.saveWPPhone = function (p) {
        $http.post(C1.api_url()+'api?action=saveWPPhone', {
            property:that.lead._id,
            phone:p,
            user:that.currentUser,
            t:AuthService.token
        }, {headers: {'Content-Type': 'application/json'}}).success(function(data){
            that.lead.phones = data.phones;
            $.notify('new phone added',"success");

        }).error(function(error){
            $.notify('Error saving phone',"error");
        });
    };
    
    that.updatePhoneStatus = function (phone) {
        var changeTo = (phone.status == 'Good')?'Bad':'Good';
        $http.post(C1.api_url()+'api/properties/phone_status', {
            property:that.lead._id,
            status:changeTo,
            phone:phone,
            user:that.currentUser,
            t:AuthService.token
        }, {headers: {'Content-Type': 'application/json'}}).success(function(data){
            phone.status = changeTo;
            phone.user = that.currentUser;
            phone.userName = that.currentUser.name.last+', '+that.currentUser.name.first;
            $.notify('phone status changed',"success");

        }).error(function(error){
            $.notify('Error changing status',"error");
        });

    };

    that.toggleDNC = function () {
        var changeTo = (that.lead.canCall == 'Yes')?'No':'Yes';
        $http.post(C1.api_url()+'api/properties/change_dnc', {
            property:that.lead._id,
            status:changeTo,
            user:that.currentUser,
            t:AuthService.token
        }, {headers: {'Content-Type': 'application/json'}}).success(function(data){
            that.lead.canCall = data.lead.canCall;
            $.notify('DNC status changed',"success");
            $rootScope.$broadcast('detail-lead-dnc');
        }).error(function(error){
            $.notify('Error changing DNC',"error");
        });

    };

    that.toggleDNM = function () {
        var changeTo = (that.lead.canMail == 'Yes')?'No':'Yes';
        $http.post(C1.api_url()+'api/properties/change_dnm', {
            property:that.lead._id,
            status:changeTo,
            user:that.currentUser,
            t:AuthService.token
        }, {headers: {'Content-Type': 'application/json'}}).success(function(data){
            that.lead.canMail = data.lead.canMail;
            $.notify('DNM status changed',"success");
            $rootScope.$broadcast('detail-lead-dnm');
        }).error(function(error){
            $.notify('Error changing DNM',"error");
        });

    };

    that.tud = function () {
        var tud = {
            reason:that.newTud,
            type:'TUD',
            date:Date.now(),
            user:that.currentUser,
            userName:that.currentUser.name.first+' '+that.currentUser.name.last
        };
        $http.post(C1.api_url()+'api/properties/turn_down', {
            property:that.lead._id,
            turnDown:tud,
            t:AuthService.token
        }, {headers: {'Content-Type': 'application/json'}}).success(function(data){
            that.lead.turnDowns.push(tud);
            $.notify('TUD success',"success");
            $rootScope.$broadcast('detail-lead-turned-down');
        }).error(function(error){
            $.notify('Error processing TUD',"error");
        });
    };

    that.wtd = function () {
        var wtd = {
            reason:that.newWtd,
            date:Date.now(),
            type:'WTD',
            user:that.currentUser,
            userName:that.currentUser.name.first+' '+that.currentUser.name.last
        };
        $http.post(C1.api_url()+'api/properties/turn_down', {
            property:that.lead._id,
            turnDown:wtd,
            t:AuthService.token
        }, {headers: {'Content-Type': 'application/json'}}).success(function(data){
            that.lead.turnDowns.push(wtd);
            $.notify('WTD success',"success");
            $rootScope.$broadcast('detail-lead-turned-down');
        }).error(function(error){
            $.notify('Error processing WTD',"error");
        });
    };

    that.claim = function () {
        if(that.lead.pipelineOwner)
        {
            sweetAlert('Claim Error', 'You cannot claim this lead.', 'error');
            return;
        }

        SourceModalService.setLead(that.lead);
    };

    $scope.$on('lead-with-source-ready', function () {
        $http.post(C1.api_url()+'api/leads/claim', {
            property:SourceModalService.getLead()._id,
            source:SourceModalService.getSource(),
            user:that.currentUser,
            t:AuthService.token
        }, {headers: {'Content-Type': 'application/json'}}).success(function(data){
            that.lead = data.property;
            $.notify('Claim success',"success");
            $rootScope.$broadcast('detail-lead-claim');
        }).error(function(error){
            $.notify('Not able to claim',"error");
        });
    });

    $scope.$on('lead-with-closed-ready', function() {
        $http.post(C1.api_url()+'api/properties/change_status_closed', {
            property:that.lead._id,
            user:that.currentUser,
            closed:ClosedModalService.getClosed(),
            t:AuthService.token
        }, {headers: {'Content-Type': 'application/json'}}).success(function(data){
            that.lead = data.property;
            DetailModalService.updateLead(that.lead, ['status','statuses','bucket']);
            $.notify('Status change success',"success");
            $rootScope.$broadcast('detail-lead-claim');
        }).error(function(error){
            $.notify('Not able to change status',"error");
        });
    });



    that.claimLead = function () {

        if(that.lead.pipelineOwner)
        {
            sweetAlert('Claim Error', 'You cannot claim this lead.', 'error');
            return;
        }
        $http.post(C1.api_url()+'api/leads/claim_lead', {
            property:that.lead._id,
            user:that.currentUser,
            t:AuthService.token
        }, {headers: {'Content-Type': 'application/json'}}).success(function(data){
            that.lead.status = 'Lead';
            that.lead.bucket = 'Leads';
            $.notify('Claim Lead success',"success");
            $rootScope.$broadcast('detail-lead-claim-lead');
        }).error(function(error){
            $.notify('Not able to claim',"error");
        });

    };

    that.changeStatus = function () {

        if(that.newStatus == 'Closed')
        {
            ClosedModalService.setLead(that.lead);
            return false;
        }

        $http.post(C1.api_url()+'api/properties/change_status', {
            property:that.lead._id,
            user:that.currentUser,
            status:that.newStatus,
            t:AuthService.token
        }, {headers: {'Content-Type': 'application/json'}}).success(function(data){
            that.lead = data.property;
            DetailModalService.updateLead(that.lead, ['status','statuses','bucket']);
            $.notify('Status change success',"success");
            $rootScope.$broadcast('detail-lead-claim');
        }).error(function(error){
            $.notify('Not able to change status',"error");
        });
    };

    that.changeOwner = function () {
        $http.post(C1.api_url()+'api/properties/change_owner', {
            property:that.lead._id,
            user:that.currentUser,
            owner:that.newOwner,
            t:AuthService.token
        }, {headers: {'Content-Type': 'application/json'}}).success(function(data){
            that.lead = data.property;
            $.notify('Owner change success',"success");
            $rootScope.$broadcast('detail-lead-claim');
        }).error(function(error){
            $.notify('Not able to change owner',"error");
        });
    };

    that.changeColor = function (c) {
        $http.post(C1.api_url()+'api/properties/change_color', {
            property:that.lead._id,
            user:that.currentUser,
            color:c,
            t:AuthService.token
        }, {headers: {'Content-Type': 'application/json'}}).success(function(data){
            that.lead = data.property;
            $log.log(that.lead);
            DetailModalService.updateLead(that.lead, ['colors']);
            $.notify('Color change success',"success");
            $rootScope.$broadcast('detail-color-change');
        }).error(function(error){
            $.notify('Not able to change color',"error");
        });
    };

    that.editApp = function (app) {
        $http.post(C1.api_url()+'api/apps/load', {
            app:app,
            t:AuthService.token
        }, {headers: {'Content-Type': 'application/json'}}).success(function(data){
            var app = data.app;
            TakeAppService.setApp(app);
            TakeAppService.setLead(that.lead);
        }).error(function(error){
            $.notify('Not able to load app',"error");
        });
    };

    that.canViewApplication = function (app) {
        if(that.isAdmin)
        {
            return true;
        } else if(app.user == that.currentUser._id)
        {
            return true;
        } else if(AuthService.teamMembers.indexOf(app.user)>=0) {
            return true;
        } else {
            return false;
        }
    };

    that.homesnapLink = function (l) {
        if(l)
        {
            return link = "http://www.homesnap.com/search?q="+encodeURI(l.address.street1+', '+l.address.zip);
        } else {
            return '';
        }
    };

    that.getWP = function () {

        C1.showLoader();

        $http.post(C1.api_url() + 'api?action=fetchWhitePages', {
            propertyId: that.lead._id,
            user: that.currentUser,
            t: AuthService.token
        }, {headers: {'Content-Type': 'application/json'}}).success(function (data) {
            C1.hideLoader();
            that.wpResults = data.results;
        }).error(function (error) {
            C1.hideLoader();
            sweetAlert('Oops!', 'There was a problem retrieving your data.', 'error');
        });
    }
        
    var checkHasLead = function () {

        $http.post(C1.api_url()+'api?action=checkHasLead', {
            property_id:that.lead._id,
            user_id:that.currentUser._id,
            t:AuthService.token
        }, {headers: {'Content-Type': 'application/json'}}).success(function(data){
            that.isLead = data.has;
        }).error(function(error){
            //$.notify('Not able to load app',"error");
        });

    };

    var fetchUsers = function() {
        if(!HelperService.users)
        {
            $http.get(C1.api_url()+'api/users/simple').success(function(data) {
                HelperService.users = data.users;
                that.users = data.users;
            }).error(function(err) {
                sweetAlert('Users List Error', 'error');
            });
        } else {
            that.users = HelperService.users;
        }
    };

    $scope.preferWhitePages = function (item) {
        if(item.source == 'Internal')
        {
            return 1;
        } else if(item.source == 'WhitePages')
        {
            return 2;
        } else {
            return 3;
        }
    };

    $scope.$on('detail-to-close', function () {
        that.hideModal();
    });


    $scope.$on('detail-data-ready', function () {
        that.lead = DetailModalService.lead;
        modal = $('#detail-modal').fadeIn();
        that.users = HelperService.users;
        if(!that.users)
        {
            fetchUsers();
        }
        that.statuses = HelperService.lead_statuses();
        that.isAdmin = AuthService.isAdmin;
        that.currentUser = AuthService.user;
        that.filteredComments = filterComments(that.lead.comments);
        that.tuds = HelperService.tud_statuses();
        that.wtds = HelperService.wtd_statuses();
        that.isLead = false;
        that.wpResults = null;
        if(that.lead.pipelineOwner)
        {
            that.isOwner = that.lead.pipelineOwner._id == that.currentUser._id;
        } else {
            that.isOwner = false;
            checkHasLead();
        }

        if(that.isOwner || that.isAdmin)
        {
            that.canChangeStatus = true;
            that.canChangeOwner = true;
        } else if(that.lead.pipelineOwner && AuthService.teamMembers.indexOf(that.lead.pipelineOwner._id)>=0) {
            that.canChangeStatus = true;
            that.canChangeOwner = true;
        } else {
            that.canChangeStatus = false;
            that.canChangeOwner = false;
        }
        if(that.lead.address.zip) {
            getWeather(that.lead.address && that.lead.address.zip);
            getMap(that.lead.address);
        }
        /*
        $scope.$watchCollection(function () {
            console.log('watched');
            return (that.lead && that.lead.comments)?that.lead.comments:[];
        }, function (n, o) {
            if(n)
            {
                that.filteredComments = [];
                if(that.isAdmin)
                {
                    that.filteredComments = n;
                } else {
                    console.log('going to loop');
                    for(var i = 0; i<n.length;i++)
                    {
                        console.log(n[i]);
                        console.log(that.currentUser._id);
                        if(n[i].user == that.currentUser._id)
                        {
                            that.filteredComments.push(n[i]);
                        }
                    }
                }
            }
        });
        */

    });


    that.weather = null;
    that.mapSrc = null;

}]);
