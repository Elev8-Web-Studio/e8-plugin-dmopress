<?php

function tourismpress_filter_the_content( $content ) { 
    if (is_singular('places')) {
        remove_filter( 'the_content', 'tourismpress_filter_the_content' );
        $tourismpress_template_loader = new Tourismpress_Template_Loader;
        ob_start();
        $tourismpress_template_loader->get_template_part('place','detail');
        $output = ob_get_clean();
        return $output;
  }

  if (is_post_type_archive('places')) {
        remove_filter( 'the_content', 'tourismpress_filter_the_content' );
        $tourismpress_template_loader = new Tourismpress_Template_Loader;
        ob_start();
        $tourismpress_template_loader->get_template_part('place','archive');
        $output = ob_get_clean();
        return $output;
  }

  if (is_tax('categories')) {
        remove_filter( 'the_content', 'tourismpress_filter_the_content' );
        $tourismpress_template_loader = new Tourismpress_Template_Loader;
        ob_start();
        $tourismpress_template_loader->get_template_part('place','category');
        $output = ob_get_clean();
        return $output;
  }

  if (is_tax('features')) {
        remove_filter( 'the_content', 'tourismpress_filter_the_content' );
        $tourismpress_template_loader = new Tourismpress_Template_Loader;
        ob_start();
        $tourismpress_template_loader->get_template_part('place','feature');
        $output = ob_get_clean();
        return $output;
  }

  if (is_tag()) {
        remove_filter( 'the_content', 'tourismpress_filter_the_content' );
        $tourismpress_template_loader = new Tourismpress_Template_Loader;
        ob_start();
        $tourismpress_template_loader->get_template_part('place','tag');
        $output = ob_get_clean();
        return $output;
  }

}
add_filter( 'the_content', 'tourismpress_filter_the_content' ); 