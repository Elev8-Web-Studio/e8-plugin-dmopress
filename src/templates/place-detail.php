<?php 
$address_block = array();

if(get_post_meta(get_the_ID(), 'address', true) != ''){
    array_push($address_block, get_post_meta(get_the_ID(), 'address', true));
};
if(get_post_meta(get_the_ID(), 'city', true) != ''){
    array_push($address_block, get_post_meta(get_the_ID(), 'city', true));
};
if(get_post_meta(get_the_ID(), 'stateprov', true) != ''){
    array_push($address_block, get_post_meta(get_the_ID(), 'stateprov', true));
};
if(get_post_meta(get_the_ID(), 'zip', true) != ''){
    array_push($address_block, get_post_meta(get_the_ID(), 'zip', true));
};

$telephone = get_post_meta(get_the_ID(), 'telephone', true);

$social_links = array();

if(get_post_meta(get_the_ID(), 'website_url', true) != ''){
    array_push($social_links, '<a href="'.get_post_meta(get_the_ID(), 'website_url', true).'" target="_blank">the Web</a>');
};

if(get_post_meta(get_the_ID(), 'facebook_url', true) != ''){
    array_push($social_links, '<a href="'.get_post_meta(get_the_ID(), 'facebook_url', true).'" target="_blank">Facebook</a>');
};

if(get_post_meta(get_the_ID(), 'twitter_url', true) != ''){
    array_push($social_links, '<a href="'.get_post_meta(get_the_ID(), 'twitter_url', true).'" target="_blank">Twitter</a>');
};

if(get_post_meta(get_the_ID(), 'instagram_url', true) != ''){
    array_push($social_links, '<a href="'.get_post_meta(get_the_ID(), 'instagram_url', true).'" target="_blank">Instagram</a>');
};

if(get_post_meta(get_the_ID(), 'tripadvisor_url', true) != ''){
    array_push($social_links, '<a href="'.get_post_meta(get_the_ID(), 'tripadvisor_url', true).'" target="_blank">TripAdvsior</a>');
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
<p>Follow <?php echo the_title(); ?> on: <?php echo implode(' &#8901; ', $social_links); ?></p>

<?php echo do_shortcode('[tourismpress-map]'); ?>
