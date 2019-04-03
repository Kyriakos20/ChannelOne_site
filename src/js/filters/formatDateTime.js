c1App.filter('formatDateTime',['$filter', function($filter){
    return function(item){
        if(item)
        {
            return moment(item).format('MM/DD/YY h:m A');
        }
    };
}]);
