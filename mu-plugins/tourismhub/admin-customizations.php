<?php 

function tourismhub_set_default_admin_color($user_id) {
	$args = array(
		'ID' => $user_id,
		'admin_color' => 'midnight'
	);
	wp_update_user($args);
}
add_action('user_register', 'tourismhub_set_default_admin_color');

function tourismhub_remove_admin_color_scheme_picker(){
	remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );
}
add_action('init','tourismhub_remove_admin_color_scheme_picker');