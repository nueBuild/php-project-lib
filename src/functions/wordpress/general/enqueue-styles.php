<?php
/**
 * Enqueue Styles
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

if ( ! function_exists( 'nbpl_enqueue_styles' ) ) {
	/**
	 * Enqueue Scripts
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 *
	 * @param array $args {
	 *     The arguments for adding Stylesheets.
	 *
	 *      @type array $styles {
	 *         Arguments for enqueuing the stylesheets.
	 *
	 *         @type string $handle      (Required) The handle or name of the script.
	 *         @type string $file        (Required) The source of the file to enqueue.
	 *         @type string $depends     (Optional) The dependencies of the enqueued file. Default: array()
	 *         @type string $media       (Optional) If Stylesheet, The media for which this stylesheet has been defined. Default: 'all'.
	 *         @type mixed  $conditional (Optional) Conditional check to enqueue the script. Default: true
	 *     }
	 *     @type array $admin-styles {
	 *         Arguments for enqueuing the admin stylesheets.
	 *
	 *         @type string $handle      (Required) The handle or name of the script.
	 *         @type string $file        (Required) The source of the file to enqueue.
	 *         @type string $depends     (Optional) The dependencies of the enqueued file. Default: array()
	 *         @type string $media       (Optional) If Stylesheet, The media for which this stylesheet has been defined. Default: 'all'.
	 *         @type mixed  $hook        (Optional) The admin page hook to conditionaly load the script.
	 *         @type mixed  $conditional (Optional) Conditional check to enqueue the script. Default: true
	 *     }
	 * }
	 *
	 * @return void
	 */
	function nbpl_enqueue_styles( $args = array() ) {
		new NBPL\WordPress\General\EnqueueStyles( $args );
	}
}
