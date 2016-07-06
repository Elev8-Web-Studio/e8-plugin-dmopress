<?php 
/**
 * Default Category Results Template
 *
 * This template displays a list of posts which have a
 * corresponding taxonomy term. It's the least specific
 * template, so templates named taxonomy-taxonomyname.php 
 * will take precedence over this one.
 *
 * Documentation: 
 * {@link http://docs.tourismpress.net/designers/templatereference.html#category-php}
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

			Category Results for term(s): <?php ?>
			
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

				<p><?php the_excerpt();?></p>
			<?php endwhile; else : ?>

			<?php endif; ?>
			
		</div>
		<div class="col-xs-12 col-sm-4">
			
		</div>
	</div>
</div>

<?php

get_footer();

