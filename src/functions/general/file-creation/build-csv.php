<?php
/**
 * Build CSV
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

if ( ! function_exists( 'nbpl_build_csv' ) ) {
	/**
	 * Get SVG
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 *
	 * @param array $args {
	 *     $args The arguments.
	 *
	 *     @type string  $filename           (Required) The name of the CSV file. Default: ''.
	 *     @type array   $data               (Required) A multidimensional array of used to build csv file. Default: Array.
	 *     @type string  $header             (Optional) The column headers for the cvs file. Default: Array.
	 * }
	 *
	 * @return string
	 */
	function nbpl_build_csv( $args = array() ) {
		$class = new NBPL\General\File_Creation\CSV( $args );
		return $class->build();
	}
}
