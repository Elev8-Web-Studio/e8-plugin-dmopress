
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "Place",
    "name": "<?php echo the_title(); ?>",
    "description": "<?php echo get_the_excerpt(); ?>",
    "address": {
        "@type": "PostalAddress",
        "addressLocality": "<?php echo dmo_get_city(); ?>",
        "addressRegion": "<?php echo dmo_get_state(); ?>",
        "postalCode": "<?php echo dmo_get_zip(); ?>",
        "streetAddress": "<?php echo dmo_get_address(); ?>"
    },
    "geo": {
        "@type": "GeoCoordinates",
        "latitude": "<?php echo dmo_get_latitude(); ?>",
        "longitude": "<?php echo dmo_get_longitude(); ?>"
    },
    <?php
    if(dmo_get_telephone() != ''){
        echo '"telephone": "'.dmo_get_telephone().'",';
    }
    ?>
    "sameAs" : [
		<?php
        $same_as = array();

        if(dmo_get_website_url() != ''){
            array_push($same_as, '"'.dmo_get_website_url().'"');
        }
        if(dmo_get_facebook_url() != ''){
            array_push($same_as, '"'.dmo_get_facebook_url().'"');
        }
        if(dmo_get_twitter_url() != ''){
            array_push($same_as, '"'.dmo_get_twitter_url().'"');
        }
        if(dmo_get_instagram_url() != ''){
            array_push($same_as, '"'.dmo_get_instagram_url().'"');
        }
        if(dmo_get_tripadvisor_url() != ''){
            array_push($same_as, '"'.dmo_get_tripadvisor_url().'"');
        }

        if(count($same_as)){
            echo implode(',', $same_as);
        }
        ?>
    ]
}
</script>