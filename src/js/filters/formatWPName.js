c1App.filter('formatWPName',['$filter', function($filter){
    return function(item){
        if(item)
        {
            var n = '';
            if(item.salutation)
            {
                n = n+item.salutation+' ';
            }
            if(item.first_name)
            {
                n = n+item.first_name+' ';
            }
            if(item.middle_name)
            {
                n = n+item.middle_name+' ';
            }
            if(item.last_name)
            {
                n = n+item.last_name+' ';
            }
            if(item.suffix)
            {
                n = n+item.suffix+' ';
            }
            return n;
        } else {
            return '';
        }

    };
}]);
