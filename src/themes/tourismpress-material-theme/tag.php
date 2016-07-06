<?php 
/**
 * Accommodations "Archive" Template
 *
 * This template queries all Accommodations posts 
 * and displays them as a list. By default, it only shows
 * a linked Title and the Excerpt, but any Accommodations
 * field can be referenced or displayed.
 *
 * Documentation: 
 * {@link http://docs.tourismpress.net/designers/templatereference.html#tag-php}
 *
 * @package WordPress
 * @subpackage TourismPress
 * @since TourismPress 1.0
 */

// Output standard page header. This function call is required for proper theme operation.
get_header();

?>

<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-8">
			
			<h1>Tag Results: <?php echo single_tag_title('', false) ?></h1>

			<h2>Blog Posts:</h2>
			<?php while ( have_posts() ) : the_post(); ?>

				<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

				<p><?php the_excerpt();?></p>
			<?php endwhile; ?>
			
		</div>
		<div class="col-xs-12 col-sm-4">
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>

<?php

get_footer();

