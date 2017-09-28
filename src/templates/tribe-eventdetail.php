<?php
$linked_posts = tribe_get_linked_posts(get_the_ID()); 
foreach($linked_posts['places'] as $post){
    setup_postdata( $post );
    echo '<a href="'.get_permalink( $post ).'">'.$post->post_title.'</a>';
}
wp_reset_postdata();