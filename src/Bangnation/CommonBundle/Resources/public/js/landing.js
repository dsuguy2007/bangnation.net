
// Set the city/state in the registration form based on the users lat/lng
function codeLatLng(lat, lng) {
    var latlng = new google.maps.LatLng(lat, lng);
    geocoder.geocode({
        'latLng': latlng
    }, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            if (results[1]) {
                //formatted address
                //alert(results[0].formatted_address)
                //find country name
                for (var i=0; i<results[0].address_components.length; i++) {
                    for (var b=0;b<results[0].address_components[i].types.length;b++) {

                        //there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
                        if (results[0].address_components[i].types[b] == "locality") {
                            city = results[0].address_components[i];
                            $('#fos_user_registration_form_city').val(city.short_name);
                            break;
                        }
                        
                        if (results[0].address_components[i].types[b] == "administrative_area_level_1") {
                            state = results[0].address_components[i];
                            $('#fos_user_registration_form_state').val(state.short_name);
                            break;
                        }
                    }
                }
            //city data
            //alert(city.short_name + " " + city.long_name)


            } else {
                alert("No results found");
            }
        } else {
            alert("Geocoder failed due to: " + status);
        }
    });
}

$(function() {
    $('#event-ticker').ticker();
   
    $("#fos_user_registration_form_city").typeahead({
        source: function(typeahead, query) {
            var url = "http://ws.geonames.org/searchJSON";
                
            $.ajax({
                dataType : 'jsonp',
                data: {
                    featureClass: "P",
                    style: "full",
                    maxRows: 12,
                    name_startsWith: query
                },
                url: url,
                success: function(data) {
                    console.log(data);
                    typeahead.process(data.geonames);
                }
            });
        },
        minLength: 2,
        property: "adminName2"
    });
                
    $("#fos_user_registration_form_state").typeahead({
        source: function(typeahead, query) {
            var url = "http://ws.geonames.org/searchJSON";
                
            $.ajax({
                dataType : 'jsonp',
                data: {
                    featureClass: "P",
                    style: "full",
                    maxRows: 12,
                    name_startsWith: query
                },
                url: url,
                success: function(data) {
                    console.log(data);
                    typeahead.process(data.geonames);
                }
            });
        },
        minLength: 2,
        property: "adminName1"
    });
                
    geocoder = new google.maps.Geocoder();
    //Check for geolocation support; hide "use my location" button if unsupported
    if (Modernizr.geolocation) { 
        navigator.geolocation.getCurrentPosition(function(position){
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            
            codeLatLng(lat, lng);
        },
        null,
        {
            timeout:10000
        });
    //App.locateInit();
    } else {
        console.log('false');
    //$('#geo-container').css('display','none');
    }
});

