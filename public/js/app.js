


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


//$('.city-select').val()
// var proxy = 'https://cors-anywhere.herokuapp.com/';
selectCity();



function selectCity(e) {
    e.preventDefault();
    $formulaire = $('.form-city');
    $city = $('.city-select').val();
    console.log($city);
    $.ajax( {
        url : 'https://api-adresse.data.gouv.fr/search/?q=toulouse', 
        method: 'GET',
        dataType : 'json',     
        }
    ).done(function(response){
        // JSON.parse(response);
        console.log(response);
    });
}
