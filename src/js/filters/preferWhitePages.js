c1App.filter('preferWhitePages',['$filter', function($filter){
    return function(val){
        return val.status == 'Good'
    };
}]);
