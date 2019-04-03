C1 = {
    base_url : document.getElementById('base_url').value,

    api_url:function () {
        var ret = this.base_url;
        switch(this.base_url)
        {
            case 'http://localhost:3000/':
                ret = 'http://localhost:8080/';
                break;
            case 'https://localhost:3000/':
                ret = 'https://localhost:8080/';
                break;
            case 'http://channelone.work/':
                ret = 'http://channelone.work:8080/';
                break;
            case 'https://channelone.work/':
                ret = 'https://channelone.work:8080/';
                break;

        }
        return ret;
    },
    showLoader:function(){
        console.log('loader');
        document.getElementById('loader').style.display = 'block';
    },
    hideLoader:function(){
        document.getElementById('loader').style.display = 'none';
    },
    systemError:function(){
        alert('System Error');
    },
    setMenu:function (which) {
        $('#main-nav').children('li').removeClass('active');
        $('li[data-link="'+which+'"]').addClass('active');
    },
    page:{
        search:{
            filter:{},
            sortField:'owner.primary.name.last',
            sortDir:'',
            leads:[]
        },
        leads:{
            leads:[],
            meta:{},
            filters:{}
        }
    },
    /*
     define('EVOLVE_USERNAME', 'ga-0001010097@voip.evolveip.net');
     define('EVOLVE_PASSWORD', '$79vn337t7qH6Q^Q6Hq7t723nv97$');
     define('EVOLVE_URL', 'https://ews2.voip.evolveip.net');
     */
    evolve:{
        username:'ga-0001010097@voip.evolveip.net',
        password:'$79vn337t7qH6Q^Q6Hq7t723nv97$',
        url:'https://ews2.voip.evolveip.net',
        cleanPhone:function (number) {
            return number.replace(/-|\.|_/g,'');
        },
        
        call:function (user,number) {
            var number = parseInt(C1.evolve.cleanPhone(number));
            var userNum = parseInt('1'+C1.evolve.cleanPhone(user.phones.desk));

            /*
            var request = require('request');
            request.post({
                url:"/com.broadsoft.xsi-actions/v2.0/user/"+userNum+"/calls/new?address="+number,
                form:{
                    username:C1.evolve.username,
                    password:C1.evolve.password
                }
            }, function (err, resp, body) {
                $log.log
            });
            */
        }
    }
};

var c1App = angular.module('c1App',['ngRoute','ngCookies','checklist-model','ui-rangeSlider','720kb.datepicker']);

c1App.config(function($routeProvider){
    $routeProvider
        .when('/', {
            templateUrl:'templates/home.html',
            controller:'HomeController as cntrl'
        }).when('/search', {
            templateUrl:'templates/search.html',
            controller:'SearchController as cntrl'
        }).when('/leads', {
            templateUrl:'templates/leads.html',
            controller:'LeadsController as cntrl'
        }).when('/pipeline', {
            templateUrl:'templates/pipeline.html',
            controller:'PipelineController as cntrl'
        }).when('/admin/dashboard', {
            templateUrl:'templates/admin/dashboard.html',
            controller:'AdminDashboardController as cntrl'
        }).when('/admin/leads', {
            templateUrl:'templates/admin/leads.html',
            controller:'AdminLeadsController as cntrl'
        }).when('/admin/users', {
            templateUrl:'templates/admin/users.html',
            controller:'AdminUsersController as cntrl'
        }).when('/admin/teams', {
            templateUrl:'templates/admin/teams.html',
            controller:'AdminTeamsController as cntrl'
        }).when('/admin/reports/property-breakdown', {
            templateUrl:'templates/admin/reports/property-breakdown.html',
            controller:'AdminReportsPropBDController as cntrl'
        }).otherwise({redirectTo : '/'})
});
