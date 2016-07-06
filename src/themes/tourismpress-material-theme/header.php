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
<body>

<nav class="navbar navbar-default navbar-static-top">
	<div class="container">
	    <div class="navbar-header">
	    	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
	    	</button>
	      	<a class="navbar-brand" href="/">
	        TourismPress Demo
	      </a>
	    </div>
	    <div class="collapse navbar-collapse" id="navbar-header-collapse">
	        <ul class="nav navbar-nav navbar-right">
	        	<li><a href="/news">News</a></li>
	        	<li><a href="/do">Attractions</a></li>
	        	<li><a href="/stay">Accommodations</a></li>
	        	<li><a href="/events">Events</a></li>
	        	<li><a href="/eat">Food &amp; Drink</a></li>
	        </ul>
	    </div>
	</div>
</nav>

<div class="content">