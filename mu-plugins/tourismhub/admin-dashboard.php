<?php

// Dashboard Widget: Latest News
function project2016_news_dashboard_widget() {
	echo "<p>Contents</p>";
}
function add_project2016_news_dashboard_widget() {
	wp_add_dashboard_widget('project2016_news_dashboard_widget', 'Project 2016 News', 'project2016_news_dashboard_widget');
}
add_action('wp_dashboard_setup', 'add_project2016_news_dashboard_widget');

// Dashboard Widget: Twitter Feed
function project2016_twitter_dashboard_widget() {
	echo "<p>Contents</p>";
}
function add_project2016_twitter_dashboard_widget() {
	wp_add_dashboard_widget('project2016_twitter_dashboard_widget', 'Twitter', 'project2016_twitter_dashboard_widget');
}
add_action('wp_dashboard_setup', 'add_project2016_twitter_dashboard_widget');