<?php 

// Main Settings Page
class MySettingsPage {
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page() {
        // This page will be under "Settings"
        add_options_page(
            __('DMOPress Settings', 'dmopress_textdomain'), 
            __('DMOPress', 'dmopress_textdomain'), 
            'manage_options', 
            'dmopress-settings', 
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page() {
        // Set class property
        $this->options = get_option('dmopress');
        ?>
        <div class="wrap">
            <h2><?php _e('DMOPress Settings', 'dmopress_textdomain') ?></h2>           
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'dmopress_options' );   
                do_settings_sections( 'dmopress-setting-admin' );
                submit_button(); 
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init() {        
        register_setting(
            'dmopress_options', // Option group
            'dmopress', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id',
            '',
            array( $this, 'print_section_info' ),
            'dmopress-setting-admin'
        );

        add_settings_section(
            'dmopress_settings_section_google_maps',
            __('Google Maps Settings', 'dmopress_textdomain'),
            array( $this, 'print_section_info' ),
            'dmopress-setting-admin'
        );

        add_settings_field(
            'google_maps_api_key', 
            __('Google Maps API Key','dmopress_textdomain'), 
            array( $this, 'google_maps_callback' ), 
            'dmopress-setting-admin', 
            'dmopress_settings_section_google_maps'
        );

        add_settings_field(
            'google_maps_style', 
            __('Google Maps Default Style','dmopress_textdomain'), 
            array( $this, 'google_maps_style_callback' ), 
            'dmopress-setting-admin', 
            'dmopress_settings_section_google_maps'
        );
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input ) {
        $new_input = array();

        if(isset( $input['google_maps_api_key'])){
            $new_input['google_maps_api_key'] = sanitize_text_field( $input['google_maps_api_key'] );
        }
        if(isset( $input['google_maps_style'])){
            $new_input['google_maps_style'] = sanitize_text_field( $input['google_maps_style'] );
        }

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info() {
        //print 'DMOPress integrates with ';
    }

    public function google_maps_callback($args) {
        extract($args);

        printf(
            '<input type="text" size="45" id="google-maps-api-key" name="dmopress[google_maps_api_key]" value="%s" placeholder="" />',
            isset( $this->options['google_maps_api_key'] ) ? esc_attr( $this->options['google_maps_api_key']) : ''
        );
    }

    public function google_maps_style_callback($args) {
        extract($args);

        $available_options = array(
            'classic' => 'Classic',
            'gotham' => 'Gotham',
            'grayscale' => 'Grayscale',
            'nature' => 'Nature',
            'pear' => 'Pear',
            'safari' => 'Safari'
        );

        $output = '<select name="dmopress[google_maps_style]">';
        foreach ($available_options as $slug => $label) {
            if($this->options['google_maps_style'] == $slug){
                $selected = ' selected';
            } else {
                $selected = '';
            }
            $output .=  '<option value="'.$slug.'" '.$selected.'>'.$label.'</option>';
        }
        
        $output .= '</select>';

        print(
            $output
        );
    }
}




if(is_admin()){
    $dmopress_settings_page = new MySettingsPage();
}

/**
 * Add a Settings link to plugin on Plugins page
 */
function dmo_add_settings_link($links, $file) {

    if ($file == 'dmopress/dmopress.php'){
        $guide_link = '<a href="https://www.dmopress.com/guide/" target="_blank">'.__('Documentation', "dmopress_textdomain").'</a>';
        array_unshift($links, $guide_link);
        
        $settings_link = '<a href="options-general.php?page=dmopress-settings">'.__('Settings', "dmopress_textdomain").'</a>';
        array_unshift($links, $settings_link);
        
    }
    return $links;
}
add_filter('plugin_action_links', 'dmo_add_settings_link', 10, 2 );



function dmopress_plugin_row_meta( $links, $file ) {

	if ( strpos( $file, 'dmopress.php' ) !== false ) {
		$new_links = array(
				'support' => '<a href="https://www.dmopress.com/support/" target="_blank">'.__('Support','dmopress_textdomain').'</a>'
				);
		
		$links = array_merge( $links, $new_links );
	}
	
	return $links;
}
add_filter( 'plugin_row_meta', 'dmopress_plugin_row_meta', 10, 2 );