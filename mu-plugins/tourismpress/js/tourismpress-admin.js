

jQuery(document).ready(function($) {
	$('#start_date').pickadate({
		format: 'mmm d, yyyy',
	});
	$('#start_time').pickatime();
	$('#end_date').pickadate({
		format: 'mmm d, yyyy',
	});
	$('#end_time').pickatime();
});