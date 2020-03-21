<?php
/**
 * Posts Using Shortcodes
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

if ( ! function_exists( 'nbpl_post_uses_shortcodes' ) ) {
	/**
	 * Posts Using Shortcodes
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 *
	 * @param string|array $shortcodes The shortcode(s) to check if a post is using.
	 *
	 * @return int
	 */
	function nbpl_post_using_shortcodes( $shortcodes ) {
		$class = new NBPL\WordPress\Posts\Post();
		return $class->posts_using_shortcodes( $shortcodes );
	}
}