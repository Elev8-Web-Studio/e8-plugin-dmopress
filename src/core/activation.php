<?php 
// Prevent external script access
defined('ABSPATH') or die('Script access not permitted.');

//Plugin Activation Tasks
function dmopress_activate() {
    if ( ! get_option( 'dmopress_flush_rewrite_rules_flag' ) ) {
        add_option( 'dmopress_flush_rewrite_rules_flag', true );
    }
}
register_activation_hook( __FILE__, 'dmopress_activate' );

//Plugin Deactivation Tasks
function dmopress_deactivate() {
    dmopress_flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'dmopress_deactivate' );