<?php 

// Remove Footer link & Replace
function remove_footer_admin () {
	echo 'Powered by <a href="http://tourismpress.net" target="_blank">TourismPress</a>';
}
add_filter('admin_footer_text', 'remove_footer_admin');