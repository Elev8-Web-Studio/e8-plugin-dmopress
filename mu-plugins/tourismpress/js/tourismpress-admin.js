

jQuery(document).ready(function($) {
	$('#start_date').pickadate({
		format: 'mmm d, yyyy',
	});
	$('#start_time').pickatime();
	$('#end_date').pickadate({
		format: 'mmm d, yyyy',
	});
	$('#end_time').pickatime();

	jQuery.validator.addMethod("friendlyURL", function(value, element) {
	  // allow any non-whitespace characters as the host part
	  return this.optional( element ) || /(http(s)?:\\)?([\w-]+\.)+[\w-]+[.com|.net|.org|.io|.biz|.travel|.ca]+(\[\?%&=]*)?/.test( value );
	}, '&#9650; Please enter a valid URL.');

	$('#post').validate();

	$(".validate_url").rules("add", {
		friendlyURL: true
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