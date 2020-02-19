<?php
/**
 * Get SVG
 *
 * @package    NBPL
 * @subpackage NBPL/Functions/General
 * @author     NueBuild
 * @copyright  Copyright (c) 2020, NueBuild
 * @license    GNU General Public License v2 or later
 * @since      1.0.0
 */

if ( ! defined( 'WPINC' ) ) {
	wp_die( 'No Access Allowed!', 'Error!', array( 'back_link' => true ) );
}

if ( ! function_exists( 'nbpl_get_svg' ) ) {
	/**
	 * Get SVG
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 *
	 * @param string $path       The path to the files.
	 * @param string $filename   The svg filename.
	 * @param array  $attributes Attributes for the image HTML output.
	 *
	 * @return string
	 */
	function nbpl_get_svg( $path, $filename, $attributes = array() ) {
		return NBPL\General\Media\SVG::get( $path, $filename, $attributes );
	}
}
