<?php
/**
 * Get Post Data
 *
 * @package    NBPL
 * @subpackage NBPL/WordPress/Posts
 * @author     Jason Witt <info@nuebuild.com>
 * @copyright  Copyright ((c) 2020, Jason Witt
 * @license    GNU General Public License v2 or later
 * @since      1.0.0
 *
 * @version 1.0.5
 */

namespace NBPL\WordPress\Posts;

if ( ! defined( 'WPINC' ) ) {
	wp_die( 'No Access Allowed!', 'Error!', array( 'back_link' => true ) );
}

if ( ! class_exists( __NAMESPACE__ . '\\Post' ) ) {

	/**
	 * Get Post Data
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 */
	class Post {

		/**
		 * Initialize the class
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @return void
		 */
		public function __construct() {}

		/**
		 * Get the Post ID
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @return int
		 */
		public function get_id() {
			global $post, $wp_query;

			$post_id = '';

			if ( ! empty( get_the_ID() ) ) {
				$post_id = (int) get_the_ID();
			} elseif ( ! empty( $post ) ) {
				if ( ! empty( $post->ID ) ) {
					$post_id = $post->ID;
				}
			} elseif ( ! empty( $wp_query ) ) {

				if ( ! empty( $wp_query->post->ID ) ) {
					$post_id = $wp_query->post->ID;
				}

				if ( ! empty( $wp_query->get_queried_object_id() ) ) {
					$post_id = $wp_query->get_queried_object_id();
				}
			} else {
				$scheme  = is_ssl() ? 'http' : 'https';
				$request = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : ''; // phpcs:ignore
				$url     = "$scheme://$_SERVER[HTTP_HOST]$request"; // phpcs:ignore
				$post_id = url_to_postid( $url );
			}

			return $post_id;
		}
	}
}
