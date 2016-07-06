<?php 
/**
 * Basic Page Template
 *
 * This template displays a single basic page.
 *
 * @package WordPress
 * @subpackage TourismPress
 * @since TourismPress 1.0
 */

// Get a reference to the current Post ID
global $wp_query;
$post_id = $wp_query->post->ID;

// Output standard page header. This function call is required for proper theme operation.
get_header();

?>

<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-8">
			
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<h2><?php the_title(); ?></h2>
				
				<p><?php the_content(); ?></p>
	
				
			<?php endwhile; else : ?>

			<?php endif; ?>
			
		</div>
		<div class="col-xs-12 col-sm-4">
			<a class="twitter-timeline" href="https://twitter.com/j_pomer" data-widget-id="698880576493760512">Tweets by @j_pomer</a>
			

			<?php get_sidebar('right-common'); ?>
		</div>
	</div>
</div>

<?php

get_footer();
