c1App.controller('AdminDashboardController', ['$scope','$http','$log','AuthService', 'DetailModalService', function ($scope, $http, $log, AuthService, DetailModalService) {


    $log.log('AdminDashboardController');

    var that = this;
    that.callTotals = [];
    that.centerTotals = [];
    that.dogHouse = [];
    var timer = null;
    var timer2 = null;

    that.showDetail = function (lead) {
        $http.post(C1.api_url()+'api?action=getProperty', {id:lead._id, t:AuthService.token}).success(function(data) {
            DetailModalService.setLead(data.property);
        }).error(function(err) {
            sweetAlert('Error loading property', 'error');
        });
    };

    that.recycle = function (lead) {
        $http.post(C1.api_url()+'api?action=recycleProperty', {id:lead._id, user:AuthService.user, t:AuthService.token}).success(function(data) {
            var dog = that.dogHouse.findIndex(function (o) {
                return o._id = lead._id;
            });
            that.dogHouse.splice(dog, 1);
            $.notify("Recycled", "success");
        }).error(function(err) {
            sweetAlert('Error loading property', 'error');
        });
    };

    $scope.$on('detail-lead-turned-down', function () {
        var lead = DetailModalService.getLead();
        var dog = that.dogHouse.findIndex(function (o) {
            return o._id = lead._id;
        });
        that.dogHouse.splice(dog, 1);
    });


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
            getCenterTotals();
            timer2 = setInterval(function () {
                getCenterTotals();
            }, 90000);
        }
    };

    function getDogHouse() {
        $http.get(C1.api_url()+'api?action=doghouseAged').success(function(data) {
            $log.log('doghouse received');
            that.dogHouse = data.properties;
        }).error(function(err) {
            sweetAlert('Unable to load aged leads', 'error');
        });
    };

    function getPropertyStats() {

        $http.get(C1.api_url()+'api?action=basicPropertyStats').success(function(data) {
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
        }).then(function () {
            getDogHouse();
            initTimer();
        });

    };

    function getCenterTotals() {
        $http.post(C1.api_url()+'api?action=getCenterTotals', {t:AuthService.token}).success(function(data) {
            $log.log('center totals received');
            that.centerTotals = data.results;
        }).error(function(err) {
            sweetAlert('Unable to load user call center data', 'error');
        });
    };

    function getCallTotals() {
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
        C1.setMenu('admin');
        getPropertyStats();
    });

    AuthService.loggedIn();
}]);
