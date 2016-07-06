<?php 
/**
 * 404 Error Page
 *
 * This template is rendered when WordPress cannot locate the page
 *
 * Documentation: 
 * {@link http://docs.tourismpress.net/designers/templatereference.html#php}
 *
 * @package WordPress
 * @subpackage TourismPress
 * @since TourismPress 1.0
 */

// Output standard page header. This function call is required for proper theme operation.
get_header();

?>

<?php get_header(); ?>

<div class="container">
	<div class="row">
		<div class="col-xs-12">
			Sorry, the page you requested could not be found.
		</div>
	</div>
</div>

<?php

get_footer();

