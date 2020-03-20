<?php
/**
 * Posts Using Templates
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

if ( ! function_exists( 'nbpl_post_uses_template' ) ) {
	/**
	 * Posts Using Templates
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 *
	 * @param string|array $templates The template(s) to check if a post uses template.
	 *
	 * @return int
	 */
	function nbpl_post_using_template( $templates ) {
		$class = new NBPL\WordPress\Posts\Post();
		return $class->posts_using_templates( $templates );
	}
}