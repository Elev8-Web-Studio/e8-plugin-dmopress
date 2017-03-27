<?php

function dmopress_filter_the_content( $content ) { 
    if (is_singular('places')) {
        remove_filter( 'the_content', 'dmopress_filter_the_content' );
        $dmopress_template_loader = new DMOPress_Template_Loader;
        ob_start();
        $dmopress_template_loader->get_template_part('place','detail');
        $output = ob_get_clean();
        add_filter( 'the_content', 'dmopress_filter_the_content' );
        return $output;
  }

  if (is_post_type_archive('places')) {
        remove_filter( 'the_content', 'dmopress_filter_the_content' );
        $dmopress_template_loader = new DMOPress_Template_Loader;
        ob_start();
        $dmopress_template_loader->get_template_part('place','archive');
        $output = ob_get_clean();
        add_filter( 'the_content', 'dmopress_filter_the_content' );
        return $output;
  }

  if (is_tax('categories')) {
        remove_filter( 'the_content', 'dmopress_filter_the_content' );
        $dmopress_template_loader = new DMOPress_Template_Loader;
        ob_start();
        $dmopress_template_loader->get_template_part('place','category');
        $output = ob_get_clean();
        add_filter( 'the_content', 'dmopress_filter_the_content' );
        return $output;
  }

  if (is_tax('features')) {
        remove_filter( 'the_content', 'dmopress_filter_the_content' );
        $dmopress_template_loader = new DMOPress_Template_Loader;
        ob_start();
        $dmopress_template_loader->get_template_part('place','feature');
        $output = ob_get_clean();
        add_filter( 'the_content', 'dmopress_filter_the_content' );
        return $output;
  }

  if (is_tag()) {
        remove_filter( 'the_content', 'dmopress_filter_the_content' );
        $dmopress_template_loader = new DMOPress_Template_Loader;
        ob_start();
        $dmopress_template_loader->get_template_part('place','tag');
        $output = ob_get_clean();
        add_filter( 'the_content', 'dmopress_filter_the_content' );
        return $output;
  }

}
add_filter( 'the_content', 'dmopress_filter_the_content' ); 

function tourismpress_add_custom_types( $query ) {
  if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
    $query->set( 'post_type', array(
     'post', 'places'
        ));
      return $query;
    }
}
add_filter( 'pre_get_posts', 'tourismpress_add_custom_types' );


