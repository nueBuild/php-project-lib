<?php
/**
 * Theme Setup
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

if ( ! function_exists( 'nbpl_theme_setup' ) ) {
	/**
	 * Theme Setup
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 *
	 * @param array $args {
	 *     Array of arguments for the theme setup.
	 *
	 *     @type array $theme_support {
	 *         $type array {
	 *             @type string $type   (Optional) The type of theme support. Default: ''.
	 *             @type array  $params (Optional) The support type parameters. Default: array.
	 *         }
	 *     }
	 *     @type array $add_image_size {
	 *         @type array {
	 *             @type string  $name   (Optional) The image size name. Default: ''.
	 *             @type int     $width  (Optional) The image width. Default: 0.
	 *             @type int     $height (Optional) The image height. Default: 0.
	 *             @type boolean $crop   (Optional) If to crop the image. Default: false.
	 *         }
	 *     }
	 *     @type array $register_nav_menus (Optional) Array of menu locations. Default: array().
	 *     @type array {
	 *         @type string textdomain (Optional) The textdomain. Default: ''.
	 *         @type string path       (Optional) The directory path to the language directory. Default: ''.
	 *     }
	 * }
	 *
	 * @return void
	 */
	function nbpl_theme_setup( $args = array() ) {
		new NBPL\WordPress\General\ThemeSetup( $args );
	}
}
