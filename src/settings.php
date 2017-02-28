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
            'TourismPress Settings', 
            'TourismPress', 
            'manage_options', 
            'tourismpress-settings', 
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page() {
        // Set class property
        $this->options = get_option('tourismpress');
        ?>
        <div class="wrap">
            <h2>TourismPress Settings</h2>           
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'tourismpress_options' );   
                do_settings_sections( 'tourismpress-setting-admin' );
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
            'tourismpress_options', // Option group
            'tourismpress', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id',
            '',
            array( $this, 'print_section_info' ),
            'tourismpress-setting-admin'
        );

        add_settings_section(
            'tourismpress_settings_section_google_maps',
            'Google Maps Settings',
            array( $this, 'print_section_info' ),
            'tourismpress-setting-admin'
        );

        add_settings_field(
            'google_maps_api_key', 
            'Google Maps API Key', 
            array( $this, 'google_maps_callback' ), 
            'tourismpress-setting-admin', 
            'tourismpress_settings_section_google_maps'
        );

        add_settings_field(
            'google_maps_style', 
            'Google Maps Default Style', 
            array( $this, 'google_maps_style_callback' ), 
            'tourismpress-setting-admin', 
            'tourismpress_settings_section_google_maps'
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
        //print 'TourismPress integrates with ';
    }

    public function google_maps_callback($args) {
        extract($args);

        printf(
            '<input type="text" size="45" id="google-maps-api-key" name="tourismpress[google_maps_api_key]" value="%s" placeholder="" />',
            isset( $this->options['google_maps_api_key'] ) ? esc_attr( $this->options['google_maps_api_key']) : ''
        );
    }

    public function google_maps_style_callback($args) {
        extract($args);

        $available_options = array(
            'classic' => 'Classic',
            'gotham' => 'Gotham',
            'grayscale' => 'Grayscale',
            'nature' => 'Nature'
        );

        $output = '<select name="tourismpress[google_maps_style]">';
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
            //'<input type="text" size="45" id="google-maps-style" name="tourismpress[google_maps_style]" value="%s" placeholder="" />'
        );
    }
}



if(is_admin()){
    $tourismpress_settings_page = new MySettingsPage();
}
