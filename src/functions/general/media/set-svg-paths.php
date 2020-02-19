<?php
/**
 * Set SVG Paths
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

if ( ! function_exists( 'nbpl_set_svg_paths' ) ) {
	/**
	 * Set SVG Paths
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 *
	 * @param array $args The paths to svg files.
	 *
	 * @return void
	 */
	function nbpl_set_svg_paths( $args = array() ) {
		NBPL\General\Media\SVG::set_paths( $args );
	}
}
