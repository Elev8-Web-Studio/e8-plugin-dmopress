<?php 

function printGoogleAnalyticsCodeIfPresent(){
	//To avoid polluting analytics, do not embed code for logged in users
	if(!is_user_logged_in()){
		$googleAnalyticsId = get_option( 'tourismhub_option', 'nope');
		if(isValidGoogleAnalyticsID($googleAnalyticsId['google_analytics'])){

		?>
<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', '<?php echo $googleAnalyticsId['google_analytics']; ?>', 'auto');
	ga('send', 'pageview');
</script>
		<?php
		}
	}
}

add_action('wp_head', 'printGoogleAnalyticsCodeIfPresent');

?>
