<?php 
/**
 * Accommodations Detail Template
 *
 * This template displays a single Accommodations post.
 * By default, it shows all available Accommodations fields and,
 * if a Google Maps API Key is detected, it also displays a Google Map. 
 *
 * Documentation: 
 * {@link http://docs.tourismpress.net/designers/templatereference.html#single-accommodations-php}
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

				<div class="row">
					<div class="col-xs-12 col-sm-6">
						<img class="img-responsive margin-top" src="<?php echo the_post_thumbnail_url('full'); ?>" alt="">
					</div>
					<div class="col-xs-12 col-sm-6">

						<h2><?php the_title(); ?></h2>
						
						<p><?php the_content(); ?></p>

						<p># of Rooms: <?php echo get_post_meta($post_id, 'rooms', true); ?></p>

						<div class="row">
							<div class="col-xs-6">
								<?php render_star_rating($post_id); ?>
							</div>
							<div class="col-xs-6">
								<span class="pull-right"><?php render_price_rating($post_id); ?></span>
							</div>
						</div>

						<div class="social-block">
							<?php if(isValidUrl(get_post_meta($post_id, 'website_url', true))) { ?>
							<a class="social-link website" href="<?php echo get_post_meta($post_id, 'website_url', true); ?>" target="_blank" alt="Visit <?php echo the_title(); ?> on the Web" title="Visit <?php echo the_title(); ?> on the Web"><i class="fa fa-external-link"></i></a>
							<?php }; ?>
						</div>

						Features:
						<?php 

						$features = get_the_terms($post_id, 'accommodations-features');
						if (!empty($features)) {
							foreach ( $features as $feature ) {
								$feature_link = get_tag_link( $feature->term_id );
								echo "<a href='{$feature_link}' title='{$feature->name}'>{$feature->name}</a>, ";
							}
						} else {
							//echo "None";
						}

						?>

						<br><br>Categories:
						<?php 

						$categories = get_the_terms($post_id, 'accommodations-categories');
						if (!empty($categories)) {
							foreach ( $categories as $cat ) {
								$cat_link = get_tag_link( $cat->term_id );
								echo "<a href='{$cat_link}' title='{$cat->name}'>{$cat->name}</a>, ";
							}
						} else {
							//echo "None";
						}

						?>
						
					</div>
				</div>
				
			<?php endwhile; else : ?>

			<?php endif; ?>
			
		</div>
		<div class="col-xs-12 col-sm-4">
			<?php 
				// Renders a Google Map based on the PostID
				// The function can be found in functions.php
				render_google_map($post_id); 
			?>
		</div>
	</div>
</div>

<?php

get_footer();
