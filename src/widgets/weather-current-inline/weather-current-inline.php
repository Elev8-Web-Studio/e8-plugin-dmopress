<?php 

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class DMOPress_Weather_Inline extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'widget_weather_inline widget_text',
			'description' => 'Displays an inline weather widget.',
		);
		parent::__construct( 'weather_inline', 'Inline Weather', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];

		
		if ( ! empty( $instance['unit'] ) ) {
			
			// echo '<a href="'.$instance['link'].'" target="_blank"><i class="fa fa-'.$instance['icon_type'].'" aria-hidden="true"></i>';
			// if( ! empty( $instance['link_text'] ) ){
			// 	echo '<span>'.$instance['link_text'].'</span>';
			// }
			// echo '</a>';

            echo do_shortcode('[dmo-inline-weather unit="'.$instance['unit'].'"]');
		}
		echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		$unit = ! empty( $instance['unit'] ) ? $instance['unit'] : 'both';
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'unit' ) ); ?>"><?php _e( esc_attr( 'Display Unit:' ) ); ?></label> 
			<select id="<?php echo esc_attr( $this->get_field_id( 'unit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'unit' ) ); ?>">
				<option value="c" <?php if(esc_attr( $unit ) == 'c'){ echo ' selected';} ?>>Celsius</option>
				<option value="f" <?php if(esc_attr( $unit ) == 'f'){ echo ' selected';} ?>>Fahrenheit</option>
				<option value="cf" <?php if(esc_attr( $unit ) == 'cf'){ echo ' selected';} ?>>Celsius / Fahrenheit</option>
				<option value="fc" <?php if(esc_attr( $unit ) == 'fc'){ echo ' selected';} ?>>Fahrenheit / Celsius</option>
			</select>
		</p>
		<?php 
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		
		$instance = array();
		$instance['unit'] = ( ! empty( $new_instance['unit'] ) ) ? strip_tags( $new_instance['unit'] ) : '';

		return $instance;

	}
}

//Register all widgets
add_action( 'widgets_init', function(){
	register_widget( 'DMOPress_Weather_Inline' );
});