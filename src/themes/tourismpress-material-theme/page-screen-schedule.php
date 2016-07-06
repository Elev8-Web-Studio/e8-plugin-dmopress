<?php
/**
 * Default Page Header - Partial Template
 * 
 * This partial template is referenced from other templates
 * by calling the get_header() method.
 *
 * It also contains the required wp_header() method call, which
 * is required for WordPress to load scripts and stylesheets.
 *
 * @package WordPress
 * @subpackage TourismPress
 * @since TourismPress 1.0
 * 
 * Documentation: 
 * {@link http://docs.tourismpress.net/designers/templatereference.html#header-php-partial}
 * 
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
<body class="largescreen<?php if(is_admin_bar_showing()){ echo " admin"; } ?>">

<div id="carousel-events" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner" role="listbox">
    



        <?php

          //Sunday Query

          $args = array(
            //Type & Status Parameters
            'post_type'   => 'events',
            'meta_key' => 'start_datetime',
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
            'meta_query' => array(
                array(
                  'key' => 'start_datetime',
                  'value'   => array(1465704000, 1465790399),
                  'type'    => 'numeric',
                  'compare' => 'BETWEEN',
                ),
              ),
          );

        $query = new WP_Query( $args );

        ?>
    					
    		<?php if ( $query->have_posts() ) : ?>

          <div class="item active">
            <header>
              <h1>Sunday, June 12</h1>
            </header>
            <ul class="events-listing">

    			<?php 
    				while ( $query->have_posts() ) : $query->the_post();
    				$event_timestamp = get_post_meta(get_the_ID(), 'start_datetime', true) * 1000;
    				$event_time = get_post_meta(get_the_ID(), 'start_time', true);
    			?>
    			
    			<li class="show" data-timestamp="<?php echo $event_timestamp; ?>"><span class="time"><?php echo $event_time; ?></span> <?php echo the_title(); ?></li>
    			<?php endwhile; ?>   

    			<?php wp_reset_postdata(); ?>

            </ul>
          </div>

    		<?php else : endif; ?>

    	
  </div>
</div>




<script>

var timeoutID = window.setTimeout(refreshScreen, (600 * 1000));

function refreshScreen(){
  window.location.reload();
}

</script>


<script>
	
events = [
		<?php if ( $query->have_posts() ) : ?>
			<?php 
				while ( $query->have_posts() ) : $query->the_post();
				$event_timestamp = get_post_meta(get_the_ID(), 'start_datetime', true) * 1000;
				$event_time = get_post_meta(get_the_ID(), 'start_time', true);
				echo "{";
				echo "'timestamp': ".$event_timestamp.",";
				echo "'time': '".$event_time."',";
				echo "'title': '".get_the_title()."'";
				echo "},";
			?>

			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		<?php else : endif; ?>
];



</script>
<?php 
// This method call is required for WordPress themes to work properly
// and should be placed immediately before the closing </body> tag.
wp_footer();
?>
</body>
</html>
