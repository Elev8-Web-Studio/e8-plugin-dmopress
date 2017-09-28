<?php
// Prevent external script access
defined('ABSPATH') or die('Script access not permitted.');

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function dmopress_place_add_hours_of_operation_meta_box() {
    add_meta_box(
        'place-hours-of-operation-section',
        __('Hours of Operation', 'dmopress_textdomain'),
        'dmopress_place_meta_box_hours_of_operation_callback',
        'places',
        'location',
        'high'
    );
}
if(dmopress_get_option('hours_of_operation') == 'enabled'){
	add_action( 'add_meta_boxes', 'dmopress_place_add_hours_of_operation_meta_box' );
}

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function dmopress_place_meta_box_hours_of_operation_callback($post) {

    // Add a nonce field so we can check for it later.
    wp_nonce_field( 'dmopress_place_save_hours_of_operation_meta_box_data', 'dmopress_hours_of_operation_meta_box_nonce' );

    /*
     * Use get_post_meta() to retrieve an existing value
     * from the database and use the value for the form.
     */
    

   ?>

   <div class="container-flex">
		<div class="column">
			<?php 
			$hours_of_operation = get_post_meta( $post->ID, 'hours_of_operation', true ); 
			
			echo '<p><label for="sunday_open">';
			_e( 'Sunday Open', 'dmopress_textdomain' );
			echo ': ';
			echo '</label><br />';
			echo dmopress_render_time_select('sunday_open', $hours_of_operation['sunday_open']);
			echo '</p>';
			?>
			<?php
			echo '<p><label for="sunday_closed">';
			_e( 'Sunday Closed', 'dmopress_textdomain' );
			echo ': ';
			echo '</label><br />';
			echo dmopress_render_time_select('sunday_closed', $hours_of_operation['sunday_closed']);
			echo '</p>';
			?>
		</div>
		<div class="column">
			<?php 
			echo '<p><label for="monday_open">';
			_e( 'Monday Open', 'dmopress_textdomain' );
			echo ': ';
			echo '</label><br />';
			echo dmopress_render_time_select('monday_open', $hours_of_operation['monday_open']);
			echo '</p>';
			?>
			<?php
			echo '<p><label for="monday_closed">';
			_e( 'Monday Closed', 'dmopress_textdomain' );
			echo ': ';
			echo '</label><br />';
			echo dmopress_render_time_select('monday_closed', $hours_of_operation['monday_closed']);
			echo '</p>';
			?>
		</div>
		<div class="column">
			<?php  
			echo '<p><label for="tuesday_open">';
			_e( 'Tuesday Open', 'dmopress_textdomain' );
			echo ': ';
			echo '</label><br />';
			echo dmopress_render_time_select('tuesday_open', $hours_of_operation['tuesday_open']);
			echo '</p>';
			?>
			<?php
			echo '<p><label for="tuesday_closed">';
			_e( 'Tuesday Closed', 'dmopress_textdomain' );
			echo ': ';
			echo '</label><br />';
			echo dmopress_render_time_select('tuesday_closed', $hours_of_operation['tuesday_closed']);
			echo '</p>';
			?>
		</div>
		<div class="column">
			<?php    
			echo '<p><label for="wednesday_open">';
			_e( 'Wednesday Open', 'dmopress_textdomain' );
			echo ': ';
			echo '</label><br />';
			echo dmopress_render_time_select('wednesday_open', $hours_of_operation['wednesday_open']);
			echo '</p>';
			?>
			<?php
			echo '<p><label for="wednesday_closed">';
			_e( 'Wednesday Closed', 'dmopress_textdomain' );
			echo ': ';
			echo '</label><br />';
			echo dmopress_render_time_select('wednesday_closed', $hours_of_operation['wednesday_closed']);
			echo '</p>';
			?>
		</div>
		<div class="column">
			<?php 
			echo '<p><label for="thursday_open">';
			_e( 'Thursday Open', 'dmopress_textdomain' );
			echo ': ';
			echo '</label><br />';
			echo dmopress_render_time_select('thursday_open', $hours_of_operation['thursday_open']);
			echo '</p>';
			?>
			<?php
			echo '<p><label for="thursday_closed">';
			_e( 'Thursday Closed', 'dmopress_textdomain' );
			echo ': ';
			echo '</label><br />';
			echo dmopress_render_time_select('thursday_closed', $hours_of_operation['thursday_closed']);
			echo '</p>';
			?>
		</div>
		<div class="column">
			<?php 
			echo '<p><label for="friday_open">';
			_e( 'Friday Open', 'dmopress_textdomain' );
			echo ': ';
			echo '</label><br />';
			echo dmopress_render_time_select('friday_open', $hours_of_operation['friday_open']);
			echo '</p>';
			?>
			<?php
			echo '<p><label for="friday_closed">';
			_e( 'Friday Closed', 'dmopress_textdomain' );
			echo ': ';
			echo '</label><br />';
			echo dmopress_render_time_select('friday_closed', $hours_of_operation['friday_closed']);
			echo '</p>';
			?>
		</div>
		<div class="column">
			<?php  
			echo '<p><label for="saturday_open">';
			_e( 'Saturday Open', 'dmopress_textdomain' );
			echo ': ';
			echo '</label><br />';
			echo dmopress_render_time_select('saturday_open', $hours_of_operation['saturday_open']);
			echo '</p>';
			?>
			<?php
			echo '<p><label for="saturday_closed">';
			_e( 'Saturday Closed', 'dmopress_textdomain' );
			echo ': ';
			echo '</label><br />';
			echo dmopress_render_time_select('saturday_closed', $hours_of_operation['saturday_closed']);
			echo '</p>';
			?>
		</div>
    </div>

    <?php
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function dmopress_place_save_hours_of_operation_meta_box_data($post_id) {

    /*
     * We need to verify this came from our screen and with proper authorization,
     * because the save_post action can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['dmopress_hours_of_operation_meta_box_nonce'] ) ) {
        return;
    }

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['dmopress_hours_of_operation_meta_box_nonce'], 'dmopress_place_save_hours_of_operation_meta_box_data' ) ) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check the user's permissions.
    if (isset( $_POST['post_type'] ) && 'page' == $_POST['post_type']) {
        if (!current_user_can( 'edit_page', $post_id )) {
            return;
        }
    } else {
        if (!current_user_can( 'edit_post', $post_id )) {
            return;
        }
    }

    /* OK, it's safe for us to save the data now. */
    
    // Make sure that it is set.
    if (!isset( $_POST['sunday_open'])) {
        return;
	}
	if (!isset( $_POST['sunday_closed'])) {
        return;
	}
	if (!isset( $_POST['monday_open'])) {
        return;
	}
	if (!isset( $_POST['monday_closed'])) {
        return;
	}
	if (!isset( $_POST['tuesday_open'])) {
        return;
	}
	if (!isset( $_POST['tuesday_closed'])) {
        return;
	}
	if (!isset( $_POST['wednesday_open'])) {
        return;
	}
	if (!isset( $_POST['wednesday_closed'])) {
        return;
	}
	if (!isset( $_POST['thursday_open'])) {
        return;
	}
	if (!isset( $_POST['thursday_closed'])) {
        return;
	}
	if (!isset( $_POST['friday_open'])) {
        return;
	}
	if (!isset( $_POST['friday_closed'])) {
        return;
	}
	if (!isset( $_POST['saturday_open'])) {
        return;
	}
	if (!isset( $_POST['saturday_closed'])) {
        return;
    }

    // Update the meta field in the database.
	// update_post_meta($post_id, 'sunday_open', sanitize_text_field($_POST['sunday_open']));
	// update_post_meta($post_id, 'sunday_closed', sanitize_text_field($_POST['sunday_closed']));
	// update_post_meta($post_id, 'monday_open', sanitize_text_field($_POST['monday_open']));
	// update_post_meta($post_id, 'monday_closed', sanitize_text_field($_POST['monday_closed']));
	// update_post_meta($post_id, 'tuesday_open', sanitize_text_field($_POST['tuesday_open']));
	// update_post_meta($post_id, 'tuesday_closed', sanitize_text_field($_POST['tuesday_closed']));
	// update_post_meta($post_id, 'wednesday_open', sanitize_text_field($_POST['wednesday_open']));
	// update_post_meta($post_id, 'wednesday_closed', sanitize_text_field($_POST['wednesday_closed']));
	// update_post_meta($post_id, 'thursday_open', sanitize_text_field($_POST['thursday_open']));
	// update_post_meta($post_id, 'thursday_closed', sanitize_text_field($_POST['thursday_closed']));
	// update_post_meta($post_id, 'friday_open', sanitize_text_field($_POST['friday_open']));
	// update_post_meta($post_id, 'friday_closed', sanitize_text_field($_POST['friday_closed']));
	// update_post_meta($post_id, 'saturday_open', sanitize_text_field($_POST['saturday_open']));
	// update_post_meta($post_id, 'saturday_closed', sanitize_text_field($_POST['saturday_closed']));

	update_post_meta($post_id, 'hours_of_operation', array(
		'sunday_open' => sanitize_text_field($_POST['sunday_open']),
		'sunday_closed' => sanitize_text_field($_POST['sunday_closed']),
		'monday_open' => sanitize_text_field($_POST['monday_open']),
		'monday_closed' => sanitize_text_field($_POST['monday_closed']),
		'tuesday_open' => sanitize_text_field($_POST['tuesday_open']),
		'tuesday_closed' => sanitize_text_field($_POST['tuesday_closed']),
		'wednesday_open' => sanitize_text_field($_POST['wednesday_open']),
		'wednesday_closed' => sanitize_text_field($_POST['wednesday_closed']),
		'thursday_open' => sanitize_text_field($_POST['thursday_open']),
		'thursday_closed' => sanitize_text_field($_POST['thursday_closed']),
		'friday_open' => sanitize_text_field($_POST['friday_open']),
		'friday_closed' => sanitize_text_field($_POST['friday_closed']),
		'saturday_open' => sanitize_text_field($_POST['saturday_open']),
		'saturday_closed' => sanitize_text_field($_POST['saturday_closed'])
	));

}
if(dmopress_get_option('hours_of_operation') == 'enabled'){
	add_action('save_post', 'dmopress_place_save_hours_of_operation_meta_box_data');
}

function dmopress_render_time_select($field_name, $selected_value){
	ob_start();
	?>
	<select id="<?php echo $field_name; ?>" name="<?php echo $field_name; ?>">
		<option value="none" <?php if($selected_value == 'none'){ echo 'selected'; } ?>><?php _e('N/A', ''); ?></option>
		<option value="closed" <?php if($selected_value == 'closed'){ echo 'selected'; } ?>><?php _e('Closed', ''); ?></option>
		<option value="0000" <?php if($selected_value == '0000'){ echo 'selected'; } ?>><?php _e('12:00AM', ''); ?></option>
		<option value="0015" <?php if($selected_value == '0015'){ echo 'selected'; } ?>><?php _e('12:15AM', ''); ?></option>
		<option value="0030" <?php if($selected_value == '0030'){ echo 'selected'; } ?>><?php _e('12:30AM', ''); ?></option>
		<option value="0045" <?php if($selected_value == '0045'){ echo 'selected'; } ?>><?php _e('12:45AM', ''); ?></option>
		<option value="0100" <?php if($selected_value == '0100'){ echo 'selected'; } ?>><?php _e('1:00AM', ''); ?></option>
		<option value="0115" <?php if($selected_value == '0115'){ echo 'selected'; } ?>><?php _e('1:15AM', ''); ?></option>
		<option value="0130" <?php if($selected_value == '0130'){ echo 'selected'; } ?>><?php _e('1:30AM', ''); ?></option>
		<option value="0145" <?php if($selected_value == '0145'){ echo 'selected'; } ?>><?php _e('1:45AM', ''); ?></option>
		<option value="0200" <?php if($selected_value == '0200'){ echo 'selected'; } ?>><?php _e('2:00AM', ''); ?></option>
		<option value="0215" <?php if($selected_value == '0215'){ echo 'selected'; } ?>><?php _e('2:15AM', ''); ?></option>
		<option value="0230" <?php if($selected_value == '0230'){ echo 'selected'; } ?>><?php _e('2:30AM', ''); ?></option>
		<option value="0245" <?php if($selected_value == '0245'){ echo 'selected'; } ?>><?php _e('2:45AM', ''); ?></option>
		<option value="0300" <?php if($selected_value == '0300'){ echo 'selected'; } ?>><?php _e('3:00AM', ''); ?></option>
		<option value="0315" <?php if($selected_value == '0315'){ echo 'selected'; } ?>><?php _e('3:15AM', ''); ?></option>
		<option value="0330" <?php if($selected_value == '0330'){ echo 'selected'; } ?>><?php _e('3:30AM', ''); ?></option>
		<option value="0345" <?php if($selected_value == '0345'){ echo 'selected'; } ?>><?php _e('3:45AM', ''); ?></option>
		<option value="0400" <?php if($selected_value == '0400'){ echo 'selected'; } ?>><?php _e('4:00AM', ''); ?></option>
		<option value="0415" <?php if($selected_value == '0415'){ echo 'selected'; } ?>><?php _e('4:15AM', ''); ?></option>
		<option value="0430" <?php if($selected_value == '0430'){ echo 'selected'; } ?>><?php _e('4:30AM', ''); ?></option>
		<option value="0445" <?php if($selected_value == '0445'){ echo 'selected'; } ?>><?php _e('4:45AM', ''); ?></option>
		<option value="0500" <?php if($selected_value == '0500'){ echo 'selected'; } ?>><?php _e('5:00AM', ''); ?></option>
		<option value="0515" <?php if($selected_value == '0515'){ echo 'selected'; } ?>><?php _e('5:15AM', ''); ?></option>
		<option value="0530" <?php if($selected_value == '0530'){ echo 'selected'; } ?>><?php _e('5:30AM', ''); ?></option>
		<option value="0545" <?php if($selected_value == '0545'){ echo 'selected'; } ?>><?php _e('5:45AM', ''); ?></option>
		<option value="0600" <?php if($selected_value == '0600'){ echo 'selected'; } ?>><?php _e('6:00AM', ''); ?></option>
		<option value="0615" <?php if($selected_value == '0615'){ echo 'selected'; } ?>><?php _e('6:15AM', ''); ?></option>
		<option value="0630" <?php if($selected_value == '0630'){ echo 'selected'; } ?>><?php _e('6:30AM', ''); ?></option>
		<option value="0645" <?php if($selected_value == '0645'){ echo 'selected'; } ?>><?php _e('6:45AM', ''); ?></option>
		<option value="0700" <?php if($selected_value == '0700'){ echo 'selected'; } ?>><?php _e('7:00AM', ''); ?></option>
		<option value="0715" <?php if($selected_value == '0715'){ echo 'selected'; } ?>><?php _e('7:15AM', ''); ?></option>
		<option value="0730" <?php if($selected_value == '0730'){ echo 'selected'; } ?>><?php _e('7:30AM', ''); ?></option>
		<option value="0745" <?php if($selected_value == '0745'){ echo 'selected'; } ?>><?php _e('7:45AM', ''); ?></option>
		<option value="0800" <?php if($selected_value == '0800'){ echo 'selected'; } ?>><?php _e('8:00AM', ''); ?></option>
		<option value="0815" <?php if($selected_value == '0815'){ echo 'selected'; } ?>><?php _e('8:15AM', ''); ?></option>
		<option value="0830" <?php if($selected_value == '0830'){ echo 'selected'; } ?>><?php _e('8:30AM', ''); ?></option>
		<option value="0845" <?php if($selected_value == '0845'){ echo 'selected'; } ?>><?php _e('8:45AM', ''); ?></option>
		<option value="0900" <?php if($selected_value == '0900'){ echo 'selected'; } ?>><?php _e('9:00AM', ''); ?></option>
		<option value="0915" <?php if($selected_value == '0915'){ echo 'selected'; } ?>><?php _e('9:15AM', ''); ?></option>
		<option value="0930" <?php if($selected_value == '0930'){ echo 'selected'; } ?>><?php _e('9:30AM', ''); ?></option>
		<option value="0945" <?php if($selected_value == '0945'){ echo 'selected'; } ?>><?php _e('9:45AM', ''); ?></option>
		<option value="1000" <?php if($selected_value == '1000'){ echo 'selected'; } ?>><?php _e('10:00AM', ''); ?></option>
		<option value="1015" <?php if($selected_value == '1015'){ echo 'selected'; } ?>><?php _e('10:15AM', ''); ?></option>
		<option value="1030" <?php if($selected_value == '1030'){ echo 'selected'; } ?>><?php _e('10:30AM', ''); ?></option>
		<option value="1045" <?php if($selected_value == '1045'){ echo 'selected'; } ?>><?php _e('10:45AM', ''); ?></option>
		<option value="1100" <?php if($selected_value == '1100'){ echo 'selected'; } ?>><?php _e('11:00AM', ''); ?></option>
		<option value="1115" <?php if($selected_value == '1115'){ echo 'selected'; } ?>><?php _e('11:15AM', ''); ?></option>
		<option value="1130" <?php if($selected_value == '1130'){ echo 'selected'; } ?>><?php _e('11:30AM', ''); ?></option>
		<option value="1145" <?php if($selected_value == '1145'){ echo 'selected'; } ?>><?php _e('11:45AM', ''); ?></option>
		<option value="1200" <?php if($selected_value == '1200'){ echo 'selected'; } ?>><?php _e('12:00PM', ''); ?></option>
		<option value="1215" <?php if($selected_value == '1215'){ echo 'selected'; } ?>><?php _e('12:15PM', ''); ?></option>
		<option value="1230" <?php if($selected_value == '1230'){ echo 'selected'; } ?>><?php _e('12:30PM', ''); ?></option>
		<option value="1245" <?php if($selected_value == '1245'){ echo 'selected'; } ?>><?php _e('12:45PM', ''); ?></option>
		<option value="1300" <?php if($selected_value == '1300'){ echo 'selected'; } ?>><?php _e('1:00PM', ''); ?></option>
		<option value="1315" <?php if($selected_value == '1335'){ echo 'selected'; } ?>><?php _e('1:15PM', ''); ?></option>
		<option value="1330" <?php if($selected_value == '1330'){ echo 'selected'; } ?>><?php _e('1:30PM', ''); ?></option>
		<option value="1345" <?php if($selected_value == '1345'){ echo 'selected'; } ?>><?php _e('1:45PM', ''); ?></option>
		<option value="1400" <?php if($selected_value == '1400'){ echo 'selected'; } ?>><?php _e('2:00PM', ''); ?></option>
		<option value="1415" <?php if($selected_value == '1415'){ echo 'selected'; } ?>><?php _e('2:15PM', ''); ?></option>
		<option value="1430" <?php if($selected_value == '1430'){ echo 'selected'; } ?>><?php _e('2:30PM', ''); ?></option>
		<option value="1445" <?php if($selected_value == '1445'){ echo 'selected'; } ?>><?php _e('2:45PM', ''); ?></option>
		<option value="1500" <?php if($selected_value == '1500'){ echo 'selected'; } ?>><?php _e('3:00PM', ''); ?></option>
		<option value="1515" <?php if($selected_value == '1515'){ echo 'selected'; } ?>><?php _e('3:15PM', ''); ?></option>
		<option value="1530" <?php if($selected_value == '1530'){ echo 'selected'; } ?>><?php _e('3:30PM', ''); ?></option>
		<option value="1545" <?php if($selected_value == '1545'){ echo 'selected'; } ?>><?php _e('3:45PM', ''); ?></option>
		<option value="1600" <?php if($selected_value == '1600'){ echo 'selected'; } ?>><?php _e('4:00PM', ''); ?></option>
		<option value="1615" <?php if($selected_value == '1615'){ echo 'selected'; } ?>><?php _e('4:15PM', ''); ?></option>
		<option value="1630" <?php if($selected_value == '1630'){ echo 'selected'; } ?>><?php _e('4:30PM', ''); ?></option>
		<option value="1645" <?php if($selected_value == '1645'){ echo 'selected'; } ?>><?php _e('4:45PM', ''); ?></option>
		<option value="1700" <?php if($selected_value == '1700'){ echo 'selected'; } ?>><?php _e('5:00PM', ''); ?></option>
		<option value="1715" <?php if($selected_value == '1715'){ echo 'selected'; } ?>><?php _e('5:15PM', ''); ?></option>
		<option value="1730" <?php if($selected_value == '1730'){ echo 'selected'; } ?>><?php _e('5:30PM', ''); ?></option>
		<option value="1745" <?php if($selected_value == '1745'){ echo 'selected'; } ?>><?php _e('5:45PM', ''); ?></option>
		<option value="1800" <?php if($selected_value == '1800'){ echo 'selected'; } ?>><?php _e('6:00PM', ''); ?></option>
		<option value="1815" <?php if($selected_value == '1815'){ echo 'selected'; } ?>><?php _e('6:15PM', ''); ?></option>
		<option value="1830" <?php if($selected_value == '1830'){ echo 'selected'; } ?>><?php _e('6:30PM', ''); ?></option>
		<option value="1845" <?php if($selected_value == '1845'){ echo 'selected'; } ?>><?php _e('6:45PM', ''); ?></option>
		<option value="1900" <?php if($selected_value == '1900'){ echo 'selected'; } ?>><?php _e('7:00PM', ''); ?></option>
		<option value="1915" <?php if($selected_value == '1915'){ echo 'selected'; } ?>><?php _e('7:15PM', ''); ?></option>
		<option value="1930" <?php if($selected_value == '1930'){ echo 'selected'; } ?>><?php _e('7:30PM', ''); ?></option>
		<option value="1945" <?php if($selected_value == '1945'){ echo 'selected'; } ?>><?php _e('7:45PM', ''); ?></option>
		<option value="2000" <?php if($selected_value == '2000'){ echo 'selected'; } ?>><?php _e('8:00PM', ''); ?></option>
		<option value="2015" <?php if($selected_value == '2015'){ echo 'selected'; } ?>><?php _e('8:15PM', ''); ?></option>
		<option value="2030" <?php if($selected_value == '2030'){ echo 'selected'; } ?>><?php _e('8:30PM', ''); ?></option>
		<option value="2045" <?php if($selected_value == '2045'){ echo 'selected'; } ?>><?php _e('8:45PM', ''); ?></option>
		<option value="2100" <?php if($selected_value == '2100'){ echo 'selected'; } ?>><?php _e('9:00PM', ''); ?></option>
		<option value="2115" <?php if($selected_value == '2115'){ echo 'selected'; } ?>><?php _e('9:15PM', ''); ?></option>
		<option value="2130" <?php if($selected_value == '2130'){ echo 'selected'; } ?>><?php _e('9:30PM', ''); ?></option>
		<option value="2145" <?php if($selected_value == '2145'){ echo 'selected'; } ?>><?php _e('9:45PM', ''); ?></option>
		<option value="2200" <?php if($selected_value == '2200'){ echo 'selected'; } ?>><?php _e('10:00PM', ''); ?></option>
		<option value="2215" <?php if($selected_value == '2215'){ echo 'selected'; } ?>><?php _e('10:15PM', ''); ?></option>
		<option value="2230" <?php if($selected_value == '2230'){ echo 'selected'; } ?>><?php _e('10:30PM', ''); ?></option>
		<option value="2245" <?php if($selected_value == '2245'){ echo 'selected'; } ?>><?php _e('10:45PM', ''); ?></option>
		<option value="2300" <?php if($selected_value == '2300'){ echo 'selected'; } ?>><?php _e('11:00PM', ''); ?></option>
		<option value="2315" <?php if($selected_value == '2315'){ echo 'selected'; } ?>><?php _e('11:15PM', ''); ?></option>
		<option value="2330" <?php if($selected_value == '2330'){ echo 'selected'; } ?>><?php _e('11:30PM', ''); ?></option>
		<option value="2345" <?php if($selected_value == '2345'){ echo 'selected'; } ?>><?php _e('11:45PM', ''); ?></option>
	</select>

	<?php
	return ob_get_clean();
}

