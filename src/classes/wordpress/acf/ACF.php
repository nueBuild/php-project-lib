<?php
/**
 * ACF
 *
 * @package    NBPL
 * @subpackage NBPL/WordPress/ACF
 * @author     Jason Witt <info@nuebuild.com>
 * @copyright  Copyright ((c) 2020, Jason Witt
 * @license    GNU General Public License v2 or later
 * @version    1.0.0
 * @since      1.0.0
 */

namespace NBPL\WordPress\ACF;

use NBPL\Base;

if ( ! defined( 'WPINC' ) ) {
	wp_die( 'No Access Allowed!', 'Error!', array( 'back_link' => true ) );
}

if ( ! class_exists( __NAMESPACE__ . '\\ACF' ) ) {

	/**
	 * ACF.
	 *
	 * @author Jason Witt
	 * @since  Plugin_Boilerplate_Version
	 */
	class ACF {

		/**
		 * Initialize the class
		 *
		 * @author Jason Witt
		 * @since  Plugin_Boilerplate_Version
		 *
		 * @return void
		 */
		public function __construct() {}

		/**
		 * Get Field
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @param array $args {
		 *     The arguments, can be an array or a string of the selector.
		 *
		 *     @type string   $selector     (Required) The ACF field ID. Default ''
		 *     @partypeam int $post_id      (Optional) The post ID. Default ''
		 *     @type string   $format_value (Optional) The type of meta to get. Default true
		 *     @type boolean  $use_acf      (Optional) True to use native ACF get_field(). Default false
		 * }
		 *
		 * @return mixed
		 */
		public static function get_field( $args = array() ) {
			$result = '';

			if ( is_array( $args ) ) {
				$selector     = ! empty( $args['selector'] ) ? $args['selector'] : '';
				$post_id      = ! empty( $args['post_id'] ) ? $args['post_id'] : nbpl_get_post_id();
				$format_value = ! empty( $args['format_value'] ) ? $args['format_value'] : true;
				$use_acf      = ! empty( $args['use_acf'] ) ? $args['use_acf'] : false;
			} else {
				$selector     = ! empty( $args ) ? $args : '';
				$post_id      = '';
				$format_value = true;
				$use_acf      = false;
			}

			// Bail if selector is empty.
			if ( empty( $selector ) ) {
				return $result;
			}

			if ( $use_acf ) {
				$result = get_field( $selector, $post_id, $format_value );
			} else {

				if ( $post_id === 'options' ) {
					$result = get_option( 'options_' . $selector );
				} else {
					$result = get_post_meta( $post_id, $selector, true );
				}

				// Fallback to ACF if results is empty.
				if ( empty( $result ) ) {
					$result = get_field( $selector, $post_id, $format_value );
				}
			}

			if ( empty( $result ) ) {
				$result = false;
			}

			return $result;
		}

		/**
		 * Get Flexible Content
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @param string $selector The ACF field ID.
		 * @param string $field    The flexible content ID.
		 * @param int    $post_id  The post ID.
		 *
		 * @return void
		 */
		public static function get_flexible_content( $selector, $field = '', $post_id = '' ) {
			// Bail if selector or field is empty.
			if ( empty( $selector ) ) {
				return;
			}

			// Try to get the post ID.
			if ( empty( $post_id ) ) {
				$post_id = nbpl_get_post_id();
			}

			// Bail if $post_id is empty.
			if ( empty( $post_id ) ) {
				return;
			}

			$field_args = array(
				'selector'     => $selector,
				'post_id'      => $post_id,
				'format_value' => true,
				'use_acf'      => true,
			);

			$get_field = self::get_field( $field_args );

			if ( empty( $field ) ) {
				return $get_field;
			} else {
				foreach ( $get_field as $entry ) {
					if ( ! empty( $entry[ $field ] ) ) {
						$entry[ $field ]['flexible_type'] = $field;
						return $entry[ $field ];
					}
				}
			}

			return array();
		}

		/**
		 * Is Flexible Type
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @param string $type  The flexible content ID.
		 * @param array  $array The flexible content array.
		 *
		 * @return boolean
		 */
		public static function is_flexible_type( $type, $array ) {
			$field = ! empty( $array['flexible_type'] ) ? $array['flexible_type'] : '';

			if ( empty( $field ) ) {
				return false;
			}

			if ( $type === $field ) {
				return true;
			}

			return false;
		}
	}
}
