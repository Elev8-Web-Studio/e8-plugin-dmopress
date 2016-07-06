<?php 
/**
 * Default Page Footer - Partial Template
 *
 * This partial template is referenced from other templates
 * by calling the get_footer() method.
 * 
 * It also contains the required wp_footer() method call, which
 * is required for WordPress to load scripts and stylesheets.
 * 
 * Documentation: 
 * {@link http://docs.tourismpress.net/designers/templatereference.html#footer-php-partial}
 *
 * @package WordPress
 * @subpackage TourismPress
 * @since TourismPress 1.0
 */
?>

</div>

<nav class="navbar navbar-default margin-top">
	<div class="container">
	    <ul class="nav navbar-nav">
	    	<li>
	    		<a href="http://tourismpress.net" target="_blank">Powered by TourismPress</a>
	    	</li>
	    </ul>
	</div>
</nav>

<?php 
// This method call is required for WordPress themes to work properly
// and should be placed immediately before the closing </body> tag.
wp_footer();
?>

</body>
</html>