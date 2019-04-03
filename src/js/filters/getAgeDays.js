c1App.filter('getAgeDays',['$filter', function($filter){
    return function(item){
        if(item)
        {
            return round((new Date() - item)/86400000);
        } else {
            return '';
        }
    };
}]);
