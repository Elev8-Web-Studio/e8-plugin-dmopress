jQuery(document).ready(function($) {

    //If there are any weather widgets on the page, fetch a weather update via OpenWeatherMap API
    if (jQuery('.weather-inline').length) {
        fetchCurrentWeather();
    }
});

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