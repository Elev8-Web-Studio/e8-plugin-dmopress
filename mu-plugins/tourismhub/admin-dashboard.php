<?php

// Dashboard Widget: Latest News
function tourismhub_news_dashboard_widget() {
	echo "<p>Contents</p>";
}
function add_tourismhub_news_dashboard_widget() {
	wp_add_dashboard_widget('tourismhub_news_dashboard_widget', 'TourismHub News', 'tourismhub_news_dashboard_widget');
}
add_action('wp_dashboard_setup', 'add_tourismhub_news_dashboard_widget');

// Dashboard Widget: Twitter Feed
function tourismhub_twitter_dashboard_widget() {
	echo "<p>Contents</p>";
}
function add_tourismhub_twitter_dashboard_widget() {
	wp_add_dashboard_widget('tourismhub_twitter_dashboard_widget', 'Twitter', 'tourismhub_twitter_dashboard_widget');
}
add_action('wp_dashboard_setup', 'add_tourismhub_twitter_dashboard_widget');