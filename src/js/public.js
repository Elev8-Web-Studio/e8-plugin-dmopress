jQuery(document).ready(function($) {
    //If there are any weather widgets on the page, fetch a weather update via OpenWeatherMap API
    if (jQuery('.weather-inline').length) {
        fetchCurrentWeather();
    }
});

var mapIcons = { 'map-icon-abseiling': 'e800', 'map-icon-accounting': 'e801', 'map-icon-airport': 'e802', 'map-icon-amusement-park': 'e803', 'map-icon-aquarium': 'e804', 'map-icon-archery': 'e805', 'map-icon-art-gallery': 'e806', 'map-icon-assistive-listening-system': 'e807', 'map-icon-atm': 'e808', 'map-icon-audio-description': 'e809', 'map-icon-bakery': 'e80a', 'map-icon-bank': 'e80b', 'map-icon-bar': 'e80c', 'map-icon-baseball': 'e80d', 'map-icon-beauty-salon': 'e80e', 'map-icon-bicycle-store': 'e80f', 'map-icon-bicycling': 'e810', 'map-icon-boat-ramp': 'e811', 'map-icon-boat-tour': 'e812', 'map-icon-boating': 'e813', 'map-icon-book-store': 'e814', 'map-icon-bowling-alley': 'e815', 'map-icon-braille': 'e816', 'map-icon-bus-station': 'e817', 'map-icon-cafe': 'e818', 'map-icon-campground': 'e819', 'map-icon-canoe': 'e81a', 'map-icon-car-dealer': 'e81b', 'map-icon-car-rental': 'e81c', 'map-icon-car-repair': 'e81d', 'map-icon-car-wash': 'e81e', 'map-icon-casino': 'e81f', 'map-icon-cemetery': 'e820', 'map-icon-chairlift': 'e821', 'map-icon-church': 'e822', 'map-icon-circle': 'e823', 'map-icon-city-hall': 'e824', 'map-icon-climbing': 'e825', 'map-icon-closed-captioning': 'e826', 'map-icon-clothing-store': 'e827', 'map-icon-compass': 'e828', 'map-icon-convenience-store': 'e829', 'map-icon-courthouse': 'e82a', 'map-icon-cross-country-skiing': 'e82b', 'map-icon-crosshairs': 'e82c', 'map-icon-dentist': 'e82d', 'map-icon-department-store': 'e82e', 'map-icon-diving': 'e82f', 'map-icon-doctor': 'e830', 'map-icon-electrician': 'e831', 'map-icon-electronics-store': 'e832', 'map-icon-embassy': 'e833', 'map-icon-expand': 'e834', 'map-icon-female': 'e835', 'map-icon-finance': 'e836', 'map-icon-fire-station': 'e837', 'map-icon-fish-cleaning': 'e838', 'map-icon-fishing-pier': 'e839', 'map-icon-fishing': 'e83a', 'map-icon-florist': 'e83b', 'map-icon-food': 'e83c', 'map-icon-fullscreen': 'e83d', 'map-icon-funeral-home': 'e83e', 'map-icon-furniture-store': 'e83f', 'map-icon-gas-station': 'e840', 'map-icon-general-contractor': 'e841', 'map-icon-golf': 'e842', 'map-icon-grocery-or-supermarket': 'e843', 'map-icon-gym': 'e844', 'map-icon-hair-care': 'e845', 'map-icon-hang-gliding': 'e846', 'map-icon-hardware-store': 'e847', 'map-icon-health': 'e848', 'map-icon-hindu-temple': 'e849', 'map-icon-horse-riding': 'e84a', 'map-icon-hospital': 'e84b', 'map-icon-ice-fishing': 'e84c', 'map-icon-ice-skating': 'e84d', 'map-icon-inline-skating': 'e84e', 'map-icon-insurance-agency': 'e84f', 'map-icon-jet-skiing': 'e850', 'map-icon-jewelry-store': 'e851', 'map-icon-kayaking': 'e852', 'map-icon-laundry': 'e853', 'map-icon-lawyer': 'e854', 'map-icon-library': 'e855', 'map-icon-liquor-store': 'e856', 'map-icon-local-government': 'e857', 'map-icon-location-arrow': 'e858', 'map-icon-locksmith': 'e859', 'map-icon-lodging': 'e85a', 'map-icon-low-vision-access': 'e85b', 'map-icon-male': 'e85c', 'map-icon-map-pin': 'e85d', 'map-icon-marina': 'e85e', 'map-icon-mosque': 'e85f', 'map-icon-motobike-trail': 'e860', 'map-icon-movie-rental': 'e861', 'map-icon-movie-theater': 'e862', 'map-icon-moving-company': 'e863', 'map-icon-museum': 'e864', 'map-icon-natural-feature': 'e865', 'map-icon-night-club': 'e866', 'map-icon-open-captioning': 'e867', 'map-icon-painter': 'e868', 'map-icon-park': 'e869', 'map-icon-parking': 'e86a', 'map-icon-pet-store': 'e86b', 'map-icon-pharmacy': 'e86c', 'map-icon-physiotherapist': 'e86d', 'map-icon-place-of-worship': 'e86e', 'map-icon-playground': 'e86f', 'map-icon-plumber': 'e870', 'map-icon-point-of-interest': 'e871', 'map-icon-police': 'e872', 'map-icon-political': 'e873', 'map-icon-post-box': 'e874', 'map-icon-post-office': 'e875', 'map-icon-postal-code-prefix': 'e876', 'map-icon-postal-code': 'e877', 'map-icon-rafting': 'e878', 'map-icon-real-estate-agency': 'e879', 'map-icon-restaurant': 'e87a', 'map-icon-roofing-contractor': 'e87b', 'map-icon-route-pin': 'e87c', 'map-icon-route': 'e87d', 'map-icon-rv-park': 'e87e', 'map-icon-sailing': 'e87f', 'map-icon-school': 'e880', 'map-icon-scuba-diving': 'e881', 'map-icon-search': 'e882', 'map-icon-shield': 'e883', 'map-icon-shopping-mall': 'e884', 'map-icon-sign-language': 'e885', 'map-icon-skateboarding': 'e886', 'map-icon-ski-jumping': 'e887', 'map-icon-skiing': 'e888', 'map-icon-sledding': 'e889', 'map-icon-snow-shoeing': 'e88a', 'map-icon-snow': 'e88b', 'map-icon-snowboarding': 'e88c', 'map-icon-snowmobile': 'e88d', 'map-icon-spa': 'e88e', 'map-icon-square-pin': 'e88f', 'map-icon-square-rounded': 'e890', 'map-icon-square': 'e891', 'map-icon-stadium': 'e892', 'map-icon-storage': 'e893', 'map-icon-store': 'e894', 'map-icon-subway-station': 'e895', 'map-icon-surfing': 'e896', 'map-icon-swimming': 'e897', 'map-icon-synagogue': 'e898', 'map-icon-taxi-stand': 'e899', 'map-icon-tennis': 'e89a', 'map-icon-toilet': 'e89b', 'map-icon-trail-walking': 'e89c', 'map-icon-train-station': 'e89d', 'map-icon-transit-station': 'e89e', 'map-icon-travel-agency': 'e89f', 'map-icon-unisex': 'e8a0', 'map-icon-university': 'e8a1', 'map-icon-veterinary-care': 'e8a2', 'map-icon-viewing': 'e8a3', 'map-icon-volume-control-telephone': 'e8a4', 'map-icon-walking': 'e8a5', 'map-icon-waterskiing': 'e8a6', 'map-icon-whale-watching': 'e8a7', 'map-icon-wheelchair': 'e8a8', 'map-icon-wind-surfing': 'e8a9', 'map-icon-zoo': 'e8aa', 'map-icon-zoom-in-alt': 'e8ab', 'map-icon-zoom-in': 'e8ac', 'map-icon-zoom-out-alt': 'e8ad', 'map-icon-zoom-out': 'e8ae' }

function initMap(mapID, locations, mapOptions, markerOptions, calloutOptions, translationStrings) {

    var mapElement = document.getElementById(mapID);
    var map = new google.maps.Map(mapElement, mapOptions);

    var infowindow = new google.maps.InfoWindow();

    var bounds = new google.maps.LatLngBounds();

    var userLocationMarker = new google.maps.Marker();

    // If browser supports geolocation and site is HTTPS, show the User Location button
    if (location.protocol == 'https:' && navigator.geolocation) {

        var userLocationControl = document.createElement('div');
        userLocationControl.className = 'dmopress-map-control-container';
        userLocationControl.style.marginRight = '10px';
        userLocationControl.title = translationStrings.labelUserLocation;
        userLocationControl.innerHTML = '<i class="fa fa-location-arrow" aria-hidden="true"></i>';

        map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(userLocationControl);

        userLocationControl.addEventListener('click', function() {
            getUserPositionAndAddMarker(mapID, map, function(userLocationMarker) {
                map.setCenter(userLocationMarker.position);
            });
        });
    }

    for (i = 0; i < locations.length; i++) {
        if (locations[i][5] != 'none' && locations[i][5] != '') {
            label = markerOptions.markerLabelBase;
            label.text = String.fromCharCode(parseInt(mapIcons[locations[i][5]], 16));
        } else {
            label = '';
        }

        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map,
            draggable: false,
            icon: markerOptions.markerIconBase,
            label: label
        });

        bounds.extend(marker.position);

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                var thumbnailMarkup = '';

                if (locations[i][6] != '' && calloutOptions.showPostThumbnail == 'true') {
                    thumbnailMarkup = '<div class="map-callout-thumbnail-container"><a class="map-callout-thumbnail-link" href="' + locations[i][3] + '"><div class="map-callout-thumbnail-image" style="background-image: url(\'' + locations[i][6] + '\');"></div></a></div>';

                }

                var directionMarkup = '';
                if (location.protocol == 'https:' && calloutOptions.showDirections == 'true') {
                    directionMarkup = '<a href="#" class="get-directions" data-address="' + locations[i][4] + '">' + translationStrings.labelGetDirections + '</a>';
                }

                var googleLinkMarkup = '';
                if (calloutOptions.showGoogleLink == 'true') {
                    googleLinkMarkup = '<a href="https://www.google.com/maps/search/' + locations[i][4] + '" class="action-link" target="_blank">' + translationStrings.labelGoogleMaps + '</a>';
                }

                var actionBlockMarkup = '';
                if (directionMarkup != '' || googleLinkMarkup != '') {
                    actionBlockMarkup = '<hr><p>';

                    if (directionMarkup != '') {
                        actionBlockMarkup += directionMarkup;
                    }

                    if (directionMarkup != '' && googleLinkMarkup != '') {
                        actionBlockMarkup += ' ⋅ ';
                    }

                    if (googleLinkMarkup != '') {
                        actionBlockMarkup += googleLinkMarkup;
                    }

                    actionBlockMarkup += '</p>';

                }

                infowindow.setContent('<div class="dmopress-map-callout">' + thumbnailMarkup + '<div class="map-callout-content"><h5 class="map-callout-title"><a href="' + locations[i][3] + '">' + locations[i][0] + '</a></h5><p class="address">' + locations[i][4] + '</p>' + actionBlockMarkup + '</div></div>');

                infowindow.open(map, marker);

                jQuery('.get-directions').on('click', function(e) {
                    e.preventDefault();
                    var destination = jQuery(this).data('address');
                    var origin = '';
                    displayDirectionsToPlace(mapID, map, origin, destination, translationStrings);
                });

            }
        })(marker, i));
    }
    map.fitBounds(bounds);

    var listener = google.maps.event.addListener(map, "idle", function() {
        if (locations.length == 1) {
            map.setZoom(mapOptions.zoom);
        }
        google.maps.event.removeListener(listener);
    });

    function getUserPositionAndAddMarker(mapID, map, callback) {
        jQuery('#' + mapID).next('.dmopress-map-overlay').fadeIn('fast');
        navigator.geolocation.getCurrentPosition(function(position) {
            jQuery('#' + mapID).next('.dmopress-map-overlay').fadeOut('fast');
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            label = markerOptions.markerUserLabel;

            userLocationMarker.setMap(null);
            userLocationMarker = new google.maps.Marker({
                position: new google.maps.LatLng(pos.lat, pos.lng),
                map: map,
                draggable: false,
                icon: markerOptions.markerUserIcon,
                label: label,
                lat: pos.lat,
                long: pos.lng
            });
            google.maps.event.addListener(userLocationMarker, 'click', (function(userLocationMarker, i) {
                return function() {
                    infowindow.setContent(markerOptions.markerUserCalloutText);
                    infowindow.open(map, userLocationMarker);
                }
            })(userLocationMarker, i));
            bounds.extend(userLocationMarker.position);
            callback(userLocationMarker);

        }, function() {
            jQuery('#' + mapID).next('.dmopress-map-overlay').fadeOut('fast');
            handleLocationError(true, map.getCenter(), translationStrings);
            callback(null);
        });
    }

    function displayDirectionsToPlace(mapID, map, origin, destination, translationStrings) {
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;

        getUserPositionAndAddMarker(mapID, map, function(userLocationMarker) {
            directionsDisplay.setOptions({
                markerOptions: {
                    icon: markerOptions.markerIconBase,
                    label: markerOptions.markerLabelBase,
                    visible: false
                },
                polylineOptions: {
                    strokeWeight: 7,
                    strokeColor: markerOptions.markerIconBase.fillColor,
                    strokeOpacity: 0.5
                },
                origin: userLocationMarker.lat + ',' + userLocationMarker.long,
                destination: destination,
            });

            directionsDisplay.setMap(map);
            calculateAndDisplayRoute(directionsService, directionsDisplay, translationStrings);
        });
    }
}

function calculateAndDisplayRoute(directionsService, directionsDisplay, translationStrings) {
    directionsService.route({
        origin: directionsDisplay.origin,
        destination: directionsDisplay.destination,
        travelMode: 'DRIVING'
    }, function(response, status) {
        if (status === 'OK') {
            directionsDisplay.setDirections(response);
        } else {
            if (status == 'ZERO_RESULTS') {
                window.alert(translationStrings.labelDirectionsUnavailable);
            } else {
                window.alert(translationStrings.labelDirectionsFailed + status);
            }
        }
    });
}

function handleLocationError(browserHasGeolocation, pos, translationStrings) {
    if (browserHasGeolocation) {
        alert(translationStrings.labelGeolocationFailed);
    } else {
        alert(translationStrings.labelGeolocationUnsupported);
    }
}

/* Inline Weather Widget Support */
function fetchCurrentWeather() {
    jQuery.ajax({
        url: 'http://api.openweathermap.org/data/2.5/weather?id=' + injectedContent.openWeatherMapCityId + '&units=metric&APPID=' + injectedContent.openWeatherMapAPIKey,
        type: 'GET',
        dataType: 'jsonp',
        contentType: "application/json; charset=utf-8",
        success: function(data, status, xhr) {
            updateWeatherInlineWidgets(data);
        },
        error: function(xhr, textStatus, errorThrown) {
            console.log('OpenWeatherMap API Error.');
            jQuery(".weather-inline").hide();
        }
    });
}

function updateWeatherInlineWidgets(data) {
    jQuery('.weather-inline').each(function(index) {
        var unit = jQuery(this).data('unit');
        var temperature = data['main']['temp'];
        var iconCode = data['weather'][0]['id'];
        jQuery(this).html('<i class="wi wi-owm-' + iconCode + '"></i>&nbsp; ' + formatTemperature(temperature, unit));
    });;
}

function formatTemperature(tempInC, unit) {
    if (unit === undefined) {
        unit = injectedContent.openWeatherMapDefaultUnit;
    }
    var tempInF = (tempInC * (9 / 5)) + 32;
    var formattedTemperature;
    switch (unit) {
        case 'cf':
            formattedTemperature = Math.round(tempInC) + "&deg;C / " + Math.round(tempInF) + "&deg;F";
            break;
        case 'fc':
            formattedTemperature = Math.round(tempInF) + "&deg;F / " + Math.round(tempInC) + "&deg;C";
            break;
        case 'c':
            formattedTemperature = Math.round(tempInC) + "&deg;C";
            break;
        case 'f':
            formattedTemperature = Math.round(tempInF) + "&deg;F";
            break;
        default:
            formattedTemperature = Math.round(tempInC) + "&deg;C / " + Math.round(tempInF) + "&deg;F";
    }
    return formattedTemperature;
}