c1App.filter('formatPhone',['$filter', function($filter){
    return function(item){
        if(item)
        {
            var n = item.replace(/\D/g,"");
            return n.replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3');
        }
    };
}]);
