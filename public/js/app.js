$("#ville").autocomplete({
    source: function (request, response) {
        $.ajax({
            url: "https://api-adresse.data.gouv.fr/search/?city="+$("input[name='ville']").val(),
            data: { q: request.term },
            dataType: "json",
            success: function (data) {
                var cities = [];
                response($.map(data.features, function (item) {
                    // Ici on est obligé d'ajouter les villes dans un array pour ne pas avoir plusieurs fois la même
                    if ($.inArray(item.properties.postcode, cities) == -1) {
                        cities.push(item.properties.postcode);
                        return { label: item.properties.postcode + " - " + item.properties.city, 
                                 postcode: item.properties.postcode,
                                 value: item.properties.city
                        };
                    }
                }));
            }
        });
    },
});

var proxy = 'https://cors-anywhere.herokuapp.com/';
selectCity();
function selectCity() {
    $.ajax( {
        url : proxy + 'https://api-adresse.data.gouv.fr/search/?q='+ $('.city-select').val() , 
        dataType : 'json',     
        }
    ).done(function(response){
        JSON.parse(response);
        return response;
    });
}
