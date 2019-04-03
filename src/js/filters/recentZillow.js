c1App.filter('recentZillow',['$filter', function($filter){
    return function(vals){
        if(vals)
        {
            var val = null;

            for(var i = 0; i < vals.length; i++)
            {
                if(vals[i].source == 'Zillow')
                {
                    val = vals[i].value;
                }
            }
            return val;
        } else {
            return null;
        }
    };
}]);
