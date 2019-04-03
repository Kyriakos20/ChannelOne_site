c1App.filter('countyTxt',['$filter', function($filter){
    return function(val){
        if(val)
        {
            return val.replace(' County','');
        } else {
            return 'No Name';
        }
    };
}]);
