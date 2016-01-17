<?php

// Dashboard Widget: Latest News
function tourismpress_news_dashboard_widget() {
	echo "<p>Contents</p>";
}
function add_tourismpress_news_dashboard_widget() {
	wp_add_dashboard_widget('tourismpress_news_dashboard_widget', 'TourismHub News', 'tourismpress_news_dashboard_widget');
}
add_action('wp_dashboard_setup', 'add_tourismpress_news_dashboard_widget');

// Dashboard Widget: Twitter Feed
function tourismpress_twitter_dashboard_widget() {
	$rss = new DOMDocument();
	$rss->load('http://wordpress.org/news/feed/');

	$feed = array();
	foreach ($rss->getElementsByTagName('item') as $node) {
		$item = array ( 
			'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
			'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
			'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
			'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
			);
		array_push($feed, $item);
	}

	$limit = 5;

	for($x=0;$x<$limit;$x++) {
		$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
		$link = $feed[$x]['link'];
		$description = $feed[$x]['desc'];
		$date = date('l F d, Y', strtotime($feed[$x]['date']));
		echo '<p><strong><a href="'.$link.'" title="'.$title.'">'.$title.'</a></strong><br />';
		echo '<small><em>Posted on '.$date.'</em></small></p>';
		echo '<p>'.$description.'</p>';
	}
}

function add_tourismpress_twitter_dashboard_widget() {
	wp_add_dashboard_widget('tourismpress_twitter_dashboard_widget', 'Twitter', 'tourismpress_twitter_dashboard_widget');
}
add_action('wp_dashboard_setup', 'add_tourismpress_twitter_dashboard_widget');