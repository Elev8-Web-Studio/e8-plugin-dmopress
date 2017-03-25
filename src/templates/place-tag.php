<?php 
$address_block = array();

if(dmo_get_address() != ''){
    array_push($address_block, dmo_get_address());
};
if(dmo_get_city() != ''){
    array_push($address_block, dmo_get_city());
};
if(dmo_get_state() != ''){
    array_push($address_block, dmo_get_state());
};
if(dmo_get_zip() != ''){
    array_push($address_block, dmo_get_zip());
};

$telephone = dmo_get_telephone();

?>
<p>
    <?php echo implode(', ', $address_block); ?>
    <?php if($telephone != '') {
        echo ' &#8901; <a href="tel:'. preg_replace('/[^0-9,]/','',$telephone) .'">' . $telephone . '</a>';
    }
    ?>
</p>
<p><?php echo the_excerpt(); ?></p>