<?php 
/**
 * Events "Archive" Template
 *
 * This template queries all Events posts 
 * and displays them as a list. By default, it only shows
 * a linked Title and the Excerpt, but any Events
 * field can be referenced or displayed.
 *
 * Documentation: 
 * {@link http://docs.tourismpress.net/designers/templatereference.html#archive-events-php}
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
			<div class="archive-events">

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

					<div class="event-profile">

					<?php if(has_post_thumbnail()) { ?>
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><img class="" src="<?php echo the_post_thumbnail_url('thumbnail'); ?>" alt=""></a>
					<?php } ?>

					<h3><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

					<p><?php the_excerpt();?></p>

					<div class="clearboth"></div>

					</div>
					
				<?php endwhile; else : ?>

				<?php endif; ?>

			</div>
		</div>
		<div class="col-xs-12 col-sm-4">
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>

<?php

get_footer();

