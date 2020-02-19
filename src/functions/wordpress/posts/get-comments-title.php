<?php
/**
 * Get Comments Title
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

if ( ! function_exists( 'nbpl_get_comments_title' ) ) {
	/**
	 * Get Comments Title
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 *
	 * @param array $args {
	 *     The arguments.
	 *
	 *     @type string $singular (Optional) The Singular text. Default: 'Comment for'.
	 *     @type string $plural   (Optional) The plural text. Default: 'Comments for'.
	 *     @type string $wrapper  (Optional) The wrapper html tag. Default: 'span'.
	 *     @type string $classes  (Optional) The wrapper calsses. Default: 'comments__title'.
	 * }
	 *
	 * @return string
	 */
	function nbpl_get_comments_title( $args = array() ) {
		$class = new NBPL\WordPress\Posts\CommentsTitle( $args );
		return $class->render();
	}
}
