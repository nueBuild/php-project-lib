<?php
/**
 * Check type of flexible content.
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

if ( ! function_exists( 'nbpl_is_flexible_content' ) ) {
	/**
	 * Allowed Tags
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 *
	 * @param string $type  The flexible content ID.
	 * @param array  $array The flexible content array.
	 *
	 * @return array
	 */
	function nbpl_is_flexible_content( $type, $array ) {
		return NBPL\WordPress\ACF\ACF::is_flexible_type( $type, $array );
	}
}
