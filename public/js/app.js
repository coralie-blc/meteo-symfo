// Utilisation d'une API externe pour gérer l'autocomplétion + remplissage des input hidden du template grace à Ajax
$("#ville").autocomplete({
    source: function (request, response) {
        $.ajax({
            url: "https://api-adresse.data.gouv.fr/search/?q=" + $("input[name='ville']").val(),
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
                    });


                    // Ajout dans un tableau pour éviter doublons
                    if ($.inArray(cities)) {
                        return { 
                            // label: item.properties.city, 
                            value: item.properties.city,
                            long: lon,
                            lat: lat,
                        };
                    }
                }));
            },
        });
    },
    minLength: 4,

    // Utilisation du select de Jquery : ajout lignes 29/30 des variables nécessaires dans le tableau d'items
    // Permet de réagir au "clic" sur une ville.
    select: function(e, ui) {
        console.log("ui", ui);
        $('.cityname').val(ui.item.value);
        $('.longitude').val(ui.item.long);
        $('.latitude').val(ui.item.lat); 
        console.log($(".cityname").val());
    }
});

