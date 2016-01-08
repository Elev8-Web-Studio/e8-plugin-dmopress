<?php 

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
            'TourismHub Settings', 
            'TourismHub', 
            'manage_options', 
            'tourismhub-settings', 
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page() {
        // Set class property
        $this->options = get_option( 'tourismhub_option' );
        ?>
        <div class="wrap">
            <h2>TourismHub Settings</h2>           
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'tourismhub_option_group' );   
                do_settings_sections( 'tourismhub-setting-admin' );
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
            'tourismhub_option_group', // Option group
            'tourismhub_option', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'My Custom Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'tourismhub-setting-admin' // Page
        );

        add_settings_field(
            'id_number', // ID
            'ID Number', // Title 
            array( $this, 'id_number_callback' ), // Callback
            'tourismhub-setting-admin', // Page
            'setting_section_id' // Section           
        );      

        add_settings_field(
            'title', 
            'Title', 
            array( $this, 'title_callback' ), 
            'tourismhub-setting-admin', 
            'setting_section_id'
        );

        add_settings_section(
            'tourismhub_settings_section_thirdparty', // ID
            'Third-Party Integration Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'tourismhub-setting-admin' // Page
        );

        add_settings_field(
            'google_analytics_id', 
            'Google Analytics Tracking ID', 
            array( $this, 'google_analytics_callback' ), 
            'tourismhub-setting-admin', 
            'tourismhub_settings_section_thirdparty',
            array(
              'desc'      => 'Tracking code should be in format UA-000000-0',
            )
        );
    }



    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input ) {
        $new_input = array();
        if( isset( $input['id_number'] ) ){
            $new_input['id_number'] = absint( $input['id_number'] );
        }

        if( isset( $input['title'] ) ){
            $new_input['title'] = sanitize_text_field( $input['title'] );
        }

        if(isset($input['google_analytics'])) {
            $new_input['google_analytics'] = strtoupper(sanitize_text_field($input['google_analytics']));
            if(!isValidGoogleAnalyticsID($new_input['google_analytics'])){
                add_settings_error('google_analytics','google-analytics','<strong>Configuration Error:</strong> This is not a valid Google Analytics Code. Code should be in the format UA-000000-0');
            } 
        }

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info() {
        //print 'TourismHub integrates with ';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function id_number_callback() {
        printf(
            '<input type="text" id="id_number" name="tourismhub_option[id_number]" value="%s" />',
            isset( $this->options['id_number'] ) ? esc_attr( $this->options['id_number']) : ''
        );
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function title_callback() {
        printf(
            '<input type="text" id="title" name="tourismhub_option[title]" value="%s" />',
            isset( $this->options['title'] ) ? esc_attr( $this->options['title']) : ''
        );
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function google_analytics_callback($args) {
        extract($args);

        printf(
            '<input type="text" id="google-analytics" name="tourismhub_option[google_analytics]" value="%s" placeholder="UA-000000-0" />',
            isset( $this->options['google_analytics'] ) ? esc_attr( $this->options['google_analytics']) : ''
        );

        if(isset( $this->options['google_analytics'])) {
          if(!isValidGoogleAnalyticsID(esc_attr($this->options['google_analytics']))){
            printf('&nbsp;&nbsp;<div style="display: inline; font-size: 13px; color: White; background-color: #cc0000; padding: 4px 10px 4px 10px; border-radius: 2px; font-weight: bold;">Missing or invalid Google Analytics ID</div>');
          } else {
            printf('&nbsp;&nbsp;<div style="display: inline; font-size: 13px; color: White; background-color: Green; padding: 4px 10px 4px 10px; border-radius: 2px; font-weight: bold;">&#10004; OK</div>');
          }
          
        }

        printf(
          ($desc != '') ? "<br /><span class='description'>$desc</span>" : ""
        );
    }
}

if(is_admin()){
    $tourismhub_settings_page = new MySettingsPage();
}
