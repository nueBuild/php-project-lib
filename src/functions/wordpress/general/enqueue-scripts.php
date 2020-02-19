<?php
/**
 * Enqueue Scripts
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

if ( ! function_exists( 'nbpl_enqueue_scripts' ) ) {
	/**
	 * Enqueue Scripts
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 *
	 * @param array $args {
	 *     The arguments for adding JavaScript.
	 *
	 *     @type array $scripts {
	 *         Arguments for enqueuing the scripts.
	 *
	 *         @type array {
	 *             @type string $handle      (Required) The handle of the script.
	 *             @type string $file        (Required) The file to enqueue.
	 *             @type string $depends     (Optional) Required depandecies. Default: array()
	 *             @type string $in_footer   (Optional) Load in the footer. Default: true
	 *             @type mixed  $conditional (Optional) Conditional check to enqueue the script. Default: true
	 *         }
	 *     }
	 *     @type array $admin_scripts {
	 *         Arguments for enqueuing the admin scripts.
	 *
	 *         @type array {
	 *             @type string $handle      (Required) The handle of the script.
	 *             @type string $file        (Required) The file to enqueue.
	 *             @type string $depends     (Optional) Required depandecies. Default: array()
	 *             @type string $in_footer   (Optional) Load in the footer. Default: true
	 *             @type mixed  $hook        (Optional) The admin page hook to conditionaly load the script.
	 *             @type mixed  $conditional (Optional) Conditional check to enqueue the script. Default: true
	 *         }
	 *     }
	 *     @type array $localized {
	 *         Arguments for localized scripts.
	 *
	 *         @type array {
	 *             @type string $handle      (Required) The handle of the script to target.
	 *             @type string $name        (Required) The name of the localized script.
	 *             @type array  $data        (Optional) The data to send.
	 *             @type mixed  $conditional (Optional) Conditional check to load the localized script. Default: true
	 *         }
	 *     }
	 *     @type array $admin_localized {
	 *         Arguments for localized admin scripts.
	 *
	 *         @type array {
	 *             @type string $handle      (Required) The handle of the script to target.
	 *             @type string $name        (Required) The name of the localized script.
	 *             @type array  $data        (Optional) The data to send.
	 *             @type mixed  $conditional (Optional) Conditional check to load the localized script. Default: true
	 *         }
	 *     }
	 * }
	 *
	 * @return void
	 */
	function nbpl_enqueue_scripts( $args = array() ) {
		new NBPL\WordPress\General\EnqueueScripts( $args );
	}
}
