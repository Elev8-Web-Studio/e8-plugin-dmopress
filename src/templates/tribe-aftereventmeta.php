<?php
$linked_posts = tribe_get_linked_posts(get_the_ID()); 
foreach($linked_posts['places'] as $post){
    setup_postdata( $post );
    echo do_shortcode('[dmo-map places="'.$post->ID.'"]');
}
wp_reset_postdata();