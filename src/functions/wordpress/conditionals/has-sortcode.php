<?php
/**
 * Has Shortcode
 *
 * @package    NBPL
 * @subpackage NBPL/Functions/WordPress/Conditionals
 * @author     NueBuild
 * @copyright  Copyright (c) 2020, NueBuild
 * @license    GNU General Public License v2 or later
 * @since      1.0.0
 */

if ( ! defined( 'WPINC' ) ) {
	wp_die( 'No Access Allowed!', 'Error!', array( 'back_link' => true ) );
}

if ( ! function_exists( 'nbpl_has_shortcode' ) ) {
	/**
	 * Has Shortcode
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 *
	 * @param string $shortcode (Required) Shortcode(s) to test. Default: ''.
	 * @param string $post_id    (Optional) The post ID. Default: ''.
	 *
	 * @return boolean
	 */
	function nbpl_has_shortcode( $shortcode = '', $post_id = '' ) {
		$class = new NBPL\WordPress\Conditionals\HasShortcode( $shortcode, $post_id );
		return $class->post_has_shortcode();
	}
}
