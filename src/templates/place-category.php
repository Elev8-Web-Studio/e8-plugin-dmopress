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

?>
<p>
    <?php echo implode(', ', $address_block); ?>
    <?php if($telephone != '') {
        echo ' &#8901; <a href="tel:'. preg_replace('/[^0-9,]/','',$telephone) .'">' . $telephone . '</a>';
    }
    ?>
</p>
<p><?php echo the_excerpt(); ?></p>

