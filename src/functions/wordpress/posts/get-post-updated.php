<?php
/**
 * Get Post Updated
 *
 * @package    NBPL
 * @subpackage NBPL/Functions/Post
 * @author     NueBuild
 * @copyright  Copyright (c) 2020, NueBuild
 * @license    GNU General Public License v2 or later
 * @since      1.0.0
 */

if ( ! defined( 'WPINC' ) ) {
	wp_die( 'No Access Allowed!', 'Error!', array( 'back_link' => true ) );
}

if ( ! function_exists( 'nbpl_get_post_updated' ) ) {
	/**
	 * Get Post Updated
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 *
	 * @param array $args {
	 *     The arguments.
	 *
	 *     @type string $label        (Optional) The label for the plublished date: Defualt: 'Published: '.
	 *     @type string $time_classes (Optional) The classes for the time element. Defualt: 'entry__published-time published-time'.
	 *     @type string $classes      (Optional) The classes for the published element. Defualt: 'entry__published published'.
	 * }
	 *
	 * @return string
	 */
	function nbpl_get_post_updated( $args = array() ) {
		$class = new NBPL\WordPress\Posts\PostUpdated( $args );
		return $class->render();
	}
}
