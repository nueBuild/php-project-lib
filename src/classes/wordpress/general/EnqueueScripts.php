<?php
/**
 * Enqueue Scripts.
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

if ( ! class_exists( __NAMESPACE__ . '\\EnqueueScripts' ) ) {

	/**
	 * Enqueue Scripts.
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 */
	class EnqueueScripts extends Base {

		/**
		 * Initialize the class
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
				'scripts'         => array(
					'handle'      => '',
					'file'        => '',
					'depends'     => array(),
					'in_footer'   => true,
					'conditional' => '',
				),
				'admin_scripts'   => array(
					'handle'      => '',
					'file'        => '',
					'depends'     => array(),
					'in_footer'   => true,
					'hook'        => '',
					'conditional' => '',
				),
				'localized'       => array(
					'handle'      => '',
					'name'        => '',
					'data'        => '',
					'conditional' => '',
				),
				'admin_localized' => array(
					'handle'      => '',
					'name'        => '',
					'data'        => '',
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
			add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'localized_scripts' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'localized_admin_scripts' ) );
		}

		/**
		 * Enqueue Scripts.
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @return void
		 */
		public function scripts() {
			// Bail if scripts is empty.
			if ( empty( $this->args->scripts ) ) {
				return;
			}

			foreach ( $this->args->scripts as $script ) {
				$conditional = ! empty( $script['conditional'] ) ? call_user_func( $script['conditional'] ) : true;

				if ( $conditional ) {
					$this->enqueue( $script );
				} else {
					continue;
				}
			}
		}

		/**
		 * Enqueue Admin Scripts.
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @param string $hook The admin page hook.
		 *
		 * @return void
		 */
		public function admin_scripts( $hook ) {
			// Bail if admin_scripts is empty.
			if ( empty( $this->args->admin_scripts ) ) {
				return;
			}

			foreach ( $this->args->admin_scripts as $script ) {
				$conditional = ! empty( $script['conditional'] ) ? call_user_func( $script['conditional'] ) : true;

				if ( ! empty( $script['hook'] ) ) {
					if ( $hook !== $script['hook'] ) {
						return;
					}
				}

				if ( $conditional ) {
					$this->enqueue( $script );
				} else {
					continue;
				}
			}
		}

		/**
		 * Localized Scipts
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @return void
		 */
		public function localized_scripts() {
			// Bail if localized is empty.
			if ( empty( $this->args->localized ) ) {
				return;
			}

			foreach ( $this->args->localized as $script ) {
				$conditional = ! empty( $script['conditional'] ) ? call_user_func( $script['conditional'] ) : true;

				if ( $conditional ) {
					$this->print_localized( $script );
				} else {
					continue;
				}
			}
		}

		/**
		 * Localized Admin Scipts
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @return void
		 */
		public function localized_admin_scripts() {
			// Bail if admin_localized is empty.
			if ( empty( $this->args->admin_localized ) ) {
				return;
			}

			foreach ( $this->args->admin_localized as $script ) {
				$conditional = ! empty( $script['conditional'] ) ? call_user_func( $script['conditional'] ) : true;

				if ( $conditional ) {
					$this->print_localized( $script );
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
		 * @param array $script The script to enqueue.
		 *
		 * @return void
		 */
		public function enqueue( $script ) {

			// Bail if script is empty.
			if ( empty( $script ) ) {
				return;
			}

			$handle    = ! empty( $script['handle'] ) ? $script['handle'] : '';
			$file      = ! empty( $script['file'] ) ? $script['file'] : '';
			$depends   = ! empty( $script['depends'] ) ? $script['depends'] : array();
			$file_time = ! empty( $script['file'] ) && file_exists( trailingslashit( constant( NBPL_CONST_PREFIX . '_DIR_PATH' ) ) . $script['file'] ) ? filemtime( trailingslashit( constant( NBPL_CONST_PREFIX . '_DIR_PATH' ) ) . $script['file'] ) : '1.0.0';
			$in_footer = ! empty( $script['in_footer'] ) ? $script['in_footer'] : true;
			$check     = ! empty( $handle ) && ! empty( $file );

			if ( $check && file_exists( trailingslashit( constant( NBPL_CONST_PREFIX . '_DIR_PATH' ) ) . $file ) ) {
				wp_register_script( constant( NBPL_CONST_PREFIX . '_PREFIX' ) . '-' . $handle, trailingslashit( constant( NBPL_CONST_PREFIX . '_DIR_URL' ) ) . $file, $depends, $file_time, $in_footer );
				wp_enqueue_script( constant( NBPL_CONST_PREFIX . '_PREFIX' ) . '-' . $handle );
			}
		}

		/**
		 * Enqueue localized scripts
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @param object $script The localized script data.
		 *
		 * @return void
		 */
		public function print_localized( $script ) {
			// Bail if script is empty.
			if ( empty( $script ) ) {
				return;
			}

			$handle = ! empty( $script['handle'] ) ? $script['handle'] : '';
			$name   = ! empty( $script['name'] ) ? $script['name'] : '';
			$data   = ! empty( $script['data'] ) ? $script['data'] : array();
			$check  = ! empty( $handle ) && ! empty( $name ) && ! empty( $data );

			if ( $check ) {
				wp_localize_script( $handle, $name, $data );
			}
		}

	}
}
