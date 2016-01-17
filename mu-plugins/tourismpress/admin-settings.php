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

        add_settings_field(
            'enabled_post_types', 
            'Enabled Content Types', 
            array( $this, 'enabled_post_types_callback' ), 
            'tourismpress-setting-admin', 
            'setting_section_id'
        );

        add_settings_section(
            'tourismpress_settings_section_thirdparty',
            'Third-Party Services Settings',
            array( $this, 'print_section_info' ),
            'tourismpress-setting-admin'
        );

        add_settings_field(
            'google_analytics_id', 
            'Google Analytics Tracking ID', 
            array( $this, 'google_analytics_callback' ), 
            'tourismpress-setting-admin', 
            'tourismpress_settings_section_thirdparty',
            array(
              'desc'      => 'Tracking code should be in format UA-000000-0',
            )
        );

        add_settings_field(
            'google_maps_api_key', 
            'Google Maps API Key', 
            array( $this, 'google_maps_callback' ), 
            'tourismpress-setting-admin', 
            'tourismpress_settings_section_thirdparty'
        );
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input ) {
        $new_input = array();

        if(isset($input['enabled_post_types']) && is_array($_POST['enabled_post_types'])) {
            // let's iterate thru the array
           foreach ($_POST['enabled_post_types'] as $enabled_post_types) {
              error_log("We got here", 0);
           }
        }

        if(isset($input['google_analytics'])) {
            $new_input['google_analytics'] = strtoupper(sanitize_text_field($input['google_analytics']));
            if(!isValidGoogleAnalyticsID($new_input['google_analytics'])){
                add_settings_error('google_analytics','google-analytics','<strong>Configuration Error:</strong> This is not a valid Google Analytics Code. Code should be in the format UA-000000-0');
            }
        }

        if(isset( $input['google_maps_api_key'])){
            $new_input['google_maps_api_key'] = sanitize_text_field( $input['google_maps_api_key'] );
        }

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info() {
        //print 'TourismPress integrates with ';
    }

    public function enabled_post_types_callback(){
        printf(
            '<label for="check_accommodations"><input id="check_accommodations" type="checkbox" name="enabled_post_types[]" value="accommodations" %s />Accommodations</label><br />', isset( $this->options['enabled_post_types'] ) ? 'checked' : ''
        );

        printf(
            '<label for="check_attractions"><input id="check_attractions" type="checkbox" name="enabled_post_types[]" value="attractions" />Attractions</label> <br />
            <label for="check_blog"><input id="check_blog" type="checkbox" name="enabled_post_types[]" value="blog" />Blog</label> <br />
            <label for="check_events"><input id="check_events" type="checkbox" name="enabled_post_types[]" value="events" />Events</label> <br />
            <label for="check_news"><input id="check_news" type="checkbox" name="enabled_post_types[]" value="news" />News</label> <br />
            <label for="check_packages"><input id="check_packages" type="checkbox" name="enabled_post_types[]" value="packages" />Packages</label> <br />
            <label for="check_restaurants"><input id="check_restaurants" type="checkbox" name="enabled_post_types[]" value="restaurants" />Restaurants</label>'
        );
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function google_analytics_callback($args) {
        extract($args);

        printf(
            '<input type="text" id="google-analytics" name="tourismpress[google_analytics]" value="%s" placeholder="UA-000000-0" />',
            isset( $this->options['google_analytics'] ) ? esc_attr( $this->options['google_analytics']) : ''
        );

        if(isset( $this->options['google_analytics'])) {
          if(!isValidGoogleAnalyticsID(esc_attr($this->options['google_analytics']))){
            printf('<div class="tourismpress-admin-badge-bad">&#9664; &nbsp;Missing or invalid Google Analytics Tracking ID</div>');
          } else {
            printf('<div class="tourismpress-admin-badge-good">&#10004; OK</div>');
          }
        }

        printf(
          ($desc != '') ? "<br /><span class='description'>$desc</span>" : ""
        );
    }

    public function google_maps_callback($args) {
        extract($args);

        printf(
            '<input type="text" size="45" id="google-maps-api-key" name="tourismpress[google_maps_api_key]" value="%s" placeholder="" />',
            isset( $this->options['google_maps_api_key'] ) ? esc_attr( $this->options['google_maps_api_key']) : ''
        );
    }
}

function tourismpress_admin_enqueue_style() {
    $cssref = plugins_url('css/tourismpress-admin.css', __FILE__);
    wp_enqueue_style('tourismpress-admin', $cssref, false);

    $bootstrap = plugins_url('css/bootstrap.min.css', __FILE__);
    wp_enqueue_style('tourismpress-bootstrap', $bootstrap, false);

    $jsref = plugins_url('js/tourismpress-admin.js', __FILE__);
    wp_enqueue_script('tourismpress-admin-js', $jsref, false );
}

if(is_admin()){
    add_action( 'admin_enqueue_scripts', 'tourismpress_admin_enqueue_style' );
    $tourismpress_settings_page = new MySettingsPage();
}
