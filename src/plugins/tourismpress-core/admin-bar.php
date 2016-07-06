<?php 

//Modify Admin Bar
function customize_admin_bar( $wp_admin_bar ) {
	$wp_admin_bar->remove_node('wp-logo');
	$wp_admin_bar->remove_node('comments');
}
add_action('admin_bar_menu', 'customize_admin_bar', 999);