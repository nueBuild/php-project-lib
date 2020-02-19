<?php
/**
 * Get ACF Field
 *
 * @package    NBPL
 * @subpackage NBPL/Functions/WordPress/Formatting
 * @author     NueBuild
 * @copyright  Copyright (c) 2020, NueBuild
 * @license    GNU General Public License v2 or later
 * @since      1.0.0
 */

if ( ! defined( 'WPINC' ) ) {
	wp_die( 'No Access Allowed!', 'Error!', array( 'back_link' => true ) );
}

if ( ! function_exists( 'nbpl_get_field' ) ) {
	/**
	 * Allowed Tags
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 *
	 * @param array $args {
	 *     The arguments, can be an array or a string of the selector.
	 *
	 *     @type string   $selector     (Required) The ACF field ID. Default ''
	 *     @partypeam int $post_id      (Optional) The post ID. Default ''
	 *     @type string   $format_value (Optional) The type of meta to get. Default true
	 *     @type boolean  $use_acf      (Optional) True to use native ACF get_field(). Default false
	 * }
	 *
	 * @return mixed
	 */
	function nbpl_get_field( $args = array() ) {
		return NBPL\WordPress\ACF\ACF::get_field( $args );
	}
}
