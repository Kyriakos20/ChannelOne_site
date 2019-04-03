c1App.controller('HomeController', ['$scope','$http','$log','AuthService', function ($scope, $http, $log, AuthService) {

    $log.log('HomeController');

    var that = this;
    that.callTotals = [];
    that.missedCalls = [];
    var timer = null;
    var timer2 = null;
    that.yorkBranch = false;

    function initTimer() {
        if(!timer)
        {
            getCallTotals();
            timer = setInterval(function () {
                getCallTotals();
            }, 90000);
        }

        if(!timer2)
        {
            getMissedCalls();
            timer2 = setInterval(function () {
                getMissedCalls();
            }, 180000);
        }
    };

    function getPropertyStats() {

        if(timer)
        {
            return;
        }
        $http.get(C1.api_url()+'api?action=basicPropertyStats&id='+that.currentUser._id).success(function(data) {
            var ctx = $('#lead-dist-chart');
            var labels = [];
            var vals = [];
            data.stats.map(function (o) {
                labels.push(o._id.bucket);
                vals.push(o.count);
            });
            // console.log(labels);
            // console.log(vals);
            var bpChart = new Chart(ctx, {
                type:"doughnut",
                data:{
                    labels:labels,
                    datasets:[{
                        data:vals,
                        backgroundColor:[
                            '#C0392B',
                            '#9B59B6',
                            '#2980B9',
                            '#1ABC9C',
                            '#27AE60',
                            '#F1C40F',
                            '#E67E22',
                            '#E74C3C',
                            '#8E44AD',
                            '#3498DB',
                            '#16A085',
                            '#2ECC71',
                            '#F39C12',
                            '#D35400'
                        ]
                    }]
                },
                options:{}
            });
        }).error(function(err) {
            sweetAlert('Unable to load lead distribution', 'error');
        }).then(initTimer());

    };

    function getMissedCalls() {
        if(that.yorkBranch) { return; }
        $http.post(C1.api_url()+'api?action=getMissedCalls2', {user:that.currentUser,t:AuthService.token}).success(function(data) {
            that.missedCalls = data.results;
        }).error(function(err) {
            sweetAlert('Unable to load missed calls', 'error');
        });
    }

    that.deleteMissedCall = function(c, i) {
        $http.post(C1.api_url()+'api?action=deleteMissedCall', {call:c,t:AuthService.token}).success(function(data) {
            $.notify('Missed Call Deleted', 'info');
            that.missedCalls.splice(i, 1);
        }).error(function(err) {
            $.notify('oops, could not delete call.', 'error');
        });
    }


    function getCallTotals() {
        if(that.yorkBranch) { return; }
        $http.post(C1.api_url()+'api?action=getCallTotals2', {t:AuthService.token}).success(function(data) {
            $log.log('call totals received');
            that.callTotals = data.results;
        }).error(function(err) {
            sweetAlert('Unable to load call totals', 'error');
        });
    };

        $scope.$on('$destroy', function () {
           clearInterval(timer);
           timer = null;
            clearInterval(timer2);
            timer2 = null;
        });


    $scope.$on('Logged In', function (event, data) {
        $log.log('Logged In');
        C1.hideLoader();
        C1.setMenu('dashboard');
        that.currentUser = AuthService.user;
        if(that.currentUser.office && that.currentUser.office == 'York 1')
        {
            that.yorkBranch = true;
        }
        getPropertyStats();
    });

    AuthService.loggedIn();
}]);
