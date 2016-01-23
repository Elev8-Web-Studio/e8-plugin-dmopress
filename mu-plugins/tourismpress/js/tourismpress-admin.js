

jQuery(document).ready(function($) {
	$('#start_date').pickadate({
		format: 'mmm d, yyyy',
	});
	$('#start_time').pickatime();
	$('#end_date').pickadate({
		format: 'mmm d, yyyy',
	});
	$('#end_time').pickatime();

	jQuery.validator.addMethod("friendlyURL", function(value, element, params) {
		return this.optional(element) || /(http(s)?:\\)?([\w-]+\.)+[\w-]+[.com|.net|.org|.io|.biz|.travel|.ca]+(\[\?%&=]*)?/.test(value);
	}, '&#9650; Invalid URL');

	$.validator.addMethod("phoneUS", function(phone_number, element) {
		phone_number = phone_number.replace(/\s+/g, "");
		return this.optional(element) || phone_number.length > 9 &&
			phone_number.match(/^(\+?1-?)?(\([2-9]([02-9]\d|1[02-9])\)|[2-9]([02-9]\d|1[02-9]))-?[2-9]([02-9]\d|1[02-9])-?\d{4}$/);
	}, "&#9650; Invalid phone number");

	$('#post').validate({
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
			event_registration_url: {
			  friendlyURL: true
			},
			telephone: {
				phoneUS: true
			},
			rooms: {
				number: true,
				min: 1
			},
			star_rating: {
				number: true,
				min: 1,
				max: 5
			},
			price_rating: {
				number: true,
				min: 1,
				max: 5
			}
		},
		messages: {
		    star_rating: {
		      number: "&#9650; Invalid number",
		      min: "&#9650; Must be at least 1",
		      max: "&#9650; Must be no more than 5"
		    },
		    price_rating: {
		      number: "&#9650; Invalid number",
		      min: "&#9650; Must be at least 1",
		      max: "&#9650; Must be no more than 5"
		    },
		    rooms: {
		    	number: "&#9650; Invalid number",
		    	min: "&#9650; Must be at least 1"
		    }
		}
	});

	

	/*
	$('.validate_domain').rules("add", {
		pattern: '^((?!-)[A-Za-z0-9-]{1,63}(?<!-)\\.)+[A-Za-z]{2,6}$',
		messages: {
			pattern: jQuery.validator.format("Must match pattern.")
		}
	});
	*/

});