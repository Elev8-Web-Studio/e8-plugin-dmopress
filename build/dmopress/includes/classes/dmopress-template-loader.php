<?php
// Prevent external script access
defined('ABSPATH') or die('Script access not permitted.');

if ( ! class_exists( 'DMOPress_Gamajo_Template_Loader' ) ) {
  require plugin_dir_path( __FILE__ ) . 'gamajo-template-loader.php';
}

class DMOPress_Template_Loader extends DMOPress_Gamajo_Template_Loader {
  protected $filter_prefix = 'dmopress';
  protected $theme_template_directory = 'dmopress';
  protected $plugin_directory = DMOPRESS_PLUGIN_DIR;
  protected $plugin_template_directory = 'templates';
}