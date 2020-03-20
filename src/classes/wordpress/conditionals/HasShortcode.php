<?php
/**
 * Has Shortcode.
 *
 * @package    NBPL
 * @subpackage NBPL/WordPress/Conditionals
 * @author     Jason Witt <info@nuebuild.com>
 * @copyright  Copyright ((c) 2020, Jason Witt
 * @license    GNU General Public License v2 or later
 * @since      1.0.0
 *
 * @version 1.0.5
 */

namespace NBPL\WordPress\Conditionals;

use NBPL\Base;

if ( ! defined( 'WPINC' ) ) {
	wp_die( 'No Access Allowed!', 'Error!', array( 'back_link' => true ) );
}

if ( ! class_exists( __NAMESPACE__ . '\\HasShortcode' ) ) {

	/**
	 * Has Shortcode.
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 */
	class HasShortcode extends Base {

		/**
		 * Shortcodes
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @var string
		 */
		protected $shortcode;

		/**
		 * Post ID
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @var string
		 */
		protected $post_id;

		/**
		 * Initialize the class
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @param string $shortcode (Required) Shortcode(s) to test. Default: ''.
		 * @param string $post_id    (Optional) The post ID. Default: ''.
		 *
		 * @return void
		 */
		public function __construct( $shortcode = '', $post_id = '' ) {
			$this->shortcode = $shortcode;
			$this->post_id   = $post_id;
		}

		/**
		 * Post Has Shortcode
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @return boolean
		 */
		public function post_has_shortcode() {
			$has_shortcode = false;
			$post_id       = $this->post_id;

			// TODO: REMOVE!
			error_log( 'post_id: ' . print_r( $post_id, true ) ); // phpcs:ignore

			if ( empty( $post_id ) ) {
				// TODO: REMOVE!
				error_log( ': ' . print_r( 'Run If', true ) ); // phpcs:ignore
				$post_id = nbpl_get_post_id();
			}

			// Bail if no post ID.
			if ( empty( $post_id ) || '0' === $post_id ) {
				return;
			}

			$content = get_the_content( null, false, $post_id ) ? get_the_content( null, false, $post_id ) : '';

			if ( $content ) {
				if ( has_shortcode( $content, $this->shortcode ) ) {
					$has_shortcode = true;
				}
			}

			return $has_shortcode;
		}
	}
}
