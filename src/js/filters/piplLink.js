c1App.filter('piplLink',['$filter', function($filter){
    return function(prop){
        if(!prop)
        {
            return '';
        }
        var link = "https://pipl.com";
        if(prop.owner.primary)
        {
            var item = prop.owner.primary.name;
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
            var nm_stng = nm.join('+');

            link = "https://pipl.com/search/?q="+nm_stng+"&l="+prop.address.city+"%2C+"+prop.address.state+"&sloc=US%7CDE%7C"+prop.address.city+"&in=6";
        }

        return link;
    };
}]);
