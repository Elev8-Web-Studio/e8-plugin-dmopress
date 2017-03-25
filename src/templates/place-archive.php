<p>
    <?php echo dmo_get_address_full(); ?>
    <?php
    $telephone = dmo_get_telephone();
    if($telephone != '') {
        echo ' &#8901; <a href="tel:'. preg_replace('/[^0-9,]/','',$telephone) .'">' . $telephone . '</a>';
    }
    ?>
</p>
<p><?php echo the_excerpt(); ?></p>

