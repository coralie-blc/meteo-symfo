
$("#ville").autocomplete({
    source: function (request, response) {
        $.ajax({
            url: "https://api-adresse.data.gouv.fr/search/?city="+$("input[name='ville']").val(),
            data: { q: request.term },
            dataType: "json",
            success: function (data) {
                var cities = [];
                response($.map(data.features, function (item) {
                    var lat = data.features[0].geometry.coordinates[0] ; 
                    var lon = data.features[0].geometry.coordinates[1];
                    var city = data.features[0].properties.city;

                    $('.city-select').keydown(function() {
                        $('.longitude').val(lon);
                        $('.latitude').val(lat); 
                        $('.cityname').val(city); 
                    })

                    // Ajout dans un tableau pour éviter doublons
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
