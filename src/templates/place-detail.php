<?php 
$address_block = array();

if(dmo_get_address() != ''){
    array_push($address_block, dmo_get_address());
};
if(dmo_get_city() != ''){
    array_push($address_block, dmo_get_city());
};
if(dmo_get_province() != ''){
    array_push($address_block, dmo_get_province());
};
if(dmo_get_postal_code() != ''){
    array_push($address_block, dmo_get_postal_code());
};

$telephone = dmo_get_telephone();

$social_links = array();

if(dmo_get_website_url() != ''){
    array_push($social_links, '<a href="'.dmo_get_website_url().'" target="_blank">the Web</a>');
};

if(dmo_get_facebook_url() != ''){
    array_push($social_links, '<a href="'.dmo_get_facebook_url().'" target="_blank">Facebook</a>');
};

if(dmo_get_twitter_url() != ''){
    array_push($social_links, '<a href="'.dmo_get_twitter_url().'" target="_blank">Twitter</a>');
};

if(dmo_get_instagram_url() != ''){
    array_push($social_links, '<a href="'.dmo_get_instagram_url().'" target="_blank">Instagram</a>');
};

if(dmo_get_tripadvisor_url() != ''){
    array_push($social_links, '<a href="'.dmo_get_tripadvisor_url().'" target="_blank">TripAdvsior</a>');
};

?>
<p>
    <?php echo implode(', ', $address_block); ?>
    <?php if($telephone != '') {
        echo ' &#8901; <a href="tel:'. preg_replace('/[^0-9,]/','',$telephone) .'">' . $telephone . '</a>';
    }
    ?>
</p>

<p><?php echo the_content(); ?></p>

<p><?php the_terms( get_the_ID(), 'categories', 'Categories: ', ', ' ); ?></p>
<p><?php the_terms( get_the_ID(), 'features', 'Features: ', ', ' ); ?></p>

<?php if(count($social_links) >0){ ?>
    <p>Follow <?php echo the_title(); ?> on: <?php echo implode(' &#8901; ', $social_links); ?></p>
<?php } ?>

<?php echo 'Twitter Handle: '.dmo_get_twitter_handle(); ?>
<?php echo 'Instagram Handle: '.dmo_get_instagram_handle(); ?>
<?php echo 'TripAdvisor Location ID: '.dmo_get_tripadvisor_location_id(); ?>

<?php echo do_shortcode('[dmo-map places="'.get_the_ID().'"]'); ?>