<?php
/**
 * Enqueue Styles.
 *
 * @package    NBPL
 * @subpackage NBPL/WordPress/General
 * @author     Jason Witt <info@nuebuild.com>
 * @copyright  Copyright ((c) 2020, Jason Witt
 * @license    GNU General Public License v2 or later
 * @since      1.0.0
 *
 * @version 1.0.5
 */

namespace NBPL\WordPress\General;

use NBPL\Base;

if ( ! defined( 'WPINC' ) ) {
	wp_die( 'No Access Allowed!', 'Error!', array( 'back_link' => true ) );
}

if ( ! class_exists( __NAMESPACE__ . '\\EnqueueStyles' ) ) {

	/**
	 * Enqueue Styles.
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 */
	class EnqueueStyles extends Base {

		/**
		 * Initialize the class
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
				'styles'       => array(
					'handle'      => '',
					'file'        => '',
					'depends'     => array(),
					'media'       => 'all',
					'conditional' => '',
				),
				'admin_styles' => array(
					'handle'      => '',
					'file'        => '',
					'depends'     => array(),
					'media'       => 'all',
					'hook'        => '',
					'conditional' => '',
				),
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
			add_action( 'wp_enqueue_scripts', array( $this, 'styles' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_styles' ) );
		}

		/**
		 * Enqueue Styles.
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @return void
		 */
		public function styles() {
			// Bail if styles is empty.
			if ( empty( $this->args->styles ) ) {
				return;
			}

			foreach ( $this->args->styles as $style ) {
				$conditional = ! empty( $script['conditional'] ) ? call_user_func( $script['conditional'] ) : true;

				if ( $conditional ) {
					$this->enqueue( $style );
				} else {
					continue;
				}
			}
		}

		/**
		 * Enqueue Admin Styles.
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @param string $hook The admin page hook.
		 *
		 * @return void
		 */
		public function admin_styles( $hook ) {
			// Bail if admin_styles is empty.
			if ( empty( $this->args->admin_styles ) ) {
				return;
			}

			foreach ( $this->args->admin_styles as $style ) {
				$conditional = ! empty( $style['conditional'] ) ? call_user_func( $style['conditional'] ) : true;

				if ( ! empty( $style['hook'] ) ) {
					if ( $hook !== $style['hook'] ) {
						return;
					}
				}

				if ( $conditional ) {
					$this->enqueue( $style );
				} else {
					continue;
				}
			}
		}

		/**
		 * Enqueue
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @param array $style The style to enqueue.
		 *
		 * @return void
		 */
		public function enqueue( $style ) {

			// Bail if script is empty.
			if ( empty( $style ) ) {
				return;
			}

			$handle    = ! empty( $style['handle'] ) ? $style['handle'] : '';
			$file      = ! empty( $style['file'] ) ? $style['file'] : '';
			$depends   = ! empty( $style['depends'] ) ? $style['depends'] : array();
			$media     = ! empty( $style['media'] ) ? $style['media'] : 'all';
			$file_time = ! empty( $style['file'] ) && file_exists( trailingslashit( constant( NBPL_CONST_PREFIX . '_DIR_PATH' ) ) . $style['file'] ) ? filemtime( trailingslashit( constant( NBPL_CONST_PREFIX . '_DIR_PATH' ) ) . $style['file'] ) : '1.0.0';
			$check     = ! empty( $handle ) && ! empty( $file );

			if ( $check && file_exists( trailingslashit( constant( NBPL_CONST_PREFIX . '_DIR_PATH' ) ) . $file ) ) {
				wp_register_style( constant( NBPL_CONST_PREFIX . '_PREFIX' ) . '-' . $handle, trailingslashit( constant( NBPL_CONST_PREFIX . '_DIR_URL' ) ) . $file, $depends, $file_time, $media );
				wp_enqueue_style( constant( NBPL_CONST_PREFIX . '_PREFIX' ) . '-' . $handle );
			}
		}
	}
}
