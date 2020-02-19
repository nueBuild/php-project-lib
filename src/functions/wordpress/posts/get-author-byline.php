<?php
/**
 * Get Author Byline
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

if ( ! function_exists( 'nbpl_get_author_byline' ) ) {
	/**
	 * Get Author Byline
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 *
	 * @param array $args {
	 *     The arguments.
	 *
	 *     @type string $label           (Optional) The label text. Default: 'Author'.
	 *     @type string $wrapper         (Optional) The wrapper html tag. Default: 'div'.
	 *     @type string $link_classes    (Optional) The link classes. Default: 'rl fn n'.
	 *     @type string $byline_classes  (Optional) The Byline classes. Default: 'entry__byline byline'.
	 *     @type string $wrapper_classes (Optional) The Author classes. Default: 'entry__author author vcard'.
	 * }
	 *
	 * @return string
	 */
	function nbpl_get_author_byline( $args = array() ) {
		$class = new NBPL\WordPress\Posts\AuthorByline( $args );
		return $class->render();
	}
}
