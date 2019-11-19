<?php
// Prevent external script access
defined('ABSPATH') or die('Script access not permitted.');

function dmo_is_place_open($post_id = false){
	if(!$post_id) {
		$post_id = get_the_ID();
	}
	$hours_of_operation = get_post_meta($post_id, 'hours_of_operation');
	
	if($hours_of_operation){
		$current_day_of_week = strtolower(date('l'));
		$current_time = date_i18n( 'Hi' );
		$open_time = $hours_of_operation[0][$current_day_of_week.'_open'];
		$closing_time = $hours_of_operation[0][$current_day_of_week.'_closed'];
		if($current_time >= $open_time){
			if($current_time <= $closing_time){
				return true;
			} else {
				if($open_time >= $closing_time){
					return true;
				} else {
					return false;
				}
			}
		} else {
			return false;
		}
	} else {
		return false;
	}	
}

function dmo_is_place_closed($post_id = false){
	if(!$post_id) {
		$post_id = get_the_ID();
	}
	$hours_of_operation = get_post_meta($post_id, 'hours_of_operation');

	if($hours_of_operation){
		$current_day_of_week = strtolower(date('l'));
		$current_time = date_i18n( 'Hi' );
		$open_time = $hours_of_operation[0][$current_day_of_week.'_open'];
		$closing_time = $hours_of_operation[0][$current_day_of_week.'_closed'];
		
		if($open_time == 'closed' || $closing_time == 'closed'){
			return true;
		} elseif ($open_time == '' || $open_time == 'none' || $closing_time == '' || $closing_time == 'none') {
			return false;
		} else {
			if($current_time <= $open_time || $current_time >= $closing_time){
				return true;
			} else {
				return false;
			}
		}
	} else {
		return false;
	}
}

function dmo_is_before_open_time($post_id = false){
	if(!$post_id) {
		$post_id = get_the_ID();
	}
	$hours_of_operation = get_post_meta($post_id, 'hours_of_operation');

	if($hours_of_operation){
		$current_day_of_week = strtolower(date('l'));
		$current_time = date_i18n( 'Hi' );
		$open_time = $hours_of_operation[0][$current_day_of_week.'_open'];
		
		if($open_time == '' || $open_time == 'none' || $open_time == 'closed'){
			return false;
		} else {
			if($current_time <= $open_time){
				return true;
			} else {
				return false;
			}
		}
	} else {
		return false;
	}
	
}

function dmo_is_after_closing_time($post_id = false){
	if(!$post_id) {
		$post_id = get_the_ID();
	}
	$hours_of_operation = get_post_meta($post_id, 'hours_of_operation');

	if($hours_of_operation){
		$current_day_of_week = strtolower(date('l'));
		$current_time = date_i18n( 'Hi' );
		$closed_time = $hours_of_operation[0][$current_day_of_week.'_closed'];
		
		if($closed_time == '' || $closed_time == 'none' || $closed_time == 'closed'){
			return false;
		} else {
			if($current_time >= $closed_time){
				return true;
			} else {
				return false;
			}
		}
	} else {
		return false;
	}
	
}

function dmo_the_open_time($post_id = false, $day_of_week = 'sunday', $date_format = 'g:ia'){
	if(!$post_id) {
		$post_id = get_the_ID();
	}
	$hours_of_operation = get_post_meta($post_id, 'hours_of_operation');
	if($hours_of_operation){
		$open_time = date_create_from_format('Hi', $hours_of_operation[0][$day_of_week.'_open']);
		echo date_format($open_time, $date_format);
	}
}

function dmo_the_closing_time($post_id = false, $day_of_week = 'sunday', $date_format = 'g:ia'){
	if(!$post_id) {
		$post_id = get_the_ID();
	}
	$hours_of_operation = get_post_meta($post_id, 'hours_of_operation');
	if($hours_of_operation){
		$closing_time = date_create_from_format('Hi', $hours_of_operation[0][$day_of_week.'_closed']);
		echo date_format($closing_time, $date_format);
	}
}

