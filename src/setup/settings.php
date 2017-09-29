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
            'dmopress_settings_section_general',
            __('<hr>Place Settings', 'dmopress_textdomain'),
            array( $this, 'print_section_info' ),
            'dmopress-setting-admin'
        );

        add_settings_field(
            'hours_of_operation', 
            __('Hours of Operation','dmopress_textdomain'), 
            array( $this, 'hours_of_operation_callback' ), 
            'dmopress-setting-admin', 
            'dmopress_settings_section_general'
        );

        add_settings_section(
            'dmopress_settings_section_google_maps',
            __('<hr>Google Maps Settings', 'dmopress_textdomain'),
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
        if(isset( $input['openweathermap_api_key'])){
            $new_input['openweathermap_api_key'] = sanitize_text_field( $input['openweathermap_api_key'] );
        }
        if(isset( $input['openweathermap_default_unit'])){
            $new_input['openweathermap_default_unit'] = sanitize_text_field( $input['openweathermap_default_unit'] );
        }
        if(isset( $input['openweathermap_city_id'])){
            $new_input['openweathermap_city_id'] = sanitize_text_field( $input['openweathermap_city_id'] );
        }
        if(isset( $input['hours_of_operation'])){
            $new_input['hours_of_operation'] = sanitize_text_field( $input['hours_of_operation'] );
        }

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info() {
        //print 'DMOPress integrates with ';
    }

    public function hours_of_operation_callback($args) {
        extract($args);
        
                $available_options = array(
                    'disabled' => 'Disabled',
                    'enabled' => 'Enabled'
                );
        
                $output = '<select name="dmopress[hours_of_operation]">';
                foreach ($available_options as $slug => $label) {
                    if($this->options['hours_of_operation'] == $slug){
                        $selected = ' selected';
                    } else {
                        $selected = '';
                    }
                    $output .=  '<option value="'.$slug.'" '.$selected.'>'.$label.'</option>';
                }
        
                $output .= '</select>';
        
                print($output);
                echo '<p class="description">Track and display the hours of operation for your Places.</p>';
    }

    public function google_maps_callback($args) {
        extract($args);

        printf(
            '<input type="text" size="45" id="google-maps-api-key" name="dmopress[google_maps_api_key]" value="%s" placeholder="" />',
            isset( $this->options['google_maps_api_key'] ) ? esc_attr( $this->options['google_maps_api_key']) : ''
        );
        echo '<p class="description">A Google Maps API Key is required to use map-related shortcodes and widgets. The <a href="https://www.dmopress.com/guide/start/" target="_blank">10 Minute Quick Start Guide</a> has information on how to obtain a key.</p>';
    }

    public function openweathermap_api_key_callback($args) {
        extract($args);

        printf(
            '<input type="text" size="45" id="openweathermap-api-key" name="dmopress[openweathermap_api_key]" value="%s" placeholder="" />',
            isset( $this->options['openweathermap_api_key'] ) ? esc_attr( $this->options['openweathermap_api_key']) : ''
        );
        echo '<p class="description">An <a href="https://www.dmopress.com/openweathermap-howto/" target="_blank">OpenWeatherMaps API Key for Current Weather Data</a> is required.</p>';

    }

    public function openweathermap_default_unit_callback($args) {
        extract($args);

        $available_options = array(
            'c' => 'Celsius',
            'f' => 'Fahrenheit',
            'cf' => 'Celsius / Fahrenheit',
            'fc' => 'Fahrenheit / Celsius'
        );

        $output = '<select name="dmopress[openweathermap_default_unit]">';
        foreach ($available_options as $slug => $label) {
            if($this->options['openweathermap_default_unit'] == $slug){
                $selected = ' selected';
            } else {
                $selected = '';
            }
            $output .=  '<option value="'.$slug.'" '.$selected.'>'.$label.'</option>';
        }
        
        $output .= '</select>';

        print($output);
    }

    public function openweathermap_city_id_callback($args) {
        extract($args);

        printf(
            '<input type="text" size="45" id="openweathermap-city-id" name="dmopress[openweathermap_city_id]" value="%s" placeholder="" />',
            isset( $this->options['openweathermap_city_id'] ) ? esc_attr( $this->options['openweathermap_city_id']) : ''
        );
        echo '<p class="description">An <a href="https://www.dmopress.com/openweathermap-howto/" target="_blank">OpenWeatherMaps City ID</a> is required.</p>';
    }

    public function google_maps_style_callback($args) {
        extract($args);

        $available_options = array(
            'classic' => 'Classic',
            'gotham' => 'Gotham',
            'grayscale' => 'Grayscale',
            'midnight' => 'Midnight',
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

        print($output);
        echo '<p class="description">To preview these options, check out the <a href="https://www.dmopress.com/guide/maps/map-themes/" target="_blank">Map Theme Gallery</a></p>';
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


add_action('customize_register','dmopress_customizer');
function dmopress_customizer( $wp_customize ) {

	$wp_customize->add_section( 'dmopress_settings', array(
		'title' => __( 'DMOPress Settings', 'dmopress' ),
		'priority' => 500
	) );

	$wp_customize->add_setting( 'dmopress[google_maps_api_key]', array(
		'type' => 'option',
		'default' => '',
		'capability' => 'edit_theme_options',
		'transport' => 'refresh', 
		'sanitize_callback' => '',
		'sanitize_js_callback' => '',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'dmopress[google_maps_api_key]', array(
		'label'   => __( 'Google Maps API Key', 'dmopress' ),
		'description' => __( 'A Google Maps API Key is required to use map-related shortcodes and widgets. The <a href="https://www.dmopress.com/guide/start/" target="_blank">10 Minute Quick Start Guide</a> has information on how to obtain a key.', 'dmopress' ),
        'type' => 'text',
		'section' => 'dmopress_settings',
		'settings'   => 'dmopress[google_maps_api_key]',
		'active_callback' => '',
	) ) );

    $wp_customize->add_setting( 'dmopress[google_maps_style]', array(
        'type' => 'option',
        'default' => '',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh', 
        'sanitize_callback' => '',
        'sanitize_js_callback' => '',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'dmopress[google_maps_style]', array(
        'label'   => __( 'Google Maps Default Style', 'dmopress' ),
        'description' => __('Visit the <a href="https://www.dmopress.com/guide/maps/map-themes/" target="_blank">map theme gallery</a> to see a preview of each style.', 'dmopresss'),
        'type' => 'select',
        'choices'  => array(
			'classic'  => 'Classic',
			'gotham' => 'Gotham',
            'grayscale' => 'Grayscale',
            'midnight' => 'Midnight',
            'nature' => 'Nature',
            'pear' => 'Pear',
            'safari' => 'Safari',
		),
        'section' => 'dmopress_settings',
        'settings'   => 'dmopress[google_maps_style]',
        'active_callback' => '',
    ) ) );

    $wp_customize->add_setting( 'dmopress[openweathermap_api_key]', array(
        'type' => 'option',
        'default' => '',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh', 
        'sanitize_callback' => '',
        'sanitize_js_callback' => '',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'dmopress[openweathermap_api_key]', array(
        'label'   => __( 'OpenWeatherMap API Key', 'dmopress' ),
        'description' => __('An <a href="https://www.dmopress.com/openweathermap-howto/" target="_blank">OpenWeatherMaps API Key</a> is required.', 'dmopress_textdomain'),
        'type' => 'text',
        'section' => 'dmopress_settings',
        'settings'   => 'dmopress[openweathermap_api_key]',
        'active_callback' => '',
    ) ) );

    $wp_customize->add_setting( 'dmopress[openweathermap_default_unit]', array(
        'type' => 'option',
        'default' => '',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh', 
        'sanitize_callback' => '',
        'sanitize_js_callback' => '',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'dmopress[openweathermap_default_unit]', array(
        'label'   => __( 'OpenWeatherMap Default Display Unit', 'dmopress' ),
        'type' => 'select',
        'choices'  => array(
            'c'  => 'Celsius',
            'f' => 'Fahrenheit',
            'cf' => 'Celsius / Fahrenheit',
            'fc' => 'Fahrenheit / Celsius'
        ),
        'section' => 'dmopress_settings',
        'settings'   => 'dmopress[openweathermap_default_unit]',
        'active_callback' => '',
    ) ) );

    $wp_customize->add_setting( 'dmopress[openweathermap_city_id]', array(
        'type' => 'option',
        'default' => '5368361',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh', 
        'sanitize_callback' => '',
        'sanitize_js_callback' => '',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'dmopress[openweathermap_city_id]', array(
        'label'   => __( 'OpenWeatherMap City ID', 'dmopress_textdomain' ),
        'description' => __('An <a href="https://www.dmopress.com/openweathermap-howto/" target="_blank">OpenWeatherMaps City ID</a> is required.', 'dmopress_textdomain'),
        'type' => 'text',
        'section' => 'dmopress_settings',
        'settings'   => 'dmopress[openweathermap_city_id]',
        'active_callback' => '',
    ) ) );

}