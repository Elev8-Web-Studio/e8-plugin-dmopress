<?php 
/**
 * Packages Detail Template
 *
 * This template displays a single Packages post.
 * By default, it shows all available Packages fields. 
 *
 * Documentation: 
 * {@link http://docs.tourismpress.net/designers/templatereference.html#single-packages-php}
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

				<p><?php the_content();?></p>

				<p>Categories:

					<?php 

					$categories = get_the_terms($post_id, 'package-categories');
					if (!empty($categories)) {
						foreach ( $categories as $cat ) {
							$cat_link = get_tag_link( $cat->term_id );
							echo "<a href='{$cat_link}' title='{$cat->name}' class='{$cat->slug}'>{$cat->name}</a> ";
						}
					} else {
						echo "None";
					}

					?>

				</p>

				<p>Tags: 
					<?php 

					$tags = get_the_tags();
					if (!empty($tags)) {
						foreach ( $tags as $tag ) {
							$tag_link = get_tag_link( $tag->term_id );
							echo "<a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>{$tag->name}</a> ";
						}
					} else {
						echo "None";
					}

					?>
				</p>

			<?php endwhile; else : ?>

			<?php endif; ?>
			
		</div>
		<div class="col-xs-12 col-sm-4">
			
		</div>
	</div>
</div>

<?php

get_footer();
