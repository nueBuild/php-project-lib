<?php
/**
 * Init
 * Initalize Common Functionality
 *
 * @package    NBPL
 * @subpackage NBPL/Inlcudes/Functions
 * @author     NueBuild
 * @copyright  Copyright (c) 2020, NueBuild
 * @license    GNU General Public License v2 or later
 * @since      1.0.0
 */

if ( ! defined( 'WPINC' ) ) {
	wp_die( 'No Access Allowed!', 'Error!', array( 'back_link' => true ) );
}

if ( ! function_exists( 'nbpl_init' ) ) {
	/**
	 * Init
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 *
	 * @return void
	 */
	function nbpl_init( $args = array() ) {
		$trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1); // phpcs:ignore
		$file  = ! empty( $trace ) && isset( $trace[0]['file'] ) ? $trace[0]['file'] : '';

		if ( ! is_array( $args ) ) {
			$args = array();
		}

		$args['root_file'] = $file;

		$class = new NBPL\Init( $args );
	}
}
