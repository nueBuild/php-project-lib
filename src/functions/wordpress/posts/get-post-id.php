<?php
/**
 * Get Post ID
 *
 * @package    NBPL
 * @subpackage NBPL/Functions/WordPress/Post
 * @author     NueBuild
 * @copyright  Copyright (c) 2020, NueBuild
 * @license    GNU General Public License v2 or later
 * @since      1.0.0
 */

if ( ! defined( 'WPINC' ) ) {
	wp_die( 'No Access Allowed!', 'Error!', array( 'back_link' => true ) );
}

if ( ! function_exists( 'nbpl_get_post_id' ) ) {
	/**
	 * Allowed Tags
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 *
	 * @return int
	 */
	function nbpl_get_post_id() {
		$class = new NBPL\WordPress\Posts\Post();
		return $class->get_id();
	}
}
