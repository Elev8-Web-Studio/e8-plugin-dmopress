<?php


function add_tourismpress_news_dashboard_widget() {
	wp_add_dashboard_widget('tourismpress_news_dashboard_widget', 'TourismPress News', 'tourismpress_news_dashboard_widget');
}
add_action('wp_dashboard_setup', 'add_tourismpress_news_dashboard_widget');

// Dashboard Widget: Latest News
function tourismpress_news_dashboard_widget() {
	$rss = new DOMDocument();
	$rss->load('http://www.jasonpomerleau.com/feed/');

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

	$limit = 2;

	for($x=0;$x<$limit;$x++) {
		$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
		$link = $feed[$x]['link'];
		$description = $feed[$x]['desc'];
		$date = date('l F d, Y', strtotime($feed[$x]['date']));
		echo '<h2><a href="'.$link.'" title="'.$title.'" target="_blank">'.$title.'</a></h2>';
		echo '<small><em>Posted on '.$date.'</em></small></p>';
		echo '<p>'.$description.'</p>';
	}
}

// Dashboard Widget: Twitter Feed
function tourismpress_dashboard_analytics() {
	

		ob_start();
		?>

		<script>
		(function(w,d,s,g,js,fs){
		  g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(f){this.q.push(f);}};
		  js=d.createElement(s);fs=d.getElementsByTagName(s)[0];
		  js.src='https://apis.google.com/js/platform.js';
		  fs.parentNode.insertBefore(js,fs);js.onload=function(){g.load('analytics');};
		}(window,document,'script'));
		</script>

		
		<h2>Sessions, by Day</h2>
		<div id="chart-container"></div>

		<h2>Page Views, by Day</h2>
		<div id="geo-container"></div>

		<div id="embed-api-auth-container"></div>

		<script>

		gapi.analytics.ready(function() {

		  gapi.analytics.auth.authorize({
		    container: 'embed-api-auth-container',
		    clientid: '221085000417-4q1i4s93ks6681ghhcf13jie5caa7fki.apps.googleusercontent.com'
		  });

		  var chart = new gapi.analytics.googleCharts.DataChart({
		    query: {
		      ids: 'ga:88691121',
		      metrics: 'ga:sessions',
		      dimensions: 'ga:date',
		      'start-date': '30daysAgo',
		      'end-date': 'yesterday'
		    },
		    chart: {
		      container: 'chart-container',
		      type: 'LINE',
		      options: {
		        width: '100%'
		      }
		    }
		  });

		  chart.execute();

		  var geoChart = new gapi.analytics.googleCharts.DataChart({
		    query: {
		      ids: 'ga:88691121',
		      metrics: 'ga:pageViews',
		      dimensions: 'ga:date',
		      'start-date': '30daysAgo',
		      'end-date': 'yesterday'
		    },
		    chart: {
		      container: 'geo-container',
		      type: 'LINE',
		      options: {
		        width: '100%'
		      }
		    }
		  });

		  geoChart.execute();

		});
		</script>

<?php
	echo ob_get_clean();
}

function add_tourismpress_dashboard_analytics() {
	wp_add_dashboard_widget('tourismpress_dashboard_analytics', 'Website Performance Metrics', 'tourismpress_dashboard_analytics');
}
add_action('wp_dashboard_setup', 'add_tourismpress_dashboard_analytics');