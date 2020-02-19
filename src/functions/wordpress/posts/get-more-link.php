<?php
/**
 * Get More Link
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

if ( ! function_exists( 'nbpl_get_more_link' ) ) {
	/**
	 * Get More Link
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 *
	 * @param array $args The arguments.
	 *
	 * @return string
	 */
	function nbpl_get_more_link( $args = array() ) {
		$class = new NBPL\WordPress\Posts\MoreLink( $args );
		return $class->render();
	}
}
