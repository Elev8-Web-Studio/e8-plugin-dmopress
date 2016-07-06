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


?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>TourismPress | <?php the_title(); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php 
		// This method call is required for WordPress themes to work properly
		// and should be placed immediately before the closing </head> tag.
		wp_head();
	?>
</head>
<body style="background-color: #000000;" class="social-stream <?php if(is_admin_bar_showing()){ echo " admin"; } ?>">

<div class="social-wall-container">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<?php the_content(); ?>
<?php endwhile; else : ?>

<?php endif; ?>

</div>

<?php

//get_footer();
wp_footer();
 ?>


<script>

var timeoutID = window.setTimeout(refreshScreen, (600 * 1000));

function refreshScreen(){
	jQuery('#social-stream-19').fadeOut('1000', function(){
		window.location.reload();
	})
}

 </script>

</body>
</html>
