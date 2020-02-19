<?php
/**
 * Load Files
 *
 * @package    NBPL
 * @subpackage NBPL/Functions/General/Elements
 * @author     NueBuild
 * @copyright  Copyright (c) 2020, NueBuild
 * @license    GNU General Public License v2 or later
 * @since      1.0.0
 */

if ( ! defined( 'WPINC' ) ) {
	wp_die( 'No Access Allowed!', 'Error!', array( 'back_link' => true ) );
}

if ( ! function_exists( 'nbpl_load_files' ) ) {
	/**
	 * Load Files
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 *
	 * @param array  $files The path to files to load.
	 * @param string $root  The directory path to the theme root.
	 *
	 * @return void
	 */
	function nbpl_load_files( $files, $root ) {
		foreach ( $files as $file ) {
			if ( file_exists( $root . $file ) ) {
				require_once $root . $file;
			}
		}
	}
}
