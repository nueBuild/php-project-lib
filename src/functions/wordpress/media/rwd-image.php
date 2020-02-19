<?php
/**
 * RWD Image.
 *
 * @package    NBPL
 * @subpackage NBPL/Functions/Media
 * @author     NueBuild
 * @copyright  Copyright (c) 2020, NueBuild
 * @license    GNU General Public License v2 or later
 * @since      1.0.0
 */

if ( ! defined( 'WPINC' ) ) {
	wp_die( 'No Access Allowed!', 'Error!', array( 'back_link' => true ) );
}

if ( ! function_exists( 'nbpl_rwd_image' ) ) {
	/**
	 * RWD Image.
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 *
	 * @param array $args {
	 *     The arguments.
	 *
	 *     @type string  $id        The image ID.
	 *     @type string  $size      The image size.
	 *     @type string  $max_width The max width of the image to be displayed.
	 *     @type boolean $data      True to return an array of the image data.
	 * }
	 *
	 * @return mixed
	 */
	function nbpl_rwd_image( $args = array() ) {
		$class = new NBPL\WordPress\Media\RWDImage( $args );
		return $class->get();
	}
}
