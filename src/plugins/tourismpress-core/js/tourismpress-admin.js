jQuery(document).ready(function($) {
	
	jQuery('#start_date').pickadate({
		format: 'mmm d, yyyy',
	});
	jQuery('#start_time').pickatime();
	jQuery('#end_date').pickadate({
		format: 'mmm d, yyyy',
	});
	jQuery('#end_time').pickatime();

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
			jQuery('.tourismpress-custom-address-block').slideDown();
		} else {
			jQuery('.tourismpress-custom-address-block').slideUp();
		}
	});


});