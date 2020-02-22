<?php
/**
 * Theme Setup.
 *
 * @package    NBPL
 * @subpackage NBPL/WordPress/General
 * @author     Jason Witt <info@nuebuild.com>
 * @copyright  Copyright ((c) 2020, Jason Witt
 * @license    GNU General Public License v2 or later
 * @since      1.0.0
 *
 * @version 1.0.2
 */

namespace NBPL\WordPress\General;

use NBPL\Base;

if ( ! defined( 'WPINC' ) ) {
	wp_die( 'No Access Allowed!', 'Error!', array( 'back_link' => true ) );
}

if ( ! class_exists( __NAMESPACE__ . '\\ThemeSetup' ) ) {

	/**
	 * Theme Setup.
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 */
	class ThemeSetup extends Base {

		/**
		 * Initialize the class
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
		public function __construct( $args = array() ) {
			$this->defaults = $this->set_defaults();
			parent::__construct( $args );

			$this->hooks();
		}

		/**
		 * Set Defaults
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @return array
		 */
		public function set_defaults() {
			return array(
				'theme_support'         => array(),
				'add_image_size'        => array(),
				'register_nav_menus'    => array(),
				'load_theme_textdomain' => array(),
			);
		}

		/**
		 * Hooks.
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @return void
		 */
		public function hooks() {
			add_action(
				'after_setup_theme',
				function() {
					$this->load_textdomain();
					$this->add_theme_support();
					$this->add_image_size();
					$this->register_nav_menus();

					do_action( 'nbpl_theme_setup' );
				}
			);
		}

		/**
		 * Load textdomain.
		 *
		 * @author Theme_Author
		 * @since  1.0.0
		 *
		 * @return void
		 */
		public function load_textdomain() {
			if ( ! empty( $this->args->load_theme_textdomain->textdomain && $this->args->load_theme_textdomain->path ) ) {
				load_theme_textdomain( $this->args->load_theme_textdomain->textdomain, $this->args->load_theme_textdomain->path );
			}
		}

		/**
		 * Add Theme support.
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @return void
		 */
		public function add_theme_support() {

			$theme_support = $this->args->theme_support;

			// Bail if theme support is not set.
			if ( empty( $theme_support ) ) {
				return;
			}

			foreach ( $theme_support as $support ) {
				$type   = ! empty( $support['type'] ) ? $support['type'] : '';
				$params = ! empty( $support['params'] ) ? $support['params'] : array();

				if ( $type && $params ) {
					add_theme_support( $support['type'], $params );
				}

				if ( $type && ! $params ) {
					add_theme_support( $support['type'] );
				}
			}
		}

		/**
		 * Add Image Sizes
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @return void
		 */
		public function add_image_size() {
			$image_sizes = ! empty( $this->args->add_image_size ) ? $this->args->add_image_size : array();
			if ( ! empty( $image_sizes ) ) {
				foreach ( $image_sizes as $sizes ) {
					$name   = ! empty( $sizes['name'] ) ? $sizes['name'] : '';
					$width  = ! empty( $sizes['width'] ) ? $sizes['width'] : 0;
					$height = ! empty( $sizes['height'] ) ? $sizes['height'] : 0;
					$crop   = ! empty( $sizes['crop'] ) ? $sizes['crop'] : false;

					add_image_size( $name, $width, $height, $crop );
				}
			}
		}

		/**
		 * Register Nav Menus
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @return void
		 */
		public function register_nav_menus() {
			$menus = ! empty( $this->args->register_nav_menus ) ? $this->args->register_nav_menus : array();

			if ( ! empty( $menus ) ) {
				register_nav_menus( (array) $menus );
			}
		}
	}
}
