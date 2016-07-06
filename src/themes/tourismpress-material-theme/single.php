<?php 
/**
 * Blog Detail Template
 *
 * This template displays a single Blog post.
 * By default, it shows all available Blog fields.
 *
 * Documentation: 
 * {@link http://docs.tourismpress.net/designers/templatereference.html#single-php}
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

<?php get_header(); ?>

<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-8">
			
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

				<p><?php the_content();?></p>
			<?php endwhile; else : ?>

			<?php endif; ?>
			
		</div>
		<div class="col-xs-12 col-sm-4">
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>

<?php

get_footer();

