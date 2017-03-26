<?php 



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
    <?php echo dmo_get_address_full(); ?>
    <?php 
    $telephone = dmo_get_telephone();
    if($telephone != '') {
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

<?php echo do_shortcode('[dmo-map places="'.get_the_ID().'"]'); ?>