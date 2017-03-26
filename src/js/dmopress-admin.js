jQuery(document).ready(function($) {

	jQuery.validator.addMethod("friendlyURL", function(value, element, params) {
		return this.optional(element) || /(http(s)?:\\)?([\w-]+\.)+[\w-]+[.com|.net|.org|.io|.biz|.travel|.ca]+(\[\?%&=]*)?/.test(value);
	}, '&#9650; Invalid URL');

	jQuery.validator.addMethod("phoneUS", function(phone_number, element) {
		phone_number = phone_number.replace(/\s+/g, "");
		return this.optional(element) || phone_number.length > 9 &&
			phone_number.match(/^(\+?1-?)?(\([2-9]([02-9]\d|1[02-9])\)|[2-9]([02-9]\d|1[02-9]))-?[2-9]([02-9]\d|1[02-9])-?\d{4}$/);
	}, "&#9650; Invalid phone number");

	jQuery('#post').validate({
		rules: {
			website_url: {
			  friendlyURL: true
			},
			facebook_url: {
			  friendlyURL: true
			},
			twitter_url: {
			  friendlyURL: true
			},
			instagram_url: {
			  friendlyURL: true
			},
			tripadvisor_url: {
			  friendlyURL: true
			},
			event_registration_url: {
			  friendlyURL: true
			},
			telephone: {
				phoneUS: true
			}
		}
	});

	jQuery('.place-lookup-field').change(function(e){
		var selectedItem = jQuery(this).val();
		if(selectedItem == 'custom'){
			jQuery('.dmopress-custom-address-block').slideDown();
		} else {
			jQuery('.dmopress-custom-address-block').slideUp();
		}
	});

	jQuery('#geocode').on('click', function(e){
		
		e.preventDefault();
		var address = jQuery('input[name=address]').val();
		var city = jQuery('input[name=city]').val();
		var stateprov = jQuery('input[name=stateprov]').val();
		var zip = jQuery('input[name=zip]').val();

		var location = address + ',' + city + ',' + stateprov + ',' + zip;
		var geocodeRequestURI = 'https://maps.googleapis.com/maps/api/geocode/json?address=' + location;

		jQuery.getJSON(geocodeRequestURI, function(data, textStatus) {
				
				if(data.status == "OK"){
					jQuery('#geocode-error').hide();
					var lat = data.results[0].geometry.location.lat;
					var long = data.results[0].geometry.location.lng;
					jQuery('input[name=latitude]').val(lat);
					jQuery('input[name=longitude]').val(long);
				} else {
					//console.log('Data: ' + data.status);
					jQuery('#geocode-error').show();
					jQuery('input[name=latitude]').val('');
					jQuery('input[name=longitude]').val('');
				}
				
		}).fail(function() {
				console.log( "Geocode request error." );
		});
			
	});


});