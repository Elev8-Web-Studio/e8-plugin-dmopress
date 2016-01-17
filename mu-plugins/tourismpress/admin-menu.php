<?php 

//Customize Admin Menu
function customize_admin_menu() {
	// Remove Media link
	remove_menu_page('upload.php');

	// Remove Comments Link
	remove_menu_page('edit-comments.php');

}
add_action('admin_menu', 'customize_admin_menu');
