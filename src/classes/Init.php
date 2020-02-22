<?php
/**
 * Init
 *
 * @package   NBPL
 * @author    Jason Witt <info@nuebuild.com>
 * @copyright Copyright ((c) 2020, Jason Witt
 * @license   GNU General Public License v2 or later
 * @since     1.0.0
 *
 * @version 1.0.2
 */

namespace NBPL;

use NBPL\General\Formatting\Parse;
use NBPL\WordPress\Formatting\AllowedTags;

if ( ! defined( 'WPINC' ) ) {
	wp_die( 'No Access Allowed!', 'Error!', array( 'back_link' => true ) );
}

if ( ! class_exists( __NAMESPACE__ . '\Init' ) ) {

	/**
	 * Init
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 */
	class Init {

		/**
		 * Args
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @var object
		 */
		protected $init_args;

		/**
		 * Initialize the class
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @param array $args The arguments.
		 *
		 * @return void
		 */
		public function __construct( $args = array() ) {
			$init_defaults   = $this->set_init_defaults( $args );
			$this->init_args = Parse::array_to_object( $args, $init_defaults );

			$this->set_constants();

			// Allowed Tags.
			if ( class_exists( 'WP' ) ) {
				if ( false !== $this->init_args->allowed_tags ) {
					$allowed_tags = new AllowedTags();
					$allowed_tags->allowed();
				}
			}
		}

		/**
		 * Set Defaults
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @param array $init_args The arguments.
		 *
		 * @throws \Exception If arguments aren't set.
		 *
		 * @return array
		 */
		public function set_init_defaults( $init_args = array() ) {
			$defaults = array();

			if ( empty( $init_args ) ) {
				return;
			}

			if ( class_exists( 'WP' ) ) {
				$defaults = array(
					'root_dir'         => dirname( $init_args['root_file'] ),
					'root_url'         => function_exists( 'get_stylesheet_directory_uri' ) ? get_stylesheet_directory_uri() : '',
					'content_dir'      => basename( dirname( dirname( $init_args['root_file'] ) ) ),
					'project_name'     => $this->get_project_name( $init_args ),
					'formatted_prefix' => strtolower( str_replace( array( '-', ' ' ), '_', $this->get_project_name( $init_args ) ) ),
					'allowed_tags'     => true,
				);

				$defaults['constant_prefix'] = ! empty( $defaults['formatted_prefix'] ) ? strtoupper( $defaults['formatted_prefix'] ) : '';
			} else {
				$defaults = array(
					'root_dir'     => basename( dirname( $init_args['root_file'] ) ),
					'root_url'     => '',
					'project_name' => '',
				);

				$defaults['formatted_prefix'] = ! empty( $defaults['project_name'] ) ? strtolower( str_replace( array( '-', ' ' ), '_', $defaults['project_name'] ) ) : '';
				$defaults['constant_prefix']  = ! empty( $defaults['formatted_prefix'] ) ? strtoupper( $defaults['formatted_prefix'] ) : '';
			}

			try {
				if ( empty( $defaults['root_dir'] ) ) {
					throw new \Exception( 'No Root Directory is set. Please check you configuration.' );
				}

				if ( empty( $defaults['root_url'] ) ) {
					throw new \Exception( 'No root URL is set. Please check you configuration.' );
				}

				if ( empty( $defaults['project_name'] ) ) {
					throw new \Exception( 'No Project Name is set. Please check you configuration.' );
				}
			} catch ( \Exception $e ) {
				echo 'Warning!: ' . $e->getMessage(); // phpcs:ignore
				die();
			}

			return $defaults;
		}

		/**
		 * Set Constants
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @return void
		 */
		public function set_constants() {
			if ( ! defined( 'NBPL_CONST_PREFIX' ) ) {
				define( 'NBPL_CONST_PREFIX', 'NBPL_' . $this->init_args->constant_prefix );
			}

			if ( ! defined( 'NBPL_' . $this->init_args->constant_prefix . '_DIR_PATH' ) ) {
				define( 'NBPL_' . $this->init_args->constant_prefix . '_DIR_PATH', $this->init_args->root_dir . '/' );
			}

			if ( ! defined( 'NBPL_' . $this->init_args->constant_prefix . '_DIR_URL' ) ) {
				define( 'NBPL_' . $this->init_args->constant_prefix . '_DIR_URL', $this->init_args->root_url . '/' );
			}

			if ( ! defined( 'NBPL_' . $this->init_args->constant_prefix . '_PREFIX' ) ) {
				define( 'NBPL_' . $this->init_args->constant_prefix . '_PREFIX', $this->init_args->formatted_prefix );
			}
		}

		/**
		 * Get Project Name
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @param array $args The arguments.
		 *
		 * @return string
		 */
		public function get_project_name( $args ) {
			$content_dir = basename( dirname( dirname( $args['root_file'] ) ) );
			$name        = '';

			if ( 'themes' === $content_dir ) {
				$theme_data = function_exists( 'wp_get_theme' ) ? wp_get_theme() : '';
				$name       = $theme_data->get( 'Name' );
			} elseif ( 'plugins' === $content_dir ) {
				$plugin_data = function_exists( 'get_plugin_data ' ) ? get_plugin_data( args['dir_path'] ) : '';
				$name        = $plugin_data['Name'];
			}

			return $name;
		}
	}
}
