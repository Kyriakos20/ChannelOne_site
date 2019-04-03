c1App.filter('toMinutes',['$filter', function($filter){
    return function(item){
        return (Number(item)/1000/60).toFixed();
    };
}]);
