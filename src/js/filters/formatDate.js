c1App.filter('formatDate',['$filter', function($filter){
    return function(item){
        if(item)
        {
            return moment(item).format('MM/DD/YY');
        }
    };
}]);
