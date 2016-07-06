<?php 
/**
 * Events Detail Template
 *
 * This template displays a single Events post.
 * By default, it shows all available Events fields and,
 * if a Google Maps API Key is detected, it also displays a Google Map. 
 *
 * Documentation: 
 * {@link http://docs.tourismpress.net/designers/templatereference.html#single-events-php}
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

						<p><?php echo get_post_meta($post_id, 'start_date', true); ?> at <?php echo get_post_meta($post_id, 'start_time', true); ?> to <?php echo get_post_meta($post_id, 'end_date', true); ?> at <?php echo get_post_meta($post_id, 'end_time', true); ?></p>
						
						<p><?php the_content(); ?></p>
					
						<p>Registration: <a href="<?php echo get_post_meta($post_id, 'event_registration_url', true); ?>" target="_blank"><?php echo get_post_meta($post_id, 'event_registration_url', true); ?></a></p>

						<div class="social-block">
							<?php if(isValidUrl(get_post_meta($post_id, 'facebook_url', true))) { ?>
							<a class="social-link facebook" href="<?php echo get_post_meta($post_id, 'facebook_url', true); ?>" target="_blank" alt="Visit <?php echo the_title(); ?> on Facebook" title="Visit <?php echo the_title(); ?> on Facebook"><i class="fa fa-facebook"></i></a>
							<?php }; ?>
							
							<?php if(isValidUrl(get_post_meta($post_id, 'twitter_url', true))) { ?>
							<a class="social-link twitter" href="<?php echo get_post_meta($post_id, 'twitter_url', true); ?>" target="_blank" alt="Visit <?php echo the_title(); ?> on Twitter" title="Visit <?php echo the_title(); ?> on Twitter"><i class="fa fa-twitter"></i></a>
							<?php }; ?>
							
							<?php if(isValidUrl(get_post_meta($post_id, 'instagram_url', true))) { ?>
							<a class="social-link instagram" href="<?php echo get_post_meta($post_id, 'instagram_url', true); ?>" target="_blank" alt="Visit <?php echo the_title(); ?> on Instagram" title="Visit <?php echo the_title(); ?> on Instagram"><i class="fa fa-instagram"></i></a>
							<?php }; ?>
							
							<?php if(isValidUrl(get_post_meta($post_id, 'website_url', true))) { ?>
							<a class="social-link website" href="<?php echo get_post_meta($post_id, 'website_url', true); ?>" target="_blank" alt="Visit <?php echo the_title(); ?> on the Web" title="Visit <?php echo the_title(); ?> on the Web"><i class="fa fa-external-link"></i></a>
							<?php }; ?>
						</div>

						Categories:
						<?php 

						$categories = get_the_terms($post_id, 'event-categories');
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