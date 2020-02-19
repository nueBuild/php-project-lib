<?php
/**
 * Allowed Tags
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

if ( ! function_exists( 'nbpl_set_allowed_tags' ) ) {
	/**
	 * Allowed Tags
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 *
	 * @param string|array $tags       The the tag(s) to add to the allowed HTML tags list.
	 * @param string|array $attributes The the attribute(s) to add to the allowed HTML tags list.
	 *
	 * @return void
	 */
	function nbpl_set_allowed_tags( $tags = '', $attributes = '' ) {
		$class = new NBPL\WordPress\Formatting\AllowedTags();
		$class->allowed( $tags, $attributes );
	}
}
