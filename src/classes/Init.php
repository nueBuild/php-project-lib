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
 * @version 1.0.5
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
				$project_type_dir = basename( dirname( dirname( $init_args['root_file'] ) ) );
				$project_dir      = basename( dirname( $init_args['root_file'] ) );
				$root_filename    = basename( basename( basename( $init_args['root_file'] ) ) );
				$project_root_url = trailingslashit( WP_CONTENT_URL ) . trailingslashit( $project_type_dir ) . trailingslashit( $project_dir ) . $root_filename;

				$defaults = array(
					'root_dir'         => dirname( $init_args['root_file'] ),
					'root_url'         => $project_root_url,
					'content_dir'      => basename( dirname( dirname( $init_args['root_file'] ) ) ),
					'project_name'     => $this->get_project_name( $init_args ),
					'formatted_prefix' => strtolower( str_replace( array( '-', ' ' ), '_', $this->get_project_name( $init_args ) ) ),
					'allowed_tags'     => true,
				);
			} else {
				$defaults = array(
					'root_dir'     => basename( dirname( $init_args['root_file'] ) ),
					'root_url'     => '',
					'project_name' => '',
				);
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
				if ( ! function_exists( 'get_plugin_data' ) ) {
					require_once ABSPATH . 'wp-admin/includes/plugin.php';
				}

				$plugin_data = function_exists( 'get_plugin_data' ) ? get_plugin_data( $args['root_file'], false ) : '';
				$name        = ! empty( $plugin_data['Name'] ) ? $plugin_data['Name'] : '';
			}

			return $name;
		}
	}
}
