c1App.filter('formatBorrower',['$filter', function($filter){
    return function(item){
        if(item)
        {
           nm = [];
            if(item.first)
            {
                nm.push(item.first);
            }
            if(item.middle)
            {
                nm.push(item.middle);
            }
            if(item.last)
            {
                nm.push(item.last);
            }
            if(item.suffix)
            {
                nm.push(item.suffix);
            }
            var nm_stng = nm.join(' ');
            return nm_stng;
        } else {
            return '';
        }

    };
}]);
