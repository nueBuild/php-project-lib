<?php
/**
 * Get ACF Flexible Content Field
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

if ( ! function_exists( 'nbpl_get_flexible_content' ) ) {
	/**
	 * Allowed Tags
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 *
	 * @param string $selector The ACF field ID.
	 * @param string $field    The flexible content ID.
	 * @param int    $post_id  The post ID.
	 *
	 * @return array
	 */
	function nbpl_get_flexible_content( $selector, $field = '', $post_id = '' ) {
		return NBPL\WordPress\ACF\ACF::get_flexible_content( $selector, $field, $post_id );
	}
}
